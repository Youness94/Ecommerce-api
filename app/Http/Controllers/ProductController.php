<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Facade\FlareClient\Stacktrace\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{

    public function index(){
        $products = Product::all();
        return response()->json([
            'status'=>200,
            'products'=> $products,
        ]);
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(), [

            'category_id'=> 'required|max:191',
            'title'=> 'required|max:191',
            'price'=> 'required|max:191',
            'description'=> 'required|max:191',
            'image'=> 'required|image|mimes:jpeg,png,jpg|max:2048',   
        ]);

        if($validator->fails()){
            return response()->json([
                'status'=> 422,
                'errors'=> $validator->messages(),

            ]);
        }
        else
        {
           
            $products = new Product;
            
            if($request->hasFile('image')){
                $file = $request->file('image');
                $extention = $file->getClientOriginalExtension();
                $filename = time().'.'.$extention;
                $file->move('uploads/product/', $filename);
                $products->image ='uploads/product/'.$filename;
            }
            
            $products->category_id = $request->input('category_id');
            $products->title = $request->input('title');
            $products->price = $request->input('price');
            $products->description = $request->input('description');
            
            $products-> save();
            return response()->json([
                'status'=> 200,
                'message'=> 'Product Added Successfully',

            ]);
        }
    }
    public function edit ($id){
        $products = Product ::find($id);
        if($products){
            return response()->json([
                'status'=>200,
                'product'=>$products,

                ]);
        }
        else{
            return response()->json([
                'status'=>404,
                'message'=>'No Product Found',

                ]);
        }
    }
    public function update (Request $request, $id){

        $validator = Validator::make($request-> all(), [
            'category_id' => 'required|max:191',
            'title' => 'required|max:191',
            'price' => 'required|max:191',
            'description' => 'required|max:191',
            
           
        ]);

        if($validator -> fails()){
            return response()->json([
                'status'=> 422,
                'errors'=> $validator->messages(),

            ]);
        }
        else
        {
            $product =  Product::find($id);
            if($product){
                $product->category_id = $request->input('category_id');
                $product->title = $request->input('title');
                $product->price = $request->input('price');
                $product->description = $request->input('description');
    
                if($request->hasFile('image')){
                    $path = $product->image;
                    if(File::exists($path)){
                        File:delete($path);
                    }
                    $file = $request->file('image');
                    $extention = $file->getClientOriginalExtension();
                    $filename = time() .'.'.$extention;
                    $file->move('uploads/product/', $filename);
                    $product->image ='uploads/product/'.$filename;
                }
                
                $product-> update();
                return response()->json([
                    'status'=> 200,
                    'message'=> 'Product Updated Successfully',
    
                ]);
            }
            else{
                return response()->json([
                    'status'=> 404,
                    'message'=> 'Product Not Found',
    
                ]);
            };
            }

            
           
            
    }
    public function destroy ($id){
        $product = Product::find($id);
        if($product){

            $product-> delete();
            return response()->json([
                'status'=> 200,
                'message'=> "Product Deleted Successfully",

            ]);
        }else{
            return response()->json([
                'status'=> 404,
                'message'=> "NO Product Id Found",

            ]);
        }
    }
}
