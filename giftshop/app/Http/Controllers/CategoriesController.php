<?php

namespace App\Http\Controllers;
use App\User; 
use App\Categories; 
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class CategoriesController extends Controller
{
    function all(Request $request)
    {
        if($request->isJson()){
            $categories = Categories::all();
            return response()->json($categories, 200);    
        }
        return $this->noAuthorizedAction();        
    }

    function createCategory(Request $request){
        
        if($request->isJson()){
            if( User::isAdminUser($request) ){
                $data = $request->json()->all();
                $category = Categories::create([
                    'name' => $data['name'],
                    'description' => $data['description']
                ]);
                return response()->json($category, 201);
            }
        }
        return $this->noAuthorizedAction();     
    }

    function deleteCategory(Request $request){
        if($request->isJson()){
            if( User::isAdminUser($request) ){
                $data = $request->json()->all();
                if(isset($data['id'])){
                    $category = Categories::find($data['id']);
                    if($category && $category->delete()){
                        return response()->json(['success'=>"Category deleted"], 201);
                    }else{
                        return response()->json(['error'=>'No Category deleted'], 401, []);
                    }
                }else{
                    $this->noAuthorizedAction();
                }
                
            }
        }
        return $this->noAuthorizedAction();        
    }

    function noAuthorizedAction()
    {
        return response()->json(['error'=>'No authorized action'], 401, []);
    }
}


 