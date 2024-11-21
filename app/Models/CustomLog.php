<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomLog extends Model
{
    use HasFactory;

    protected $table = 'custom_logs';

    public $fillable = [
        'descricao',
        'operacao',
        'admin_id',
        ];
}
