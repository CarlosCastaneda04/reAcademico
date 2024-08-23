<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class IpVerificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $ip;

    public function __construct($user, $ip)
    {
        $this->user = $user;
        $this->ip = $ip;
    }

    public function build()
    {
        return $this->view('emails.ip_verification')
                    ->subject('Verificación de IP')
                    ->with([
                        'nombre' => $this->user->nombre,
                        'ip' => $this->ip,
                    ]);
    }
}
