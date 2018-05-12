<?php

namespace App\Http\Controllers\API;

use App\Models\Account;
use App\Models\Comments;
use App\Models\SearchLog;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ServiceController extends Controller
{
    function index($account_id){
        $response=new \stdClass();

        if(!isset($account_id) || empty($account_id)){
            $response->success=false;
            $response->message="Couldn't find your account";
            return response()->json($response);
        }

        $services=Service::where('account_id',$account_id)->get();

        if($services){
            $response->success=true;
            $response->data=$services;
            $response->message="Services found";
        }
        else{
            $response->success=false;
            $response->data=null;
            $response->message="No services found";
        }

        return response()->json($response);

    }

    function show($service_id){
        $response=new \stdClass();

        if(!isset($service_id) || empty($service_id)){
            $response->success=false;
            $response->data=null;
            $response->message="Couldn't find the service";
            return response()->json($response);
        }

        $service=Service::find($service_id);

        if($service){
            $data['name']=$service->name;
            $data['rate']=$service->rate;
            $data['service_id']=$service->id;

            $response->success=true;
            $response->data=null;
            $response->message="Service found";
        }
        else{
            $response->success=true;
            $response->data=null;
            $response->message="Service not found";
        }

        return response()->json($response);
    }

    function store(Request $request,$account_id){
        $response=new \stdClass();

        DB::beginTransaction();

        if(!isset($account_id) || empty($account_id)){
            $response->success=false;
            $response->message="Couldn't find your account";
            return response()->json($response);
        }

        $data=$request->all();
        $data['account_id']=$account_id;
        $validator=Validator::make($data,Service::$rules['create']);
        if($validator->passes()){
            $service=Service::create($data);
            if($service){
                $response->success=true;
                $response->message="A new service has been added";
            }
            else{
                $response->success=false;
                $response->message="Unable to add the service";
            }
        }
        else{
            $response->success=false;
            $response->message=$validator->errors()->first();
        }

        return response()->json($response);
    }

    function update(Request $request,$service_id){
        $response=new \stdClass();
        $data=$request->all();

        DB::beginTransaction();

        if(!isset($service_id) || empty($service_id)){
            $response->success=false;
            $response->message="Couldn't find the service";
            return response()->json($response);
        }

        $validator=Validator::make($data,Service::$rules['update']);

        if($validator->passes()){
            $service=Service::find($service_id);
            $update=$service->update($data);
            if($update){
                DB::commit();
                $response->success=true;
                $response->message="Service has been updated";
            }
            else{
                DB::rollBack();
                $response->success=false;
                $response->message="Unable to update the service";
            }
        }
        else{
            $response->success=false;
            $response->message=$validator->errors()->first();
        }
        return response()->json($response);
    }

    function delete($service_id){
        $response=new \stdClass();

        DB::beginTransaction();

        if(!isset($service_id) || empty($service_id)){
            $response->success=false;
            $response->message="Couldn't find the service";
            return response()->json($response);
        }

        $service=Service::find($service_id);
        $delete=$service->delete();
        if($delete){
            $response->success=true;
            $response->message="Service has been deleted";
        }
        else{
            $response->success=false;
            $response->message="Unable to delete the service";
        }

        return response()->json($response);
    }

    function timeline($account_id){
        $response=new \stdClass();

        if(!isset($account_id) || empty($account_id)){
            $response->success=false;
            $response->data=null;
            $response->message="Couldn't find the account";
            return response()->json($response);
        }

        $services=Service::with('serviceTaken','account')->get();

        if($services){
            $response->success=true;
            $response->data=$services;
            $response->message="Services found";
        }
        else{
            $response->success=false;
            $response->data=null;
            $response->message="Services not found";
        }
    }

    /*************************************************************************************************/
    /*Taker services*/

    function scatter(){
        $response=new \stdClass();

        $accounts=Account::where('is_provider','1')->pluck('id')->get();
        $services=Service::whereIn('account_id',$accounts)->get();

        if($services){
            $response->success=true;
            $response->data=$services;
            $response->message="Services found";
        }
        else{
            $response->success=false;
            $response->data=null;
            $response->message="Services not found";
        }

        return response()->json($response);
    }

    function byLocation($latitude,$longitude){
        $response=new \stdClass();

        $lat=isset($latitude) ? $latitude : '';
        $lon=isset($longitude) ? $longitude : '';

        if(!empty($lat) && !empty($lon)){

            $radius = 1; // Km

            $angle_radius = $radius / ( 111 * cos( $lat ) ); // Every lat|lon degree° is ~ 111Km
            $min_lat = $lat - $angle_radius;
            $max_lat = $lat + $angle_radius;
            $min_lon = $lon - $angle_radius;
            $max_lon = $lon + $angle_radius;

            $results=Account::whereBetween('longitude', array($min_lon, $max_lon))->whereBetween('latitude', array($min_lat, $max_lat))->where('is_provider','1')->get();
            $n_rows = count( $results);
            for($i=0; $i<$n_rows; $i++) {
                if($this->getDistanceBetweenPointsNew($lat, $lon, $results[$i]->latitude, $results[$i]->longitude, 'Km') > $radius) {
                    // This is out of the "perfect" circle radius. Strip it out.
                    unset($results[$i]);
                }
            }

            $ids=$results->pluck('id')->toArray();
            $services=Service::whereIn('account_id',$ids)->where('is_active','1')->get();
            $response->success=true;
            $response->data=$services;
            $response->message="Service found";
        }
        else{
            $response->success=false;
            $response->data=array();
            $response->message="Unable to detect the service area";
        }

        return response()->json($response);
    }

    function search(Request $request){
        $response=new \stdClass();

        $user_id=$log['account_id']=isset($user_id) ? $user_id : '';//optional
        $name=$log['name']=isset($request->service) ? $request->service : '';
        $latitude=isset($request->latitude) ? $request->latitude : '';//optional
        $longitude=isset($request->longitude) ? $request->longitude : '';//optional
        $rad=$log['radius']=isset($request->radius) ? $request->radius: 1;

        if(empty($name)){
            $response->success=false;
            $response->data=array();
            $response->message="No search paramter found";
            return response()->json($response);
        }

        if(empty($user_id)){
            $response->success=false;
            $response->data=array();
            $response->message="Unable to find the services";
            return response()->json($response,$http);
        }

        $location=$this->getUserLocation($user_id);
        if(empty($latitude) && empty($longitude)){
            $lat=$log['latitude']=$location->latitude;
            $lon=$log['longitude']=$location->longitude;
        }
        else{
            $lat=$log['latitude']=$latitude;
            $lon=$log['longitude']=$longitude;
        }

        /*Add search logs*/
        SearchLog::create($log);

        if(!empty($lat) && !empty($lon)){

            $radius = !empty($rad) ? $rad : 1; // Km

            $min_lon = $lon-$radius/(cos(deg2rad($lat)));
            $max_lon=  $lon+$radius/(cos(deg2rad($lat)));
            $min_lat = $lat-($radius);
            $max_lat = $lat+($radius);

            $results=Account::whereBetween('longitude', array($min_lon, $max_lon))->whereBetween('latitude', array($min_lat, $max_lat))->where('is_provider','1')->get();
            $n_rows = count( $results);
            for($i=0; $i<$n_rows; $i++) {
                if($this->getDistanceBetweenPointsNew($lat, $lon, $results[$i]->latitude, $results[$i]->longitude, 'Km') > $radius) {
                    unset($results[$i]);
                }
            }

            $ids=$results->pluck('id')->toArray();
            $services=Service::with('account')->whereIn('account_id',$ids)->where('name','LIKE',"%{$name}%")->get();

            $info=[];
            foreach ($services as $key=>$service) {
                $info[$key]['provider_id'] = $service->account_id;
                $info[$key]['service_id'] = $service->id;
                $info[$key]['name'] = $service->name;
                $info[$key]['latitude'] = $service->account->latitude;
                $info[$key]['longitude'] = $service->account->longitude;
            }

            $response->success=true;
            $response->data=$info;
            $response->message="Service found";
        }
        else{
            $services=Service::with('account')->where('name','LIKE',"%{$name}%")->get();

            $info=[];
            foreach ($services as $key=>$service) {
                $info[$key]['provider_id'] = $service->account_id;
                $info[$key]['service_id'] = $service->id;
                $info[$key]['name'] = $service->name;
                $info[$key]['latitude'] = $service->account->latitude;
                $info[$key]['longitude'] = $service->account->longitude;
            }

            $response->success=true;
            $response->data=$info;
            $response->message="Service found";
        }

        return response()->json($response);
    }

    function bubble($user_id,$service_id){
        $response=new \stdClass();

        if(!isset($user_id) || empty($user_id)){
            $response->success=false;
            $response->data=null;
            $response->message="Provider not found";
            return response()->json($response);
        }

        if(!isset($service_id) || empty($service_id)){
            $response->success=false;
            $response->data=null;
            $response->message="Service not found";
            return response()->json($response);
        }

        $service=Service::with('account.user')->where('id',$service_id)->first();
        $account=$service->account;
        $cord=$this->getUserLocation($user_id);

        $distance=$this->getDistanceBetweenPointsNew($cord->latitude, $cord->longitude, $account->latitude, $account->longitude, $unit = 'Km');

        if($service && $cord){
            $comments=Comments::where('provider_id',$service->account_id)->get();
            $total = $comments->sum('ratings');
            $rating=number_format(floatval($total) / count($comments),1);
            $data=array(
                'provider'=>$service->account->user->name,
                'rate'=>$service->rate,
                'provider_id'=>$account->id,
                'name'=>$service->name,
                'service_id'=>$service->id,
                'address'=>$this->formattedAddress($account->address,$account->city,$account->state,$account->country,$account->zip),
                'ratings'=>$rating,
                'distance'=>$distance." Km"
            );

            $response->success=true;
            $response->data=$data;
            $response->message="Service found";
        }
        else{
            $response->success=false;
            $response->data=null;
            $response->message="Service not available";
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

        switch($unit)
        {
            case 'Mi': break;
            case 'Km' : $distance = $distance * 1.609344;
        }
        return (round($distance,2));
    }

    function formattedAddress($address,$city,$state,$country,$zip){
        $formatted=null;

        if(!empty($address))
            $formatted.=$address;

        if(!empty($city))
            $formatted.=' ,'.$city;

        if(!empty($state))
            $formatted.=' ,'.$state;

        if(!empty($country))
            $formatted.=' ,'.$country;

        if(!empty($zip))
            $formatted.=', '.$zip;

        return ltrim(preg_replace('/,/', '', $formatted, 1));
    }
}
