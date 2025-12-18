<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Events\DailyAnswersThresholdReached;
use App\Models\Survey;

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
        $this->info('Command executed successfully.');


        $surveys = Survey::all();

        foreach ($surveys as $survey) {
            if ($survey->total_daily_answers >= 10) {
                event(new DailyAnswersThresholdReached($survey));
            }
        }

        return Command::SUCCESS;
    }
}
