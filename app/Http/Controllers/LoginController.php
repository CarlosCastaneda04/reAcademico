<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\IpVerificationMail;

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
            $userId = $user[0]->id;
            $currentIp = $request->ip();

            // Verificar si la IP ya está permitida
            $ipAllowed = DB::select('SELECT * FROM user_ips WHERE user_id = ? AND ip = ?', [$userId, $currentIp]);

            if (!$ipAllowed) {
                // Enviar correo de verificación de IP
                Mail::to($user[0]->email)->send(new IpVerificationMail($user[0], $currentIp));

                // Redirigir a la pantalla de espera de verificación
                return redirect()->route('ip.verification.wait');
            }

            // Si la IP está permitida, iniciar sesión
            Auth::loginUsingId($userId);
            return redirect()->route('home');
        }

        return redirect()->route('login')->withErrors(['email' => 'Las credenciales no coinciden']);
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('login');
    }
}
