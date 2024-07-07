<?php

namespace App\Http\Controllers;
 
use Illuminate\Http\Request; 
use App\Models\Alternativas;

class AlternativaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $data = Alternativas::all();
        return view('admin.user.index', compact('data'));
    }
    public function store(Request $request)
    {
        if ($request->id > 0) {
            Alternativas::find($request->id)->update($request->all());
        } else {
            Alternativas::create($request->all());
        }
        return redirect()->back();
    }

    public function destroy($id)
    {
        Alternativas::destroy($id);
        return redirect()->back();
    }
}
