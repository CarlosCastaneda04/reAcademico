<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Asegúrate de importar Auth
use Illuminate\Support\Facades\DB;   // Asegúrate de importar DB

class LoginController extends Controller
{
    public function showLoginForm() {
        return view('auth.login');
    }

    public function login(Request $request) {
        $email = $request->input('email');
        $password = $request->input('password');

        $user = DB::select('SELECT * FROM usuarios WHERE email = ?', [$email]);

        // Comparación directa sin encriptación
        if ($user && $password === $user[0]->password) {
            Auth::loginUsingId($user[0]->id);
            return redirect()->route('home');
        }

        return redirect()->route('login')->withErrors(['email' => 'Las credenciales no coinciden']);
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('login');
    }
}
