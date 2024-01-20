<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detallerol extends Model
{
    use HasFactory;
    protected $dates=['fecha'];
    public function rol()
    {
        return $this->belongsTo(Rol::class);
    }
    public function hermanopreside()
    {
        return $this->belongsTo(Hermano::class,'preside_id');
    }
    public function hermanoministra()
    {
        return $this->belongsTo(Hermano::class,'ministra_id');
    }
}
