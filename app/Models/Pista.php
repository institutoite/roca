<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pista extends Model
{
    use HasFactory;
    public function hermano()
    {
        return $this->belongsTo(Hermano::class);
    }
}
