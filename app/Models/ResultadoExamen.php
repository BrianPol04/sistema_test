<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResultadoExamen extends Model
{
    use HasFactory;
    protected $table = 'exame_resultados';
    protected $fillable = [
        'id_examen_alumno',
        'id_pregunta',
        'respuesta', 
    ];
    public $timestamps = true;
    protected $guarded = ['id'];
    protected $hidden = ['$created_at', '$updated_at'];
}
