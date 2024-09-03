<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

// $config['simae_mail_protocol'] = "smtp";
// $config['simae_smtp_server'] = "smtp-relay.sendinblue.com";
// $config['simae_smtp_port'] = "587";
// $config['simae_smtp_timeout'] = "7";
// $config['simae_smtp_user'] = "simaefab@gmail.com";
// $config['simae_smtp_password'] = "Oq6P7kTL3Sy12w0H";


class TestMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($detalles)
    {
        //
        $this->detalles = $detalles; 
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Test mail Casa Propia')->view('intro', ['detalles'=> $this->detalles]);
    }
}
