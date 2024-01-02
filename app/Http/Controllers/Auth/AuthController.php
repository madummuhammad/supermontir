<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;

class AuthController extends Controller
{
    public function index()
    {
        return Inertia::render('Auth/Login');
    }

    public function _login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->with('loginError', 'Login Gagal! Username atau password salah');
    }

    public function register()
    {
        return Inertia::render('Auth/Register');
    }

    public function _register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
            'wa' => 'required|numeric',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'wa' => $request->wa,
            'password' => Hash::make($request->password),
        ]);

        return redirect('login');
    }

    public function me()
    {
        if (Auth::check()) {
            return response()->json(['status' => 'logged', 'data' => auth()->user()]);
        } else {
            return response()->json(['status' => 'logout']);
        }
    }

    public function logout(Request $request)
    {
        Session::flush();

        return response()->json(['status' => 'success', 'message' => 'Berhasil logout']);

    }

}