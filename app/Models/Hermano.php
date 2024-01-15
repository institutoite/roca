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
   
    public function papeles()
    {
        return $this->belongsToMany(Papel::class)->withTimestamps();
    }
}
