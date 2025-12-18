<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Survey;
use App\Events\SurveyClosed;

class CheckForSurveyToClose extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-for-survey-to-close';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check for surveys to close if their end date has passed';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Command executed successfully.');

        $surveys = Survey::getSurveysToClose();

        foreach ($surveys as $survey) {
            event(new SurveyClosed($survey));
            $survey->is_active = false;
            $survey->save();
        }

        return Command::SUCCESS;
    }
}
