<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SendSurveyDailyReports extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-survey-daily-reports';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'each day, a mail report is sent to creator for the survey who have more than 10 answers';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        return 0;
    }
}
