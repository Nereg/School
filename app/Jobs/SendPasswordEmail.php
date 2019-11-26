<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use Mail;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Cartalyst\Sentinel\Laravel\Facades\Activation;
use App\User;
use App\Mail\PasswordEmail;
use Cartalyst\Sentinel\Laravel\Facades\Reminder;

class SendPasswordEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    public $Id = 0;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($Id)
    {
        $this->Id = $Id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $user = Sentinel::findById($this->Id);
        if (is_null($user)){
            return 'No such user with id'. $this->Id;
        }
        else
        {
            $Reminder = Reminder::exists($user);
            if($Reminder)
            {
                $code = $Reminder->code;
                $user = json_decode($user);
                $email = $user->email; //get email adress 
                $name = $user->first_name; //get name of user
                var_export(Mail::to($email)->send(new PasswordEmail($code,$name,$this->Id)));
            }
            else
            {
            }
        }
    }
}
