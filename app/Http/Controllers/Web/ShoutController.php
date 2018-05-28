<?php

namespace App\Http\Controllers\Web;

use App\Models\Shout;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShoutController extends Controller
{
    function index(){
        $data['page']='shout';
        $data['bodyClass']='';
        $data['shouts']=$this->load(new Request());
        return view('shouts.index',$data);
    }

    function load(Request $request){
        $search=$request->get('search');
        $offset=$request->get('offset');
        $sort_opt=$request->get('sort');
        $filter=$request->get('filter');
        $start=$request->get('start');
        $end=$request->get('end');

        if(empty($offset))$offset=0;

        if(!empty($sort_opt)){
            $sort_arr=explode(' ',$sort_opt);
            if(!empty($sort_arr)){
                $sort_col=$sort_arr[0];
                $sort_val=$sort_arr[1];
            }
            else{
                $sort_col='name';
                $sort_val='asc';
            }
        }
        else{
            $sort_col='name';
            $sort_val='asc';
        }

        $result=Shout::with('service','account.user');

        return $result->get();

    }
}
