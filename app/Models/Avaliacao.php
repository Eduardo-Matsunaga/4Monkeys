<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avaliacao extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'avaliacoes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'rating',
        'comentario',
    ];

    /**
     * Relationship with the User model.
     *
     * Each avaliação belongs to one user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
