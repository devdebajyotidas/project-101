<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    function index(){
        $data['page']='payment';
        $data['bodyClass']='animsition';
        return view('payments.index',$data);
    }
}
