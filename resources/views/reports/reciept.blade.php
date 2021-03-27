<?php
function moneyFormat($n) {
    return number_format($n, 2);
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
<table style="margin-top20px;">
    <tr>
        <td style="padding-top:90px;">
            <p class="bold-text">To:</p>
            <p>{{$data['client_name']}}</p>
        </td>
        <td>
            <div class="text-right">
                <h2>CUSTOMER"S RECIEPT</h2>
                <h3><strong>Invoice No: </strong> {{$data['invoice_no']}}</h3>
                <br>
                <br>
                <p><strong>Prepared By:</strong></p>
                <p>Namswee</p>
                <br>
            </div>
        </td>

    </tr>
</table>

<table class="table" >
  <thead>
        <tr style="background-color:#222f3e; color:white;">
            <th class="text-left">#</th>
            <th class="text-left">Product</th>
            <th class="text-right">Quantity</th>
            <th class="text-right">Price</th>
            <th class="text-right">Subtotal</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data->orderline as $key => $item)
            <tr>
                <td>{{$key + 1}}</td>
                <td>{{$item['name']}}</td>
                <td class="text-right">{{$item['qty']}}</td>
                <td class="text-right">{{moneyFormat($item['price'])}}</td>
                <td class="text-right">{{moneyFormat($item['subtotal'])}}</td>
            </tr>
        @endforeach
            <tr><td></td></tr>
            <tr>
                <td colspan="3"></td>
                <td class="text-right"><h3>TOTAL:</h3></td>
                <td class="text-right"><h3>{{moneyFormat($data['amount'])}}</h3></td>
            </tr>
            <tr><td></td></tr>
    </tbody>
    {{-- <tfoot>
        <tr>
            <td colspan="4"></td>
            <th class="text-right">Sub Total</th>
            <td class="text-right">{{showMoneyValue($data['sub_total'])}} </td>
        </tr>
        <tr>
            <td colspan="4"></td>
            <th class="text-right">Total</th>
            <td class="text-right">{{showMoneyValue($data['total'])}} </td>
        </tr>
        <tr>
            <td colspan="4"></td>
            <th class="text-right">Total Paid</th>
            <td class="text-right">{{showMoneyValue($data['totalAmountPaid'])}} </td>
        </tr>
        <tr>
           <td colspan="4"></td>
            @if($data['totalAmountBalance'] != 0)
                <th class="text-right text-red">Amount Due</th>
                <td class="text-right text-red" >{{showMoneyValue($data['totalAmountBalance'])}} </td>
            @else
                <th class="text-right">Amount Due</th>
                <td class="text-right">{{showMoneyValue($data['totalAmountBalance'])}} </td>
            @endif
        </tr>
    </tfoot> --}}

</table>


<div>

    <br>
    <br>
    <br>
    <br>
    <br>
    <span>Authorized Signature: ______________________</span>
</div>



