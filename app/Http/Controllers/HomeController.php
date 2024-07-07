<?php

namespace App\Http\Controllers;

use App\Models\Cursos;
use App\Models\Examen;
use App\Models\Pregunta;
use App\Models\ResultadoExamen;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public  function index()  {
        $alumno = User::where('rol', 'Alumno')->count(); 
        $profesores = User::where('rol', 'Profesor')->count();
        $admin = User::where('rol', 'Admin')->count();
        $curso = Cursos::all()->count();
        $examenes = Examen::all()->count();

        setlocale(LC_TIME, null);   
        $id_examen = Examen::where('estado', 0)->latest('created_at')->value('id');
 
        $examen = DB::table('examen as e')
            ->join('users as u', 'e.id_user', '=', 'u.id')
            ->join('cursos as c', 'e.curso_id', '=', 'c.id')
            ->select('e.*', 'u.name', 'c.nombre as curso')
            ->where('e.id', $id_examen)
            ->first();
        $data = DB::table('examen_alumno as ex')
            ->join('users as u', 'ex.id_user', '=', 'u.id')
            ->join('examen as e', 'ex.id_examen', '=', 'e.id')
            ->select('ex.*', 'u.name', 'e.cantidad')
            ->where('ex.id_examen', $id_examen)
            ->get();

        foreach ($data as $examen_alumno) {
            $ids = json_decode($examen_alumno->preguntas_ids);
            $preguntas = Pregunta::whereIn('id', $ids)
                ->with('respuestas')
                ->orderBy(DB::raw("FIELD(id, " . implode(',', $ids) . ")"))
                ->get();
            $examen_resultado = ResultadoExamen::where('id_examen_alumno', $examen_alumno->id)->get();

            $buenas = 0;
            $malas = 0;
            $sinresponder = 0;
            foreach ($preguntas as $pregunta) {
                $id_pregunta = $pregunta->id;
                $respuesta_correcta = $pregunta->alternativa;
                $resultado = $examen_resultado->where('id_pregunta', $id_pregunta)->first();

                if ($resultado) {
                    $respuesta_alumno = $resultado->respuesta;
                    $es_correcta = $respuesta_alumno === $respuesta_correcta;
                    if ($es_correcta) {
                        $buenas++;
                    } else {
                        $malas++;
                    }
                } else {
                    $respuesta_alumno = null;
                    $es_correcta = false;
                    $sinresponder++;
                }

                $pregunta->respuesta_alumno = $respuesta_alumno;
                $pregunta->es_correcta = $es_correcta;
            }

            $examen_alumno->buenas_p = round(($buenas / $examen_alumno->cantidad) * 100, 2);
            $examen_alumno->malas_p = round(($malas / $examen_alumno->cantidad) * 100, 2);
            $examen_alumno->sinresponder_p = round(($sinresponder / $examen_alumno->cantidad) * 100, 2);
            $examen_alumno->buenas = $buenas;
            $examen_alumno->malas = $malas;
            $examen_alumno->sinresponder = $sinresponder;
        }
        // return $data;

        return view('dashboard',compact('profesores','alumno','admin','curso','examenes','data','examen'));
    }
}
