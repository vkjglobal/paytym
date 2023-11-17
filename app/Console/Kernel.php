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
        "App\Console\Commands\SendAccountDeactivationEmail",
        "\App\Console\Commands\ProcessPayrollReminder",
        "App\Console\Commands\ProjectBudgetReached",
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
       /* $schedule->command('invoices:add')
        ->monthlyOn(27, '15:19')
        ->timezone('Asia/Kolkata'); */

 /*   $schedule->command('invoices:add')
             ->monthlyOn(1, '00:00'); */
             //->timezone('Pacific/Fiji');  

        $schedule->command('db:backup')->daily();
        $schedule->command('send:employment-over-email')->daily();
        $schedule->command('send:payment-reminder')->monthlyOn(6, '00:00');
        $schedule->command('email:account-deactivation')
        ->monthlyOn(8, '00:00');
        //$schedule->command('send:login_credentials')->twiceDaily(24 ,18);
        $schedule->command('invoices:add')->monthlyOn(1, '00:00');
        
        $schedule->command('payroll:reminder')
        ->dailyAt('00:00');
      
       /*  $schedule->command('project budget reached:reminder')
        ->dailyAt('16:59');  */   
             
          
             
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
