<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Software;

class ChartController extends Controller
{
    public function getChartData()
{
    // Contar o número total de softwares
    $total = Software::count();

    // Selecionar os IDs de todos os softwares
    $softwareIds = Software::pluck('id');

    return response()->json([
        'total_softwares' => $total,
        'software_ids' => $softwareIds
    ]);
}
}

/*<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ConjuntoController;

class ChartController extends Controller
{
    public function getChartData()
    {
        $dados = ConjuntoController::select('id')
            ->get();

        return response()->json($dados);
    }
}*/
