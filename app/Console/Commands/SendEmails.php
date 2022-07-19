<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Models\Subscription;




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
            'name' => "Inisev"
       );


        Mail::send('email.allsubscribers', $data, function ($message) {
            $subscribers = Subscription::all();

            foreach ($subscribers as $subscriber) {

            $message->from('oluyosolaafolabi@gmail.com');

            $message->to($subscriber->email)->subject('Welcome');
            }

        });
        $this->info('Emails sent successfully!');
    }    
}

