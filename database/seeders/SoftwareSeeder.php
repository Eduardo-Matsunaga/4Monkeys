<?php

namespace Database\Seeders;

use App\Models\Software;
use Illuminate\Database\Seeder;

class SoftwareSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Software::create([
            'tipo'  => 1,
            'nome' => 'Valorant',
            'descricao' => 'Valorant é um FPS tático 5x5 que tem como objetivo plantar ou desarmar a Spike',
            'imagem' => 'images/Valorant.jpg',
            'peso' => 5,
        ]);

        Software::create([
            'tipo'  => 1,
            'nome' => 'PUBG: BATTLEGROUNDS',
            'descricao' => 'PUBG: BATTLEGROUNDS é um battle royale de tiro que coloca 100 jogadores uns contra os outros até que o último sobreviva.',
            'imagem' => 'images/pubG.jpg',
            'peso' => 4,
        ]);

        Software::create([
            'tipo'  => 1,
            'nome' => 'ELDEN RING',
            'descricao' => 'Elden Ring é um RPG épico de ação ambientado em um mundo de fantasia sombria.',
            'imagem' => 'images/Elden_Ring.jpg',
            'peso' => 7,
        ]);

        Software::create([
            'tipo'  => 1,
            'nome' => 'Grand Theft Auto V',
            'descricao' => 'GTA V, é um jogo eletrônico de ação e aventura lançado em 2013 para o PS3.',
            'imagem' => 'images/GTAV.jpg',
            'peso' => 7,
        ]);

        Software::create([
            'tipo'  => 2,
            'nome' => 'Pacote Office',
            'descricao' => 'O pacote office facilita processos diários, de modo a possibilitar maior produtividade.',
            'imagem' => 'images/Pacote_Ofice.jpg',
            'peso' => 1,
        ]);

        Software::create([
            'tipo'  => 3,
            'nome' => 'OBS',
            'descricao' => 'Open Broadcaster Software é um programa de streaming e gravação gratuito e de código aberto mantido pelo OBS Project.',
            'imagem' => 'images/OBS.jpg',
            'peso' => 6,
        ]);

        Software::create([
            'tipo'  => 2,
            'nome' => 'Adobe Photoshop',
            'descricao' => 'O Photoshop é um software da multinacional americana Adobe Inc. usado para edição de imagens, criação de arte digital, design gráfico e animações.',
            'imagem' => 'images/Adobe_Photoshop.jpg',
            'peso' => 6,
        ]);

        Software::create([
            'tipo'  => 1,
            'nome' => 'Minecraft',
            'descricao' => 'Minecraft é um jogo eletrônico lançado em 2009 que consiste em sobreviver em um mundo formado (majoritariamente) por blocos cúbicos.',
            'imagem' => 'images/Minecraft.jpg',
            'peso' => 2,
        ]);

        Software::create([
            'tipo'  => 3,
            'nome' => 'PhpStorm',
            'descricao' => 'O PhpStorm fornece uma experiência simplificada para o ciclo de desenvolvimento completo com novos idiomas, como TypeScript, CoffeeScript e Dart.',
            'imagem' => 'images/Phpstorm.jpg',
            'peso' => 2,
        ]);

        Software::create([
            'tipo'  => 3,
            'nome' => 'Visual Studio Code',
            'descricao' => 'O Visual Studio Code é um editor de código-fonte desenvolvido pela Microsoft, lançado em abril de 2015.',
            'imagem' => 'images/Visual_Studio_Code.jpg',
            'peso' => 3,
        ]);

        Software::create([
            'tipo'  => 3,
            'nome' => 'Eclipse',
            'descricao' => 'Eclipse é uma IDE para desenvolvimento Java, porém suporta várias outras linguagens a partir de plugins como C/C++, PHP, ColdFusion, Python, Scala e Kotlin.',
            'imagem' => 'images/Eclipse.jpg',
            'peso' => 3,
        ]);

        Software::create([
            'tipo'  => 2,
            'nome' => 'Skype',
            'descricao' => 'Skype é um software proprietário de mensagens e videoconferência, criado por Janus Friis e Niklas Zennstrom.',
            'imagem' => 'images/Skype.jpg',
            'peso' => 1,
        ]);

        Software::create([
            'tipo'  => 2,
            'nome' => 'Adobe Acrobat Reader',
            'descricao' => 'Adobe Reader é um software que permite que o usuário do computador visualize, navegue e imprima arquivos no formato PDF.',
            'imagem' => 'images/Adobe_Acrobat_Reader.jpg',
            'peso' => 1,
        ]);

        Software::create([
            'tipo'  => 3,
            'nome' => 'BlueStacks',
            'descricao' => 'O BlueStacks App Player foi produzido para permitir que aplicativos Android rodem em computadores Windows e Macintosh.',
            'imagem' => 'images/BlueStacks.jpg',
            'peso' => 4,
        ]);

        Software::create([
            'tipo'  => 2,
            'nome' => 'Oracle VirtualBox',
            'descricao' => 'VirtualBox é um software de virtualização desenvolvido pela empresa Innotek depois comprado pela Sun Microsystems que posteriormente foi comprada pela Oracle que, como o VMware Workstation, visa criar ambientes para instalação de sistemas distintos.',
            'imagem' => 'images/Oracle_Virtual_Box.jpg',
            'peso' => 4,
        ]);
    }
}
