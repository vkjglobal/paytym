<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Exports\Employer\PaymentExport;
use Carbon\Carbon;
use App\Models\Employer;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class SplitPayment extends Command
{

    protected $signature = 'send:bankcsv';


    protected $description = 'To send the payroll amount for bank account in csv file';


    public function handle()
    {
        //sending payroll csv file through email
        $EmployerId = Auth::guard('employer')->id();
        dd($EmployerId);
        $export = new PaymentExport();
        $store = Storage::put('exports/payroll.csv', Excel::raw($export, \Maatwebsite\Excel\Excel::CSV));
        $path = 'exports/payroll.csv';
        Mail::send([], [], function ($message) use ($path, $EmployerId) {
            $hr = User::where('employer_id', $EmployerId)->where('position', 1)->first();
            $finance = User::where('employer_id', $EmployerId)->where('position', 5)->first();
            if($finance == null){
                $to = [$hr->email];
            }elseif($hr == null){
                $to = [$finance->email];
            }elseif($finance == null && $hr == null){
                $employer = Employer::where('employer_id', $EmployerId)->first();
                $to = $employer->email;
            }else{
                $to = [$hr->email, $finance->email];
            }
            $message->to($to)
                    ->subject('Payroll csv file created on:'.Carbon::today()->format('d-m-Y'))
                    ->attach(Storage::path($path), [
                        'as' => 'users.csv',
                        'mime' => 'text/csv'
                    ]);
        });
        Storage::delete($path); 
        //end sending
        return Command::SUCCESS;
    }
}
