<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\SuplementController;
use App\Http\Controllers\TariffsController;
use App\Http\Controllers\TaxiController;
use App\Http\Controllers\TravelController;
use App\Http\Controllers\TripTypeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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
    return view('auth.login');
});

Route::get('/register', function () {
    return view('auth.register');
});

Route::middleware(['auth', 'check_admin_or_superadmin'])->name('admin.')->prefix('admin')->group(function () {
    Route::post('/roles/{role}/permissions', [RoleController::class, 'givePermission'])->name('roles.permissions');
    Route::delete('/roles/{role}/permissions/{permission}', [RoleController::class, 'revokePermission'])->name('roles.permissions.revoke');
    Route::patch('/user/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('user.toggleStatus');
    Route::patch('/roles/{role}/toggle-role', [RoleController::class, 'toggleRole'])->name('roles.toggleRole');
    Route::patch('/permissions/{permission}/toggle-permission', [PermissionController::class, 'togglePermission'])->name('permissions.togglePermission');
    Route::resource('/user', UserController::class);
    Route::resource('/roles', RoleController::class);
    Route::resource('/permissions', PermissionController::class);
    Route::get('/dataTaxistas', [UserController::class, 'taxistas']);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/welcome', [HomeController::class, 'index']);
    Route::get('/startViagem', [TravelController::class, 'index']);
    Route::get('/dataViagens', [TravelController::class, 'showForm']);
    Route::get('/dataUser', [UserController::class, 'index']);
    Route::get('/dataTaxis', [TaxiController::class, 'index']);

    // Rotas das tarifas
    Route::resource('/tarifas', TariffsController::class);
    Route::get('/formListaTarifas', [TariffsController::class, 'index'])->name('formListaTarifas');
    Route::delete('/tarifas/{tarifa}', [TariffsController::class, 'destroy'])->name('tarifas.destroy');

    Route::get('/formTaxistas', [UserController::class, 'showForm']);
    Route::get('/dataTaxistas', [UserController::class, 'taxistas']);

    // Rotas dos suplementos
    Route::get('/formSuplementos', [SuplementController::class, 'formShow'])->name('suplement.formShow');
    Route::get('/dataSuplementos', [SuplementController::class, 'index'])->name('suplement.index');
    Route::resource('suplementos', SuplementController::class)->except(['show']);
    Route::get('/suplementos/{suplement}/edit', [SuplementController::class, 'edit'])->name('suplementos.edit');
    Route::put('/suplementos/{suplement}', [SuplementController::class, 'update'])->name('suplementos.update');
    Route::patch('/suplementos/{suplement}/updateStatus', [SuplementController::class, 'updateStatus'])->name('suplementos.updateStatus');

    Route::resource('shifts', ShiftController::class);

    // Rotas dos taxis
    Route::get('/taxis/create', [TaxiController::class, 'create'])->name('taxis.create');
    Route::post('/taxis', [TaxiController::class, 'store'])->name('taxis.store');
    Route::get('/dataTaxis', [TaxiController::class, 'index'])->name('taxi.index');
    Route::get('/formTaxis', [TaxiController::class, 'showForm'])->name('taxi.showForm');
    Route::get('/taxis/create', [TaxiController::class, 'create'])->name('taxis.create');
    Route::patch('/taxis/{taxi}/updateStatus', [TaxiController::class, 'updateStatus'])->name('taxis.updateStatus');
    Route::resource('taxis', TaxiController::class)->except(['show']);
    Route::get('/taxis/{taxi}/edit', [TaxiController::class, 'edit'])->name('taxis.edit');
    Route::put('/taxis/{taxi}', [TaxiController::class, 'update'])->name('taxis.update');

    Route::get('/startTurno', [ShiftController::class, 'showForm'])->name('startTurno');
    Route::get('/dataTurnos', [ShiftController::class, 'index'])->name('dataTurnos');
    Route::resource('turnos', ShiftController::class);
    Route::get('/turnos/{turno}/edit', [ShiftController::class, 'edit'])->name('turnos.edit');
    Route::put('/turnos/{turno}', [ShiftController::class, 'update'])->name('turnos.update');
    Route::delete('/turnos/{turno}', [ShiftController::class, 'destroy'])->name('turnos.destroy');
    Route::get('/formTurnos', [ShiftController::class, 'create'])->name('formTurnos');
    Route::post('/turnos', [ShiftController::class, 'store'])->name('turnos.store');

    //Rotas dos tipos de viagens
    Route::get('/trip-types', [TripTypeController::class, 'index'])->name('trip-types.index');
    Route::get('/trip-types/create', [TripTypeController::class, 'create'])->name('trip-types.create');
    Route::post('/trip-types', [TripTypeController::class, 'store'])->name('trip-types.store');
    Route::get('/trip-types/{tripType}/edit', [TripTypeController::class, 'edit'])->name('trip-types.edit');
    Route::put('/trip-types/{tripType}', [TripTypeController::class, 'update'])->name('trip-types.update');
    Route::patch('/trip-types/{tripType}/updateStatus', [TripTypeController::class, 'updateStatus'])->name('trip-types.updateStatus');
    
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
