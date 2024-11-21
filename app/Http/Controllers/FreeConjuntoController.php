<?php

namespace App\Http\Controllers;

use App\Models\RequisitoSoftware;
use App\Models\Software;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FreeConjuntoController extends Controller
{

    public function selecionar(Request $request)
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


        $requisitos = RequisitoSoftware::where('software_id', $softwareMaisPesado->id)
            ->get()
            ->groupBy('requisito_nivel'); // Agrupa os requisitos por nível

        // Preparar o array de resposta com os requisitos agrupados
        $response = [
            'Minimo' => [],
            'Medio' => [],
            'Recomendado' => []
        ];

        // Preencher o array de resposta com os requisitos
        foreach ($requisitos as $nivel => $requisitoNivel) {
            foreach ($requisitoNivel as $requisito) {
                $response[$nivel][] = [
                    'cpu' => $requisito->cpu,
                    'gpu' => $requisito->gpu,
                    'ram' => $requisito->ram,
                    'placa_mae' => $requisito->placa_mae,
                    'ssd' => $requisito->ssd,
                    'cooler' => $requisito->cooler,
                    'fonte' => $requisito->fonte
                ];
            }
        }

        // Retorna a resposta em formato JSON
        //dd($response);
        /*return response()->json([
            //'software_mais_pesado' => $softwareMaisPesado,
            'requisitos' => $response
        ]);*/
        //dd($software_mais_pesado);
        return view('conjuntosFree', [
            //'software_mais_pesado' => $softwareMaisPesado,
            'requisitos' => $response
        ]);
        
    }
}
