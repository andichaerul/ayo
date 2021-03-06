<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;


Route::get("/login", 'LoginController@index');
Route::post("/login/auth", 'LoginController@auth');

Route::get("/", 'HomeController@index');

// Cabang Olahraga
Route::get("/cabang-olahraga", 'CabangOlahragaController@index');
Route::post("/cabang-olahraga/simpan", 'CabangOlahragaController@simpan');
Route::post("/cabang-olahraga/deleted/{id}", 'CabangOlahragaController@deleted');
Route::post("/cabang-olahraga/{id}/update", 'CabangOlahragaController@update');

// Organisasi
Route::get("/organisasi", 'OrganisasiController@index');
Route::post("/organisasi/simpan", 'OrganisasiController@simpan');
Route::post("/organisasi/update", 'OrganisasiController@update');
Route::post("/organisasi/deleted", 'OrganisasiController@deleted');

// member
Route::get("/member/{id}", 'MemberController@index');
Route::post("/member/simpan", 'MemberController@simpan');
Route::post("/member/update", 'MemberController@update');
Route::post("/member/deleted", 'MemberController@deleted');

// Team
Route::get("/team", 'TeamController@index');
Route::post("/team/simpan", 'TeamController@simpan');
Route::post("/team/update", 'TeamController@update');
Route::post("/team/deleted", 'TeamController@delete');

// Acara
Route::get("/jadwal-acara", 'JadwalAcaraController@index');
Route::post("/jadwal-acara/simpan", 'JadwalAcaraController@simpan');
Route::post("/jadwal-acara/get-member", 'JadwalAcaraController@getMember');
Route::post("/jadwal-acara/selesai", 'JadwalAcaraController@selesai');
Route::post("/jadwal-acara/get-resume", 'JadwalAcaraController@getResume');
