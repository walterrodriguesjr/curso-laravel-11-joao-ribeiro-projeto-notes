<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        echo 'inside the app!';
    }

    public function newNote()
    {
        echo 'creating new note!';
    }
}
