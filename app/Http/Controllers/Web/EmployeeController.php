<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmployeeController extends Controller
{
    function index(){
        $data['page'] = 'user';
        return view('users.index',$data);
    }
}
