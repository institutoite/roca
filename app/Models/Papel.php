<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Papel extends Model
{
    use HasFactory;
    public function hermanos()
    {
        return $this->belongsToMany(Hermano::class)->withTimestamps();;
    }
}
