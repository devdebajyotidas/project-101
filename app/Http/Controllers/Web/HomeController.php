<?php

namespace App\Http\Controllers\Web;

use App\Models\Account;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    function home(){
        $data['page'] = 'home';
        $data['bodyClass']='animsition page-map page-map-full';

        $accounts=Account::where('is_provider','1')->pluck('id')->toArray();
        $services=Service::whereIn('account_id',$accounts)->get();
        $data['services']=$services;
        return view('home',$data);
    }



    function profile(){
        $data['page'] = 'employee profile';
        $data['bodyClass']='animsition page-profile-v2';
        return view('profile',$data);
    }
}
