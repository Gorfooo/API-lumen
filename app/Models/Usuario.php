<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'nome',
        'telefone',
        'cpf',
        'empresa_id'
    ];

    public function produtos(){
        return $this->hasMany(Produto::class);
    }

    public function empresa(){
        return $this->belongsTo(Empresa::class);
    }
}
