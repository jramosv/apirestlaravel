<?php

namespace App\Http\Controllers;

use App\models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorys = Category::all();
        return response()->json([
            'data' => $categorys
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
            'name' => 'required'
           
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

        $category = Category::create($request->all());

        //especificacion Json:ApiSpec
        return response()->json([
            'ok' => true,
            'message' => 'Resource successfully created',
            'data' => $category 
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        if(!$category || $category == null){
            return response()->json([
                'ok' => false,
                'message' => 'The requested resource was not found'
            ], 404);
        }
        return response()->json([
            'ok'=> true,
            'data' => $category
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $rules = [
            'name' => 'required'
           
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

        $category->name = $request->name;
       

        if($category->isClean()){

            return response()->json([
                'ok' => false,
                'message' => 'A differen value must be specified to update'
            ], 400);
        }
        
        $category->save();

        return response()->json([
            'ok' => true,
            'data'=> $category
        ], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return response()->json([
            'ok' => true,
            'message' => ' The resource has been deleted succesfully',
            'data' => $category
        ], 200);
    }
}
