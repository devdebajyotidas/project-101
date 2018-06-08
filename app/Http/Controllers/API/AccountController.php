<?php

namespace App\Http\Controllers\API;

use App\Mail\VerificationMail;
use App\Models\Account;
use App\Models\ActivityLog;
use App\Models\Comments;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    function index($account_id){
        $response = new \stdClass();

        if(!isset($account_id) && empty($account_id)){
            $response->success=false;
            $response->data=null;
            $response->message="Couldn't find your account";
            return response()->json($response);
        }

        $user=User::with('account')->where('account_id',$account_id)->first();

        if($user){
            $response->success=true;
            $response->data=$user;
            $response->message="Account found";
        }
        else{
            $response->success=false;
            $response->data=null;
            $response->message="Invalid account selection";
        }

        return response()->json($response);
    }

    /*Profile Update*/
    function update(Request $request,$account_id){
        $response = new \stdClass();
        DB::beginTransaction();

        if(!isset($account_id) && empty($account_id)){
            $response->success=false;
            $response->message="Couldn't find your account";
            return response()->json($response);
        }

        $data['user']=$request->only(['name']);
        $data['account']=$request->only(['about','dob','address','city','state','country','zip','photo']);


        $user=User::where('account_id',$account_id)->first();
        $account=Account::find($account_id);

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $name = time().rand(100,999).".".$file->getClientOriginalExtension();
            if($file->move('uploads/',$name)){
                $data['account']['photo'] = $name;
            }else{
                $data['account']['photo'] = null;
            }
        }

        if(!empty($data['user'])){
            $user_save=$user->update($data['user']);
        }
        else{
            $user_save=true;
        }

        if(!empty($data['account'])){
            $account_save=$account->update($data['account']);
        }
        else{
            $account_save=true;
        }

        if($user_save && $account_save){
            DB::commit();
            $response->success=true;
            $response->message="Account has been updated";
        }
        else{
            DB::rollBack();
            $response->success=true;
            $response->message="Unable to update the account";
        }

        return response()->json($response);

    }

    /*Incomplete*/
    function delete($account_id){
        $response=new \stdClass();

        if(!isset($account_id) || empty($account_id)){
            $response->success=false;
            $response->message="Couldn't find your account";
            return response()->json($response);
        }

        $user=User::with('account')->find($account_id);
        $service_del=0;
        $comment_del=0;

        /*Need to be update later with chat and other features*/

        if($user){
            if($user->account->is_provider==1){
                $services=Service::where('account_id',$account_id)->get();
                $comments=Comments::where('provider_id',$account_id)->get();
            }

        }
        else{
            $response->success=false;
            $response->message="Invalid account selection";
            return response()->json($response);
        }

    }

    function changePassword(Request $request,$account_id){
        $response=new \stdClass();

        if(empty($account_id)){
            $response->success=false;
            $response->message="Couldn't find your account";
            return response()->json($response);
        }

        $validator=Validator::make($request->all(),User::$rules['update']);
        if($validator->passes()){
              $user=User::find($account_id);
              $user->password=$request->get('password');
              if($user->update()){
                  $response->success=true;
                  $response->message="Your password has been changed";
              }
              else{
                  $response->success=false;
                  $response->message="Unable to change your password";
              }
        }
        else{
            $response->success=false;
            $response->message=$validator->errors()->first();
        }
        return response()->json($response);
    }

    function verifyEmail($account_id){
        $response=new \stdClass();

        if(empty($account_id)){
            $response->success=false;
            $response->message="Couldn't find your account";
            return response()->json($response);
        }

        $user=User::find($account_id);
        if($user){
            $data['token']=$user->verification_token;
            $data['name']=$user->name;
            Mail::to($user->email)->send(new VerificationMail($data));

            if(Mail::failures()){
                $response->success=false;
                $response->message="Unable to sent the verification email";
            }
            else{
                $response->success=true;
                $response->message="A verification email has been sent";
            }
        }
        else{
            $response->success=false;
            $response->message="Invalid account selection";
        }
    }

    /*On hold*/
    function verifyAadhar(){

    }

    function changeEmail(Request $request,$account_id){
        $response=new \stdClass();
        $email=$request->get('email');

        if(empty($account_id)){
            $response->success=false;
            $response->message="Couldn't find your account";
            return response()->json($response);
        }

        if(empty($email)){
            $response->success=false;
            $response->message="Email address is required";
            return response()->json($response);
        }

        $validator=Validator::make($request->all(),User::$rules['update']);
        if($validator->passes()){
            $user=User::find($account_id);
            if($user){
                $user->email=$email;
                if($user->update()){
                    $response->success=true;
                    $response->message="Email has been updated";
                }
                else{
                    $response->success=false;
                    $response->message="Unable to update your email";
                }
            }
            else{
                $response->success=false;
                $response->message="Invalid account selection";
            }
        }
        else{
            $response->success=false;
            $response->message=$validator->errors()->first();
        }
        return response()->json($response);
    }

    function changeMobile(Request $request,$account_id){
        $response=new \stdClass();
        $mobile=$request->get('mobile');

        if(empty($account_id)){
            $response->success=false;
            $response->message="Couldn't find your account";
            return response()->json($response);
        }

        if(empty($mobile)){
            $response->success=false;
            $response->message="mobile address is required";
            return response()->json($response);
        }

        $validator=Validator::make($request->all(),User::$rules['update']);
        if($validator->passes()){
            $user=User::find($account_id);
            if($user){
                $user->mobile=$mobile;
                if($user->update()){
                    $response->success=true;
                    $response->message="Mobile has been updated";
                }
                else{
                    $response->success=false;
                    $response->message="Unable to update your mobile";
                }
            }
            else{
                $response->success=false;
                $response->message="Invalid account selection";
            }
        }
        else{
            $response->success=false;
            $response->message=$validator->errors()->first();
        }
        return response()->json($response);
    }

    public function activity($account_id){
        $response=new \stdClass();
        if(empty($account_id)){
            $response->success=false;
            $response->message="Invalid account selection";
            return $response;
        }

        $data['account_id']=$account_id;
        $activity=ActivityLog::create($data);
        if($activity){
            $response->success=true;
            $response->message="New activity added";
        }
        else{
            $response->success=false;
            $response->message="Unable to add activity";
        }
        return response()->json($response);
    }
}
