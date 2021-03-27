<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Client;
use App\Models\Product;
use App\Models\Product_transaction;
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
       return Transaction::with('client')->orderBy('id', 'DESC')->get();
    }

    public function searchTransacntion(Request $request){
        $transactions = Transaction::with('client')->where('client_name', 'LIKE', "%{$request->search}%") 
        ->orWhere('invoice_no', 'LIKE', "%{$request->search}%") 
        ->orderBy('id', 'DESC')
        ->get();
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
            Transaction::where('id',$trans_last_id)->update(array('invoice_no' => 'INV-'.$trans_last_id));
            foreach ($collection as $key => $product) {
                Product::where('id', $product['id'])->update(array('stocks' => $product['stocks'] - $product['qty']));
            }
        }
    }


    public function generateClientsInvoicePdf(Request $request)
    {
        $invoice_controller = new InvoiceController;
        $invoices = $invoice_controller->getClientInvoice($request->id);

        $pdf = PDF::loadView( 
            'pdfs.invoice.clients_invoice',
            [
                'invoices'=>$invoices,
                'company' => getCompanyDetails()
            ]
        );
      
        return $pdf->stream('clients_invoice.pdf');
    }

    public function generateClientsInvoicePrintPreview(Request $request)
    {
        $invoice_controller = new InvoiceController;
        $invoice = $invoice_controller->getClientInvoice($request->id);
    
        $pdf = PDF::loadView( 
            'pdfs.invoice.clients_invoice',
            [
                'invoices' => $invoice,
                'company'  => getCompanyDetails()
            ]
        );
        $pdf->save(public_path($this->pdfPreview_dir));
        return $invoice;
    }
    


}
