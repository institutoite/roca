<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuenta extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function detalles()
    {
        return $this->hasMany(DetalleCuenta::class);
    }
}
