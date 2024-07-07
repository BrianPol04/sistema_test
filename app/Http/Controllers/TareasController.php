<?php

namespace App\Http\Controllers;

use App\Models\Examen;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TareasController extends Controller
{
    //
    public function __construct()
    {
     
    }
    
    public function controlExamen()
    {

        $fecha_hora_actual = Carbon::now()->toIso8601String();

        $data = Examen::where('fecha_hora_fin', '<=', $fecha_hora_actual)->where('estado',true)->get(); 
        Examen::where('fecha_hora_fin', '<=', $fecha_hora_actual)->update(['estado' => false]);

        return $data;
    }
    
}
