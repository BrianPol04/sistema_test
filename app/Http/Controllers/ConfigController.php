<?php

namespace App\Http\Controllers;

use App\Models\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ConfigController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = Config::find(1);
        return view('admin.config.index', compact('data'));
    }
    public function store(Request $request)
    {
        $url = null;
        if ($request->file('logo')) {
            $archivo = $request->file('logo');
            $url = 'logo_' . Str::random(10) . '.png';
            $path = public_path() . '/imgconfig';
            $archivo->move($path, $url);
        }
        $url2 = null;
        if ($request->file('logo_sm')) {
            $archivo = $request->file('logo_sm');
            $url2 = 'logo_' . Str::random(10) . '.png';
            $path = public_path() . '/imgconfig';
            $archivo->move($path, $url2);
        }
        $config = Config::find(1);
        $path = public_path(str_replace(url('/'), '', $config->logo_light));
        $path1 = public_path(str_replace(url('/'), '', $config->logo_sm));
        $data = $request->all();
        if (file_exists($path) && $url !== null) {
            unlink($path);
            $data['logo_light'] = url('imgconfig') . '/' . $url;
        }
        if (file_exists($path1) && $url2 !== null) {
            unlink($path1);
            $data['logo_sm'] = url('imgconfig') . '/' . $url2;
        }
        $config->update($data);
        return redirect()->back();
    }

}