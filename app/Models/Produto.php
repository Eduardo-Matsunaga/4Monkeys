<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'loja_online_id',
        'disponibilidade',
        'created_at',
        'updated_at',
    ];


    public function lojaOnline(){
        return $this->belongsTo(LojaOnline::class);
    }

    public function conjunto()
    {
        return $this->belongsToMany(Conjunto::class, 'conjunto_produto', 'produto_id', 'conjunto_id');
    }

    public static function search($term)
    {
        return self::where('nome', 'like', '%' . $term . '%');
    }

    public function estoque()
    {
        return $this->hasOne(Estoque::class);
    }
}
