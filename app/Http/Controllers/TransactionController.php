<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Client;
use App\Models\Product_transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $clientID = $request->value;

        if($request->value==""){
            $table = new Client;
            $table->name = $request->text;
            $table->phone = $request->phone;
            $table->count_purchase = 0;
            $table->img = rand(1,5).'.png';
            $table->save();
            $clientID = $table->id;
        }

        $table = new Transaction;
        $table->client_id = $clientID;
        $table->name = $request->text;
        $table->phone = $request->phone;
        $table->invoice_no = 'INV-';
        $table->amount = $request->amount;
        $table->save();
        $trans_last_id = $table->id;
         
        $collection = collect($request->purchase);
        $data =[];
        $data = $collection->map(function ($item) use ($trans_last_id) {
            $data['transaction_id'] = $trans_last_id;
            $data['product_id'] = $item['id'];
            $data['name'] = $item['name'];
            $data['price'] = $item['price'];
            $data['qty'] = $item['qty'];
            $data['subtotal'] = $item['subtotal'];
            return $data;
        });
        if($trans_last_id){
            Product_transaction::insert($data->toArray());
        }
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
