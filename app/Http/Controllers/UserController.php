<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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
        session()->regenerate();
        return redirect('/');
    }
    public function profile(){
        $user = User::find(Auth::id());
        return view('user.profile', compact('user'));
    }
    public function show($id)
    {
        $user = User::find($id);
        return view('user.show', compact('user'));
    }
    public function edit($id){
        $user = User::find($id);
        return view('user.edit', compact('user'));
    }

    public function update(Request $request){
        $validated = $request->validate([
            'name' => 'required|min:3|max:20',
            'email' => 'required|email|unique:users,email,'.Auth::id(),
        ]);
        $user = User::find(Auth::id());
        if(!empty($request->avatar)){
            if($user->avatar !== 'avatar.png'){
                Storage::delete('public/'. $user->avatar);
            }
            $avatar = $request->file('avatar')->store('public');
            $avatar = $request->avatar->hashName();
            User::where('id', Auth::id())->update([
                'avatar' => $avatar,
            ]);
        }

        User::where('id', Auth::id())->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
        ]);

        session()->regenerate();
        Auth::login($user);

        return redirect()->route('user.profile');
    }
    public function updatePassword(Request $request){

    }
    public function destroy(Request $request){
        $user = User::find(Auth::id());
        Auth::logout();
        session()->regenerate();
        if($user->avatar === 'avatar.png'){
            User::destroy($user->id);
            return redirect()->route('user.login');
        }
        Storage::delete('public/'.$user->avatar);
        User::destroy($user->id);
        return redirect()->route('user.login');
    }

}
