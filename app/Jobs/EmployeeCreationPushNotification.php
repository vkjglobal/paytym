<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use App\Models\User;

class EmployeeCreationPushNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $employer_id;
    protected $employeeBranch;
    protected $position;
    protected $employeeName;

    public function __construct($employer_id,$employeeBranch,$position,$employeeName)
    {
        $this->employer_id = $employer_id;
        $this->employeeBranch = $employeeBranch;
        $this->position = $position;
        $this->employeeName = $employeeName;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $employerId = $this->employer_id;
        $employeeBranch = $this->employeeBranch;
        $position = $this->position;
        $employeeName = $this->employeeName;
        $message = $employeeName ." has been added to ".$employeeBranch . " as" . $position ;
        $employees= User::where('employer_id' , $employerId)->get();

        foreach($employees as $user){

            if ($user->device_id) {
                $deviceToken = $user->device_id;
                // $deviceToken ="dxKlDTGET6OgTWjsyPCAkG:APA91bH5Sh6oBWvZzgELdjlc6-U6ghe37EeoF75KJqBAIZUhx0lG6tAgnlXn6QnLxCez_XKSlIlkNVVamEa0sRWVai51f12dMMsbxHWaodN_IDgcooMkyGw8PLsADrlBpq0Zi943TwIr";
                              
                $url = 'https://fcm.googleapis.com/fcm/send';
    
                $headers = [
                    'Authorization' => 'key=AAAAmB77ark:APA91bFXkWwXAW_cKzE_dRmc9efC0pHD4R-6tUXArCht88ABJi-50ug3pvDVcxs6Obe_Qj58D_jrJcCuKqkvja7BcVBqCQy_solhOb-1H1KzzCRvFTyicc3wrEJqBmF68mRMDwFR52h3',
                    'Content-Type' => 'application/json'
                ];
                $data = [
                    'to' => $deviceToken,
                    'notification' => [
                        'title' => 'You have a new notification',
                        'body' => $message
                    ],
                ];
                $response = Http::withHeaders($headers)->post($url, $data);
                
                // Check for HTTP errors
                if ($response->failed()) {
                    throw new Exception('Failed to send FCM notification: ' . $response->body());
                    continue;
                }
                
                // Parse the response body
                $responseBody = $response->json();
        } 

        }

        
        

    }
}
