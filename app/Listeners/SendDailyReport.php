<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\DailyAnswersThresholdReached;

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
        Mail::to('admin@example.com')->send(
            new ArticlePublishedMail($event->article)
        );
    }
}
