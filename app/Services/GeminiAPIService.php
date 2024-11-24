<?php
namespace App\Services;

use App\Models\GeminiLog;
use App\Models\LojaOnline;
use App\Models\Produto;
use Illuminate\Support\Facades\Log;


class GeminiAPIService
{
    protected $apiKey;
    protected $apiUrl;

    public function __construct()
    {
        $this->apiKey = config('services.gemini.api_key');
        $this->apiUrl = config('services.gemini.api_url');

    }

    public function getRecommendations(array $softwares)
    {
        $prompt = $this->generatePrompt($softwares);

        try {
            $client = \Gemini::client($this->apiKey);
            $response = $client->geminiPro()->generateContent($prompt);

            if ($response) {
                // Extrai o JSON do texto da resposta
                $content = $response->candidates[0]->content->parts[0]->text ?? null;

                // Se o conteúdo está vazio, lança uma exceção
                if (!$content) {
                    throw new \Exception('Resposta vazia da API do Gemini');
                }

                // Remove quebras de linha e caracteres indesejados que podem quebrar o JSON
                $content = preg_replace('/```json|```/', '', trim($content));

                // Tenta decodificar o conteúdo JSON
                $recommendations = json_decode($content, true);

                // Verifica se a decodificação foi bem-sucedida e contém "desktops"
                if (json_last_error() !== JSON_ERROR_NONE || !isset($recommendations['desktops'])) {
                    $errorMessage = 'Formato de resposta inválido da API do Gemini: ' . json_last_error_msg();
                    throw new \Exception($errorMessage);
                }

                $totals = $this->calculateTotals($recommendations['desktops']);

                // Log de sucesso
                GeminiLog::create([
                    'descricao' => 'Recomendações obtidas com sucesso',
                    'operacao' => 'getRecommendations',
                    'status' => 'sucesso',
                    'user_id' => auth()->id(),
                ]);

                return $totals;
            } else {
                throw new \Exception('Resposta inesperada da API do Gemini');
            }
        } catch (\Exception $e) {
            // Log de erro e lançamento de exceção para tratamento no controlador
            GeminiLog::create([
                'descricao' => 'Erro ao obter recomendações: ' . $e->getMessage(),
                'operacao' => 'getRecommendations',
                'status' => 'erro',
                'user_id' => auth()->id(),
            ]);

            // Lança uma exceção personalizada para que o controlador trate o redirecionamento
            throw new \Exception('Erro ao obter recomendações: ' . $e->getMessage());
        }
    }



    protected function generatePrompt(array $softwares)
    {

        $prompt = "Avalie os softwares selecionados e utilize como base para montar três desktops categorizados como bronze, silver e gold.\n\n";
        $prompt .= "Monte os desktops de forma que atendam aos requisitos mínimos dos softwares escolhidos, focando na custo-efetividade dos componentes utilizados.\n";
        $prompt .= "Crie um arquivo JSON mostrando todos os produtos necessários para que cada desktop atenda os requisitos das categorias.\n\n";
        $prompt .= "Certifique-se de que todos os componentes são compatíveis entre si e que cada desktop inclui os seguintes componentes essenciais: CPU, GPU, RAM, HD, Fonte, placa_mae e Cooler.\n\n";
        $prompt .= "Retorne os dados estruturados no seguinte formato JSON, mantendo apenas os nomes dos componentes e removendo qualquer informação adicional:\n\n";
        $prompt .= "{ \"desktops\": [ { \"categoria\": \"1\", \"componentes\": { \"CPU\": \"Nome do Produto\", \"GPU\": \"Nome do Produto\", \"RAM\": \"Nome do Produto\", \"Fonte\": \"Nome do Produto\", \"placa_mae\": \"Nome do Produto\", \"Cooler\": \"Nome do Produto\", \"HD\": \"Nome do Produto\" }, \"total\": VALOR_DA_SOMA_TOTAL_DOS_ITENS_SELECIONADOS }, { \"categoria\": \"2\", \"componentes\": { \"CPU\": \"Nome do Produto\", \"GPU\": \"Nome do Produto\", \"RAM\": \"Nome do Produto\", \"Fonte\": \"Nome do Produto\", \"placa_mae\": \"Nome do Produto\", \"Cooler\": \"Nome do Produto\", \"HD\": \"Nome do Produto\" }, \"total\": VALOR_DA_SOMA_TOTAL_DOS_ITENS SELECIONADOS }, { \"categoria\": \"3\", \"componentes\": { \"CPU\": \"Nome do Produto\", \"GPU\": \"Nome do Produto\", \"RAM\": \"Nome do Produto\", \"Fonte\": \"Nome do Produto\", \"placa_mae\": \"Nome do Produto\", \"Cooler\": \"Nome do Produto\", \"HD\": \"Nome do Produto\" }, \"total\": VALOR_DA_SOMA TOTAL_DOS ITENS SELECIONADOS } ] }\n\n";
        $prompt .= "Garanta a integridade e consistência de todas as informações.\n\n";
        $prompt .= "Softwares selecionados:\n";

        foreach ($softwares as $software) {
            $prompt .= "- Nome: {$software['nome']}\n";
        }

        $prompt .= "\nDicas adicionais:\n";
        $prompt .= "- Sempre serão 7 componentes, CPU,GPU,RAM,Fonte,placa_mae,Cooler,HD.\n";
        $prompt .= "- Priorize componentes com melhor relação custo-efetividade.\n";
        $prompt .= "- Para a categoria 1, escolha componentes que atendam aos requisitos mínimos dos softwares com o menor custo.\n";
        $prompt .= "- Para a categoria 2, escolha componentes que ofereçam um bom equilíbrio entre desempenho e custo.\n";
        $prompt .= "- Para a categoria 3, escolha componentes de alta performance, mas ainda mantendo a preocupação com o custo-efetividade.\n";

        return $prompt;
    }

    protected function parseResponse($response)
    {
        $candidates = $response->candidates ?? [];

        foreach ($candidates as $candidate) {
            $content = $candidate->content->parts[0]->text ?? null;
            if ($content) {
                $cleanContent = preg_replace('/```json|```/', '', $content);
                $cleanContent = trim($cleanContent);

                $decodedContent = json_decode($cleanContent, true);

                if (json_last_error() === JSON_ERROR_NONE) {
                    GeminiLog::create([
                        'descricao' => 'JSON decodificado com sucesso',
                        'operacao' => 'parseResponse',
                        'status' => 'sucesso',
                        'user_id' => auth()->id(),
                    ]);

                    return $decodedContent;
                } else {
                    GeminiLog::create([
                        'descricao' => 'Erro ao decodificar o JSON: ' . json_last_error_msg(),
                        'operacao' => 'parseResponse',
                        'status' => 'erro',
                        'user_id' => auth()->id(),
                    ]);

                    return redirect()->back()->with('json_error', true);
                }
            }
        }

        return redirect()->back()->with('format_error', true);
    }


    public function calculateTotals($desktops)
    {
        $processedComponents = []; // Para rastrear componentes já processados

        foreach ($desktops as &$desktop) {
            $category = $desktop['categoria'];
            $components = $desktop['componentes'];
            $total = 0;

            foreach ($components as $key => $componentName) {
                // Determinar o tipo do componente com base na chave
                $componentType = $this->mapComponentKeyToType($key);

                if (!$componentType) {
                    Log::warning("Tipo não identificado para o componente: $key ($componentName)");
                    continue;
                }

                // Verificar se o componente já foi processado
                if (isset($processedComponents[$componentName])) {
                    Log::info("Componente '$componentName' já processado, reutilizando.");
                    $desktop['componentes'][$key] = $processedComponents[$componentName];
                    $total += $processedComponents[$componentName]['preco'];
                    continue;
                }

                // Busca pelo produto correspondente
                $productId = $this->findProductIdByTypeAndSimilarity($componentType, $componentName);

                if ($productId) {
                    // Encontrar o produto e o preço associado na tabela loja_online
                    $produto = Produto::find($productId);
                    if ($produto) {
                        $lojaOnline = LojaOnline::find($produto->loja_online_id);
                        $price = $lojaOnline->valor ?? 0;
                        $url = $lojaOnline->urlLoja ?? 'URL não disponível';

                        $componentDetails = [
                            'nome' => $produto->nome,
                            'preco' => $price,
                            'moeda' => $lojaOnline->moeda,
                            'url' => $url
                        ];

                        Log::info("Produto: {$produto->nome}, Preço: {$lojaOnline->moeda} $price, URL: $url");

                        // Adiciona o componente aos resultados e ao rastreador
                        $desktop['componentes'][$key] = $componentDetails;
                        $processedComponents[$componentName] = $componentDetails;

                        $total += $price;
                    } else {
                        Log::warning("Produto com ID $productId não encontrado na tabela produtos.");
                    }
                } else {
                    Log::warning("Produto não encontrado para o componente: $key ($componentName)");
                }
            }

            Log::info("Total para a categoria $category: $total");
            $desktop['total'] = $total; // Atualiza o total no array $desktops
        }

        return [
            'desktops' => $desktops
        ];
    }

    public function findProductIdByTypeAndSimilarity($componentType, $componentName)
    {
        // Busca pelo produto diretamente pelo nome exato e tipo
        $produto = Produto::where('nome', $componentName)
            ->where('tipo', $componentType)
            ->first();

        if (!$produto) {
            // Se não encontrar pelo nome exato, buscar produtos do mesmo tipo
            $possiveisProdutos = Produto::where('tipo', $componentType)->get();

            if ($possiveisProdutos->isNotEmpty()) {
                // Usar Levenshtein para encontrar o nome mais parecido dentro do mesmo tipo
                $produto = $possiveisProdutos->sortBy(function ($produto) use ($componentName) {
                    return levenshtein($componentName, $produto->nome);
                })->first();

                if ($produto) {
                    Log::info("Produto mais semelhante encontrado: '{$produto->nome}' para o tipo $componentType");
                }
            }
        }

        return $produto ? $produto->id : null;
    }

    protected function mapComponentKeyToType($key)
    {
        $map = [
            'CPU' => 'CPU',
            'GPU' => 'GPU',
            'RAM' => 'RAM',
            'Fonte' => 'Fonte',
            'placa_mae' => 'Placa Mãe',
            'Cooler' => 'Cooler',
            'HD' => 'HD/SSD',
        ];

        return $map[$key] ?? null;
    }

}
