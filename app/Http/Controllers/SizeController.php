<?php

namespace App\Http\Controllers;

use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sizes =Size::all();
        return response()->json([
            'status'=>200,
            'sizes'=>$sizes,
        ]);
    }
    public function allSize(){
        $sizes =Size::all();
        return response()->json([
            'status'=>200,
            'sizes'=>$sizes,
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
            'type' => 'required|min:1|max:4',
           
        ]);

        if($validator -> fails()){
            return response()->json([
                'status'=> 400,
                'errors'=> $validator->messages(),

            ]);
        }
        else
        {
            $sizes = new Size;
           
            $sizes->type = $request->type;
            
            $sizes-> save();
            return response()->json([
                'status'=> 200,
                'message'=> 'Size Added Successfully',

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
        $sizes =Size::find($id);
        if($sizes){
            return response()->json([
                'status'=>200,
                'sizes'=>$sizes,
            ]);
        }else{
            return response()->json([
                'status'=>404,
                'message'=>'NO Size Id Found',
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
            'type' => 'required|min:1|max:4',
           
        ]);
        if($validator -> fails()){
            return response()->json([
                'status'=> 422,
                'errors'=> $validator->messages(),

            ]);
        }
        else
        {
            $sizes =  Size::find($id);
            if($sizes){

                $sizes->type = $request->type;
               
            
            $sizes-> save();
            return response()->json([
                'status'=> 200,
                'message'=> 'Size updated Successfully',

            ]);
            }else{
                return response()->json([
                    'status'=> 404,
                    'message'=> "NO Size Id Found",
    
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
        $sizes = Size::find($id);
        if($sizes){

            $sizes-> delete();
            return response()->json([
                'status'=> 200,
                'message'=> "Size Deleted Successfully",

            ]);
        }else{
            return response()->json([
                'status'=> 404,
                'message'=> "NO Size Id Found",

            ]);
        }
    }
}
