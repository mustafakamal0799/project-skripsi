<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index() {
        return view('login');
    }

    public function authentication(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required']
        ]);

        // Check if the username exists
        $user = User::where('username', $request->username)->first();

        if ($user) {
            // Check if the password is correct
            if (Auth::attempt($credentials)) {
                if (Auth::user()->position_id == 1) {
                    return redirect('/dashboard');
                }
                if (Auth::user()->position_id == 2) {
                    return redirect('/dashboard');
                }
            } else {
                // Username is correct but password is wrong
                return redirect('/')->with('error', 'Password Salah');
            }
        } else {
            // Username does not exist
            $userWithSamePassword = User::where('password', bcrypt($request->password))->first();
            if ($userWithSamePassword) {
                return redirect('/')->with('error', 'Username Salah');
            } else {
            return redirect('/')->with('error', 'Username dan Password Salah');
            }
        }
    }
}
