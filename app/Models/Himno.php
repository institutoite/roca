<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Himno extends Model
{
    protected $table = 'himnos';

    protected $fillable = [
        'numero',
        'numero_text',
        'titulo',
        'letra',
        'estrofas_html',
        'estrofas_texto',
        'estrofas',
        'coro',
        'url',
        'informacion',
        'datos',
    ];

    protected $casts = [
        'estrofas' => 'array',
        'coro' => 'array',
        'informacion' => 'array',
        'datos' => 'array',
    ];
}
