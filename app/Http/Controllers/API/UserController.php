<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $response = [];

        if($request->get('password') && Auth::attempt(['email' => $request->get('email'), 'password' => $request->get('password')], true))
        {
            $user = Auth::user();
            $user->fcm_token = $request->get('fcm_token');
            $user->save();

            $response['success'] = true;
            $response['account'] = $user->account->load('user', 'department.organization');
            $response['error'] = '';

        }
        else
        {
            $response['success'] = false;
            $response['account'] = null;
            $response['error'] = 'Invalid Email or Password!';
        }

        return $response;


    }

    /*Register*/

    public function register(Request $request)
    {
        try{
            // Validate the request
            $validator =  Validator::make($request->all(),User::$rules['create']);

            // Check if validation passes
            if($validator->passes()){

                // Creating a new User
                $user = User::create($request->all());

                // Return User object in response with status code 201
                $response = response()->json($user,Response::HTTP_CREATED);
            }else{
                // Return errors in response with status code 400
                $response = response()->json(['errors'=>$validator->errors()],Response::HTTP_BAD_REQUEST);
            }
            // Return the response
            return $response;

        }catch (\Exception $e){
            // Catch any exception that might occur on server and set response with status code 500
            return response()->json(['errors'=>$e->getMessage()],Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /*Logout*/

    public function logout($id)
    {
        try
        {
            // Check of the specific user, otherwise throw exception
            $user = User::findorFail($id);

            // Delete the user (Soft Delete)
            $user->delete();

            return response()->json($user->deleted_at,Response::HTTP_OK);
        }
        catch(ModelNotFoundException $e)
        {
            return response()->json(['errors' => 'Requested resource could not be found'],Response::HTTP_NOT_FOUND);
        }
    }
}
