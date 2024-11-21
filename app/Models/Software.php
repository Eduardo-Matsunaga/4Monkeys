<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Software extends Model
{
    use HasFactory;

    protected $table = 'softwares';
    protected $fillable = [
        'nome',
        'tipo',
        'descricao',
        'peso',
        'imagem'
    ];



    public function requisitos()
    {
        return $this->hasMany(RequisitoSoftware::class);
    }

    public function conjuntos()
    {
        return $this->belongsToMany(Conjunto::class, 'conjunto_software');
    }
}
