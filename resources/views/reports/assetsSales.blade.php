<?php
function moneyFormat($n) {
    return number_format($n, 2);
}
function formatDate($date){
    return date('M-d-Y', strtotime($date));
}
?>
<style type="text/css">
    body {
        padding:0px;
        margin:20px 35px;
        font-size:14px;
    }

    p {
        padding: 0px;
        margin:0px;
    }

    .bold-text {
        font-weight: bold
    }

    @page { margin: 0px; }

    div, table {
        width: 100%;
        font-family: Arial, Helvetica, sans-serif
    }

    .header p {
        font-size: 12px;
    }

    .text-center, th {
        text-align: center !important;
    }

    .text-left{
        text-align: left !important;
    }

    .text-right{
        text-align: right !important;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th {
        font-weight: bold;
    }

    td, th {
        padding: 7px;
        text-align: left;
        font-size: 12px;
    }

    .plain-table {
        margin-top: 20px;
    }

    .plain-table td,
    .plain-table th {
        border: none !important;
        padding: 0px !important;
    }
    .text-red{
        color:red;
    }
    .text-right{
        text-align:right;
    }
    .borderedbottom{
        border-bottom: 1px solid black;
    }
    #borderedth th{
        border-top:1px solid black;
    }
    /* th:nth-child(1) {
        width: 10%;
    }

    th:nth-child(2) {
        width: 25%;
    }

    th:nth-child(3) {
        width: 10%;
    }

    th:nth-child(4) {
        width: 10%;
    }

    th:nth-child(5) {
        width: 10%;
    }

    th:nth-child(6) {
        width: 25%;
    } */

    .header-title {
        overflow: hidden;
        width:100%
    }

    .header-title p {
        float: left;
        width:50%;
    }
</style>

{{-- <div class="text-center header">
    <img src="{{public_path().'/images/logo.jpg'}}" width="150">
    <p style="margin-top:10px">BFC Bldg., Magsaysay Blvd Ext., Rawis Calbayog City</p>
</div> --}}
<div>
    <h2 style="text-align: center">SALES INVENTORY REPORT</h2>
    @if ($data->from == null && $data->to == null)
        <p style="text-align: center; margin-bottom:30px;">from:<b> Start </b>to: <b>Present</b> </p>
    @elseif($data->from == $data->to)
        <p style="text-align: center; margin-bottom:30px;">for: <b>{{formatDate($data->from)}}</b> </p>
    @else
        <p style="text-align: center; margin-bottom:30px;">from: <b>{{formatDate($data->from)}} </b>to:  <b> {{formatDate($data->to)}}</b> </p>
    @endif
</div>

<table class="table" >
  <thead>
        <tr style="background-color:#222f3e; color:white;">
            <th class="text-left">#</th>
            <th class="text-left">Product Name w/ Variant </th>
            <th class="text-right">Price</th>
            <th class="text-right">Quantity</th>
            <th class="text-right">Date Created</th>
            <th class="text-right">Subtotal</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data->data as $key => $item)
            <tr>
                <td>{{$key + 1}}</td>
                <td>{{$item['name']}}</td>
                <td class="text-right">{{moneyFormat($item['price'])}}</td>
                <td class="text-right">{{$item['qty']}}</td>
                <td class="text-right">{{formatDate($item['created_at'])}}</td>
                <td class="text-right">{{moneyFormat($item['price'] * $item['qty'])}}</td>
            </tr>
        @endforeach
            <tr><td></td></tr>
            <tr>
                <td colspan="4"></td>
                <td class="text-right"><h3>TOTAL:</h3></td>
                <td class="text-right"><h3>{{moneyFormat($data['total'])}}</h3></td>
            </tr>
            <tr><td></td></tr>
    </tbody>


</table>





