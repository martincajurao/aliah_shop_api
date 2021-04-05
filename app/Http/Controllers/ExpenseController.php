<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Expense::all();
    }

    public function getSearchExpenses(Request $request)
    {
        $expense = Expense::whereBetween('created_at', [$request->from." 00:00:00", $request->to." 23:59:59"])->get();
        return $expense;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $table = new Expense;
        $table->subject = $request->subject;
        $table->amount = $request->amount;
        $table->save();
        return $table;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $table = Expense::findOrFail($id);
        $table->subject = $request->subject;
        $table->amount = $request->amount;
        $table->save();

        return $table;
    }

    public function gerenateExpensesPrint(Request $request){
        $pdf = PDF::loadView(
            'reports.expenses',
            ['data'=>$request]
        )->setPaper('a4', 'portrait');

        $pdf->save(public_path('files/preview.pdf'));
        return $request;
    }


}
