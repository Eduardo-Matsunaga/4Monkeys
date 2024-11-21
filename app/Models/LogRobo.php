<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogRobo extends Model
{
    use HasFactory;

    protected $table = 'logs_scraper';

    public $fillable = [
        'url',
        'pagina',
        'mensagem',
        ];

    public $timestamps = true;
    const UPDATED_AT = null;
}
