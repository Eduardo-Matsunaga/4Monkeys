<?php

namespace App\Http\Controllers;

use App\Models\LogRobo;


class LogRoboController extends Controller
{

    public function index()
    {
        try {
            
            $log_scraper = LogRobo::paginate(10000); 
        } catch (\Exception $e) {
            
            LogRobo::create([
                'url' => $e->getMessage(),
                'mensagem' => $e->getMessage(),
                'pagina' => auth()->id() ?? 1,
            ]);
            
            
            $log_scraper = [];
        }
    
        
        return view('admin.logRobo', ['log_scraper' => $log_scraper]);
    }
}