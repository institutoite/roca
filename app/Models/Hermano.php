<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hermano extends Model
{
    use HasFactory;
    public function delete()
    {
        $this->estado = false;
        $this->save();
    }
   
    public function pistas()
    {
        return $this->hasMany(Pista::class);
    }

    public function papeles()
    {
        return $this->belongsToMany(Papel::class)->withTimestamps();
    }

    public function cartas()
    {
        return $this->belongsToMany(Carta::class, 'carta_hermano')->withTimestamps();
    }

    public function cartasComoDestinatarioPrincipal()
    {
        return $this->hasMany(Carta::class, 'destinatario_principal_id');
    }

    public function cartasSolicitadas()
    {
        return $this->belongsToMany(Carta::class, 'carta_solicitante')->withTimestamps();
    }
    public function presidedetalles()
    {
        return $this->hasMany(Detallerol::class,"preside_id");
    }
    public function ministradetalles()
    {
        return $this->hasMany(Detallerol::class,"ministra_id");
    }
}
