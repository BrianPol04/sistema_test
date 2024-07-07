<?php

namespace App\Http\Controllers;

use App\Models\Alternativas;
use App\Models\Pregunta;
use Illuminate\Http\Request;

class PreguntasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $id_tema = base64_decode($request->cod);
        $data = Pregunta::with('respuestas')->where('tema_id', $id_tema)->get(); 
        return view('admin.preguntas.index', compact('data', 'id_tema'));
    }
    public function store(Request $request)
    {
        if ($request->id > 0) {
            $pregunta = Pregunta::find($request->id);
            $productosAEliminar = Alternativas::where('pregunta_id', $request->id)->get();
            $productosAEliminar->each->delete();
        } else {
            $pregunta = new Pregunta();
        }

        $pregunta->tema_id = $request->tema_id;
        $pregunta->pregunta = $request->pregunta;
        $pregunta->tipo_pregunta = $request->tipo_pregunta; 
        $pregunta->alternativa= ($request->tipo_pregunta === "Unica") ? $request->alternativa  :   json_encode($request->alternativa);
        $pregunta->save();

        $respuestas = json_decode($request->respuestas);

        foreach ($respuestas as $row) {
            $nuevaAlternativa = new Alternativas();
            $nuevaAlternativa->pregunta_id = $pregunta->id;
            $nuevaAlternativa->respuesta = $row->respuesta;
            $nuevaAlternativa->es_correcta = $row->es_correcta;
            $nuevaAlternativa->save();
        }
        return redirect()->back();
    }

    public function destroy($id)
    {
        Pregunta::destroy($id);
        return redirect()->back();
    }
}