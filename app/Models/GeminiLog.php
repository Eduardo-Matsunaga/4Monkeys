<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeminiLog extends Model
{
    use HasFactory;

    protected $table = 'gemini_logs';

    protected $fillable = [
        'descricao',
        'operacao',
        'status',
        'user_id'
    ];
}
