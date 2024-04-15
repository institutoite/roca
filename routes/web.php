<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HermanoController;
use App\Http\Controllers\PapelController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\DetalleRolController;
use App\Http\Controllers\PistaController;
use App\Models\Pista;
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
    $pistas= Pista::all();
    return view('home',compact("pistas"));
});

Auth::routes();

Route::get('/home', [HermanoController::class, 'index'])->name('home');
// Rutas para mostrar la lista y el formulario de creación
Route::get('hermanos', [HermanoController::class, 'index'])->name('hermano.index');
Route::get('hermanos/create', [HermanoController::class, 'create'])->name('hermano.create');

// Rutas para almacenar un nuevo hermano y mostrar detalles de un hermano
Route::post('hermano/store', [HermanoController::class, 'store'])->name('hermano.store');
Route::get('hermano/{hermano}', [HermanoController::class, 'show'])->name('hermano.show');

// Rutas para mostrar el formulario de edición y actualizar un hermano
Route::get('hermano/{hermano}/edit', [HermanoController::class, 'edit'])->name('hermano.edit');
Route::put('hermano/{hermano}', [HermanoController::class, 'update'])->name('hermano.update');

// Ruta para eliminar un hermano
Route::delete('hermano/{hermano}', [HermanoController::class, 'destroy'])->name('hermano.destroy');


// Rutas para mostrar la lista y el formulario de creación
Route::get('papeles', [PapelController::class, 'index'])->name('papel.index');
Route::get('papeles/create', [PapelController::class, 'create'])->name('papel.create');

// Rutas para almacenar un nuevo papel y mostrar detalles de un papel
Route::post('papel/store', [PapelController::class, 'store'])->name('papel.store');
Route::get('papel/{papel}', [PapelController::class, 'show'])->name('papel.show');

// Rutas para mostrar el formulario de edición y actualizar un papel
Route::get('papel/{papel}/edit', [PapelController::class, 'edit'])->name('papel.edit');
Route::put('papel/{papel}', [PapelController::class, 'update'])->name('papel.update');

// Ruta para eliminar un papel
Route::delete('papel/{papel}', [PapelController::class, 'destroy'])->name('papel.destroy');


// routes/web.php

Route::get('/hermano/{hermano}/agregarpapeles', [HermanoController::class, "mostrarAgregarPapeles"])->name('hermano.mostraragregarpapeles');
Route::post('/hermano/{hermano}/agregarpapeles', [HermanoController::class, "agregarPapeles"])->name('hermano.agregarpapeles');


// Rutas para mostrar la lista y el formulario de creación
Route::get('roles', [RolController::class, 'index'])->name('rol.index');
Route::get('roles/create', [RolController::class, 'create'])->name('rol.create');

// Rutas para almacenar un nuevo rol y mostrar detalles de un rol
Route::post('roles/store', [RolController::class, 'store'])->name('rol.store');
Route::get('roles/{rol}', [RolController::class, 'show'])->name('rol.show');

// Rutas para mostrar el formulario de edición y actualizar un rol
Route::get('roles/{rol}/edit', [RolController::class, 'edit'])->name('rol.edit');
Route::put('roles/{rol}', [RolController::class, 'update'])->name('rol.update');

// Ruta para eliminar un rol
Route::delete('roles/{rol}', [RolController::class, 'destroy'])->name('rol.destroy');

Route::get('roles/{rol}/detalles', [DetalleRolController::class, 'index'])->name('roles.detalles.index');
Route::get('detalle/{rol}/create', [DetalleRolController::class, 'create'])->name('detallerol.create');
Route::post('roles/{rol}/detalles/store', [DetalleRolController::class, 'store'])->name('detallerol.store');
Route::get('detallerol/ver/{rol}',[DetalleRolController::class,'show'])->name("detallerol.ver");
Route::get("descargar/pdf/{rol}",[DetalleRolController::class,'descargar'])->name("descargar.rol");

// endpoints 


Route::get("presididores",[HermanoController::class,"presididores"])->name("presididores");
Route::get("miercoles",[HermanoController::class,"miercoles"])->name("miercoles");
Route::get("sabados",[HermanoController::class,"sabados"])->name("sabados");
Route::get("domingos",[HermanoController::class,"domingos"])->name("domingos");
Route::get("predicadores",[HermanoController::class,"predicadores"])->name("predicadores");
Route::get("participantes",[HermanoController::class,"participantes"])->name("get.participantes");
Route::get("updateparcipantes",[DetallerolController::class,"updateparcipantes"])->name("update.parcipantes");
Route::get("deletedetalle",[DetallerolController::class,"deletedetalle"])->name("delete.detalle");

Route::get("ministerios",[PistaController::class,"index"])->name("ministerios.index");
Route::delete('predica/{pista}', [PistaController::class, 'destroy'])->name('pista.destroy');
Route::get('predica/edit/{pista}', [PistaController::class, 'edit'])->name('pista.edit');
Route::get('predica/create', [PistaController::class, 'create'])->name('pista.create');
Route::post('pista/store', [PistaController::class, 'store'])->name('pista.store');
Route::put('pista/{pista}/update', [PistaController::class, 'update'])->name('pista.update');

Route::get('buscar/ministerios', [PistaController::class, 'busqueda'])->name('search');