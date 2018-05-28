<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FeedbackController extends Controller
{
    function index(){
        $data['page']='abuse';
        $data['bodyClass']='';
        return view('feedback.index',$data);
    }
}
