<?php

namespace App\Http\Controllers\Web;

use App\Models\Account;
use App\Models\AdminService;
use App\Models\Shout;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShoutController extends Controller
{
    function index(){
        $data['page']='shout';
        $data['bodyClass']='animsition';
        $request=new Request();
        $request->setMethod('POST');
        $request->request->add(['sort' => 'name asc']);
        $data['shouts']=$this->load($request);
//        dd($data['shouts']);
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


        $result=Shout::join('admin_services as ad','ad.id','=','shouts.service_id')->select(['shouts.*','ad.name','ad.image'])->with(['taker.user','provider.user']);

        if(!empty($search)){
           $result=$result->where('name','LIKE',"%$search%");
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
            $result=$result->whereBetween('shouts.created_at', [$start, $end]);
        }

        $data['total_result']=$result->count();
        $data['shouts']=$result->orderBy($sort_col,$sort_val)->skip($offset)->take(20)->get();
        return view('shouts.card',$data);
    }
}
