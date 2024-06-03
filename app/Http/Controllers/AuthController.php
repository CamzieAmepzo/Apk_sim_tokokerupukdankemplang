<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('halaman_utama.login');
    }

    public function proses_login(Request $request)
    {
        $request->validate([
            'username' => 'equired',
            'password' => 'equired',
        ]);

        $credentials = $request->only('username', 'password');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->status == 'admin') {
                return redirect()->intended(route('admin.dashboard'));
            } elseif ($user->status == 'pegawai1') {
                return redirect()->intended(route('pegawai1.dashboard'));
            } elseif ($user->status == 'pegawai2') {
                return redirect()->intended(route('pegawai2.dashboard'));
            }
            return redirect()->route('home');
        }
        return redirect()->route('login')->withErrors(['username' => 'Invalid username or password']);
    }

   public function adminDashboard()
{
    if (Auth::user()->status == 'admin') {
        return view('admin.dashboard', ['title' => 'Admin Dashboard']);
    } else {
        return redirect()->route('home');
    }
}

public function pegawai1Dashboard()
{
    if (Auth::user()->status == 'pegawai1') {
        return view('pegawai1.dashboard', ['title' => 'Pegawai 1 Dashboard']);
    } else {
        return redirect()->route('home');
    }
}

public function pegawai2Dashboard()
{
    if (Auth::user()->status == 'pegawai2') {
        return view('pegawai2.dashboard', ['title' => 'Pegawai 2 Dashboard']);
    } else {
        return redirect()->route('home');
    }
}

    public function logout(Request $request)
    {
        $request->session()->flush();
        Auth::logout();
        return redirect()->route('login');
    }
}
