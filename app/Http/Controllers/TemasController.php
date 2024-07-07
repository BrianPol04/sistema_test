<?php

namespace App\Http\Controllers;

use App\Models\Temas;
use Illuminate\Http\Request;

class TemasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $id_curso = base64_decode($request->cod);
        $data = Temas::where('curso_id', $id_curso)->get();
        return view('admin.tema.index', compact('data', 'id_curso'));
    }
    public function store(Request $request)
    {
        if ($request->id > 0) {
            Temas::find($request->id)->update($request->all());
        } else {
            Temas::create($request->all());
        }
        return redirect()->back();
    }

    public function destroy($id)
    {
        Temas::destroy($id);
        return redirect()->back();
    }
}
