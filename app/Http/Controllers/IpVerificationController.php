<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class IpVerificationController extends Controller
{
    public function verify($userId, $ip)
    {
        // Insertar la IP permitida en la base de datos
        DB::insert('INSERT INTO user_ips (user_id, ip) VALUES (?, ?)', [$userId, $ip]);

        // Redirigir al login con un mensaje de éxito
        return redirect()->route('login')->with('success', 'IP verificada con éxito. Ahora puedes iniciar sesión.');
    }
}
