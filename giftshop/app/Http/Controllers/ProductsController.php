<?php

namespace App\Http\Controllers;
use App\User; 
use App\Products; 
use App\Categories; 
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class ProductsController extends Controller
{

    function all(Request $request){
        if($request->isJson()){
            $products = Products::all();
            return response()->json($products, 200);    
        }
        return $this->noAuthorizedAction();                
    }

    function createProduct(Request $request){
        if($request->isJson()){
            if( User::isAdminUser($request) ){
                $data = $request->json()->all();
                $product = Products::create([
                    'name' => $data['name'],
                    'description' => $data['description'],
                    'category_id' => $data['category_id'],
                    'price' => $data['price']
                ]);
                return response()->json($product, 201);
            }
        }
        return $this->noAuthorizedAction();     
    }

    function deleteProduct(Request $request){
        if($request->isJson()){
            if( User::isAdminUser($request) ){
                $data = $request->json()->all();
                if(isset($data['id'])){
                    $product= Products::find($data['id']);
                    if($product && $product->delete()){
                        return response()->json(['success'=>"Product deleted"], 201);
                    }else{
                        return response()->json(['error'=>'No Product deleted'], 401, []);
                    }
                }else{
                    $this->noAuthorizedAction();
                }
                
            }
        }
        return $this->noAuthorizedAction();  
    }

    function byCategory($category_id, Request $request)
    {
        if($request->isJson()){
            $products = Products::where('category_id',$category_id)->get();
            return response()->json($products, 200);    
        }
        return $this->noAuthorizedAction();                
    }

    function byFilters(Request $request)
    {

        if($request->isJson()){
            $data = $request->json()->all();
            $searchString = trim($data['searchString']);
            $categoryId = intval($data['category']); 
            $products = new Products;
            if($searchString!='')    
                $products = $products->where('name', 'like', '%' . $searchString . '%');
            if( $categoryId > 0)
                $products = $products->where('category_id', $categoryId);    
            $products = $products->get();
            return response()->json($products, 200);    
        }
        return $this->noAuthorizedAction();                


    }

    function noAuthorizedAction()
    {
        return response()->json(['error'=>'No authorized action'], 401, []);
    }

}