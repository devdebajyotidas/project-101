<?php

namespace App\Http\Controllers\Web;

use App\Models\Account;
use App\Models\Chat;
use App\Models\ServiceTaken;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    function index(){
        $data['page']='customer';
        $data['bodyClass']='animsition';
        $data['customers']=$this->search(new Request());
        return view('customers.index',$data);
    }

    function search(Request $request){
        $search=$request->get('search');
        $offset=$request->get('offset');
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

        $filter_arr=explode(',',$filter);

        $results=Account::join('users as u','u.account_id','=','accounts.id')->with(['activity'=>function($query){
                  $query->orderBy('created_at','desc')->first();
        }])->select(['accounts.*','u.name','u.email','u.mobile','u.created_at','u.is_employee','u.mobile_verified','u.email_verified'])->where('is_provider',0)->where('is_employee',0);

        if(!empty($search)){
            $results=$results->where('name','LIKE',"%$search%")->orWhere('email','LIKE',"%$search%")->orWhere('mobile','LIKE',"%$search%");
        }

        if(count($filter_arr) > 0){
            foreach ($filter_arr as $fil){
                if(!empty($fil)){
                    $results->where($fil,1);
                }
            }
        }

        if(!empty($sort_col)){
            $results=$results->orderBy($sort_col,$sort_val);
        }

        $data['total_result']=$results->count();
        $data['customers']=$results->skip($offset)->take(20)->get();
        return view('customers.card',$data);
    }

    function block(Request $request,$account_id){
        $response=new \stdClass();
        $status=$request->get('status');
        $value=($status=='block') ? 1 : 0;

        if(empty($account_id)){
            $response->status=false;
            $response->message="Invalid account selection";
            return response()->json($response);
        }

        $user=Account::find($account_id);
        if($user){
            $user->is_blocked=$value;
            if($user->update()){
                $response->status=true;
                $response->message="Account has been ".$status.'ed';
            }
            else{
                $response->status=false;
                $response->message="Unable to perform request";
            }
        }
        else{
            $response->status=false;
            $response->message="User not found";
        }
        return response()->json($response);
    }


    function profile($account_id){
        $data['page']='profile';
        $data['bodyClass']='animsition page-profile-v3';
        $data['info']=$this->customerInfo($account_id);
        $connects=$this->customerConnects($account_id);
        $data['connects']=$connects['connects'];
        $data['total_connects']=$connects['total_connects'];
        $takens=$this->customerServiceHistory($account_id);
        $data['serviceTakens']=$takens;
        $data['total_services']=$takens->count();
        return view('customers.profile',$data);
    }

    function customerInfo($account_id){
        if(empty($account_id)){
            return null;
        }

        $provider=User::with('account')->where('account_id',$account_id)->first();
        return $provider;
    }

    function customerConnects($account_id){
        if(empty($account_id)){
            return null;
        }

        $data['total_connects']=Chat::with('taker.user')->where('user_id',$account_id)->count();
        $data['connects']=Chat::with('taker.user')->where('user_id',$account_id)->take(6)->get();
        return $data;
    }

    function customerServiceHistory($account_id){
        if(empty($account_id)){
            return null;
        }

        $services=ServiceTaken::with('account.user')->where('user_id',$account_id)->take(6)->get();
        return $services;
    }

}
