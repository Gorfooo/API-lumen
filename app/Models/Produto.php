<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'quanto',
        'ncm',
    ];

    public function usuarios(){
        return $this->belongsTo(Usuario::class);
    }
}
