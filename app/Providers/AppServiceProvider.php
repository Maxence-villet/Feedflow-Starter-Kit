<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Events\SurveyAnswerSubmitted;
use App\Listeners\SendNewAnswerNotification;
use App\Events\DailyAnswersThresholdReached;
use App\Listeners\SendDailyReport;

class AppServiceProvider extends ServiceProvider
{
    protected $listen = [
        SurveyAnswerSubmitted::class => [
            SendNewAnswerNotification::class,
        ],

        DailyAnswersThresholdReached::class => [
            SendDailyReport::class,
        ],
    ];
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
