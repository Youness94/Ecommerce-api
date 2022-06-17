<?php

namespace App\Http\Controllers;


use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brand =Brand::all();
        return response()->json([
            'status'=>200,
            'brand'=>$brand,
        ]);
    }
    public function allBrand(){
        $brand =Brand::all();
        return response()->json([
            'status'=>200,
            'brand'=>$brand,
        ]);
    }

   
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request-> all(), [
            'name' => 'required|min:2|max:191',
           
        ]);

        if($validator -> fails()){
            return response()->json([
                'status'=> 400,
                'errors'=> $validator->messages(),

            ]);
        }
        else
        {
            $brand = new Brand;
           
            $brand->name = $request->name;
            $brand->description = $request->description;
            $brand-> save();
            return response()->json([
                'status'=> 200,
                'message'=> 'Brand Added Successfully',

            ]);
        }
    }

    
   

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brand =Brand::find($id);
        if($brand){
            return response()->json([
                'status'=>200,
                'brand'=>$brand,
            ]);
        }else{
            return response()->json([
                'status'=>404,
                'message'=>'NO Brand Id Found',
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request-> all(), [
            'name' => 'required|min:2|max:191',
           
        ]);
        if($validator -> fails()){
            return response()->json([
                'status'=> 422,
                'errors'=> $validator->messages(),

            ]);
        }
        else
        {
            $brand =  Brand::find($id);
            if($brand){

                $brand->name = $request->name;
                $brand->description = $request->description;
            
            $brand-> save();
            return response()->json([
                'status'=> 200,
                'message'=> 'Brand updated Successfully',

            ]);
            }else{
                return response()->json([
                    'status'=> 404,
                    'message'=> "NO Brand Id Found",
    
                ]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand = Brand::find($id);
        if($brand){

            $brand-> delete();
            return response()->json([
                'status'=> 200,
                'message'=> "Brand Deleted Successfully",

            ]);
        }else{
            return response()->json([
                'status'=> 404,
                'message'=> "NO Brand Id Found",

            ]);
        }
    }
}
