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

            'name' => 'required',
            'website' => 'required',
            'email' => 'required'

        ]);

        if($validator->fails()){
            return response()->json([
                'Failed' => ' Kindly input your name and the website you wish to subscribe to',
            
            ]);    
        }
        $website= Website::where('name', $request->website)->exists();

        
        if(!$website){
            return response()->json([
                'Failed' => ' Website does not Exist',
        
        ]);

        }
        $sub = Subscription::where('email', $request->email)->get();
        $website_id = Website::where('name', $request->website)->first()->id;

        $website= Subscription::where('website_id', $website_id)->exists();
        if($website && $sub){
            return response()->json([
                'Failed' => ' You are subscribed to this website',
            
            ]);
        }


        $subscription = new Subscription;
        $subscription->website_id = $website_id;
        $subscription->name = $request->name;
        $subscription->email = $request->email;


        $subscription->save();


        return response()->json([
            'Sucess' => 'Successfully subscribed',
            'You are Subscribed to'=> Website::where('id',  $website_id)->get(),
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
            $post->created_by = $request->created_by;
            $post->website_id = $website_id;
            $post->save();
            

            return response()->json([
                'Sucess' => 'New Post Made and post sent to all subscribers',
                'details' => $post,
                'website deatils'=>Website::find($post->website_id)
                

            ]);
    }


}

