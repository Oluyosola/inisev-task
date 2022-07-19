<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Models\Subscriber;




class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'emails:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sending Emails to Subscribers';

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
     * @return int
     * 


     */


    
        
    public function handle(Request $request)
    {
        $data = array(
            'name' => "xxx"
       );


        Mail::send('email.sub', $data, function ($message) {
            $subscribers = Subscriber::all();
            

            foreach ($subscribers as $subscriber) {

            $message->from('oluyosolaafolabi@gmail.com');

            $message->to($subscriber->email)->subject('Hi');
            }

        });
        $this->info('Emails sent successfully!');
    }    
}

