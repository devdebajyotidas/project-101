<?php

namespace App\Http\Controllers\Web;

use App\Models\Account;
use App\Models\Shout;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShoutController extends Controller
{
    function index(){
        $data['page']='shout';
        $data['bodyClass']='';
        $request=new Request();
        $request->setMethod('POST');
        $request->request->add(['search' => 'plum']);
        $data['shouts']=$this->load($request);
        return view('shouts.index',$data);
    }

    function load(Request $request){
        $search=$request->get('search');
        $offset=$request->get('offset');
        $sort_opt=$request->get('sort');
        $filter=$request->get('filter');
        $start=!empty($request->get('start')) ? Carbon::parse($request->get('start'))->format('Y-m-d') : '';
        $end=!empty($request->get('end')) ? Carbon::parse($request->get('end'))->format('Y-m-d') : '';

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

        if(!empty($search)){
            if($sort_col=='name'){
                $result=Shout::with(['adminService'=>function($query) use ($search,$sort_val,$sort_col){
                    $query->where('name','LIKE',"%$search%")->orderBy('name',$sort_val);
                },'taker.user','provider.user']);
            }
            else{
                $result=Shout::with(['adminService'=>function($query) use ($search,$sort_val,$sort_col){
                    $query->where('name','LIKE',"%$search%");
                },'taker.user','provider.user'])->orderBy($sort_col,$sort_val);
            }

        }
        else{
            if($sort_col=='name'){
                $result=Shout::with(['adminService'=>function($query) use ($sort_col,$sort_val){
                    $query->orderBy('name',$sort_val);
                },'taker.user','provider.user']);
            }
            else{
                $result=Shout::with(['adminService','taker.user','provider.user'])->orderBy($sort_col,$sort_val);
            }

        }

        if(!empty($filter)){
            if($filter=='taken'){
                $result=$result->whereNotNull('taken_by');
            }
            else{
                $result=$result->whereNull('taken_by');
            }
        }

        if(!empty($start) && !empty($end)){
            $result=$result->whereBetween('created_at', [$start, $end]);
        }

        $data['total_result']=$result->count();
        $data['shouts']=$result->skip($offset)->take(20)->get();
//        return $data['shouts'];
        return view('shouts.card',$data);
    }
}
