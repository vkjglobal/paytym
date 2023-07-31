<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf;
use symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Mail;

class SendEmployeeInfo implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $data;
    protected $user;
    protected $rolename;
    
    public function __construct($data,$user,$rolename)
    {
        $this->data = $data;
        $this->user = $user;
        $this->rolename = $rolename;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $data = $this->data;
        $user = $this->user;
        $rolename = $this->rolename;
        $pdf = PDF::LoadView('employer.user.publicinformation',$data, compact('user','rolename'));
        try{
            Mail::send('employer.user.publicinformation',$data,function($message) use ($data, $pdf)
            { 
           
             $message->to($data["email"])
                     ->subject('Employee Information of ' .$data["name"])
                     ->attachData($pdf->output(),"information.pdf");
            }); 
            notify()->success(__('User information shared successfully'));
            return redirect()->route('employer.user.index');
        }catch (TransportExceptionInterface $e){
            notify()->error(__('Failed to Send. Please check the email and try again'));
            return redirect()->route('employer.user.index');
        }   
    }
}
