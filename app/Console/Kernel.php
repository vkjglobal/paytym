<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $command = [
        "App\Console\Commands\DbBackup",
        "App\Console\Commands\EmploymentOverEmails",
        "App\Console\Commands\SendLoginCredentials",
        "App\Console\Commands\SplitPayment",
        "App\Console\Commands\AddInvoices",
        "App\Console\Commands\SendPaymentReminder",
        "App\Console\Commands\SendAccountDeactivationEmail"
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
        $schedule->command('invoices:add')
        ->monthlyOn(12, '9:14')
        ->timezone('Asia/Kolkata'); 
        $schedule->command('db:backup')->daily();
        $schedule->command('send:employment-over-email')->daily();
        $schedule->command('send:payment-reminder')->monthlyOn(11, '17:00');
        $schedule->command('email:account-deactivation')
        ->monthlyOn(11, '17:00');
        //$schedule->command('send:login_credentials')->twiceDaily(24 ,18);
        //$schedule->command('invoices:add')->monthlyOn(30, '23:50');
        
      /*   $schedule->command('invoices:add')
             ->monthlyOn(30, '23:00')
             ->timezone('Pacific/Fiji');  */
             
             
          
             
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
