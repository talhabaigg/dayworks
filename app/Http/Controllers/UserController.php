<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Project;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function checkauth(){
        if (auth()->check()) {
            return redirect('/projects');
        } else {
            return redirect('/login');
        }
    }

    public function showregisterpage(){
        if (auth()->check()) {
            return redirect('/projects');
        } else {
            return view('register');
        }
    }

    public function showloginpage(){
        if (auth()->check()) {
            return redirect('/projects');
        } else {
            return view('login');
        }
    }
    public function logout() {
        auth()->logout();
        return redirect('/')->with('success', 'You are now logged out.');
    }

    public function login(Request $request) {
        $incomingFields = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if (auth()->attempt(['email' => $incomingFields['email'], 'password' => $incomingFields['password']])) {
            $request->session()->regenerate();
            return redirect('/')->with('success', 'You are now logged in.');
        } else {
            return 'Sorry!!!';
        }
    }

    public function register(Request $request) {
        $incomingFields = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);
        $incomingFields['password'] = bcrypt($incomingFields['password']);
        User::create($incomingFields);
        return 'Hello from register function';
    }
}
