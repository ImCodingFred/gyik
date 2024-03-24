<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataController;
use App\Http\Controllers\UserController;

Route::get('/',[DataController::class, 'welcome']);
//Route::get('/kereses',[DataController::class, 'Search']);
Route::view('/kereses', 'kereses');
Route::post('/kereses',[DataController::class, 'SearchPost']);
Route::get('/letrehozas',[DataController::class,'Tema']);
Route::post('/letrehozas',[DataController::class,'TemaData']);
Route::get('/tema/{id}',[DataController::class,'EgyTema']);
Route::post('/tema/{id}',[DataController::class,'EgyTemaData']);
Route::get('/temak',[DataController::class,'OsszTema']);

/*Users */
Route::view('/regisztracio','reg');
Route::post('/regisztracio',[UserController::class,'RegPost']);

Route::view('/belepes','login');
Route::post('/belepes',[UserController::class,'LoginPost']);

Route::get('/kijelentkezes',[UserController::class,'Logout']);


Route::get('/profil',[UserController::class,'Profil']);

Route::get('/mod',[UserController::class,'Mod']);
Route::Post('/mod',[UserController::class,'ModData']);

Route::get('/jelszomod',[UserController::class,'Pass']);
Route::Post('/jelszomod',[UserController::class,'PassData']);

Route::get('/profil-torles',[UserController::class,'alert']);
Route::get('/del',[UserController::class,'Del']);

Route::view('/szabalyzat','szabalyzat');
Route::view('/impresszum','impresszum');
Route::view('/jog','jog');
Route::view('/adatvedelem','adatvedelem');
