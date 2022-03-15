<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

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


Route::get("/login", 'LoginController@index');
Route::post("/login/auth", 'LoginController@auth');

Route::get("/", 'HomeController@index');

// Cabang Olahraga
Route::get("/cabang-olahraga", 'CabangOlahragaController@index');
Route::post("/cabang-olahraga/simpan", 'CabangOlahragaController@simpan');
Route::post("/cabang-olahraga/update", 'CabangOlahragaController@update');
Route::post("/cabang-olahraga/deleted", 'CabangOlahragaController@deleted');

// Organisasi
Route::get("/organisasi", 'OrganisasiController@index');
Route::post("/organisasi/simpan", 'OrganisasiController@simpan');
Route::post("/organisasi/update", 'OrganisasiController@update');
Route::post("/organisasi/deleted", 'OrganisasiController@deleted');
