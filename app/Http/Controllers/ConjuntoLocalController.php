<?php

namespace App\Http\Controllers;

use App\Models\Software;
use Illuminate\Http\Request;

class ConjuntoLocalController extends Controller
{
    public function getConjuntoProdutos(Request $request)
    {

        // Validação: garantir que 3 softwares foram selecionados
        $request->validate([
            'softwares' => 'required|array|min:1|max:3',
            'softwares.*' => 'exists:softwares,id'
        ]);


        // Receber os IDs dos softwares selecionados
        $softwareIds = $request->input('softwares');


        // Encontra o software com o maior peso
        $softwareMaisPesado = Software::whereIn('id', $softwareIds)
            ->orderBy('peso', 'desc')
            ->first();

        if (!$softwareMaisPesado) {
            return response()->json(['message' => 'Nenhum software encontrado'], 404);
        }

        // Identificar todos os conjuntos relacionados ao software mais pesado
        $conjuntos = $softwareMaisPesado->conjuntos()->get();

        if ($conjuntos->isEmpty()) {
            return response()->json(['message' => 'Nenhum conjunto encontrado para o software mais pesado'], 404);
        }

        // Inicializar arrays para agrupar os produtos por categoria
        $produtosCategoria1 = [];
        $produtosCategoria2 = [];
        $produtosCategoria3 = [];

        // Buscar os produtos relacionados a todos os conjuntos e separá-los por categoria_id
        foreach ($conjuntos as $conjunto) {
            $produtos = $conjunto->produtos()->get();

            foreach ($produtos as $produto) {
                switch ($conjunto->categoria_id) {
                    case 1:
                        $produtosCategoria1[] = $produto;
                        break;
                    case 2:
                        $produtosCategoria2[] = $produto;
                        break;
                    case 3:
                        $produtosCategoria3[] = $produto;
                        break;
                }
            }
        }

        // Retornar a resposta JSON separada por categoria
        return response()->json([
            'software' => $softwareMaisPesado,
            'categoria_1' => $produtosCategoria1,
            'categoria_2' => $produtosCategoria2,
            'categoria_3' => $produtosCategoria3,
        ]);
    }
}
