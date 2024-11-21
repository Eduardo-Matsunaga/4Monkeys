<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class PythonScraper extends Command
{
    protected $signature = 'scraper:run';
    protected $description = 'Executa o scraper Python e salva os produtos no banco de dados';

    public function handle()
    {
        // Caminho para o ambiente virtual
        $venvActivate = '/home/edudev/Desktop/projetos/Laravel-Sistema/python/venv/bin/activate';

        // Caminho para o interpretador Python dentro do ambiente virtual
        $pythonInterpreter = '/home/edudev/Desktop/projetos/Laravel-Sistema/python/venv/bin/python3';

        // Executa o comando para ativar o ambiente virtual e rodar o script Python
        $output = shell_exec('/bin/bash -c "source ' . $venvActivate . ' && ' . $pythonInterpreter . ' /home/edudev/Desktop/projetos/Laravel-Sistema/python/scraper/main.py"');

        if ($output === null) {
            $this->error('Erro ao executar o scraper');
        } else {
            $this->info('Scraper executado com sucesso');
            $this->line($output);  // Mostra a saída do script Python
        }
    }
}
