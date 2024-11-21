<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSoftwareRequest;
use App\Http\Requests\UpdateSoftwareRequest;
use App\Models\CustomLog;
use App\Models\Software;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Models\RequisitoSoftware;

class SoftwareController extends Controller
{
    protected $custom_log;

    public function __construct(CustomLog $custom_log)
    {
        $this->custom_log = $custom_log;
    }

    public function index(Request $request)
    {
        try {
            $search = $request->input('search');
            if ($search) {
                $softwares = Software::where('nome', 'like', "%$search%")
                    ->orWhere('descricao', 'like', "%$search%")
                    ->orWhere('peso', 'like', "%$search%")
                    ->with('requisitos')
                    ->get();
            } else {
                $softwares = Software::with('requisitos')->get();
            }
        } catch (\Exception $e) {
            Log::warning('Ocorreu o seguinte erro ao listar Software: ' . $e->getMessage());
            $softwares = []; // Definindo $softwares como vazio caso ocorra erro
        }
        return view('softwares.index', [
            'softwares' => $softwares,
            'search' => $search ?? ''
        ]);
    }

    public function create()
    {
        return view('softwares.createSoftware');
    }

    public function show(Request $request)
    {
        $search = $request->input('search');
        $results = Software::where('nome', 'like', "%$search%")
            ->orWhere('descricao', 'like', "%$search%")
            ->orWhere('peso', 'like', "%$search%")
            ->get();

        return view('softwares.searchSoftware', compact('results'));
    }

    public function store(StoreSoftwareRequest $request)
    {
        try {
            // Verifica se uma imagem foi enviada
            if ($request->hasFile('software_imagem')) {
                // Armazena a imagem na pasta 'public/images'
                $imagemPath = $request->file('software_imagem')->store('images', 'public');

                // Cria um novo registro no banco de dados para o software
                $software = Software::create([
                    'tipo' => $request->input('tipo'),
                    'nome' => $request->input('nome'),
                    'descricao' => $request->input('descricao'),
                    'peso' => $request->input('peso'),
                    'imagem' => $imagemPath, // Salva o caminho da imagem
                ]);

                // Log de criação do software
                $this->custom_log->create([
                    'descricao' => 'Software criado: ' . $software->nome,
                    'operacao' => 'create',
                    'admin_id' => auth()->guard('admin')->id(),
                ]);

                // Se o software foi criado com sucesso, cria os requisitos
                if ($software) {
                    $requisitos = [
                        [
                            'software_id' => $software->id,
                            'requisito_nivel' => 'Minimo',
                            'cpu' => $request->input('cpu_min'),
                            'gpu' => $request->input('gpu_min'),
                            'ram' => $request->input('ram_min'),
                            'placa_mae' => $request->input('placa_mae_min'),
                            'ssd' => $request->input('ssd_min'),
                            'cooler' => $request->input('cooler_min'),
                            'fonte' => $request->input('fonte_min')
                        ],
                        [
                            'software_id' => $software->id,
                            'requisito_nivel' => 'Medio',
                            'cpu' => $request->input('cpu_med'),
                            'gpu' => $request->input('gpu_med'),
                            'ram' => $request->input('ram_med'),
                            'placa_mae' => $request->input('placa_mae_med'),
                            'ssd' => $request->input('ssd_med'),
                            'cooler' => $request->input('cooler_med'),
                            'fonte' => $request->input('fonte_med')
                        ],
                        [
                            'software_id' => $software->id,
                            'requisito_nivel' => 'Recomendado',
                            'cpu' => $request->input('cpu_rec'),
                            'gpu' => $request->input('gpu_rec'),
                            'ram' => $request->input('ram_rec'),
                            'placa_mae' => $request->input('placa_mae_rec'),
                            'ssd' => $request->input('ssd_rec'),
                            'cooler' => $request->input('cooler_rec'),
                            'fonte' => $request->input('fonte_rec')
                        ],
                    ];


                    // Insere os requisitos no banco de dados
                    foreach ($requisitos as $requisito) {
                        RequisitoSoftware::create($requisito);
                    }

                    return redirect()->route('softwares.index')->with('success', 'Software cadastrado com sucesso!');
                }
            } else {
                return back()->withErrors(['message' => 'Imagem obrigatória para o cadastro.']);
            }

        } catch (\Exception $e) {
            // Em caso de erro, registra no log e retorna mensagem de erro
            Log::error('Erro ao salvar o software: ' . $e->getMessage());
            return back()->withErrors(['message' => 'Erro ao salvar o software.']);
        }
    }

    public function edit($id)
    {
        try {
            $software = Software::findOrFail($id);
            Log::alert('Acessou para editar Software: ' . $id);

            // Busca os requisitos de hardware relacionados
            $requisitos = [
                'Minimo' => RequisitoSoftware::where('software_id', $software->id)->where('requisito_nivel', 'Minimo')->first(),
                'Medio' => RequisitoSoftware::where('software_id', $software->id)->where('requisito_nivel', 'Medio')->first(),
                'Recomendado' => RequisitoSoftware::where('software_id', $software->id)->where('requisito_nivel', 'Recomendado')->first()
            ];

            return view('softwares.editSoftware', compact('software', 'requisitos'));

        } catch (\Exception $e) {
            // Registra log personalizado em caso de erro
            $this->custom_log->create([
                'descricao' => $e->getMessage(),
                'operacao' => 'edit',
                'admin_id' => auth()->guard('admin')->id(), // Pega o ID do usuário autenticado ou '1' como fallback
            ]);

            return redirect()->route('softwares.index')->with('error', 'Erro ao acessar o software para edição.');
        }
    }

    public function update(UpdateSoftwareRequest $request, $id)
    {
        // Busca o registro do software pelo ID
        $software = Software::findOrFail($id);
        $oldData = $software->toArray(); // Captura os dados antigos antes da atualização

        // Log da alteração de imagem
        if ($request->has('remover_imagem') && $software->imagem) {
            // Remove a imagem do diretório 'public/storage'
            Storage::disk('public')->delete($software->imagem);
            // Remove o caminho da imagem do banco de dados
            $software->imagem = null;
        }

        // Verifica se uma nova imagem foi enviada
        if ($request->hasFile('software_imagem')) {
            // Remove a imagem antiga se existir
            if ($software->imagem) {
                Storage::disk('public')->delete($software->imagem);
            }

            // Armazena a nova imagem
            $imagemPath = $request->file('software_imagem')->store('images', 'public');

            // Atualiza o caminho da imagem no banco de dados
            $software->imagem = $imagemPath;
        }

        // Atualiza os demais campos
        $software->nome = $request->input('nome');
        $software->tipo = $request->input('tipo');
        $software->descricao = $request->input('descricao');
        $software->peso = $request->input('peso');

        // Salva as alterações no banco de dados
        $software->save();

        // Log de alterações
        $newData = $software->toArray();
        $this->logChanges($oldData, $newData, 'update', $software->id);

        // Requisitos
        $requisitos = [
            'Minimo' => [
                'cpu' => $request->input('cpu_min'),
                'gpu' => $request->input('gpu_min'),
                'ram' => $request->input('ram_min'),
                'placa_mae' => $request->input('placa_mae_min'),
                'ssd' => $request->input('ssd_min'),
                'cooler' => $request->input('cooler_min'),
                'fonte' => $request->input('fonte_min')
            ],
            'Medio' => [
                'cpu' => $request->input('cpu_med'),
                'gpu' => $request->input('gpu_med'),
                'ram' => $request->input('ram_med'),
                'placa_mae' => $request->input('placa_mae_med'),
                'ssd' => $request->input('ssd_med'),
                'cooler' => $request->input('cooler_med'),
                'fonte' => $request->input('fonte_med')
            ],
            'Recomendado' => [
                'cpu' => $request->input('cpu_rec'),
                'gpu' => $request->input('gpu_rec'),
                'ram' => $request->input('ram_rec'),
                'placa_mae' => $request->input('placa_mae_rec'),
                'ssd' => $request->input('ssd_rec'),
                'cooler' => $request->input('cooler_rec'),
                'fonte' => $request->input('fonte_rec')
            ],
        ];

        // Atualiza ou cria os requisitos no banco de dados
        foreach ($requisitos as $nivel => $requisito) {
            // Busca o requisito atual no banco de dados
            $oldRequisito = RequisitoSoftware::where('software_id', $software->id)
                ->where('requisito_nivel', $nivel)
                ->first();

            // Atualiza ou cria os requisitos
            $updatedRequisito = RequisitoSoftware::updateOrCreate(
                ['software_id' => $software->id, 'requisito_nivel' => $nivel],
                $requisito
            );

            Log::info('Requisito atualizado ou criado', ['requisito' => $updatedRequisito->toArray()]);

            // Se o requisito já existia, loga as alterações
            if ($oldRequisito) {
                $this->logChanges($oldRequisito->toArray(), $requisito, 'update_requisito', $oldRequisito->id);
            }
        }

        return redirect()->route('softwares.index')->with('success', 'Software atualizado com sucesso!');
    }

    public function destroy($id)
    {
        try {
            $software = Software::findOrFail($id);
            $softwareName = $software->nome;

            // Remove os requisitos relacionados
            RequisitoSoftware::where('software_id', $id)->delete();

            // Remove o software
            $software->delete();

            // Log da exclusão
            $this->custom_log->create([
                'descricao' => 'Software excluído: ' . $softwareName,
                'operacao' => 'Deletar',
                'admin_id' => auth()->guard('admin')->id(),
            ]);

            return redirect()->route('softwares.index')->with('success', 'Software excluído com sucesso!');
        } catch (\Exception $e) {
            Log::error('Erro ao excluir o software: ' . $e->getMessage());
            return back()->withErrors(['message' => 'Erro ao excluir o software.']);
        }
    }

    private function logChanges($oldData, $newData, $operacao, $softwareId = null)
    {
        $logs = [];

        // Remover campos indesejados dos dados
        unset($oldData['updated_at'], $newData['updated_at']);

        foreach ($newData as $key => $value) {
            if (array_key_exists($key, $oldData) && $oldData[$key] != $value) {
                // Monta a string no formato: "campo: De: X, Para: Y"
                $logs[] = "$key: De: {$oldData[$key]}, Para: $value";
            }
        }

        if (!empty($logs)) {
            // Concatena os logs em uma única string
            $descricao = implode("; ", $logs);

            // Grava o log no banco de dados
            $this->custom_log->create([
                'descricao'   => $descricao,
                'operacao'    => $operacao,
                'admin_id'    => auth()->guard('admin')->id(),
                'software_id' => $softwareId,
            ]);
        }
    }
}
