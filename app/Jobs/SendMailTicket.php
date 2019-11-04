<?php

namespace App\Jobs;

use App\Mail\MailTicket;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class SendMailTicket implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;
    protected $vehicleP;
    protected $vehicleT;
    protected $passenger;

    /**
     * Create a new job instance.
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
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->data[0]['email'])->send(new MailTicket($this->data, $this->vehicleP, $this->vehicleT, $this->passenger));
    }
}
