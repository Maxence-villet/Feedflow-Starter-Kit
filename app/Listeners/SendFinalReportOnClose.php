<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\SurveyClosed;
use App\Mail\FinalReportOnCloseMail;
use Illuminate\Support\Facades\Mail;

class SendFinalReportOnClose
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(SurveyClosed $event): void
    {
        Mail::to($event->email)->send(
            new FinalReportOnCloseMail($event->survey)
        );
    }
}
