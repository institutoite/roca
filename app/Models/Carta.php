<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Carta extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'tipo',
        'fecha',
        'lugar',
        'iglesia_origen_id',
        'iglesia_destino_id',
        'destino_texto',
        'destinatario_principal_id',
        'destinatario_principal_texto',
        'destinatarios_texto',
        'motivo',
        'carta_motivo_id',
        'motivo_texto',
        'carta_plantilla_id',
    ];

    protected $casts = [
        'fecha' => 'date',
    ];

    public function plantilla()
    {
        return $this->belongsTo(CartaPlantilla::class, 'carta_plantilla_id');
    }

    public function iglesiaOrigen()
    {
        return $this->belongsTo(Iglesia::class, 'iglesia_origen_id');
    }

    public function iglesiaDestino()
    {
        return $this->belongsTo(Iglesia::class, 'iglesia_destino_id');
    }

    public function destinatarioPrincipal()
    {
        return $this->belongsTo(Hermano::class, 'destinatario_principal_id');
    }

    public function motivoCatalogo()
    {
        return $this->belongsTo(CartaMotivo::class, 'carta_motivo_id');
    }

    public function hermanos()
    {
        return $this->belongsToMany(Hermano::class, 'carta_hermano')->withTimestamps();
    }

    public function solicitantes()
    {
        return $this->belongsToMany(Hermano::class, 'carta_solicitante')->withTimestamps();
    }
}
