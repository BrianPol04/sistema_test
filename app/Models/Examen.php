<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Examen extends Model
{
    use HasFactory;
    protected $table = 'examen';
    protected $fillable = [
        'id_user',
        'curso_id',
        'temas',
        'descripcion',
        'cantidad',
        'tiempo_limite',
        'fecha_hora_inicio',
        'fecha_hora_fin',
        'estado', 
    ];
    public $timestamps = true;
    protected $guarded = ['id'];
    protected $hidden = ['created_at', 'updated_at'];
}
     