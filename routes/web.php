<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Middleware\CheckIsLogged;
use App\Http\Middleware\CheckIsNotLogged;
use Illuminate\Support\Facades\Route;

//auth routes
Route::middleware([CheckIsNotLogged::class])->group(function(){
    Route::get('/login', [AuthController::class, 'login']);
    Route::post('/loginSubmit', [AuthController::class, 'loginSubmit']);
});

Route::middleware([CheckIsLogged::class])->group(function () {
    Route::get('/', [MainController::class, 'index'])->name('home');
    Route::get('/newNote', [MainController::class, 'newNote'])->name('new');
    Route::post('/newNoteSubmit', [MainController::class, 'newNoteSubmit'])->name('newNoteSubmit');
    //edit note
    Route::get('/editNote/{id}', [MainController::class, 'editNote'])->name('edit');
    //delete note
    Route::get('/deletenote/{id}', [MainController::class, 'deleteNote'])->name('delete');
    //logout
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
