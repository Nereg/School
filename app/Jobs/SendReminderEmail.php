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
use App\Mail\VerificationEmail;

class SendReminderEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function genRandStr($length = 6) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public $Id = 0;
    /**
    * Создание нового экземпляра задачи.
    *
    * @param  Podcast  $podcast
    * @return void
    */
    public function __construct($Id)
    {
        $this->Id =  $Id;
    }
    /**
     * Execute the job.
     * @param int Id of user to which send email
     * @return void
     */
    public function handle()
    {
        $user = Sentinel::findById($this->Id);
        if (is_null($user)){
            return new Exeption ('No such user with id'. $this->Id);
        }
        else
        {
            $activation = Activation::create($user);
            $user = json_decode($user);
            $activation = json_decode($activation);
            $email = $user->email; //get email adress 
            $name = $user->first_name; //get name of user
            $code = $activation->code;
            Mail::to($email)->send(new VerificationEmail($code,$this->Id,$name));
        }
    }
}
