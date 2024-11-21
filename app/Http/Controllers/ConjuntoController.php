<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Estoque;
use App\Models\GeminiLog;
use App\Models\Produto;
use App\Models\Conjunto;
use App\Models\Software;
use App\Services\GeminiAPIService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ConjuntoController extends Controller
{
    protected $geminiAPIService;

    public function __construct(GeminiAPIService $geminiAPIService)
    {
        $this->geminiAPIService = $geminiAPIService;
    }

    public function create()
    {
        // Obtem todos os softwares
        $softwares = Software::all();

        // Verifica se o usuário está logado
        if (Auth::check()) {
            // Se o usuário estiver autenticado, renderiza a view do dashboard
            return view('dashboard', compact('softwares'));
        }

        // Se o usuário não estiver autenticado, renderiza a view da home
        return view('home', compact('softwares'));
    }



    public function selecionar(Request $request)
    {
        $softwaresSelecionados = $this->obterSoftwaresSelecionados($request);
        $produtos = $this->obterTodosProdutos();
        $user = auth()->user();

        do {
            DB::beginTransaction();

            try {
                $produtoNaoEncontrado = false;
                $conjuntos = [];

                Log::info("Chamando Gemini API para recomendações...");
                $recommendations = $this->geminiAPIService->getRecommendations($softwaresSelecionados, $produtos);
                Log::info("Recomendações obtidas: ", $recommendations);

                foreach ($recommendations['desktops'] as $desktop) {
                    $categoria = $this->buscarCategoriaPorId($desktop['categoria']);

                    if (!$categoria) {
                        Log::warning("Categoria não encontrada para o ID: {$desktop['categoria']}");
                        $produtoNaoEncontrado = true;
                        break;
                    }

                    $conjunto = $this->criarConjunto($categoria, $user);

                    if (!$this->associarProdutosAoConjunto($conjunto, $desktop['componentes'])) {
                        $produtoNaoEncontrado = true;
                        break;
                    }

                    $this->associarSoftwaresAoConjunto($conjunto, $softwaresSelecionados);

                    $componentesDetalhados = [];
                    foreach ($desktop['componentes'] as $componenteNome => $detalhes) {
                        $componentesDetalhados[$componenteNome] = [
                            'nome' => $detalhes['nome'],
                            'preco' => $detalhes['preco'],
                            'url' => $detalhes['url']
                        ];
                    }

                    $conjuntos[] = [
                        'categoria' => $categoria->nome,
                        'componentes' => $componentesDetalhados,
                        'total' => $desktop['total']
                    ];
                }

                if (!$produtoNaoEncontrado) {
                    DB::commit();
                    return view('conjuntos', compact('conjuntos'));
                } else {
                    DB::rollBack();
                }

            } catch (\Exception $e) {
                DB::rollBack();

                GeminiLog::create([
                    'descricao' => 'Erro na comunicação com a API do Gemini: ' . $e->getMessage(),
                    'operacao' => 'getRecommendations',
                    'status' => 'erro',
                    'user_id' => auth()->id(),
                ]);

                Log::error("Erro ao processar: " . $e->getMessage());

                // Redireciona para a rota dashboard com uma mensagem de erro
                return redirect()->route('dashboard')->with('error', 'Erro ao processar a seleção. Por favor, tente novamente.');
            }

        } while ($produtoNaoEncontrado);
    }



    public function obterSoftwaresSelecionados(Request $request)
    {
        return Software::find($request->input('softwares'))->toArray();
    }

    public function obterTodosProdutos()
    {
        return Produto::whereHas('estoque')->get()->toArray();
    }

    public function buscarCategoriaPorId($categoryId)
    {
        return Categoria::find($categoryId);
    }

    public function criarConjunto(Categoria $categoria, $user)
    {
        try {
            $conjunto = $user->conjuntos()->create([
                'nome' => 'Conjunto ' . ucfirst($categoria->nome),
                'categoria_id' => $categoria->id,
            ]);

            GeminiLog::create([
                'descricao' => 'Conjunto criado com sucesso',
                'operacao' => 'criarConjunto',
                'status' => 'sucesso',
                'user_id' => $user->id,
            ]);

            return $conjunto;

        } catch (\Exception $e) {
            GeminiLog::create([
                'descricao' => 'Erro ao criar conjunto: ' . $e->getMessage(),
                'operacao' => 'criarConjunto',
                'status' => 'erro',
                'user_id' => $user->id,
            ]);
            throw $e;
        }
    }

    public function associarProdutosAoConjunto(Conjunto $conjunto, array $componentes)
    {
        try {
            foreach ($componentes as $componentDetails) {
                $productId = $this->geminiAPIService->findProductIdBySimilarity($componentDetails['nome']);

                if ($productId) {
                    $conjunto->produtos()->attach($productId);

                    $produto = Produto::find($productId);
                    $lojaOnline = $produto->lojaOnline;

                    if ($lojaOnline && $lojaOnline->valor) {
                        $preco = $lojaOnline->valor;
                        $this->salvarConjuntoHistorico($productId, $preco, $conjunto->id);
                    } else {
                        Log::warning("Preço não encontrado para o produto ID: $productId na loja online.");
                    }
                } else {
                    GeminiLog::create([
                        'descricao' => "Produto {$componentDetails['nome']} não encontrado para associação ao conjunto",
                        'operacao' => 'associarProdutosAoConjunto',
                        'status' => 'erro',
                        'user_id' => auth()->id(),
                    ]);
                    return false;
                }
            }

            GeminiLog::create([
                'descricao' => "Produtos associados com sucesso ao conjunto ID: {$conjunto->id}",
                'operacao' => 'associarProdutosAoConjunto',
                'status' => 'sucesso',
                'user_id' => auth()->id(),
            ]);

            return true;
        } catch (\Exception $e) {
            GeminiLog::create([
                'descricao' => 'Erro ao associar produtos ao conjunto: ' . $e->getMessage(),
                'operacao' => 'associarProdutosAoConjunto',
                'status' => 'erro',
                'user_id' => auth()->id(),
            ]);
            throw $e;
        }
    }

    public function associarSoftwaresAoConjunto(Conjunto $conjunto, array $softwaresSelecionados)
    {
        try {
            foreach ($softwaresSelecionados as $softwareSelecionado) {
                $conjunto->softwares()->attach($softwareSelecionado['id']);
            }

            GeminiLog::create([
                'descricao' => "Softwares associados com sucesso ao conjunto ID: {$conjunto->id}",
                'operacao' => 'associarSoftwaresAoConjunto',
                'status' => 'sucesso',
                'user_id' => auth()->id(),
            ]);

        } catch (\Exception $e) {
            GeminiLog::create([
                'descricao' => 'Erro ao associar softwares ao conjunto: ' . $e->getMessage(),
                'operacao' => 'associarSoftwaresAoConjunto',
                'status' => 'erro',
                'user_id' => auth()->id(),
            ]);
            throw $e;
        }
    }

    public function historicoConjuntos()
    {
        $userId = auth()->id(); // Obter o ID do usuário autenticado

        // Buscar todos os conjuntos do usuário específico SEM filtrar por nome
        $conjuntos = Conjunto::where('user_id', $userId)
            ->orderBy('created_at', 'asc') // Ordenar por data de criação
            ->with(['produtos.lojaOnline', 'softwares']) // Carregar produtos com suas lojas online e softwares relacionados
            ->get();

        // Agrupar os conjuntos pela data de criação
        $agrupadosPorData = $conjuntos->groupBy(function ($conjunto) {
            return $conjunto->created_at->format('Y-m-d H:i:s'); // Agrupar por data de criação completa
        });

        // Preparar o histórico
        $historico = [];

        foreach ($agrupadosPorData as $data => $conjuntosPorData) {
            $historicoPorData = [
                'data' => $data,
                'conjuntos' => [],
            ];

            foreach ($conjuntosPorData as $conjunto) {
                // Pegar os IDs dos produtos do conjunto atual
                $produtoIds = $conjunto->produtos->pluck('id');

                // Calcular o total dos valores mais recentes dos produtos no conjunto específico (com base no conjunto_id)
                $totalConjunto = DB::table('conjunto_historicos')
                    ->where('conjunto_id', $conjunto->id) // Filtrar pelo conjunto atual
                    ->whereIn('produto_id', $produtoIds) // Somente os produtos relacionados ao conjunto
                    ->sum('valor'); // Somar os valores

                // Adicionar o conjunto ao histórico por data
                $historicoPorData['conjuntos'][] = [
                    'id' => $conjunto->id,
                    'nome' => $conjunto->nome,
                    'categoria' => $conjunto->categoria_id,
                    'total' => $totalConjunto, // Adiciona o total calculado
                    'produtos' => $conjunto->produtos->map(function ($produto) use ($conjunto) {
                        // Busca o valor específico do produto no conjunto_historicos
                        $valorProduto = DB::table('conjunto_historicos')
                            ->where('conjunto_id', $conjunto->id)
                            ->where('produto_id', $produto->id)
                            ->value('valor'); // Pega o valor específico do produto

                        return [
                            'id' => $produto->id,
                            'nome' => $produto->nome,
                            'url' => $produto->lojaOnline->urlLoja ?? 'URL não disponível', // Adiciona a URL da loja online
                            'valor' => $valorProduto, // Adiciona o valor específico do produto
                        ];
                    }),
                    'softwares' => $conjunto->softwares->map(function ($software) {
                        return [
                            'id' => $software->id,
                            'nome' => $software->nome,
                            'descricao' => $software->descricao,
                            'requisitos' => $software->requisitos->map(function ($requisito) {
                                return [
                                    'nivel' => $requisito->requisito_nivel,
                                    'cpu' => $requisito->cpu,
                                    'gpu' => $requisito->gpu,
                                    'ram' => $requisito->ram,
                                    'placa_mae' => $requisito->placa_mae,
                                    'ssd' => $requisito->ssd,
                                    'cooler' => $requisito->cooler,
                                    'fonte' => $requisito->fonte,
                                ];
                            }),
                        ];
                    }),
                ];
            }


            // Adicionar o histórico do conjunto por data à lista geral
            $historico[] = $historicoPorData;

        }

        // Retornar o histórico em formato JSON
        /*return response()->json([
            'historico' => $historico,
        ]);*/

        return view('historico', [
            'historico' => $historico,
        ]);
    }

    public function salvarConjuntoHistorico($produtoId, $valor, $conjuntoId)
    {
        // Verifica se o produto, o valor e o conjunto_id são válidos
        if ($produtoId && $valor && $conjuntoId) {
            // Insere um registro na tabela conjunto_historicos
            DB::table('conjunto_historicos')->insert([
                'produto_id' => $produtoId,
                'conjunto_id' => $conjuntoId,  // Adiciona o conjunto_id
                'valor' => $valor,
                'created_at' => now(),
            ]);
        } else {
            Log::warning("Produto ID, valor ou conjunto ID inválidos ao salvar no histórico.");
        }
    }

}
