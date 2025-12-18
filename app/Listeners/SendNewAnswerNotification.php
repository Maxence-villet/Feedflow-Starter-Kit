<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\SurveyAnswerSubmitted;
use App\Mail\NewAnswerSubmittedMail;
use Illuminate\Support\Facades\Mail;


class SendNewAnswerNotification implements ShouldQueue
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
    public function handle(SurveyAnswerSubmitted $event): void
    {
        Mail::to($event->email)->send(
            new NewAnswerSubmittedMail($event->survey)
        );
    }
}
