<?php

namespace App\Http\Controllers;
use \App\Models\Product;
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
        $products = Product::with('category')->get();
        return $products;
    }

    public function searchProduct(Request $request){
        $products =Product::where('name', 'LIKE', "%{$request->search}%") 
        ->orWhere('id', 'LIKE', "%{$request->search}%") 
        ->get();
        return $products;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $table = new Product;
        $table->name = $request->name;
        $table->desc = $request->desc;
        $table->price = $request->price;
        $table->stocks = $request->stocks;
        $table->product_category = $request->product_category;

        if($request->file('image')){
            $imageName = time().'.'. $request->file('image')->extension();  
            $request->file('image')->move(public_path('images'), $imageName);
            $table->img =   $imageName;
        }

        $table->save();
        
        return $table;

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Product::with('category')->findOrFail($id);
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
        $table = Product::findOrFail($id);
        $table->name = $request->name;
        $table->desc = $request->desc;
        $table->price = $request->price;
        $table->stocks = $request->stocks;
        $table->product_category = $request->product_category;
   
        if($request->file('image')){

            $imageName = time().'.'. $request->file('image')->extension();  
            $request->file('image')->move(public_path('images'), $imageName);
            $table->img =   $imageName;
            // unlink(public_path('images/'.$request->img));
        }
       

        $table->save();
        return $table;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $table = Product::findOrFail($id);
        $table->delete();
    }
}
