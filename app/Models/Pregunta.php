<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pregunta extends Model
{
    use HasFactory;
    protected $table = 'preguntas';
    protected $fillable = [
        'pregunta',
        'tipo_pregunta', 
        'tema_id',
        'alternativa', 
    ];
    public $timestamps = true;
    protected $guarded = ['id'];
    protected $hidden = ['created_at', 'updated_at'];
    public function respuestas()
    {
        return $this->hasMany(Alternativas::class);
    }
}
 