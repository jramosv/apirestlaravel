<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\models\Product;
use App\models\Category;

use Carbon\Carbon;
use Illuminate\Support\Str;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('searches.search');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    public function search(Request $request)
    {
        $product = Product::All()->where('id', $request->id)->first();
        
        
        if ($product == null) {
            return redirect()->route('searches.index')
                ->with('error', 'No se encontro Ningun Producto con ese codigo.');
        }
        
        return view('searches.show', compact('product'));
    }
}
