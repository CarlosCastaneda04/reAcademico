<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UsuarioCreadoMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $nombre;
    public $email;
    public $rol;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nombre, $email,$rol)
    {
        $this->nombre = $nombre;
        $this->email = $email;
        $this->rol = $rol;
    }



    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Bienvenido a la plataforma')
                    ->view('emails.usuario_creado');
    }
}
