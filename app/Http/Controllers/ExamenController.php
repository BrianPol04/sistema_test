<?php

namespace App\Http\Controllers;

use App\Models\Cursos;
use App\Models\Examen;
use App\Models\Temas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamenController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // $cursos = Cursos::all();
        if (Auth::user()->rol === 'Profesor') {
            $cursos = Cursos::whereIn('id', json_decode(Auth::user()->curso_id))->get();
            $data = Examen::where('id_user', Auth::user()->id)->get();
        } else {
            $cursos = Cursos::all();
            $data = Examen::all();
        } 
        $temas = Temas::all();
        return view('admin.examen.index', compact('cursos', 'data', 'temas'));
    }
     
    public function store(Request $request)
    {
        $data = $request->all();
        $data['id_user'] = Auth::user()->id;
        $data['temas'] = json_encode($request->temas);
        $request->id > 0 ? Examen::find($request->id)->update($data) : Examen::create($data);
        return redirect()->back();
    }

    public function destroy($id)
    {
        Examen::destroy($id);
        return redirect()->back();
    }
}