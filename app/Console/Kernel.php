<?php

namespace App\Console;

use App\Events\MonthlyBillingEvent;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    // protected function schedule(Schedule $schedule): void
    // {
    //     $schedule->call(function () {
    //         event(new MonthlyBillingEvent());
    //     })->everyMinute()
    //     ->appendOutputTo('schedular.log');
    //     ->monthlyOn(1, '00:00')
    // }

    protected function schedule(Schedule $schedule): void
    {
        $schedule->call(function () {
            event(new MonthlyBillingEvent());
        }) ->everyMinute();
        //->monthlyOn(1, '00:00')->shouldAppendOutput('schedular.log');
    }



    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
