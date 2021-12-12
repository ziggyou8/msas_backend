<?php

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

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

Route::get("/", function () {
    return view("welcome");
});

Route::get('/send-mail', function () {
   
    $details = [
        'title' => 'Création compte MSAS',
        'body' => 'Bonjour, Vous êtes désigné comme piont focal pour gérer l\'activité de la structure POSTE DE SANTE DE PARCELLE'
    ];
   
    Mail::to('myrespect4all@gmail.com')->send(new \App\Mail\CreatedAcountMailer($details));
   
   // dd("Email is Sent.");
});
