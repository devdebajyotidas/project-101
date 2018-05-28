<?php

namespace App\Http\Controllers\Web;

use App\Models\AdminService;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class ServiceController extends Controller
{
    function index(){
        $data['page']='service';
        $data['bodyClass']='animsition';
        $request=new Request();
        $data['services']=$this->load($request);
        return view('services.index',$data);
    }

    function load(Request $request){

        $search=$request->get('search');
        $sort_opt=$request->get('sort');
        $filter=$request->get('filter');

        $sort_arr=explode(' ',$sort_opt);

        if(!empty($sort_opt) && !empty($sort_arr)){
            $sort_col=$sort_arr[0];
            $sort_val=$sort_arr[1];
        }
        else{
            $sort_col='name';
            $sort_val='asc';
        }

        if(!empty($filter)){
            $result=AdminService::withTrashed()->with(['service'])->withCount('serviceTaken as usage');
        }
        else{
            $result=AdminService::with(['service'])->withCount('serviceTaken as usage');
        }

        if(!empty($search)){
            $result=$result->where('name','LIKE',"%$search%");
        }

        $data['total_result']=$result->count();
        $data['services']=$result->orderBy($sort_col,$sort_val)->get();

        return view('services.card',$data);
    }

    function create(Request $request){
        $response=new \stdClass();
        $name=$request->get('name');
        $id=$request->get('id');

        if(empty($name)){
          $response->status=false;
          $response->message="Can't create service with empty name";
          return response()->json($response);
        }

        if(empty($id)){
            $exist=AdminService::where('name',$name)->exists();
            if($exist){
                $response->status=false;
                $response->message="A service with same name exists";
                return response()->json($response);
            }
        }



        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $image = strtolower(preg_replace("/[\s_]/", "-", str_replace('&','',$name))).'-'.time().rand(100,999).".".$file->getClientOriginalExtension();
            if($file->move('uploads/service/',$image)){
                $data['image'] = $image;
            }else{
                $data['image'] = null;
            }
        }

        $data['name']=$name;

        if(!empty($id)){
            $service=AdminService::find($id);
            if(isset($data['image']) && !empty($data['image'])){
                $image_path=public_path('uploads/service').'/'.$service->image;
                if(file_exists($image_path)){
                    @unlink($image_path);
                }
            }

            $result=$service->update($data);
            $message="update";
        }
        else{
            $result=AdminService::create($data);
            $message="create";
        }


        if($result){
            $response->status=true;
            $response->message="Service has been ".$message.'d';
        }
        else{
            $response->status=false;
            $response->message="Unable to ".$message." the service";
        }

        return response()->json($response);
    }

    function archive(Request $request,$service_id){
        $response=new \stdClass();
        $action=$request->get('action');

        if(!isset($service_id) || empty($service_id)){
            $response->status=false;
            $response->message="Invalid service selection";
        }

        $servCount=0;
        $services=Service::withTrashed()->where('service_id',$service_id)->get();
        $adminService=AdminService::withTrashed()->find($service_id);
        if($action=='archive'){
            if(!empty($services)){
                foreach ($services as $service){
                    $service->delete();
                    $servCount++;
                }
            }
            else{
                $servCount=1;
            }
            $adminStat=$adminService->delete();
            $message="archive";
        }
        else{
            if(!empty($services)){
                foreach ($services as $service){
                    $service->restore();
                    $servCount++;
                }
            }
            else{
                $servCount=1;
            }
            $adminStat=$adminService->restore();
            $message='restore';
        }

        if(count($servCount) > 0 && $adminStat){
            $response->status=true;
            $response->message="Service has been ".$message."d";
        }
        else{
            $response->status=false;
            $response->message="Unable to ".$message." the service";
        }

        return response()->json($response);
    }
}
