<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    
    // Agregamos la relacion con Categoria
    public function categoria(){
        return $this->belongsTo(Categoria::class);
    }

    public function compras(){
        return $this->hasMany(Compra::class);
    }
}
