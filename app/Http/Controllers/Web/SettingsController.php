<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
    function index(){
        $data['page']='settings';
        $data['title']="Settings";
        $data['bodyClass']='animisation';
        return view('settings',$data);
    }
}
