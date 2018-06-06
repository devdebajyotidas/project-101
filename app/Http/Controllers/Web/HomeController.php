<?php

namespace App\Http\Controllers\Web;

use App\Models\Account;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;

class HomeController extends Controller
{
    function home(){
        $data['page'] = 'home';
        $data['bodyClass']='animsition page-map page-map-full';
        $request=new Request();
//        $request->setMethod('POST');
//        $request->request->add('');
//        $data['accounts']=$this->load($request);
//        dd($data['accounts']);
        return view('home',$data);
    }

    function load(Request $request){
        $lat=$request->get('latitude');
        $lon=$request->get('longitude');
        $zoom=$request->get('zoom');

        if(!empty($zoom)){
            $radius=156543.03392 * cos($lat * pi() / 180) / pow(2, $zoom);
        }
        else{
            $radius=1;
        }
        $min_lon = $lon-$radius/(cos(deg2rad($lat)));
        $max_lon=  $lon+$radius/(cos(deg2rad($lat)));
        $min_lat = $lat-($radius);
        $max_lat = $lat+($radius);


       $results=Account::whereNotNull('latitude')->whereNotNull('longitude')->whereBetween('longitude', array($min_lon, $max_lon))->whereBetween('latitude', array($min_lat, $max_lat))->get();

        $filtered=new Collection();
        $results->each(function ($item) use ($filtered,$lat,$lon,$radius) {
            if(!empty($item['latitude']) && !empty($item['longitude'])){
                $insearch=$this->getDistanceBetweenPointsNew($lat, $lon, $item['latitude'], $item['longitude']);
                if( $insearch < $radius) {
                    $filtered->push($item);
                }
            }

        });

        $data = $filtered->map(function ($item) {
            if($item['is_provider']==1){
                $image=url('/assets/provider.svg');
            }
            else{
                $image=url('/assets/customer.svg');
            }

            $collect=new Collection(['account_id'=>$item['id'],'image'=>$image,'latitude'=>$item['latitude'],'longitude'=>$item['longitude']]);
            return $collect;
        });

          return response()->json($data);
    }


    function profile(){
        $data['page'] = 'employee profile';
        $data['bodyClass']='animsition page-profile-v2';
        return view('profile',$data);
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

    function accountInfo($account_id){
        $response=new \stdClass();

        if(empty($account_id)){
            $response->status=false;
            $response->data=null;
            $response->message="Invalid account selection";
            return response()->json($response);
        }

        $account=Account::with('user')->where('id',$account_id)->first();
        if(!empty($account)){
            $data['account_id']=$account->id;
            $data['name']=ucwords($account->user->name);
            $data['email']=$account->user->email;
            $data['type']=$account->is_provider==0 ? 'Customer' : 'Provider' ;
            $data['active']=$account->is_blocked == 0 ?  'Active' :  'Blocked' ;
            $data['image']=!empty($account->photo) ? $account->photo : url('uploads/demo-avatar.png');

            $response->status=true;
            $response->data=$data;
            $response->message="Contents found";
        }
        else{
            $response->status=false;
            $response->data=null;
            $response->message="No contents available";
        }

        return response()->json($response);
    }
}
