<?php

namespace App\Http\Controllers\Web;

use App\Mail\InvitationMail;
use App\Models\Invitation;
use App\Models\User;
use App\Models\Account;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class EmployeeController extends Controller
{


    function index(){
        $data['page']='provider';
        $data['title']="Employees";
        $data['bodyClass']='animsition';
        $data['employees']=$this->load(new Request());
        return view('employees.index',$data);
    }

    function load(Request $request){
        $search=$request->get('search');
        $sort_opt=$request->get('sort');
        $filter=$request->get('filter');

        if(!empty($sort_opt)){
            $explode=explode(" ",$sort_opt);
            if(!empty($explode)){
                $sort_col=$explode[0];
                $sort_val=$explode[1];
            }
            else{
                $sort_col="name";
                $sort_val="asc";
            }
        }
        else{
            $sort_col="name";
            $sort_val="asc";
        }

        if(!empty($filter) && $filter=='invited'){
            $result=Invitation::where('is_joined',0);
        }
        else{
            $result=User::join('accounts as ac','ac.id','=','users.account_id')->select(['users.name','users.email','users.mobile','users.account_id','ac.photo','users.created_at'])->where('is_employee',1);
        }
        if(!empty($search)){
            $result=$result->where(function($query) use ($search){
                $query->where('name','LIKE',"%$search%")->orWhere('email','LIKE',"%$search%")->orWhere('mobile','LIKE',"%$search%");
            });
        }
        $result=$result->orderBy($sort_col,$sort_val);
        $data['total_result']=$result->count();
        $data['employees']=$result->get();
        return view('employees.card',$data);
    }

    function invite(Request $request){
        $data=$request->all();
        $data['token']=md5(time());

        $validator=Validator::make($data,Invitation::$rules['create']);

        if($validator->passes()){
            $invitaion=Invitation::create($data);
            if($invitaion){

                Mail::to($request->get('email'))->send(new InvitationMail($data));

                $response['status']=true;
                $response['message']="New user has been invited";
            }
            else{
                $response['status']=false;
                $response['message']='Unable send the invitation, something went wrong';
            }
        }
        else{
            $response['status']=false;
            $response['message']=$validator->errors()->first();
        }

        return $response;
    }

    function update(Request $request,$token){

        if(empty($token)){
            return redirect()->back()->withErrors('Invalid Invitation');
        }

        $invitation=Invitation::where('token',$token)->first();

        if(!$invitation){
            return redirect()->back()->withErrors('Invalid Invitation');
        }

        $conf_pass=isset($request->password_confirmation) ? $request->password_confirmation : '';
        if(!empty($conf_pass)){
            $data['user']['password_confirmation']=$conf_pass;
        }
        else{
            $data['user']['password_confirmation']=$request->get('password');
        }

        $data['user']['password']=$request->get('password');
        $data['user']['verification_token'] = md5(time());
        $data['user']['mobile']=$invitation->mobile;
        $data['user']['email']=$invitation->email;
        $data['user']['name']=$invitation->name;
        $data['user']['fcm_token']='';
        $data['user']['is_employee']='1';

        $userValidator =  Validator::make($data['user'],User::$rules['create']);
        if($userValidator->passes()){

            $account = Account::create();
            $user = User::make($data['user']);

            if($account->user()->save($user)){
                $invitation->is_joined=1;
                $invitation->update();
                return redirect()->intended(url('login'));
            }else{
                return redirect()->back()->withErrors('Unable to create your account');
            }
        }
        else{
            return redirect()->back()->withErrors($userValidator->errors()->first());
        }
    }



    function show($token){
        if(!empty($token)){
            $inviation=Invitation::where('token',$token)->first();
            if($inviation){
                $email=$inviation->email;
            }
            else{
                $email="N/A";
            }
        }
        else{
            $email='N/A';
        }
        $data['email']=$email;
        return view('invitation',$data);
    }
}
