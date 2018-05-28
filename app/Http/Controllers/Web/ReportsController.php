<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportsController extends Controller
{
    function index(){
        $data['page']='report';
        $data['bodyClass']='animsition dashboard';
        return view('reports.index',$data);
    }
}
