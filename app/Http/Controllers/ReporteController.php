<?php

namespace App\Http\Controllers;

use App\Models\Cursos;
use App\Models\Pregunta;
use App\Models\ResultadoExamen;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReporteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        if (Auth::user()->rol === 'Profesor') {
            $data = DB::table('examen as e')
                ->join('users as u', 'e.id_user', '=', 'u.id')
                ->join('cursos as c', 'e.curso_id', '=', 'c.id')
                ->where('e.id_user', Auth::user()->id)
                ->select('e.*', 'u.name', 'c.nombre as curso')
                ->get();
        } else {
            $data = DB::table('examen as e')
                ->join('users as u', 'e.id_user', '=', 'u.id')
                ->join('cursos as c', 'e.curso_id', '=', 'c.id')
                ->select('e.*', 'u.name', 'c.nombre as curso')
                ->get();
        }
        return view('admin.reportes.index', compact('data'));
    }
    public function estadisticasexamen(Request $request)
    {
        setlocale(LC_TIME, null);
        $id_examen = base64_decode($request->cod);

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

        return view('admin.reportes.estadistica', compact('data', 'examen'));
    }
    public function listalumnos()
    {
        $cursos = Cursos::all();
        $data = User::where('rol', 'Alumno')->get();
        return view('admin.reportes.estudiantes', compact('data', 'cursos'));
    }
    public function analisis(Request $request)
    {
        setlocale(LC_TIME, null);
        $id_curso = base64_decode($request->cod);
        $id_user = base64_decode($request->id);
        $data = DB::table('examen_alumno as ex')
            ->join('examen as e', 'ex.id_examen', '=', 'e.id')
            ->join('cursos as c', 'e.curso_id', '=', 'c.id')
            ->select('ex.*', 'e.descripcion', 'e.cantidad', 'e.tiempo_limite', 'c.nombre as curso')
            ->where('ex.id_user', $id_user)
            ->where('e.curso_id', $id_curso)
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
        return view('admin.reportes.analisis', compact('data'));
    }
}
