<?php

namespace App\Http\Controllers\Web;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class EmployeeController extends Controller
{
    function store(Request $request){
        $conf_pass=isset($request->password_confirmation) ? $request->password_confirmation : '';
        if(!empty($conf_pass)){
            $data['user']['password_confirmation']=$conf_pass;
        }
        else{
            $data['user']['password_confirmation']=$request->get('password');
        }

        $data['user']['password']=$request->get('password');
        $data['user']['verification_token'] = md5(time());
        $data['user']['mobile']=$request->get('mobile');
        $data['user']['email']=$request->get('email');
        $data['user']['name']=isset($request->name) ? $request->name : '';
        $data['user']['fcm_token']='';

        $userValidator =  Validator::make($data['user'],User::$rules['create']);
        if($userValidator->passes()){

            $account = Employee::create();
            $user = User::make($data['user']);

            if($account->user()->save($user)){
                Mail::to($user->email)->send(new SignupMail($user->name));
                $response['success'] = true;
                $response['message'] = 'User has been added';
                return response()->json($response);
            }else{
                DB::rollBack();
                $response['success'] = false;
                $response['message'] = 'Unable to create account';
                return response()->json($response);
            }
        }
        else{
            $response['success'] = false;
            $response['request_id']=null;
            $response['message'] = $userValidator->errors()->first();
            return response()->json($response);
        }
    }
}
