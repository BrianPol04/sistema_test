<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alternativas extends Model
{
    use HasFactory;
    protected $table = 'pregunta_alternativa';
    protected $fillable = [ 
        'pregunta_id',
        'respuesta',
        'es_correcta',
    ];
    public $timestamps = true;
    protected $guarded = ['id'];
    protected $hidden = ['created_at', 'updated_at'];
}
