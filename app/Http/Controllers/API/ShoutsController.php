<?php

namespace App\Http\Controllers\API;

use App\Models\Account;
use App\Models\Shout;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ShoutsController extends Controller
{
    function takerShouts($account_id){
        $response=new \stdClass();

        if(!isset($account_id) || empty($account_id)){
            $response->success=false;
            $response->data=array();
            $response->message="Couldn't find the account";
            return response()->json($response);
        }

        $results=Shout::with('adminservice','provider.user')->where('user_id',$account_id)->get();

        $shouts =$results->map(function($item){
            $date=Carbon::createFromFormat('Y-m-d H:i:s',$item['created_at'])->toDateString();
            return ['shout_id'=>$item['id'],'area'=>$item['area'],'service_id'=>$item['service_id'],'service_name'=>$item['adminservice'][0]['name'],'date'=>$date,

                'prvoider_id'=>isset($item['provider'][0]['id']) ? $item['provider'][0]['id'] : null,'provider_name'=>isset($item['provider'][0]['user']['name']) ? $item['provider'][0]['user']['name'] : null];
        });

        $response->status=true;
        $response->data=$shouts;
        $response->message="Shouts found";

        return response()->json($response);

    }

    function providerShouts($account_id){
        $response=new \stdClass();

        if(!isset($account_id) || empty($account_id)){
            $response->success=false;
            $response->data=array();
            $response->message="Couldn't find the account";
            return response()->json($response);
        }

        $account=Account::find($account_id);
        $main_results=Shout::with('adminservice','taker.user')->where('taken_by',$account_id)->get();
        $shouts =$main_results->map(function($item){
            $date=Carbon::createFromFormat('Y-m-d H:i:s',$item['created_at'])->toDateString();
            return ['shout_id'=>$item['id'],'area'=>$item['area'],'service_id'=>$item['service_id'],'service_name'=>$item['adminservice'][0]['name'],'date'=>$date,

                'user_id'=>isset($item['taker'][0]['id']) ? $item['taker'][0]['id'] : null,'user_name'=>isset($item['taker'][0]['user']['name']) ? $item['taker'][0]['user']['name'] : null,'type'=>'existing'];
        });
        if(!empty($account) && !empty($account->latitude) && !empty($account->longitude)){
            $radius = 5; // Km
            $lon=$account->longitude;
            $lat=$account->latitude;

            $min_lon = $lon-$radius/(cos(deg2rad($lat)));
            $max_lon=  $lon+$radius/(cos(deg2rad($lat)));
            $min_lat = $lat-($radius);
            $max_lat = $lat+($radius);

            $loc_results=Shout::with('adminservice','taker.user')->whereBetween('longitude', array($min_lon, $max_lon))->whereBetween('latitude', array($min_lat, $max_lat))->where('taken_by','!=',$account_id)->get();
            $loc_shouts =$loc_results->map(function($item){
                $date=Carbon::createFromFormat('Y-m-d H:i:s',$item['created_at'])->toDateString();
                $name=isset($item['taker'][0]['user']['name']) ? $item['taker'][0]['user']['name'] : null;
                $id=isset($item['taker'][0]['id']) ? $item['taker'][0]['id'] : null;
                return ['shout_id'=>$item['id'],'area'=>$item['area'],'service_id'=>$item['service_id'],'service_name'=>$item['adminservice'][0]['name'],'date'=>$date,

                    'user_id'=>$id,'user_name'=> $name,'type'=>'new'];
            });

            if($shouts->count() > 0 && $loc_shouts->count() > 0){
                $data=$shouts->merge($loc_shouts);
            }
            elseif($shouts->count() > 0 && $loc_shouts->count() == 0){
                $data=$shouts;
            }
            elseif($shouts->count() ==0 && $loc_shouts->count() > 0){
                $data=$loc_shouts;
            }
            else{
                $data=array();
            }
        }
        else{
            $data=$shouts;
        }

        $response->status=true;
        $response->data=$data;
        $response->message="Shouts found";

        return response()->json($response);
    }

    function takeShout(Request $request){
        $response=new \stdClass();

       if(empty($request->shout_id)){
           $response->success=false;
           $response->message="Invalid shout selection";
           return response()->json($response);
       }

       if(empty($request->account_id)){
           $response->success=false;
           $response->message="Invalid account selection";
           return response()->json($response);
       }

       $shout=Shout::find($request->shout_id);
       $shout->taken_by=$request->account_id;
       if($shout->update()){
           $response->success=true;
           $response->message="You've taken the service";
       }
       else{
           $response->success=false;
           $response->message="Something went wrong";
       }

       return response()->json($response);
    }

    function createShout(Request $request){
        $response=new \stdClass();
        $data=$request->all();

        $validator =  Validator::make($data,Shout::$rules['create']);
        if($validator->passes()){
            $shout=Shout::create($data);
            if($shout){
                $response->success=true;
                $response->message="New service shout has been added";
            }
            else{
                $response->success=true;
                $response->message="Unable to add the service shout";
            }
        }
        else{
            $response->success = false;
            $response->message = $validator->errors()->first();
        }

        return response()->json($response);
    }

    function getDistanceBetweenPointsNew($latitude1, $longitude1, $latitude2, $longitude2, $unit = 'Km')
    {
        $theta = $longitude1 - $longitude2;
        $distance = (sin(deg2rad($latitude1)) * sin(deg2rad($latitude2))+
            (cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * cos(deg2rad($theta))));
        $distance = acos($distance); $distance = rad2deg($distance);
        $distance = $distance * 60 * 1.1515;
        return (round($distance * 1.609344,2));
    }
}
