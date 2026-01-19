<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\detalleCompra;
use App\Models\Producto;
use App\Models\Proveedor;
use Illuminate\Database\Eloquent\Relations\BelongsTo; 
use Illuminate\Database\Eloquent\Relations\hasMany; 

class Compra extends Model
{
    use hasFactory;

    public function detalles(){
        return $this->hasMany(detalleCompra::class);
    }

    // Define la relación con Producto
    public function productos(): BelongsTo
    {
        return $this->belongsTo(Producto::class);//, 'id_producto'
    }

    // Asegúrate de tener también la de proveedor ya que la usas en el with()
    public function proveedores(): BelongsTo
    {
        return $this->belongsTo(Proveedor::class);//, 'id_proveedor'
    }
}
