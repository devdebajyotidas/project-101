<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestController extends Controller
{
    function ping(){
        return response()->json(['status' => 'Ok'], 201);
    }

    function post_test(Request $request){
        return $request->all();
    }
}
