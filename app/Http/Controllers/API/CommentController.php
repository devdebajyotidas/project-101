<?php

namespace App\Http\Controllers\API;

use App\Models\Comments;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{

    public function index($provider_id){
        $response=new \stdClass();
        DB::beginTransaction();

        if(empty($provider_id)){
            $response->status=false;
            $response->message="Select a service provider first";
            return response()->json($response);
        }

        $results=Comments::with('user.account')->where('provider_id',$provider_id)->get();

        $comments=array();
        foreach ($results as $key=>$comment){
            $comments[$key]['name']=$comment->user->name;
            $comments[$key]['user_id']=$comment->user->account_id;
            $comments[$key]['photo']=$comment->user->account->photo;
            $comments[$key]['comment_id']=$comment->id;
            $comments[$key]['comment']=$comment->comment;
            $comments[$key]['ratings']=$comment->ratings;
        }

        return response()->json($comments);
    }

    public function store(Request $request){
        $response=new \stdClass();
        DB::beginTransaction();

        $provider_id=$request->provider_id;
        $user_id=$request->user_id;

        if(empty($provider_id) && empty($user_id)){
            $response->status=false;
            $response->message="Select a service provider first";
            return response()->json($response);
        }

        try{
            $result=Comments::create($request->all());
            if($result){
                DB::commit();
                $response->status=true;
                $response->message="Your comment has been added";
            }
            else{
                DB::commit();
                $response->status=false;
                $response->message="Couldn't store your comment";
            }
        }catch(\Exception $exception){
            $response->status=false;
            $response->message=$exception->getMessage();
        }

        return response()->json($response);
    }

    public function update(Request $request,$comment_id){
        $response=new \stdClass();
        DB::beginTransaction();

        if(empty($comment_id)){
            $response->status=false;
            $response->message="Select a comment first";
            return response()->json($response);
        }
        try{
            $comment=Comments::find($comment_id);
            $result=$comment->update(['comment'=>$request->comment,'ratings'=>$request->ratings]);
            if($result){
                DB::commit();
                $response->status=true;
                $response->message="Your comment has been updated";
            }
            else{
                DB::commit();
                $response->status=false;
                $response->message="Couldn't update your comment";
            }
        }catch(\Exception $exception){
            $response->status=false;
            $response->message=$exception->getMessage();
        }

        return response()->json($response);
    }
}
