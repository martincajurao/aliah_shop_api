<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Client;
use App\Models\Product;
use App\Models\Product_transaction;
use App\Http\Controllers\Carbon\Carbon;
use App\Models\Expense;
use App\Models\Product_sku;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;


class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = Transaction::with('client')->orderBy('id', 'DESC')->get();
        return $result;
    }
    public function getbarsData()
    {
        $sales = Transaction::selectRaw('sum(amount) as total_sales')->get();
        $assets = Product_sku::selectRaw('sum(stocks*price) as total_assets')->get();
        $expenses = Expense::selectRaw('sum(amount) as total_expenses')->get();
        return [$assets, $sales, $expenses];
    }

    public function searchTransacntion(Request $request){
        $transactions = Transaction::with('client')->where('client_name', 'LIKE', "%{$request->search}%")
        ->orWhere('invoice_no', 'LIKE', "%{$request->search}%")
        ->orderBy('id', 'DESC')
        ->get();
        return $transactions;
    }
    public function getTodaysSale(){
        $date = date('Y-m-d');
        $transactions = Transaction::selectRaw('sum(amount) as total')
        ->where('created_at', 'LIKE', "%{$date}%")
        ->get();

        $expenses = Expense::selectRaw('sum(amount) as total_expenses')
        ->where('created_at', 'LIKE', "%{$date}%")
        ->get();


        return [$transactions, $expenses];
    }
    public function getSearchSales(Request $request){
        // $transactions = Transaction::with('client')->where('created_at', '>=', $request->from)
        // ->where('created_at', '<=', $request->to)->get();
        $transactions = Transaction::with('client')->whereBetween('created_at', [$request->from." 00:00:00", $request->to." 23:59:59"])->get();
        return $transactions;
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
        $table->client_name = $request->text;
        $table->phone = $request->phone;
        $table->invoice_no = 'INV-'.$table->id;
        $table->amount = $request->amount;
        $table->save();
        $trans_last_id = $table->id;


        $collection = collect($request->purchase);

        $data = $collection->map(function ($item) use ($trans_last_id) {
            $data['transaction_id'] = $trans_last_id;
            $data['product_id'] = $item['id'];
            $data['name'] = $item['name'];
            $data['price'] = $item['price'];
            $data['qty'] = $item['qty'];
            $data['subtotal'] = $item['subtotal'];
            $data['created_at'] = date('Y-m-d H:i:s');
            return $data;
        });
        if($trans_last_id){
            Product_transaction::insert($data->toArray());
            Transaction::where('id',$trans_last_id)->update(array('invoice_no' => 'INV-'.$trans_last_id));
            foreach ($collection as $key => $product) {
                Product::where('id', $product['id'])->update(array('stocks' => $product['stocks'] - $product['qty']));
                Product_sku::where('id', $product['id'])->update(array('stocks' => $product['stocks'] - $product['qty']));
            }
        }
    }


    public function gerenatePdf(Request $request)
    {
        $data = Transaction::with('orderline')->find($request->id);

        $pdf = PDF::loadView(
            'reports.reciept',
            ['data'=>$data]
        );

        return $pdf->download('filename.pdf');
        // return $data;

    }

    public function gerenatePrint(Request $request)
    {
        $data = Transaction::with('product')->find($request->id);

        $pdf = PDF::loadView(
            'reports.reciept',
            ['data'=>$data]
        );

        $pdf->save(public_path('files/preview.pdf'));
        return $data;
    }

    public function gerenateSalesPrint(Request $request){
        // $data = Transaction::with('product')->find($request->id);

        $pdf = PDF::loadView(
            'reports.sales',
            ['data'=>$request]
        )->setPaper('a4', 'portrait');

        $pdf->save(public_path('files/preview.pdf'));
        return $request;
    }


}
