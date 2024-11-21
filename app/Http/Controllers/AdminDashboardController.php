<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\GeminiLog;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index()
    {
        try {
            // Contagem de administradores para o "Primary Card" (exemplo)
            $adminCount = Admin::count();

            // Quantidade de usuários registrados para o "Warning Card"
            $userCount = User::count();

            // Quantidade de operações "criarConjunto" na tabela gemini_logs para o "Success Card"
            $createConjuntoCount = GeminiLog::where('operacao', 'criarConjunto')->count()/3;

            $errorCount = GeminiLog::where('status', 'erro')->count();

            // Busca de logs para a tabela de logs com paginação
            $logs = GeminiLog::paginate(100000);
        } catch (\Exception $e) {
            // Cria um log de erro na tabela GeminiLog
            GeminiLog::create([
                'operacao' => 'ErroAdminDashboard',
                'mensagem' => $e->getMessage(),
                'user_id' => auth()->id() ?? 1,
                'status' => 'erro',
            ]);

            // Define uma lista vazia para os logs em caso de erro
            $logs = [];
        }

        // Retorna a view com os dados dos cards e dos logs
        return view('admin.dashboard', compact('adminCount', 'userCount', 'createConjuntoCount', 'errorCount', 'logs'));
    }

}
