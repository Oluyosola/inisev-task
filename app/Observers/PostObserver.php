<?php

namespace App\Observers;

use App\Models\Post;
use App\Models\Website;
use Illuminate\Support\Facades\Mail;
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
            'name' => 'Oluyosola',
            // 'description' => $post->description
       );
    //    $emailBody= $post->description;
    //    $body = htmlspecialchars_decode($post->description);

        Mail::send('email.sub', ['msg' => $post->description], function ($message) use($post) {


            $subscribers = Subscription::where('website_id', $post->website_id)->get();

            foreach ($subscribers as $subscriber) {

            $message->from('oluyosolaafolabi@gmail.com');

            $message->to($subscriber->email)->subject($post->title);

            $message->setBody($post->description);

            }
               
        });


        
    
    }    

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
