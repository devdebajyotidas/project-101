<?php

namespace App\Http\Controllers\API;

use App\Models\Account;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ServiceController extends Controller
{

    function index($id){
        $response=new \stdClass();

        if(isset($id) && !empty($id)){
            $services=Service::where('account_id',$id)->get();
            $response->status=true;
            $response->data=$services;
            $response->message="Services found";
            $http=Response::HTTP_OK;
        }
        else{
            $response->status=false;
            $response->data=array();
            $response->message="Please provide a valid account";
            $http=Response::HTTP_OK;
        }

        return response()->json($response,$http);

    }

    /*service details*/
    /*This in incomplete...will be updated after future changes*/
    function show($id){
        $response=new \stdClass();

        if(isset($id) && !empty($id)){
            $service=Service::find($id);
            $response->status=true;
            $response->data=$service;
            $response->message="Service found";
            $http=Response::HTTP_OK;
        }
        else{
            $response->status=false;
            $response->data=array();
            $response->message="Please provide a valid account";
            $http=Response::HTTP_OK;
        }

        return response()->json($response,$http);
    }

    /*Store Services*/
    function store(Request $request,$id){
        $response=new \stdClass();

        DB::beginTransaction();

        $names=$request->name;
        $count=0;
        $service['account_id']=$id;

        try{
            foreach ($names as $name){
                $exist=Service::where('name',$name)->where('account_id',$id)->exists();
                if(!$exist){
                    $service['name']=$name;
                    if(Service::create($service)){
                        $count++;
                    }
                }
                else{
                    $count++;
                }
            }
        }catch (\Exception $exception){
            $response->status=false;
            $response->message=$exception->getMessage();
            $http=Response::HTTP_BAD_REQUEST;
            return response()->json($response,$http);
        }

        if($count > 0){
            DB::commit();
           $response->status=true;
           $response->message="Services has been added";
           $http=Response::HTTP_CREATED;
        }
        else{
            DB::rollBack();
            $response->status=false;
            $response->message="Unable to add the services";
            $http=Response::HTTP_OK;
        }

        return response()->json($response,$http);
    }

    /*update service*/
    function update(Request $request,$id){
        $response=new \stdClass();

        DB::beginTransaction();

        if(isset($id) && !empty($id)){
            try{
                $data=$request->all();
                if(empty($data)){
                    $response->status=false;
                    $response->message="No data to update";
                    $http=Response::HTTP_OK;
                }
                else{
                    $service=Service::find($id);
                    $update=$service->update($data);
                    if($update){
                        DB::commit();
                        $response->status=true;
                        $response->message="Service has been updated";
                        $http=Response::HTTP_CREATED;
                    }
                    else{
                        DB::rollBack();
                        $response->status=false;
                        $response->message="Unable to update the service";
                        $http=Response::HTTP_OK;
                    }
                }
            }catch (\Exception $exception){
                $response->status=false;
                $response->message=$exception->getMessage();
                $http=Response::HTTP_BAD_REQUEST;
                return response()->json($response,$http);
            }

        }
        else{
            $response->status=false;
            $response->message="Please provide a valid account";
            $http=Response::HTTP_OK;
        }

        return response()->json($response,$http);
    }

    /*remove service*/
    function delete($id){
        $response=new \stdClass();

        DB::beginTransaction();

        if(isset($id) && !empty($id)){
            $service=Service::find($id);
            $delete=$service->delete();
            if($delete){
                DB::commit();
                $response->status=true;
                $response->message="Service has been removed";
                $http=Response::HTTP_CREATED;
            }
            else{
                DB::rollBack();
                $response->status=false;
                $response->message="Unable to remove the service";
                $http=Response::HTTP_OK;
            }
        }
        else{
            $response->status=false;
            $response->message="Please provide a valid account";
            $http=Response::HTTP_OK;
        }

        return response()->json($response,$http);
    }

    /*service by location*/
    function serviceByLocation($location){
        $response=new \stdClass();

        if(isset($location) && !empty($location)){
            $ids=Account::where('location',$location)->pluck('id')->toArray();
            $services=Service::whereIn('account_id',$ids)->get();
            $response->status=true;
            $response->data=$services;
            $response->message="Service found";
            $http=Response::HTTP_OK;
        }
        else{
            $response->status=false;
            $response->data=array();
            $response->message="Please provide a valid account";
            $http=Response::HTTP_OK;
        }

        return response()->json($response,$http);
    }

    /*service by provider*/
    function serviceByProvider($provider){
        $response=new \stdClass();

        if(isset($provider) && !empty($provider)){
            $services=Service::where('account_id',$provider)->get();
            $response->status=true;
            $response->data=$services;
            $response->message="Services found";
            $http=Response::HTTP_OK;
        }
        else{
            $response->status=false;
            $response->data=array();
            $response->message="Please provide a valid account";
            $http=Response::HTTP_OK;
        }

        return response()->json($response,$http);
    }

}
