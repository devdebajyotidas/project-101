<?php

namespace App\Http\Controllers\API;

use App\Models\Account;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $response = [];

        if(!isset($request->password) || is_null($request->password)){
            $response['success'] = false;
            $response['data'] = null;
            $response['error'] = 'Invalid password';
            return response()->json($response,Response::HTTP_OK);
        }

        if(!isset($request->email) || is_null($request->email)){
            $response['success'] = false;
            $response['data'] = null;
            $response['error'] = 'Invalid email address';
            return response()->json($response,Response::HTTP_OK);
        }

        try{
            if($request->get('password') && Auth::attempt(['email' => $request->get('email'), 'password' => $request->get('password')], true))
            {
                $fcm_token=isset($request->fcm_token) ? $request->get('fcm_token') : '';
                $user = Auth::user();

                if(!is_null($fcm_token)){
                    $user->fcm_token = $fcm_token;
                    $user->save();
                }

                $account=User::with('account')->where('account_id',$user->account_id)->first();

                $response['success'] = true;
                $response['data'] = $account;
                $response['error'] = '';
                return response()->json($response,Response::HTTP_OK);
            }
            else
            {
                $response['success'] = false;
                $response['data'] = null;
                $response['error'] = 'Invalid Email or Password!';
                return response()->json($response,Response::HTTP_OK);
            }
        }catch (\Exception $exception){
            $response['success'] = false;
            $response['data'] = null;
            $response['error'] = $exception->getMessage();
            return response()->json($response,Response::HTTP_BAD_REQUEST);
        }
    }

    /*Register*/
    function register(Request $request){
        $response = [];

        DB::beginTransaction();

        $data['user']['password_confirmation']=$data['user']['password']=$request->password;
        $data['user']['verification_token'] = md5(microtime());
        $data['user']['mobile']=$request->mobile;
        $data['user']['email']=$request->email;
        $data['user']['name']=$request->name;

        $data['account']['aadhaar']=isset($request->aadhaar) ? $request->aadhaar : '';

        $exist=User::withTrashed()->where('email',$data['user']['email'])->orWhere('mobile',$data['user']['mobile'])->exists();
        $aadhaar_exist=Account::where('aadhaar',$data['account']['aadhaar'])->exists();

        if($exist || $aadhaar_exist){
            $response['success'] = false;
            $response['message'] = 'User already exists';
            return response()->json($response,Response::HTTP_OK);
        }

        try {

            $userValidator = Validator::make($data['user'], User::$rules['create']);

            if ($userValidator->passes())
            {
                $account = Account::create($data['account']);
                $user = User::make($data['user']);

                if($account->user()->save($user)){
                    DB::commit();
                    $response['status'] = true;
                    $response['message'] = "A new user has been added";
                    return response()->json($response,Response::HTTP_CREATED);
                }else{
                    DB::rollBack();
                    $response['status'] = false;
                    $response['message'] = 'Unable to create account';
                    return response()->json($response,Response::HTTP_OK);
                }

            }else{
                $response['status'] = false;
                $response['message'] = 'Some required parameters are missing';
                return response()->json($response,Response::HTTP_OK);
            }

        }catch(\Exception $exception){

            $response['success'] = false;
            $response['message'] = $exception->getMessage();
            return response()->json($response,Response::HTTP_BAD_REQUEST);
        }
    }

    /*Profile Update*/
    function update(Request $request,$id){
        $response = new \stdClass();
        DB::beginTransaction();

        if(!isset($id) && empty($id)){
            $response->status=false;
            $response->message="Please select an account to udpate";
            $http=Response::HTTP_OK;
            return response()->json($response,$http);
        }

        $data['user']=$request->get('user');
        $data['account']=$request->get('account');

        $user=User::where('account_id',$id)->first();
        $account=Account::find($id);

        try{
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
                $response->status=true;
                $response->message="Account has been updated";
                $http=Response::HTTP_CREATED;
            }
            else{
                DB::rollBack();
                $response->status=true;
                $response->message="Unable to update the account";
                $http=Response::HTTP_OK;
            }
        }catch(\Exception $exception){
            $response->status=false;
            $response->message=$exception->getMessage();
            $http=Response::HTTP_BAD_REQUEST;
        }

        return response()->json($response,$http);

    }

}
