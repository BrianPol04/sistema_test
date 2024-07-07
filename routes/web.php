<?php

use App\Http\Controllers\AccesoAlumnoController;
use App\Http\Controllers\AlumnosController;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\CursoContorller;
use App\Http\Controllers\ExamenController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PreguntasController;
use App\Http\Controllers\ProfesorController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\TareasController;
use App\Http\Controllers\TemasController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route; 

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('home');
});
 
Route::get('/home', [HomeController::class, 'index'])->name('home');
 
Route::get('/controlExamen', [TareasController::class, 'controlExamen'])->name('controlExamen');

Route::get('/usuario', [UsuarioController::class, 'index'])->name('usuario');
Route::post('/usuario/create', [UsuarioController::class, 'store'])->name('usuario.create');
Route::get('/usuario/{id}', [UsuarioController::class, 'destroy'])->name('usuario.delete');

Route::get('/curso', [AccesoAlumnoController::class, 'curso'])->name('curso');
Route::get('/axamenview', [AccesoAlumnoController::class, 'examenshow'])->name('axamenview');
Route::get('/examen', [AccesoAlumnoController::class, 'examen'])->name('examen');
Route::get('/examenconfig', [AccesoAlumnoController::class, 'examenconfig'])->name('examenconfig');
Route::post('/examen/examenresulto', [AccesoAlumnoController::class, 'create_resultado'])->name('examenresulto.create');
Route::get('/ver_resultado', [AccesoAlumnoController::class, 'ver_resultado'])->name('ver_resultado.view');

Route::post('/tiempo/update', [AccesoAlumnoController::class, 'update_tiempo'])->name('update_tiempo');

Route::get('/alumnos', [AlumnosController::class, 'index'])->name('alumnos');
Route::post('/alumno/create', [AlumnosController::class, 'store'])->name('alumno.create');
Route::get('/alumno/{id}', [AlumnosController::class, 'destroy'])->name('alumno.delete');

Route::get('/profesores', [ProfesorController::class, 'index'])->name('profesores');
Route::post('/profesor/create', [ProfesorController::class, 'store'])->name('profesor.create');
Route::post('/profesor/cursos', [ProfesorController::class, 'updatecurso'])->name('profesor.cursos');
Route::get('/profesor/{id}', [ProfesorController::class, 'destroy'])->name('profesor.delete');

Route::get('/cursos', [CursoContorller::class, 'index'])->name('cursos');
Route::post('/curso/create', [CursoContorller::class, 'store'])->name('curso.create');
Route::get('/curso/{id}', [CursoContorller::class, 'destroy'])->name('curso.delete');

Route::get('/temas', [TemasController::class, 'index'])->name('temas');
Route::post('/temas/create', [TemasController::class, 'store'])->name('temas.create');
Route::get('/temas/{id}', [TemasController::class, 'destroy'])->name('temas.delete');

Route::get('/preguntas', [PreguntasController::class, 'index'])->name('preguntas');
Route::post('/preguntas/create', [PreguntasController::class, 'store'])->name('preguntas.create');
Route::get('/preguntas/{id}', [PreguntasController::class, 'destroy'])->name('preguntas.delete');

Route::get('/examennew', [ExamenController::class, 'index'])->name('examennew'); 
Route::post('/examen/create', [ExamenController::class, 'store'])->name('examen.create');
Route::get('/examen/{id}', [ExamenController::class, 'destroy'])->name('examen.delete');

Route::get('/reportexamen', [ReporteController::class, 'index'])->name('reportexamen');  
Route::get('/estadisticasexamen', [ReporteController::class, 'estadisticasexamen'])->name('estadisticasexamen');  
Route::get('/listalumnos', [ReporteController::class, 'listalumnos'])->name('listalumnos');  
Route::get('/analisis', [ReporteController::class, 'analisis'])->name('analisis');  

Route::get('/cofiguracion', [ConfigController::class, 'index'])->name('cofiguracion');  
Route::post('/cofiguracion/store', [ConfigController::class, 'store'])->name('cofiguracion.store');  

