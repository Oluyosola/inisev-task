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
            'name' => $post->title,
            'description' => $post->description
       );


        Mail::send('email.sub', $data, function ($message) use($post) {

            

            $subscribers = Subscription::where('website_id', $post->website_id)->get();

            foreach ($subscribers as $subscriber) {

            $message->from('oluyosolaafolabi@gmail.com');

            $message->to($subscriber->email)->subject($post->title);
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
