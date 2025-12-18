<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\DailyAnswersThresholdReached;
use App\Mail\DailyReportMail;
use Illuminate\Support\Facades\Mail;

class SendDailyReport implements ShouldQueue
{
    use InteractsWithQueue;
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
    public function handle(DailyAnswersThresholdReached $event): void
    {
        Mail::to($event->email)->send(
            new DailyReportMail($event->survey)
        );
    }
}
