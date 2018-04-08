<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestController extends Controller
{
    function ping(){
        return response()->json(['status' => 'Ok'], 201);
    }
}
