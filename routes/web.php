<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Community\CommunityController;
use App\Http\Controllers\District\DistrictController;
use App\Http\Controllers\Pronvice\ProvinceController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    //return view('welcome');
    return redirect('/login');
});

Auth::routes();

/*
//Si un intruso quiere acceder a la ruta de laravel /register lo redireccionara al login
Route::match(['get', 'post'], 'register', function(){
    return redirect('/login');
});
*/

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', function() {
    return redirect('/admin');
});
Route::get('/admin', [AdminController::class, 'index'])->name("admin");


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group([
    'middleware' => 'auth',
    'prefix'     => '/admin',
    'as'         => 'admin.'
], function () {

   Route::resource('communities', CommunityController::class);
   Route::get('/communities/{id}/confirm', [CommunityController::class, 'confirm'])->name('communities.confirm');



    Route::get('/user', [AdminController::class, 'userConfig'])->name("userConfig");
    Route::post('/user', [AdminController::class, 'updateUserPassword'])->name("updateUserPassword");

    Route::get('cancelar/{ruta}', function($ruta) {
        return redirect()->route($ruta)->with('cancelar','Acción Cancelada!');
    })->name('cancelar');

    // ruta para buscar las provincias por un departamento
    Route::post('/pronvice/searchProvincesByDepartment', [ProvinceController::class, 'searchProvincesByDepartment'])
    ->name("searchProvincesByDepartment");
    // ruta para buscar los distritos por una provincia
    Route::post('/district/searchDistrictsByProvince', [DistrictController::class, 'searchDistrictsByProvince'])
    ->name("searchDistrictsByProvince");

});