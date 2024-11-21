<?php

namespace App\Http\Controllers;

use App\Models\CustomLog;
use App\Models\Estoque;
use App\Models\LojaOnline;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProdutoController extends Controller
{
    protected $custom_log;

    public function __construct(CustomLog $custom_log)
    {
        $this->custom_log = $custom_log;
    }

    public function index()
    {
        try {
            $produtos = Produto::with('lojaOnline')->paginate(10000);
        } catch (\Exception $e) {
            Log::warning('Ocorreu o seguinte erro ao listar Software: ' . $e->getMessage());
            $produtos = [];
        }
        // Renderiza a view com os produtos
        return view('produtos.index', ['produtos' => $produtos]);
    }

    public function create()
    {
        return view('produtos.createProduto');
    }

    public function store(Request $request)
    {
        // Validações dos campos obrigatórios
        $request->validate([
            'nome' => 'required',
            'preco_valor' => 'required',
            'preco_moeda' => 'required',
            'urlLojaOnline' => 'required',
            'disponibilidade' => 'required',
        ]);

        try {
            // Verifica se há um admin autenticado
            if (!auth()->guard('admin')->check()) {
                throw new \Exception('Nenhum administrador autenticado para criar o produto.');
            }

            // Criação do registro na tabela LojaOnline
            $lojaOnline = LojaOnline::create([
                'valor' => $request->input('preco_valor'),
                'moeda' => $request->input('preco_moeda'),
                'urlLoja' => $request->input('urlLojaOnline'),
            ]);

            // Criação do produto
            $produto = Produto::create([
                'nome' => $request->input('nome'),
                'disponibilidade' => $request->input('disponibilidade'),
                'loja_online_id' => $lojaOnline->id,
            ]);

            // Se o produto estiver disponível, crie um registro no estoque
            if ($produto->disponibilidade == 1) {
                Estoque::create(['produto_id' => $produto->id]);
            }

            // Cria o log com o admin_id do administrador autenticado
            $this->custom_log->create([
                'descricao' => "Produto criado: {$produto->nome}",
                'operacao' => 'create',
                'admin_id' => auth()->guard('admin')->id(),
            ]);
            // Redireciona com sucesso
            return redirect()->route('produtos.index')->with('success', 'Produto criado com sucesso!');
        } catch (\Exception $e) {
            // Log de erro com o admin_id do administrador autenticado
            if (auth()->guard('admin')->check()) {
                $this->custom_log->create([
                    'descricao' => $e->getMessage(),
                    'operacao' => 'store',
                    'admin_id' => auth()->guard('admin')->id(),
                ]);
            }
            // Retorna com erro caso ocorra falha
            return back()->withErrors('Erro ao criar o produto.');
        }
    }


    public function show(Request $request)
    {
        $search = $request->input('search');

        $results = Produto::where(function($query) use ($search) {
            $query->where('id', 'like', "%$search%")
                ->orWhere('nome', 'like', "%$search%");
        })
            ->orWhereHas('lojaOnline', function($query) use ($search) {
                $query->where('urlLoja', 'like', "%$search%")
                    ->orWhere('valor', 'like', "%$search%")
                    ->orWhere('moeda', 'like', "%$search%");
            })
            ->paginate(10)->appends(['search' => $search]);

        return view('produtos.searchProduto', compact('results'));
    }

    public function edit($id)
    {
        try {
            $produto = Produto::with('lojaOnline')->findOrFail($id);
            return view('produtos.editProduto', compact('produto'));
        } catch (\Exception $e) {
            $this->custom_log->create([
                'descricao' => $e->getMessage(),
                'operacao' => 'edit',
                'admin_id' => auth()->guard('admin')->id(),
            ]);

            return redirect()->route('produtos.index')->withErrors('Erro ao acessar o produto para edição.');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $produto = Produto::findOrFail($id);
            $oldValues = $produto->getAttributes();

            $produto->update($request->all());
            $newValues = $produto->getAttributes();
            $this->logChanges($oldValues, $newValues, 'update', $id);

            $lojaOnline = LojaOnline::find($produto->loja_online_id);
            $oldLojaValues = $lojaOnline->getAttributes();

            $lojaOnline->update([
                'urlLoja' => $request->input('urlLojaOnline'),
                'valor' => $request->input('preco_valor'),
                'moeda' => $request->input('preco_moeda'),
            ]);

            $newLojaValues = $lojaOnline->getAttributes();
            $this->logChanges($oldLojaValues, $newLojaValues, 'update', $id, 'loja online');

            $this->updateEstoque($produto);

            return redirect()->route('produtos.index')->with('success', 'Produto atualizado com sucesso!');
        } catch (\Exception $e) {
            $this->custom_log->create([
                'descricao' => $e->getMessage(),
                'operacao' => 'update',
                'admin_id' => auth()->guard('admin')->id(),
            ]);

            return back()->withErrors('Erro ao atualizar o produto.');
        }
    }

    public function destroy($id)
    {
        try {
            $produto = Produto::findOrFail($id);

            // Excluir a loja online associada
            $produto->lojaOnline()->delete();

            // Excluir o produto
            $produto->delete();

            $this->custom_log->create([
                'descricao' => "Produto excluído: {$produto->nome}",
                'operacao' => 'destroy',
                'admin_id' => auth()->guard('admin')->id(),
            ]);

            return redirect()->route('produtos.index')->with('success', 'Produto excluído com sucesso!');
        } catch (\Exception $e) {
            $this->custom_log->create([
                'descricao' => $e->getMessage(),
                'operacao' => 'destroy',
                'admin_id' => auth()->guard('admin')->id()
            ]);

            return back()->withErrors('Erro ao excluir o produto.');
        }
    }

    private function logChanges($oldValues, $newValues, $operation, $id, $entity = 'produto')
    {
        $logs = [];

        // Itera sobre os novos valores para detectar mudanças
        foreach ($newValues as $key => $newValue) {
            if (
                $key !== 'updated_at' && // Ignora a coluna updated_at
                array_key_exists($key, $oldValues) &&
                $oldValues[$key] != $newValue
            ) {
                // Formata a mudança no estilo desejado
                $logs[] = "$key: De: {$oldValues[$key]}, Para: $newValue";
            }
        }

        if (!empty($logs)) {
            // Junta todas as mudanças em uma string separada por "; "
            $descricao = implode("; ", $logs);

            // Grava o log formatado no banco de dados
            $this->custom_log->create([
                'descricao'  => "ID: $id, Entidade: $entity, Mudanças: $descricao",
                'operacao'   => $operation,
                'admin_id'   => auth()->guard('admin')->id(),
            ]);
        }
    }

    private function updateEstoque($produto)
    {
        if ($produto->disponibilidade == 1) {
            Estoque::firstOrCreate(['produto_id' => $produto->id]);
        } else {
            Estoque::where('produto_id', $produto->id)->delete();
        }
    }
}
