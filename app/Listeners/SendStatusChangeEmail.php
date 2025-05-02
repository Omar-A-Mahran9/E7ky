<?php

namespace App\Listeners;

use App\Events\CustomerStatusChanged;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendStatusChangeEmail implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  CustomerStatusChanged  $event
     * @return void
     */
    public function handle(CustomerStatusChanged $event)
    {
        // Logic to send the email
        $vendor = $event->vendor;
        $status = $event->status;
        $resetLink = $event->resetLink;
        // Assuming you have a mailable class CustomerStatusChangedMail
        Mail::to($vendor->email)->send(new \App\Mail\CustomerStatusChangedMail($vendor, $status, $resetLink));
    }
}
