<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $command = [
        "App\Console\Commands\DbBackup",
        "App\Console\Commands\CalculatePayroll",
        "App\Console\Commands\EmploymentOverEmails"
    ];
    
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->command('db:backup')->daily();
        $schedule->command('payroll:hourly')->daily();
        $schedule->command('payroll:fixed')->daily();
        $schedule->command('send:employment-over-email')->daily();
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
