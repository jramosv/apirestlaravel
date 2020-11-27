<?php

namespace App\Http\Controllers;

use App\models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return response()->json([
            'data' => $products
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'img' => 'required',
            'price' => 'required',
            'category_id' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $errors = $validator->errors();

            return response()->json([
                'ok' => false,
                'message' => 'Form validation error',
                'errors' => $errors
            ], 400);
        }

        $product = Product::create($request->all());

        //especificacion Json:ApiSpec
        return response()->json([
            'ok' => true,
            'message' => 'Resource successfully created',
            'data' => $product 
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        if(!$product || $product == null){
            return response()->json([
                'ok' => false,
                'message' => 'The requested resource was not found'
            ], 404);
        }
        return response()->json([
            'ok'=> true,
            'data' => $product
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $rules = [
            'name' => 'required',
            'img' => 'required',
            'price' => 'required',
            'category_id' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $errors = $validator->errors();

            return response()->json([
                'ok' => false,
                'message' => 'Form validation error',
                'errors' => $errors
            ], 400);
        }

        $product->name = $request->name;
        $product->img = $request->img;
        $product->price = $request->price;
        $product->category_id = $request->category_id;

        if($product->isClean()){

            return response()->json([
                'ok' => false,
                'message' => 'A differen value must be specified to update'
            ], 400);
        }
        
        $product->save();

        return response()->json([
            'ok' => true,
            'data'=> $product
        ], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json([
            'ok' => true,
            'message' => ' The resource has been deleted succesfully',
            'data' => $product
        ], 200);
    }
}
