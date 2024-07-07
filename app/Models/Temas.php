<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Temas extends Model
{
    use HasFactory;
    protected $table = 'temas';
    protected $fillable = [
        'nombre',
        'curso_id'
    ];
    public $timestamps = true;
    protected $guarded = ['id'];
    protected $hidden = ['created_at', 'updated_at'];
}
