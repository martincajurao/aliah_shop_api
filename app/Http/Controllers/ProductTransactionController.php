<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;

class ProductTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getChartsData(Request $request)
    {
        // $sales = Transaction::selectRaw("sum(amount) as sales,  DATE_FORMAT(created_at, '%Y %m %e') date")
        $sales = Transaction::selectRaw("sum(amount) as sales, Date(created_at) date")
        ->groupBy('date')
        ->get();
        return $sales;
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product_transaction  $product_transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Product_transaction $product_transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product_transaction  $product_transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Product_transaction $product_transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product_transaction  $product_transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product_transaction $product_transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product_transaction  $product_transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product_transaction $product_transaction)
    {
        //
    }
}
