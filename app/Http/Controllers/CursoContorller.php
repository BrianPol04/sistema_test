<?php

namespace App\Http\Controllers;

use App\Models\Cursos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CursoContorller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
 * Display a listing of the resource.
 *
 * @return \Illuminate\Http\Response
 */
public function index()
{
    // Check if the authenticated user is a Profesor
    if (Auth::user()->rol==='Profesor') {
        // If the user is a Profesor, retrieve the courses associated with the user
        // The course IDs are stored in the 'curso_id' field of the user model, and are JSON encoded
        // Decode the JSON and use the 'whereIn' method to retrieve the corresponding courses
        $data = Cursos::whereIn('id', json_decode(Auth::user()->curso_id))->get();
    } else {
        // If the user is not a Profesor, retrieve all courses
        $data = Cursos::all();
    }

    // Pass the retrieved data to the view 'admin.curso.index' and return the view with the data
    return view('admin.curso.index', compact('data'));
}

    public function store(Request $request)
    {
        if ($request->id > 0) {
            Cursos::find($request->id)->update($request->all());
        } else {
            Cursos::create($request->all());
        }
        return redirect()->back();
    }

    public function destroy($id)
    {
        Cursos::destroy($id);
        return redirect()->back();
    }
}
