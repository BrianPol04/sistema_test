<?php

namespace App\Http\Controllers;

use App\Models\Matricula;
use Illuminate\Http\Request;

class MatriculaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $data = Matricula::all();
        return view('admin.user.index', compact('data'));
    }
    public function store(Request $request)
    {
        if ($request->id > 0) {
            Matricula::find($request->id)->update($request->all());
        } else {
            Matricula::create($request->all());
        }
        return redirect()->back();
    }

    public function destroy($id)
    {
        Matricula::destroy($id);
        return redirect()->back();
    }
}
