<?php

namespace App\Http\Controllers\Web;

use App\Models\Account;
use App\Models\Chat;
use App\Models\Service;
use App\Models\ServiceTaken;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProviderController extends Controller
{
    function index(){
        $data['page']='provider';
        $data['bodyClass']='animsition';
        $data['providers']=$this->search(new Request());
        return view('provider.index',$data);
    }

    function profile($account_id){
        $data['page']='profile';
        $data['bodyClass']='animsition page-profile-v3';
        $data['info']=$this->providerInfo($account_id);
        $connects=$this->providerConnects($account_id);
        $data['connects']=$connects['connects'];
        $data['total_connects']=$connects['total_connects'];
        $data['serviceTakens']=$this->providerServiceHistory($account_id);
        $services=$this->providerServices($account_id);
        $data['services']=$services;
        $data['total_services']=$services->count();
        return view('provider.profile',$data);
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
        }])->select(['accounts.*','u.name','u.email','u.mobile','u.created_at','u.is_employee','u.mobile_verified','u.email_verified'])->where('is_provider',1)->where('is_employee',0);

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
        $data['providers']=$results->skip($offset)->take(20)->get();
        return view('provider.card',$data);
    }

    function providerInfo($account_id){
        if(empty($account_id)){
            return null;
        }

        $provider=User::with('account')->where('account_id',$account_id)->first();
        return $provider;
    }

    function providerConnects($account_id){
        if(empty($account_id)){
            return null;
        }

        $data['total_connects']=Chat::with('provider.user')->where('provider_id',$account_id)->count();
        $data['connects']=Chat::with('provider.user')->where('provider_id',$account_id)->take(6)->get();
        return $data;
    }

    function providerServiceHistory($account_id){
        if(empty($account_id)){
            return null;
        }

        $services=ServiceTaken::with('account.user')->where('provider_id',$account_id)->take(6)->get();
        return $services;
    }

    function providerServices($account_id){
        if(empty($account_id)){
            return null;
        }

        $services=Service::with('adminService')->where('account_id',$account_id)->get();
        return $services;
    }
}
