<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RequestController extends Controller
{
    public function index(){
        $data['page']='request';
        $data['bodyClass']='animsition';
        return view('requests.index',$data);
    }
}
