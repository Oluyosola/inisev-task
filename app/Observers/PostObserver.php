<?php

namespace App\Observers;

use App\Models\Post;
use App\Models\Website;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

use App\Models\Subscription;

class PostObserver
{
    /**
     * Handle the Post "created" event.
     *
     * @param  \App\Models\Post  $post
     * @return void
     */
    public function created(Post $post)
    {

        $data = array(
            'name' => "xxx"
       );


        Mail::send('email.sub', $data, function ($message) {

            

            $subscribers = Subscription::all();

            foreach ($subscribers as $subscriber) {

            $message->from('oluyosolaafolabi@gmail.com');

            $message->to($subscriber->email)->subject('Hi');
            }
               
        });
        
    
    }    
        // $post = Post::all();
        // $subscription = Subscription::all();

        // if($post->website_id == $subscription->website->id){

        // $subscriber_id = $subscription->subscriber->id;
      
        // $subscribers = Subscriber::where('id', $subscriber_id)->get();
        
        // Mail::send('email.sub', function ($message) {

        //     foreach ($subscribers as $subscriber) {

        //     $message->from('oluyosolaafolabi@gmail.com');

        //     $message->to($subscriber->email)->subject('Hi');
        //     }

        // });
        // $this->info('Emails sent successfully!');
    
    



    /**
     * Handle the Post "updated" event.
     *
     * @param  \App\Models\Post  $post
     * @return void
     */
    public function updated(Post $post)
    {
        //
    }

    /**
     * Handle the Post "deleted" event.
     *
     * @param  \App\Models\Post  $post
     * @return void
     */
    public function deleted(Post $post)
    {
        //
    }

    /**
     * Handle the Post "restored" event.
     *
     * @param  \App\Models\Post  $post
     * @return void
     */
    public function restored(Post $post)
    {
        //
    }

    /**
     * Handle the Post "force deleted" event.
     *
     * @param  \App\Models\Post  $post
     * @return void
     */
    public function forceDeleted(Post $post)
    {
        //
    }
}
