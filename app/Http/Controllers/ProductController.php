<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $products = Product::all();
        $products = Product::with(['category', 'brand'])->get();
        return response()->json([
            'status'=>200,
            'products'=> $products,
        ]);
    }
    public function allProduct()
    {
        $products = Product::paginate(20);
        return response()->json([
            'status'=>200,
            'products'=> $products,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $validator = Validator::make($request-> all(), [
        //     'category_id'=> 'required|max:191|exists:categories,id',
        //     'brand_id'=>'required|max:191|exists:brands,id',
        //     'title'=> 'required|max:191',
        //     'description'=> 'required|max:400',
        //     "selling_price"=>'required',
        //     'original_price'=>'required',
        //     'image'=> 'required|image|mimes:jpeg,png,jpg|max:2048',  
           
        // ]);

        // if($validator->fails()){
        //     return response()->json([
        //         'status'=> 422,
        //         'errors'=> $validator->messages(),

        //     ]);
        // }
        // else
        // {
        $products = new Product();


        $products->brand_id = $request->brand_id;
        $products->category_id = $request->category_id;
        $products->title = $request->title;
        $products->description = $request->description;
        $products->selling_price = $request->selling_price;
        $products->original_price = $request->original_price;
        if($request->hasFile('image')){
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time().'.'.$extention;
            $file->move('uploads/product/', $filename);
            $products->image ='uploads/product/'.$filename;
        }

        $products-> save();

        // store product size stock 
        // if($request->items){
        //     foreach($request->items as $item){
        //         $size_stock = new ProductSizeStock();
        //         $size_stock->product_id = $products->id;
        //         $size_stock->size_id = $item['size_id'];
        //         $size_stock->quantity = $item['quantity'];
        //         $size_stock-> save();
        //     }
        // }



        return response()->json([
            'status'=> 200,
            'message'=> 'Product Added Successfully',

        ]);
    // }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        
        $products = Product ::find($id);
        if($products){
            return response()->json([
                'status'=>200,
                'products'=>$products,

                ]);
        }
        else{
            return response()->json([
                'status'=>404,
                'message'=>'No Product Found',

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
        $products = Product ::find($id);
        // $products = Product::with(['category', 'brand'])->where('id', $id)->get();
        if($products){
            return response()->json([
                'status'=>200,
                'products'=>$products,

                ]);
        }
        else{
            return response()->json([
                'status'=>404,
                'message'=>'No Product Found',

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
        $products =  Product::find($id);
        // $products = Product::with(['category', 'brand'])->where('id', $id)->get();
        if($products){
            // $products = new Product();
            $products->brand_id = $request->brand_id;
            $products->category_id = $request->category_id;
            $products->title = $request->title;
            $products->description = $request->description;
            $products->selling_price = $request->selling_price;
            $products->original_price = $request->original_price;
            if($request->hasFile('image')){
               
            
                $path= $products->image;
                if(File::exists($path)){

                    File::delete($path);
                }
                $file = $request->file('image');
                $extention = $file->getClientOriginalExtension();
                $filename = time().'.'.$extention;
                $file->move('uploads/product/', $filename);
                $products->image ='uploads/product/'.$filename;
            }
          

            $products-> update();

            // ProductSizeStock::where('product_id', $id)->delete();

        // store product size stock 
        //     if($request->items){
        //         foreach($request->items as $item){
        //             $size_stock = new ProductSizeStock();
        //             $size_stock->product_id = $products->id;
        //             $size_stock->size_id = $item['size_id'];
        //             $size_stock->quantity = $item['quantity'];
        //             $size_stock-> save();
        //         }
        //         return response()->json([
        //             'status'=> 200,
        //             'message'=> 'Product Updated Successfully',

        //         ]);
        // }
        // else{
        //     return response()->json([
        //         'status'=> 404,
        //         'message'=> 'Product Not Found',

        //     ]);
        // }

        return response()->json([
            'status'=> 200,
            'message'=> 'Product Updated Successfully',

        ]);





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
        $products = Product::find($id);
        if($products){

            $products-> delete();
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
