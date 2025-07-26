<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('kirim:email')->weekly()->mondays()->at('07:00')->timezone('Asia/Jakarta');
        $schedule->command('kirim:email2')->weekly()->mondays()->at('07:00')->timezone('Asia/Jakarta');
        $schedule->command('reset:cuti')->dailyAt('07:00')->timezone('Asia/Jakarta');
        $schedule->command('create:shift')->monthly()->timezone('Asia/Jakarta');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
