<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    // Agregamos la relacion con User.php
    public function users(){
        return $this->hasMany(User::class);
    }
}
