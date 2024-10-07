<?php

use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;


Route::get('/about', function(){
    echo 'about us';
});

Route::get('/main/{value}',[MainController::class, 'index']);
