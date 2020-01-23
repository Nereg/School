<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Queue;
use App\Jobs\SendPasswordEmail;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Cartalyst\Sentinel\Laravel\Facades\Activation;
use Cartalyst\Sentinel\Laravel\Facades\Reminder;
use Mail;
use App\Mail\PasswordEmail;
class Debug extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'debug';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $id = 2;
        $reminder = Reminder::create(Sentinel::findById($id));
        $user = Sentinel::findById($id);
        if (is_null($user)){
            return 'No such user with id'. $id;
        }
        else
        {
            $Reminder = Reminder::exists($user);
            var_export($Reminder);
            if($Reminder)
            {
                $code = $Reminder->code;
                $user = json_decode($user);
                $email = $user->email; //get email adress 
                $name = $user->first_name; //get name of user
                Mail::to($email)->send(new PasswordEmail($code,$name,$id));
            }
            else
            {
                return 'No reminder !';
            }
        }
    }
}
