<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'tipo'
    ];
    protected $table = 'categorias';

    public function conjuntos()
    {
        return $this->hasMany(Conjunto::class, 'categoria_id');
    }

}
