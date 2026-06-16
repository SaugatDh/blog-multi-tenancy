<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
class AuthController extends Controller
{
    public function showRegister(){
        return view('auth.register');
    }

    public function register(Request $request){
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
        ]);
        $validated['password'] = Hash::make($validated['password']);
        $validated['role'] = 'user';
        $user = User::create($validated);

        Auth::login($user);

        return redirect()->route('posts.index');
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request){
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($validated)){
            $request->session()->regenerate();
            if (auth()->user()->isAdmin()){
                return redirect()->route('admin.posts.index');
            }
            return redirect()->route('posts.index');
        }
        return back()
        ->withErrors([
            'email'=>'Invalid email or password.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');

    }
}
