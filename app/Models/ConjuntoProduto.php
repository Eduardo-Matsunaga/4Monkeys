<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConjuntoProduto extends Model
{
    use HasFactory;

    protected $fillable = [
        'conjunto_id',
        'software_id',
    ];
    protected $table = 'conjunto_produto';

}
