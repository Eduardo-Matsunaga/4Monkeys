<?php

namespace App\Http\Controllers;

use App\Models\CustomLog;


class LogController extends Controller
{

    public function index()
    {
        try {

            $custom_log = CustomLog::paginate(10);
        } catch (\Exception $e) {

            CustomLog::create([
                'descricao' => $e->getMessage(),
                'operacao' => 'index',
                'user_id' => auth()->id() ?? 1,
            ]);


            $custom_log = [];
        }


        return view('admin.logs', ['custom_log' => $custom_log]);
    }

    public function export()
    {
    $custom_log = CustomLog::all();

    $filename = 'logs_alteracao' . date('Ymd') . '.csv';

    $handle = fopen('php://output', 'w');

    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '"');

    fputcsv($handle, ['ID do usuário', 'Descrição', 'Operação', 'Data Criação', 'Data Alteração']);

    foreach ($custom_log as $log) {
        fputcsv($handle, [
            $log->user_id,
            $log->descricao,
            $log->operacao,
            $log->created_at,
            $log->updated_at,
        ]);
    }

    fclose($handle);

    exit;
}

} 
