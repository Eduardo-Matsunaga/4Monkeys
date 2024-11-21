<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequisitoSoftware extends Model
{
    use HasFactory;

    protected $table = 'requisitos_software';

    protected $fillable = [
        'software_id',
        'requisito_nivel',
        'cpu',
        'gpu',
        'ram',
        'placa_mae',
        'ssd',
        'cooler',
        'fonte',
    ];

    public function software()
    {
        return $this->belongsTo(Software::class);
    }
}
