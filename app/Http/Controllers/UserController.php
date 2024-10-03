<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(){

    }
    public function login(Request $request){
        if(Auth::check()){
            return redirect('/');
        }
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if(Auth::attempt(['email' => $validated['email'], 'password' => $validated['password']])){
            $user = User::where('email', $validated['email'])->first();
            Auth::login($user);
            return redirect('/');
        }
        return back()->withErrors(['email' => 'Неверный логин или пароль']);
    }
}
