<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\Website;
use App\Models\Subscription;
use App\Models\Subscriber;



class ApiController extends Controller
{

    

public function subscribe(Request $request, Website $website){
    $subscriber= Subscriber::where('id', $request->subscriber_id)->exists();
    if(!$subscriber)
    {
        return response()->json([
            'Failed' => ' Subscriber does not Exist',
        
        ]);
    }

    $website->update([
    'subscriber_id'=> $request->subscriber_id
]);
  return response()->json([
    'Sucess' => 'Successfully subscribed',
    'You are Subscribed to'=> Website::where('subscriber_id',  $request->subscriber_id)->get(),
    'You details'=> Subscriber::find($website)->last()
]);
}

public function createPost(Request $request){

    // $plan = Plans::where(['user_id' => auth()->user()->id, 'name' => $request->name_of_plan])->first();


$post= Post::where('title', $request->title)->exists();
if($post)
{
    return response()->json([
        'Failed' => ' Posts Exists',
    
    ]);
}
$post = new Post;

$post->title = $request->title;
$post->description = $request->description;
$post->content = $request->content;
$post->created_by = $request->created_by;
$post->website_id = $request->website_id;
$post->save();

return response()->json([
    'Sucess' => 'New Post Made',
    'details' => $post,
    'website deatils'=>Website::find($post->website_id)

]);



}

}