<?php
namespace App\Http\Controllers\API;

use App\Mail\SignupMail;
use App\Models\Account;
use App\Models\Otp;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class UserController extends Controller
{

    public function requestOtp(Request $request){
        $response=[];

        DB::beginTransaction();

        $mobile=isset($request->mobile) ? $request->mobile : '';
        if(empty($mobile)){
            $response['success'] = false;
            $response['request_id'] = null;
            $response['message'] = 'Invalid Mobile';
            return response()->json($response,Response::HTTP_OK);
        }

        $account_id=User::where('mobile',$mobile)->pluck('account_id')->first();

        if(!isset($account_id) || is_null($account_id)){
            $response['success'] = false;
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
                $response['success'] = true;
                $response['request_id'] = $data['request_id'];
                $response['message'] = 'An otp has been sent';
            }
            else{
                DB::rollback();
                $response['success'] = false;
                $response['request_id'] = null;
                $response['message'] = 'Unable to sent the otp';
            }
        }

        return response()->json($response);
    }

    function resendOtp($request_id=null){
        $response=new \stdClass();

        if(empty($request_id)){
            $response->success=false;
            $response->message="Request id is required";
            return response()->json($response);
        }

        $now = time();
        $two_minutes = $now + (2 * 60);
        $expiry=date('Y-m-d H:i:s', $two_minutes);
        $result=Otp::where('request_id',$request_id)->first();

        if($result){
            $otp='123456';
            //Handle otp sent to mobile
            $result->expiry=$expiry;
            $result->otp=$otp;
            $result->update();
            $response->success=true;
            $response->message="Otp has been sent";
        }
        else{
            $response->success=false;
            $response->message="Unable to sent the otp";
        }

        return response()->json($response);
    }

    public function checkOtp(Request $request){
        $response=[];

        $otp=$request->otp;
        $request_id=$request->request_id;

        if(!isset($otp) && is_null($otp)){
            $response['success'] = false;
            $response['data'] = null;
            $response['message'] = 'Invalid otp';

            return response()->json($response,Response::HTTP_OK);
        }

        if(!isset($request_id) && is_null($request_id)){
            $response['success'] = false;
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

            $response['success'] = true;
            $response['data'] = $account;
            $response['message'] = 'Account found';
            return response()->json($response,Response::HTTP_OK);
        }
        else{
            $response['success'] = false;
            $response['data'] = null;
            $response['message'] = 'Invalid otp';
            return response()->json($response,Response::HTTP_OK);
        }

    }

    public function login(Request $request)
    {
        $response = [];

        if(!isset($request->password) || is_null($request->password)){
            $response['success'] = false;
            $response['data'] = null;
            $response['message'] = 'Invalid password';
            return response()->json($response,Response::HTTP_OK);
        }

        if(!isset($request->email) || is_null($request->email)){
            $response['success'] = false;
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

                $response['success'] = true;
                $response['data'] = $account;
                $response['message'] = '';
                return response()->json($response,Response::HTTP_OK);
            }
            else
            {
                $response['success'] = false;
                $response['data'] = null;
                $response['message'] = 'Invalid Email or Password!';
                return response()->json($response,Response::HTTP_OK);
            }
        }catch (\Exception $exception){
            $response['success'] = false;
            $response['data'] = null;
            $response['message'] = $exception->getMessage();
            return response()->json($response,Response::HTTP_BAD_REQUEST);
        }
    }

    /*Register*/
    function register(Request $request){

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
        $data['user']['fcm_token']=isset($request->fcm_token) ? $request->fcm_token : '';

        $data['account']['aadhaar']=isset($request->aadhaar) ? $request->aadhaar : '';
        $data['account']['longitude']=isset($request->longitude) ? $request->longitude : '';
        $data['account']['latitude']=isset($request->latitude) ? $request->latitude : '';
        $data['account']['is_provider']=isset($request->is_provider) ? $request->is_provider : '0';
        $data['account']['language']=isset($request->language) ? $request->language : '';

        $userValidator =  Validator::make($data['user'],User::$rules['create']);
        if($userValidator->passes()){

            $account = Account::create($data['account']);
            $user = User::make($data['user']);

            if($account->user()->save($user)){

                Mail::to($user->email)->send(new SignupMail($user->name));
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
                        $response['success'] = true;
                        $response['request_id']=$data['request_id'];
                        $response['message'] = 'An otp has been sent';
                        return response()->json($response,Response::HTTP_OK);
                    }
                    else{
                        DB::rollBack();
                        $response['success'] = false;
                        $response['request_id']=null;
                        $response['message'] = 'Unable to send the otp';
                        return response()->json($response,Response::HTTP_OK);
                    }
                }
                else{
                    DB::commit();
                    $response['success'] = true;
                    $response['request_id']=null;
                    $response['message'] = 'Account has been created';
                    return response()->json($response,Response::HTTP_OK);
                }

            }else{
                DB::rollBack();
                $response['success'] = false;
                $response['request_id']=null;
                $response['message'] = 'Unable to create account';
                return response()->json($response,Response::HTTP_OK);
            }
        }
        else{
            $response['success'] = false;
            $response['request_id']=null;
            $response['message'] = $userValidator->errors()->first();
            return response()->json($response,Response::HTTP_OK);
        }

    }



}