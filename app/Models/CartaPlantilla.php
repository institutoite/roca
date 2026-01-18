<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartaPlantilla extends Model
{
    use HasFactory;

    protected $table = 'carta_plantillas';

    protected $fillable = [
        'nombre',
        'tipo',
        'parrafo1',
        'parrafo2',
        'parrafo3',
        'parrafo4',
        'parrafo5',
        'parrafo6',
        'parrafo7',
        'parrafo8',
        'parrafo9',
        'parrafo10',
        'parrafo11',
        'parrafo12',
        'activo',
    ];
}
