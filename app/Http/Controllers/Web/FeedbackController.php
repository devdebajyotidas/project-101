<?php

namespace App\Http\Controllers\Web;

use App\Models\ReportAbuse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FeedbackController extends Controller
{
    function index(){
        $data['page']='abuse';
        $data['bodyClass']='';
        $request=new Request();
        $data['feedbacks']=$this->load($request);
        return view('feedback.index',$data);
    }

    function load(Request $request){

        $offset=$request->get('offset');
        $sort_opt=$request->get('sort');
        $filter=$request->get('filter');

        if(!empty($sort_opt)){
            $explode=explode(" ",$sort_opt);
            if(!empty($explode)){
                $sort_col=$explode[0];
                $sort_val=$explode[1];
            }
            else{
                $sort_col="created_at";
                $sort_val="desc";
            }
        }
        else{
            $sort_col="created_at";
            $sort_val="desc";
        }

        $result=ReportAbuse::join('accounts as ac','ac.id','=','report_abuses.user_id')->select(['report_abuses.*','ac.is_blocked'])->with(['comment','provider.user','taker.user']);


        if(!empty($filter)){
            if($filter=='blocked'){
                $result=$result->where('is_blocked',1);
            }
            else{
                $result=$result->where('is_blocked',0);
            }
        }


        $result=$result->orderBy($sort_col,$sort_val);

        $data['total_result']=$result->count();
        $data['feedbacks']=$result->skip($offset)->take(20)->get();
        return view('feedback.card',$data);
    }
}
