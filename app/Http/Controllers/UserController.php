<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){

    }
    public function login(Request $request){
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(Auth::attempt($validated)){
            $user = User::where('email', $validated['email'])->first();
            Auth::login($user);
            return redirect('/');
        }
        return back()->withErrors(['email' => 'Неверный логин или пароль']);
    }
    public function register(Request $request){
        $validated = $request->validate([
            'name' => 'required|min:3|max:20',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:4|max:255',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        Auth::login($user);
        return redirect('/');
    }
    public function logout(){
        Auth::logout();
        return redirect('user/login');
    }
    public function profile(){
        $user = User::find(Auth::id());
        return view('user.profile', compact('user'));
    }
}
