<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{

    public function index(){

        $category =Category::all();
        return response()->json([
            'status'=>200,
            'category'=>$category,
        ]);
    }
    public function allCategory(){
        $category =Category::all();
        return response()->json([
            'status'=>200,
            'category'=>$category,
        ]);
    }

    public function store (Request $request){

        $validator = Validator::make($request-> all(), [
            'name' => 'required|max:191',
           
        ]);
        if($validator -> fails()){
            return response()->json([
                'status'=> 400,
                'errors'=> $validator->messages(),

            ]);
        }
        else
        {
            $category = new Category;
            $category->name = $request->name;
            $category->description = $request->description;
            $category-> save();
            return response()->json([
                'status'=> 200,
                'message'=> 'Category Added Successfully',

            ]);
        }

        
    }

    public function edit($id){

        $category =Category::find($id);
        if($category){
            return response()->json([
                'status'=>200,
                'category'=>$category,
            ]);
        }else{
            return response()->json([
                'status'=>404,
                'message'=>'NO Category Id Found',
            ]);
        }
    }
    public function update(Request $request, $id){


        $validator = Validator::make($request-> all(), [
            'name' => 'required|max:191',
           
        ]);
        if($validator -> fails()){
            return response()->json([
                'status'=> 422,
                'errors'=> $validator->messages(),

            ]);
        }
        else
        {
            $category =  Category::find($id);
            if($category){

                $category->name = $request->name;
                $category->description = $request->description;
            
            $category-> save();
            return response()->json([
                'status'=> 200,
                'message'=> 'Category updated Successfully',

            ]);
            }else{
                return response()->json([
                    'status'=> 404,
                    'message'=> "NO Ctegory Id Found",
    
                ]);
            }
        }
        
    }

    public function destroy ($id){
        $category = Category::find($id);
        if($category){

            $category-> delete();
            return response()->json([
                'status'=> 200,
                'message'=> "Category Deleted Successfully",

            ]);
        }else{
            return response()->json([
                'status'=> 404,
                'message'=> "NO Ctegory Id Found",

            ]);
        }
    }
}
