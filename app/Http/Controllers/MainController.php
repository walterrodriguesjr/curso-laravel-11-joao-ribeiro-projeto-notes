<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class MainController extends Controller
{
    public function index()
    {
        //load user's notes
        $id = session('user.id');
        $user = User::find($id)->toArray();
        $notes = User::find($id)->notes()->get()->toArray();

        //show home view
        return view('home', ['notes' => $notes]);
    }

    public function newNote()
    {
        echo 'creating new note!';
    }

    public function editNote($id)
    {
        $id = $this->decryptId($id);
        echo "i'm editing note with id = $id";
    }

    public function deleteNote($id)
    {
        $id = $this->decryptId($id);
        echo "i'm deleting note with id = $id";
    }

    //função que permite reutilizar a funcionalidade de desencriptação
    private function decryptId($id)
    {
        try {
            $id = Crypt::decrypt($id);
        } catch (DecryptException $e) {
            return redirect()->route('home');
        }
        return $id;
    }
}
