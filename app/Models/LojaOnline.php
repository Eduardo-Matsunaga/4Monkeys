<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LojaOnline extends Model
{
    use HasFactory;

    protected $table = 'loja_online';

    protected $fillable = [
        'urlLoja',
        'valor',
        'moeda',
        'created_at',
        'updated_at',
    ];

    public function produto(){
        return $this->hasOne(Produto::class);
    }
}
