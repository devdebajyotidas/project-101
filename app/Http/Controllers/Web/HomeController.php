<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    function home(){
        $data['page'] = 'home';
        return view('home',$data);
    }
}
