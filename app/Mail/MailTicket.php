<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MailTicket extends Mailable
{
    use Queueable, SerializesModels;

    protected $data;
    protected $vehicleP;
    protected $vehicleT;
    protected $passenger;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data, $vehicleP, $vehicleT, $passenger)
    {
        $this->data = $data;
        $this->vehicleP = $vehicleP;
        $this->vehicleT = $vehicleT;
        $this->passenger = $passenger;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('booking.tiket', ['data' => $this->data, 'vehicleP' => $this->vehicleP, 'vehicleT' => $this->vehicleT, 'passenger' => $this->passenger]);
    }
}
