<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{ 
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $data = User::where('rol', 'Admin')->get();
        return view('admin.user.index', compact('data')); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
            'rol' => 'Admin',
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
