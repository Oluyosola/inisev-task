<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\Website;
use App\Models\Subscription;
use App\Models\Subscriber;
use Illuminate\Support\Facades\Validator;




class ApiController extends Controller
{

    

    public function subscribe(Request $request, Website $website){
        $validator = Validator::make($request->all(), [

            'subscriber' => 'required',
            'website' => 'required',

        ]);

        if($validator->fails()){
            return response()->json([
                'Failed' => ' Kindly input your name and the website you wish to subscribe to',
            
            ]);    
        }
        $subscriber= Subscriber::where('name', $request->subscriber)->exists();
        $website= Website::where('name', $request->website)->exists();

        if(!$subscriber)
        {
            return response()->json([
                'Failed' => ' Subscriber does not Exist',
            
            ]);
        }elseif(!$website){
            return response()->json([
                'Failed' => ' Website does not Exist',
        
        ]);

        }


        $sub_id = Subscriber::where('name', $request->subscriber)->first()->id;
        $website_id = Website::where('name', $request->website)->first()->id;

        $subscriber= Subscription::where('subscriber_id', $sub_id)->exists();
        $website= Subscription::where('website_id', $website_id)->exists();
        if($subscriber && $website){
            return response()->json([
                'Failed' => ' You are subscribed to this website',
            
            ]);
        }


        $subscription = new Subscription;
        $subscription->subscriber_id = $sub_id;
        $subscription->website_id = $website_id;
        $subscription->save();


        return response()->json([
            'Sucess' => 'Successfully subscribed',
            'You are Subscribed to'=> Website::where('id',  $website_id)->get(),
            'You details'=> Subscriber::where('id', $sub_id)->get()
        ]);
    }



    public function createPost(Request $request){



        $post= Post::where('title', $request->title)->exists();
        if($post)
        {
            return response()->json([
                'Failed' => ' Post Exists',
            
            ]);
        }


        $web_id = Website::where('name', $request->website)->exists();
        if(!$web_id){
            
            return response()->json([
                'Failed' => ' Website does not Exist',

            ]);
        }
        $website_id = Website::where('name', $request->website)->first()->id;
            

            $post = new Post;
            $post->title = $request->title;
            $post->description = $request->description;
            $post->content = $request->content;
            $post->created_by = $request->created_by;
            $post->website_id = $website_id;
            $post->save();

            return response()->json([
                'Sucess' => 'New Post Made',
                'details' => $post,
                'website deatils'=>Website::find($post->website_id)

            ]);
    }


}

