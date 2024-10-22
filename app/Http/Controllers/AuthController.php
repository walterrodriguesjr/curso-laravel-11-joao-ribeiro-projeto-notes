<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    

    public function loginSubmit(Request $request) {
        //form validation
        $request->validate(
            //rules
            [
            'text_username' => 'required|email',
            'text_password' => 'required|min:6|max:16'
            ],
            [
            //error message
            'text_username.required' => 'O username é obrigatório',
            'text_username.email' => 'O username deve ser um e-mail válido',
            'text_password.required' => 'O password é obrigatório',
            'text_password.min' => 'O password deve ter pelo menos :min caracteres',
            'text_password.max' => 'O password deve ter no máximo :max caracteres',
            ]);

        //get user name
        $username = $request->input('text_username');
        $password = $request->input('text_password');

        //check if user exists 
        $user = User::where('username', $username)
                    ->where('deleted_at', NULL)
                    ->first();

       if(!$user){
        return redirect()
               ->back()
               ->withInput()
               ->with('loginError', 'Username ou password incorretos!');
       }
       //check if password is correct 
       if(!password_verify($password, $user->password)){
        return redirect()
               ->back()
               ->withInput()
               ->with('loginError', 'Username ou password incorretos!');
       }
        //update last login
       $user->last_login = date('Y-m-d H:i:s');
       $user->save();

       //login user 
       session([
        'user' => [
            'id' => $user->id,
            'username' => $user->username 
        ]
        ]);

   

        echo 'LOGIN COM SUCESSO!';

       }

    
    //logout from the application
    public function logout()
    {
        session()->forget('users');
        return redirect()->to('/login');
        
    }
}
