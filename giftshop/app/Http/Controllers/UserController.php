<?php

namespace App\Http\Controllers;
use App\User; 
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class UserController extends Controller
{
 

    function index()
    {
        return response()->json(['UserController'], 200);

    }

    function all(Request $request )
    {
        if($request->isJson()){
            if( User::isAdminUser($request) ){
                $users = User::all();
                return response()->json($users, 200);
            }
        }
        return $this->noAuthorizedAction();
    }


    function create(Request $request)
    {
        if($request->isJson()){
            if( User::isAdminUser($request) ){
                $data = $request->json()->all();
                $user = User::create([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => Hash::make($data['password']),
                    'level' => 1,
                    'api_token' => Str::random(60)
                ]);
                return response()->json($user, 201);
            }
        }
        return $this->noAuthorizedAction();  
    }

    function delete(Request $request)
    { 
        if($request->isJson()){
            if( User::isAdminUser($request) ){
                $data = $request->json()->all();
                $user = User::find($data['id']);
                if($user && $user->delete()){
                    return response()->json(['success'=>"User deleted"], 201);
                }else{
                    return response()->json(['error'=>'No user deleted'], 401, []);
                }
            }
        }
        return $this->noAuthorizedAction();
        

    }

    function noAuthorizedAction()
    {
        return response()->json(['error'=>'No authorized action'], 401, []);
    }

    function getUserToken(Request $request)
    {
        if( $request->isJson() ){

            try{
                $data = $request->json()->all();
                $user = User::where('email',$data['email'])->first();
                if($user && Hash::check($data['password'],$user->password)){
                     return response()->json($user, 200);
                }else{
                    return  $this->noAuthorizedAction();    
                }
            } catch (ModelNotFOundException $e){
                return  $this->noAuthorizedAction();
            }

        }else{
            return  $this->noAuthorizedAction();
        }
    }

}
