<?php

namespace App\Http\Controllers\Web;

use App\Models\Account;
use App\Models\AdminService;
use App\Models\Service;
use App\Models\ServiceTaken;
use App\Models\User;
use Carbon\Carbon;
use DebugBar\DebugBar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class ReportsController extends Controller
{
    function index(){
        $data['page']='report';
        $data['bodyClass']='animsition dashboard';
        $data['user']=$this->userData();
        $data['customer']=$this->customerData();
        $data['vendor']=$this->vendorData();
        $data['taken']=$this->serviceData();
        $data['service_category']=$this->serviceCategory();

//        $request=new Request();
//        $request->setMethod('POST');
//        $request->request->add(['start'=>'02-05-2018','end'=>'02-06-2018']);
//        dd($this->serviceHistory($request));

        return view('reports.index',$data);
    }

    function userData(){
        $now=Carbon::now();
        $month=$now->month;
        $last_month=$now->subMonth()->month;
        $user=User::where('is_employee',1);
        $data['total_user']=$user->count();
        $data['total_user_last']=$user->whereMonth('created_at',$last_month)->count();
        $data['total_user_current']=$user->whereMonth('created_at',$month)->count();
        return $data;
    }

    function customerData(){
        $now=Carbon::now();
        $month=$now->month;
        $last_month=$now->subMonth()->month;
        $customer=Account::join('users as user','user.account_id','=','accounts.id')->select(['accounts.*','DATE(user.created_at)'])->where('user.is_employee',0)->where('is_provider',0);
        $data['total_customer']=$customer->count();
        $data['total_customer_last']=$customer->whereMonth('created_at',$last_month)->count();
        $data['total_customer_current']=$customer->whereMonth('created_at',$month)->count();
        return $data;
    }

    function vendorData(){
        $now=Carbon::now();
        $month=$now->month;
        $last_month=$now->subMonth()->month;
        $vendor=Account::join('users as user','user.account_id','=','accounts.id')->select(['accounts.*','DATE(user.created_at)'])->where('user.is_employee',0)->where('is_provider',1);
        $data['total_vendor']=$vendor->count();
        $data['total_vendor_last']=$vendor->whereMonth('created_at',$last_month)->count();
        $data['total_vendor_current']=$vendor->whereMonth('created_at',$month)->count();
        return $data;
    }

    function serviceData(){
        $now=Carbon::now();
        $month=$now->month;
        $last_month=$now->subMonth()->month;
        $taken=ServiceTaken::whereNotNull('service_id');
        $data['total_taken']=$taken->count();
        $data['total_taken_last']=$taken->whereMonth('created_at',$last_month)->count();
        $data['total_taken_current']=$taken->whereMonth('created_at',$month)->count();
        return $data;
    }

    function serviceCategory(){
        $service=Service::join('admin_services as as','as.id','=','services.service_id')->select(DB::raw('count(*) as total_service,MAX(as.name) as name,services.service_id'))->groupBy('services.service_id')->get();
        return $service;
    }

    function serviceHistory(Request $request){
        $month=Carbon::now()->month;
        $start=!empty($request->get('start')) ? Carbon::parse($request->get('start'))->format('Y-m-d') : '';
        $end=!empty($request->get('end')) ? Carbon::parse($request->get('end'))->format('Y-m-d') : '';

        if(!empty($start) && !empty($end)){
            $service=ServiceTaken::join('admin_services as as','as.id','=','service_takens.service_id')->select(DB::raw('count(*) as total_service,MAX(as.name) as name,service_takens.service_id'))->groupBy('service_takens.service_id')->whereBetween('service_takens.created_at', [$start, $end])->get();
        }
        else{
            $service=ServiceTaken::join('admin_services as as','as.id','=','service_takens.service_id')->select(DB::raw('count(*) as total_service,MAX(as.name) as name,service_takens.service_id'))->groupBy('service_takens.service_id')->whereMonth('service_takens.created_at',$month)->get();
        }

        $response['label']=$service->pluck('name')->toArray();
        $response['data']=$service->pluck('total_service')->toArray();

        return response()->json($response);
    }

    function customerHistory(Request $request){
        $month=Carbon::now()->month;
        $start=!empty($request->get('start')) ? Carbon::parse($request->get('start'))->format('Y-m-d') : '';
        $end=!empty($request->get('end')) ? Carbon::parse($request->get('end'))->format('Y-m-d') : '';

        if(!empty($start) && !empty($end)){
            $customers=User::join('accounts as ac','ac.id','=','users.account_id')->select(DB::raw('count(*) as total_customer,DATE(users.created_at) as date'))->groupBy('users.created_at')
                ->where('users.is_employee',0)->where('ac.is_provider',0)->whereBetween('users.created_at', [$start, $end])->get();
        }
        else{
            $customers=User::join('accounts as ac','ac.id','=','users.account_id')->select(DB::raw('count(*) as total_customer,DATE(users.created_at) as date'))->groupBy('users.created_at')
                ->where('users.is_employee',0)->where('ac.is_provider',0)->whereMonth('users.created_at',$month)->get();
        }

        $response['label']=$customers->pluck('date')->ToArray();
        $response['data']=$customers->pluck('total_customer')->ToArray();
        return response()->json($response);
    }

    function vendorHistory(Request $request){
        $month=Carbon::now()->month;
        $start=!empty($request->get('start')) ? Carbon::parse($request->get('start'))->format('Y-m-d') : '';
        $end=!empty($request->get('end')) ? Carbon::parse($request->get('end'))->format('Y-m-d') : '';

        if(!empty($start) && !empty($end)){
            $vendors=User::join('accounts as ac','ac.id','=','users.account_id')->select(DB::raw('count(*) as total_vendor,DATE(users.created_at) as date'))->groupBy('users.created_at')
                ->where('users.is_employee',0)->where('ac.is_provider',1)->whereBetween('users.created_at', [$start, $end])->get();
        }
        else{
            $vendors=User::join('accounts as ac','ac.id','=','users.account_id')->select(DB::raw('count(*) as total_vendor,DATE(users.created_at) as date'))->groupBy('users.created_at')
                ->where('users.is_employee',0)->where('ac.is_provider',1)->whereMonth('users.created_at',$month)->get();
        }

        $response['label']=$vendors->pluck('date')->toArray();
        $response['data']=$vendors->pluck('total_vendor')->toArray();
        return response()->json($response);
    }

    /*Service Report*/

    function serviceReport($service_id){
        $data['page']='report';
        $data['bodyClass']='animsition dashboard';
        $service=AdminService::find($service_id,['name']);
        $data['title']="Service Report";
        $request=new Request();
        $data['usage']=$this->serviceUsage($request,$service_id);
        $data['taken']=$this->serviceTaken($request,$service_id);
        $data['name']=$service->name;
        $data['service_id']=$service_id;

        return view('reports.service',$data);
    }

    function serviceUsage(Request $request,$service_id){
        $month=Carbon::now()->month;
        $start=!empty($request->get('start')) ? Carbon::parse($request->get('start'))->format('Y-m-d') : '';
        $end=!empty($request->get('end')) ? Carbon::parse($request->get('end'))->format('Y-m-d') : '';

        if(!empty($start) && !empty($end)){
            $services=Service::where('service_id',$service_id)->select(DB::raw('count(*) as total_usage,DATE(created_at) as date'))->whereBetween('created_at', [$start, $end])->groupBy('created_at')->get();
            $response['label']=$services->pluck('date');
            $response['data']=$services->pluck('total_usage');
            return response()->json($response);
        }
        else{
            $services=Service::where('service_id',$service_id)->select(DB::raw('count(*) as total_usage,DATE(created_at) as date'))->whereMonth('created_at',$month)->groupBy('created_at')->get();
            $response['label']=$services->pluck('date');
            $response['data']=$services->pluck('total_usage');
            return $response;
        }

    }

    function serviceTaken(Request $request,$service_id){
        $month=Carbon::now()->month;
        $start=!empty($request->get('start')) ? Carbon::parse($request->get('start'))->format('Y-m-d') : '';
        $end=!empty($request->get('end')) ? Carbon::parse($request->get('end'))->format('Y-m-d') : '';

        if(!empty($start) && !empty($end)){
            $services=ServiceTaken::where('service_id',$service_id)->select(DB::raw('count(*) as total_taken,DATE(created_at) as date'))->whereBetween('created_at', [$start, $end])->groupBy('created_at')->get();
            $response['label']=$services->pluck('date');
            $response['data']=$services->pluck('total_taken');
            return response()->json($response);
        }
        else{
            $services=ServiceTaken::where('service_id',$service_id)->select(DB::raw('count(*) as total_taken,DATE(created_at) as date'))->whereMonth('created_at',$month)->groupBy('created_at')->get();
            $response['label']=$services->pluck('date');
            $response['data']=$services->pluck('total_taken');
            return $response;
        }

    }
}
