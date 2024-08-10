<?php

namespace App\Http\Controllers;

use App\Models\Examen;
use App\Models\Examen_alumno;
use App\Models\Pregunta;
use App\Models\ResultadoExamen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AccesoAlumnoController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'roles:Alumno']);
    }

    public function curso()
    {
        $data = DB::table('cursos AS c')
            ->leftJoin('examen', 'c.id', '=', 'examen.curso_id')
            ->select(
                'c.id',
                'c.nombre',
                'c.color',
                'c.created_at',
                'c.updated_at',
                'c.descripcion',
                DB::raw('COUNT(CASE WHEN examen.estado = 1 AND (ea.estado != "completado" OR ea.estado IS NULL) THEN 1 ELSE NULL END) as examen_activo')
            )
            ->leftJoin('examen_alumno AS ea', function ($join) {
                $join->on('ea.id_examen', '=', 'examen.id')
                    ->where('ea.id_user', '=', Auth::user()->id);
            })
            ->groupBy('c.id', 'c.nombre', 'c.color', 'c.created_at', 'c.updated_at', 'c.descripcion')
            ->whereIn('c.id', json_decode(Auth::user()->curso_id))
            ->get();

        return view('admin.curso.listalumnos', compact('data'));
    }

    public function examenshow(Request $request)
    {
        setlocale(LC_TIME, null);

        $id_curso = base64_decode($request->cod);
        $data = DB::table('examen as e')
            ->join('users as u', 'e.id_user', '=', 'u.id')
            ->select('e.*', 'u.name')
            ->where('e.curso_id', $id_curso)
            ->orderByDesc('e.id')
            ->get();

        foreach ($data as $examen) {
            $examen->verify = Examen_alumno::where('id_examen', $examen->id)
                ->where('id_user', Auth::user()->id)
                ->exists();
        }

        return view('admin.examen.examenshow', compact('data'));
    }

    public function examenconfig(Request $request)
    {
        $id_curso = base64_decode($request->cod);
        $examen = Examen::find($id_curso);

        // Verifica si la decodificación de temas es exitosa
        $temas = json_decode($examen->temas);
        if (is_null($temas)) {
            // Maneja el caso cuando la decodificación falla
            return redirect()->back()->withErrors('El formato de los temas es incorrecto.');
        }

        $preguntas = Pregunta::whereIn('tema_id', $temas)
            ->inRandomOrder()
            ->limit($examen->cantidad)
            ->get();

        $ids = $preguntas->pluck('id')->toArray();

        $ex = Examen_alumno::create([
            'id_examen' => $examen->id,
            'tiempo' => $examen->tiempo_limite,
            'preguntas_ids' => json_encode($ids),
            'id_user' => Auth::user()->id
        ]);

        return redirect(url('examen?cod=' . base64_encode($ex->id)));
    }

    public function examen(Request $request)
    {
        setlocale(LC_TIME, null);
        $id_examen = base64_decode($request->cod);
        $examen_alumno = Examen_alumno::find($id_examen);

        if (!$examen_alumno) {
            abort(404); // Manejar el caso cuando no se encuentra el examen del alumno
        }

        if ($examen_alumno->estado === 'completado') {
            return redirect(url('ver_resultado?cod=' . base64_encode($examen_alumno->id)));
        }

        $ids = json_decode($examen_alumno->preguntas_ids);
        $preguntas = Pregunta::whereIn('id', $ids)
            ->with('respuestas')
            ->orderBy(DB::raw("FIELD(id, " . implode(',', $ids) . ")"))
            ->get();

        return view('admin.examen.examen', compact('preguntas', 'examen_alumno'));
    }

    public function create_resultado(Request $request)
    {
        $id_examen_alumno = base64_decode($request->id_examen_alumno);
        Examen_alumno::find($id_examen_alumno)->update(['estado' => 'completado']);
        $data = request()->all();

        foreach ($data as $key => $value) {
            if ($key !== "_token" && substr($key, 0, 9) === "pregunta-") {
                $id_pregunta = (int) substr($key, 9);
                $respuesta = is_array($value) ? json_encode($value) : $value;
                ResultadoExamen::Create(['id_examen_alumno' => $id_examen_alumno, 'id_pregunta' => $id_pregunta, 'respuesta' => $respuesta]);
            }
        }

        $urlRedireccion = url('ver_resultado?cod=' . base64_encode($id_examen_alumno));
        return response()->json(['url' => $urlRedireccion])->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0, post-check=0, pre-check=0');
    }

    public function ver_resultado(Request $request)
    {
        $id = base64_decode($request->cod);
        $examen_alumno = Examen_alumno::find($id);

        if (!$examen_alumno) {
            abort(404); // Manejar el caso cuando no se encuentra el examen del alumno
        }

        $ids = json_decode($examen_alumno->preguntas_ids);

        $preguntas = Pregunta::whereIn('id', $ids)
            ->with('respuestas')
            ->orderBy(DB::raw("FIELD(id, " . implode(',', $ids) . ")"))
            ->get();

        $examen_resultado = ResultadoExamen::where('id_examen_alumno', $id)->get();
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

        $datos = DB::table('examen_alumno as e')
            ->join('users as u', 'e.id_user', '=', 'u.id')
            ->join('examen as ex', 'e.id_examen', '=', 'ex.id')
            ->select('e.*', 'u.name', 'u.email', 'ex.tiempo_limite', 'ex.id as codigo_examen')
            ->where('e.id', $id)
            ->first();

        $datos->buenas = $buenas;
        $datos->malas = $malas;
        $datos->sinresponder = $sinresponder;

        return view('admin.examen.examen_resultado', compact('preguntas', 'examen_resultado', 'datos'));
    }

    public function update_tiempo(Request $request)
    {
        Examen_alumno::find($request->id)->update(['tiempo' => $request->tiempo]);
        return response()->json(true);
    }
}
