<?php

namespace App\Http\Controllers\API;

use App\Models\Comments;
use App\Models\ReportAbuse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{

    public function index($provider_id){
        $response=new \stdClass();
        DB::beginTransaction();

        if(!isset($provider_id) || empty($provider_id)){
            $response->success=false;
            $response->message="Couldn't find the provider";
            return response()->json($response);
        }

        $results=Comments::with('user.account')->where('provider_id',$provider_id)->where('is_approved',1)->get();

        if($results->count() > 0){
            $comments=array();
            foreach ($results as $key=>$comment){
                $comments[$key]['name']=$comment->user->name;
                $comments[$key]['user_id']=$comment->user->account_id;
                $comments[$key]['photo']=$comment->user->account->photo;
                $comments[$key]['comment_id']=$comment->id;
                $comments[$key]['comment']=$comment->comment;
                $comments[$key]['ratings']=$comment->ratings;
            }
            $response->success=true;
            $response->data=$comments;
            $response->message="Comments found";
        }
        else{
            $response->success=false;
            $response->data=null;
            $response->message="No comments found";
        }

        return response()->json($response);
    }

    public function store(Request $request){
        $response=new \stdClass();
        DB::beginTransaction();

        $provider_id=$request->get('provider_id');
        $user_id=$request->get('user_id');

        if(empty($provider_id) && empty($user_id)){
            $response->success=false;
            $response->message="Couldn't find the service provider";
            return response()->json($response);
        }

        $result=Comments::create($request->all());
        if($result){
            DB::commit();
            $response->success=true;
            $response->message="Your comment has been added";
        }
        else{
            DB::commit();
            $response->success=false;
            $response->message="Couldn't store your comment";
        }

        return response()->json($response);
    }

    public function update(Request $request,$comment_id){
        $response=new \stdClass();
        DB::beginTransaction();

        if(!isset($comment_id) || empty($comment_id)){
            $response->success=false;
            $response->message="Couldn't find the comment";
            return response()->json($response);
        }

        $comment=Comments::find($comment_id);
        $result=$comment->update(['comment'=>$request->comment,'ratings'=>$request->ratings]);
        if($result){
            DB::commit();
            $response->success=true;
            $response->message="Your comment has been updated";
        }
        else{
            DB::commit();
            $response->success=false;
            $response->message="Couldn't update your comment";
        }

        return response()->json($response);
    }

    function approve($comment_id){
        $response=new \stdClass();

        if(!isset($comment_id) || empty($comment_id)){
            $response->success=false;
            $response->message="Couldn't find the comment";
            return response()->json($response);
        }

        $comment=Comments::find($comment_id);
        if($comment){
            $comment->is_approved=1;
            if($comment->update()){
                $response->success=false;
                $response->message="Comment has been approved";
            }
            else{
                $response->success=false;
                $response->message="Something went wrong, try again later";
            }
        }
        else{
            $response->success=false;
            $response->message="Comment doesn't exist";
        }

        return response()->json($response);
    }

    function report(Request $request){
        $response=new \stdClass();

        if(!isset($request->account_id) && empty($request->account_id)){
            $response->success=false;
            $response->message="Invalid account selection";
            return response()->json($response);
        }

        if(!isset($request->account_id) && empty($request->account_id)){
            $response->success=false;
            $response->message="Invalid account selection";
            return response()->json($response);
        }

        if(!isset($request->comment_id) && empty($request->comment_id)){
            $response->success=false;
            $response->message="Invalid comment selection";
            return response()->json($response);
        }

        $status=ReportAbuse::create($request->all());
        if($status){
            $response->success=true;
            $response->message="You've reported this as abuse";
        }
        else{
            $response->success=false;
            $response->message="Unable to report this";
        }
        return response()->json($response);
    }
}
