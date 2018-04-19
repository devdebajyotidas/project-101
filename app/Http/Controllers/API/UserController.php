<?php

namespace App\Http\Controllers\API;

use App\Models\Account;
use App\Models\Otp;
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

    public function requestOtp(Request $request){
        $response=[];

        DB::beginTransaction();

        $mobile=$request->mobile;
        if(!isset($mobile) || is_null($mobile)){
            $response['status'] = false;
            $response['request_id'] = null;
            $response['message'] = 'Invalid Mobile';
            return response()->json($response,Response::HTTP_OK);
        }

        $account_id=User::where('mobile',$mobile)->pluck('account_id')->first();

        if(!isset($account_id) || is_null($account_id)){
            $response['status'] = true;
            $response['request_id'] = null;
            $response['message'] = 'Account does not exist';
        }
        else{
            $now = time();
            $two_minutes = $now + (2 * 60);
            $data['otp']='123456';
            $data['account_id']=$account_id;
            $data['request_id']=bin2hex(random_bytes(16));
            $data['expiry']=date('Y-m-d H:i:s', $two_minutes);
            $otp=Otp::create($data);

            if($otp){
                DB::commit();
                $response['status'] = true;
                $response['request_id'] = $data['request_id'];
                $response['message'] = 'An otp has been sent';
            }
            else{
                DB::fallBack();
                $response['status'] = false;
                $response['request_id'] = null;
                $response['message'] = 'Unable to sent the otp';
            }
        }

        return response()->json($response);
    }

    public function checkOtp(Request $request){
        $response=[];

        $otp=$request->otp;
        $request_id=$request->request_id;

        if(!isset($otp) && is_null($otp)){
            $response['status'] = false;
            $response['data'] = null;
            $response['message'] = 'Invalid otp';

            return response()->json($response,Response::HTTP_OK);
        }

        if(!isset($request_id) && is_null($request_id)){
            $response['status'] = false;
            $response['data'] = null;
            $response['message'] = 'Invalid rquest id';
            return response()->json($response,Response::HTTP_OK);
        }

        $account_id=Otp::where('request_id',$request_id)->where('otp',$otp)->where('expiry', '>=', date('Y-m-d H:i:s'))->pluck('account_id')->first();

        if(isset($account_id) && !empty($account_id)){
            $user=User::where('account_id',$account_id)->first();

            $fcm_token=isset($request->fcm_token) ? $request->get('fcm_token') : '';

            if(!is_null($fcm_token)){
                $user->fcm_token = $fcm_token;
                $user->save();
            }

            if($user->mobile_verified==0){
                $user->mobile_verified = 1;
                $user->save();
            }

            $account=User::with('account')->where('account_id',$account_id)->first();

            $response['status'] = true;
            $response['data'] = $account;
            $response['message'] = 'Account found';
            return response()->json($response,Response::HTTP_OK);
        }
        else{
            $response['status'] = false;
            $response['data'] = null;
            $response['message'] = 'Invalid otp';
            return response()->json($response,Response::HTTP_OK);
        }

    }

    public function login(Request $request)
    {
        $response = [];

        if(!isset($request->password) || is_null($request->password)){
            $response['status'] = false;
            $response['data'] = null;
            $response['message'] = 'Invalid password';
            return response()->json($response,Response::HTTP_OK);
        }

        if(!isset($request->email) || is_null($request->email)){
            $response['status'] = false;
            $response['data'] = null;
            $response['message'] = 'Invalid email address';
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

                $response['status'] = true;
                $response['data'] = $account;
                $response['message'] = '';
                return response()->json($response,Response::HTTP_OK);
            }
            else
            {
                $response['status'] = false;
                $response['data'] = null;
                $response['message'] = 'Invalid Email or Password!';
                return response()->json($response,Response::HTTP_OK);
            }
        }catch (\Exception $exception){
            $response['status'] = false;
            $response['data'] = null;
            $response['message'] = $exception->getMessage();
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
        $data['account']['longitude']=isset($request->longitude) ? $request->longitude : '';
        $data['account']['latitude']=isset($request->latitude) ? $request->latitude : '';
        $data['account']['is_provider']=isset($request->is_provider) ? $request->is_provider : '0';
        $data['account']['language']=isset($request->language) ? $request->language : '';

        $exist=User::withTrashed()->where('email',$data['user']['email'])->orWhere('mobile',$data['user']['mobile'])->exists();
        $aadhaar_exist=Account::where('aadhaar',$data['account']['aadhaar'])->exists();

        if($exist || $aadhaar_exist){
            $response['status'] = false;
            $response['request_id']=null;
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

                    if(isset($data['user']['mobile']) && !empty($data['user']['mobile'])){
                        $now = time();
                        $two_minutes = $now + (2 * 60);
                        $data['otp']='123456';
                        $data['account_id']=$user->account_id;
                        $data['request_id']=bin2hex(random_bytes(16));
                        $data['expiry']=date('Y-m-d H:i:s', $two_minutes);
                        $otp=Otp::create($data);
                        if($otp){
                            DB::commit();
                            $response['status'] = true;
                            $response['request_id']=$data['request_id'];
                            $response['message'] = 'An otp has been sent';
                            return response()->json($response,Response::HTTP_OK);
                        }
                        else{
                            DB::rollBack();
                            $response['status'] = false;
                            $response['request_id']=null;
                            $response['message'] = 'Unable to send the otp';
                            return response()->json($response,Response::HTTP_OK);
                        }
                    }
                    else{
                        DB::commit();
                        $response['status'] = true;
                        $response['request_id']=null;
                        $response['message'] = 'Account has been created';
                        return response()->json($response,Response::HTTP_OK);
                    }

                }else{
                    DB::rollBack();
                    $response['status'] = false;
                    $response['request_id']=null;
                    $response['message'] = 'Unable to create account';
                    return response()->json($response,Response::HTTP_OK);
                }

            }else{
                $response['status'] = false;
                $response['request_id']=null;
                $response['message'] = 'Some required parameters are missing';
                return response()->json($response,Response::HTTP_OK);
            }

        }catch(\Exception $exception){

            $response['success'] = false;
            $response['request_id']=null;
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
