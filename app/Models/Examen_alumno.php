<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Examen_alumno extends Model
{
    use HasFactory;
    protected $table = 'examen_alumno';
    protected $fillable = [ 
        'id_user',
        'id_examen',
        'tiempo',
        'preguntas_ids',
        'estado',
    ];
    public $timestamps = true;
    protected $guarded = ['id'];
    protected $hidden = ['$created_at', '$updated_at'];
}
