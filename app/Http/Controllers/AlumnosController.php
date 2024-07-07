<?php
namespace App\Http\Controllers;
use App\Models\Cursos;
use App\Models\User;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Hash;
class AlumnosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $cursos = Cursos::all();
        $data = User::where('rol','Alumno')->get();
        return view('admin.alumno.index', compact('data','cursos'));
    }
   
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email,' . $request->id 
        ];
        $request->filled('password') ? $rules['password'] = 'required|min:8|max:255' : null;
        $request->validate($rules);
        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'genero' => $request->genero,
            'curso_id' => json_encode((array)$request->curso_id),
            'rol' => 'Alumno',
        ];
        $request->filled('password') ?  $userData['password'] = Hash::make($request->password) : null;
        $request->id > 0 ? User::find($request->id)->update($userData) :  User::create($userData);
        return redirect()->back();
    }
    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->back();
    }
}
