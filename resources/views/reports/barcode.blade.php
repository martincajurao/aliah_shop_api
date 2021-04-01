<?php
function moneyFormat($n) {
    return number_format($n, 2);
}
?>
<style type="text/css">
    body {
        padding:10px;
        margin:20px 5px;
        font-size:12px;
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

</style>
<div style="margin-left:-5px;">
    @for ($i = 0; $i < 5; $i++)
        <div style="display: inline-block; width: 20%; margin:0; padding-bottom:2px;">
            <p>{{$data['name']}}</p>
            <span>Php {{moneyFormat($data['price'])}}</span>
            <img style="width: 100px;">{!! DNS1D::getBarcodeHTML($data['desc'], 'C128',1.6,37) !!}</img>
            <p style="width: 100%; text-align:center; font-weight:bold;">{{$data['desc']}}</p>
        </div>
    @endfor
</div>


