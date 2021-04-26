<?php

namespace App\Http\Controllers;
use \App\Models\Product;
use App\Models\Product_sku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Barryvdh\DomPDF\Facade as PDF;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('category', 'sku')->get();
        return $products;
    }
    public function getFeaturedProducts()
    {
        $products = Product_sku::with('product')
        ->limit(8)
        ->get();
        return $products;
    }
    public function getAllAssets()
    {
        $assets = Product_sku::with('product')->get();
        return $assets;
    }

    public function searchProduct(Request $request){
        $searchString = $request->search;
        $products =Product_sku::with('product')
        ->whereHas('product', function ($query) use ($searchString){
            $query->where('name', 'like', '%'.$searchString.'%');
        })
        ->orWhere('sku', 'LIKE', "%{$searchString}%")
        ->limit(8)
        ->get();
        return $products;
    }
    public function searchBarcode(Request $request){
        $searchString = $request->barcode;
        $products = Product_sku::with('product')
        ->whereHas('product', function ($query) use ($searchString){
            $query->where('sku', 'like', '%'.$searchString.'%');
        })
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
        $table->img = "default.jpg";
        if($request->file('image')){
            $imageName = time().'.'. $request->file('image')->extension();
            $request->file('image')->move(public_path('images'), $imageName);
            $table->img =   $imageName;
        }
        $table->save();
        $product_id = $table->id;

        $collection = collect(json_decode($request->variants));

        $data = $collection->map(function ($item) use ($product_id) {
            $data['product_id'] = $product_id;
            $data['sku'] = $item->sku;
            $data['price'] = $item->price;
            $data['size'] = $item->size;
            $data['color'] = $item->color;
            $data['stocks'] = $item->stocks;
            $data['created_at'] = date('Y-m-d H:i:s');
            return $data;
        });

        Product_sku::insert($data->toArray());

        return $data;

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Product::with('category','sku')->findOrFail($id);
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

        Product_sku::where('product_id', $id)->delete();

        $collection = collect(json_decode($request->variants));
        $data = $collection->map(function ($item) use ($id) {
            $data['product_id'] = $id;
            $data['sku'] = $item->sku;
            $data['price'] = $item->price;
            $data['size'] = $item->size;
            $data['color'] = $item->color;
            $data['stocks'] = $item->stocks;
            $data['created_at'] = date('Y-m-d H:i:s');
            return $data;
        });

        Product_sku::insert($data->toArray());

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

    public function generateBarcode(Request $request){

        $data = Product::find($request->id);

        $pdf = PDF::loadView(
            'reports.barcode',
            ['data'=>$data]
        );

        $pdf->save(public_path('files/preview.pdf'));
        return $data;
    }
    public function gerenateAssetsPrint(Request $request){

        $pdf = PDF::loadView(
            'reports.assets',
            ['data'=>$request]
        )->setPaper('a4', 'portrait');

        $pdf->save(public_path('files/preview.pdf'));
        return $request;
    }
    public function gerenateAssetsSalesPrint(Request $request){

        $pdf = PDF::loadView(
            'reports.assetsSales',
            ['data'=>$request]
        )->setPaper('a4', 'portrait');

        $pdf->save(public_path('files/preview.pdf'));
        return $request;
    }
}
