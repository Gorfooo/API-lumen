<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'nome',
        'quanto',
        'ncm',
        'usuario_id'
    ];

    public function usuarios(){
        return $this->belongsTo(Usuario::class);
    }
}
