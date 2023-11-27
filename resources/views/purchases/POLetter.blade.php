<html>
<head>
    <title>Inventory</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">

    <!-- External CSS libraries -->
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/invoice/css/bootstrap.min.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/invoice/fonts/font-awesome/css/font-awesome.min.css') }}">

    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Custom Stylesheet -->
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/invoice/css/style.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/css/POCustom.css') }}">
    <meta content="text/html; charset=UTF-8" http-equiv="content-type"/>
</head>

<body class="c14 doc-content">
<p class="c0">
    <span class="c3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
</p>
<a id="t.3f88231f54d733ad0c525dfeb1cf1833424fc3fc"></a><a id="t.0"></a>
<table class="c1">
    <tr class="c16">
        <td class="c17" colspan="1" rowspan="1">
            <p class="c0">
            <span
                style="
                overflow: hidden;
                display: inline-block;
                margin: 0px 0px;
                border: 0px solid #000000;
                transform: rotate(0rad) translateZ(0px);
                -webkit-transform: rotate(0rad) translateZ(0px);
                width: 106px;
                height: 70.67px;
              "
            ><img
                    alt=""
                    src="images/image1.png"
                    style="
                  width: 106px;
                  height: 70.67px;
                  margin-left: 0px;
                  margin-top: 0px;
                  transform: rotate(0rad) translateZ(0px);
                  -webkit-transform: rotate(0rad) translateZ(0px);
                "
                    title=""
                /></span>
            </p>
        </td>
        <td class="c18" colspan="1" rowspan="1">
            <p class="c0"><span class="c3">Company Name</span></p>
            <p class="c0"><span>Company Address</span></p>
        </td>
        <td class="c9" colspan="1" rowspan="1">
            <p class="c0"><span class="c3">PURCHASE ORDER</span></p>
            <a id="t.97b8bfc120a2ecf816c5ab27dedaa70e1907a5e1"></a
            ><a id="t.1"></a>
            <table class="c1">
                <tr class="c5">
                    <td class="c6" colspan="1" rowspan="1">
                        <p class="c4"><span class="c3">PO Date :</span></p>
                    </td>
                    <td class="c6" colspan="1" rowspan="1">
                        <p class="c4"><span class="c3">PO Number :</span></p>
                    </td>
                </tr>
                <tr class="c5">
                    <td class="c6" colspan="1" rowspan="1">
                        <p class="c4"><span class="c3">{{$purchase->purchase_date}}</span></p>
                    </td>
                    <td class="c6" colspan="1" rowspan="1">
                        <p class="c4"><span class="c3">{{$purchase->purchase_no}}</span></p>
                    </td>
                </tr>
                <tr class="c5">
                    <td class="c6" colspan="1" rowspan="1">
                        <p class="c4 c2"><span class="c3"></span></p>
                    </td>
                    <td class="c6" colspan="1" rowspan="1">
                        <p class="c4 c2"><span class="c3"></span></p>
                    </td>
                </tr>
{{--                <tr class="c5">--}}
{{--                    <td class="c6" colspan="1" rowspan="1">--}}
{{--                        <p class="c4"><span class="c3">Terms</span></p>--}}
{{--                    </td>--}}
{{--                    <td class="c6" colspan="1" rowspan="1">--}}
{{--                        <p class="c4"><span class="c3">Tax</span></p>--}}
{{--                    </td>--}}
{{--                </tr>--}}
            </table>

{{--            @php--}}
{{--            dd($purchase)--}}
{{--            @endphp--}}
            <p class="c0 c2"><span class="c3"></span></p>
        </td>
    </tr>
</table>
<p class="c0"><span class="c3">Vendor : {{$purchase->supplier->name}}</span></p>
<p class="c0"><span class="c3">Ship to : 1</span></p>
<p class="c0 c2"><span class="c3"></span></p>
<p class="c0 c2"><span class="c3"></span></p>
<a id="t.8c84625dab197fab899129fa96bdab20b18460c0"></a><a id="t.2"></a>
<table class="c1">
    <tr class="c5">
        <td class="c7 c11" colspan="1" rowspan="1">
            <p class="c4"><span class="c3">Item</span></p>
        </td>
        <td class="c7 c11" colspan="1" rowspan="1">
            <p class="c4"><span class="c3">Desc</span></p>
        </td>
        <td class="c7 c11" colspan="1" rowspan="1">
            <p class="c4"><span class="c3">Qty</span></p>
        </td>
        <td class="c7 c11" colspan="1" rowspan="1">
            <p class="c4"><span class="c3">Unit Price</span></p>
        </td>
        <td class="c7 c11" colspan="1" rowspan="1">
            <p class="c4"><span class="c3">Amount</span></p>
        </td>
    </tr>
    @foreach($purchaseDetails as $item)
        <tr class="c5">
            <td class="c7" colspan="1" rowspan="1">
                <p class="c4 c2"><span class="c3">{{$item->product->product_name}}</span></p>
            </td>
            <td class="c7" colspan="1" rowspan="1">
                <p class="c4 c2"><span class="c3"></span>{{$item->product->detail}}</p>
            </td>
            <td class="c7" colspan="1" rowspan="1">
                <p class="c4 c2"><span class="c3"></span>{{$item->quantity}}</p>
            </td>
            <td class="c7" colspan="1" rowspan="1">
                <p class="c4 c2"><span class="c3"></span>{{$item->unitcost}}</p>
            </td>
            <td class="c7" colspan="1" rowspan="1">
                <p class="c4 c2"><span class="c3"></span>{{$item->total}}</p>
            </td>
        </tr>
    @endforeach
</table>
<p class="c0 c2"><span class="c3"></span></p>
<p class="c0 c2"><span class="c3"></span></p>
<a id="t.02aafa16db45ca58507518f04bd954cd429040b9"></a><a id="t.3"></a>
<table class="c1">
    <tr class="c5">
        <td class="c13" colspan="1" rowspan="1">
            <p class="c0"><span class="c3">Description : {{$purchase->description_purchase}}</span></p>
        </td>
        <td class="c10" colspan="1" rowspan="1">
            <p class="c4 c2"><span class="c3"></span></p>
            <a id="t.5593084b963b24f8385fd5c8ab8f42ad79672d71"></a
            ><a id="t.4"></a>
            <table class="c1">
                <tr class="c5">
                    <td class="c8" colspan="1" rowspan="1">
                        <p class="c4"><span class="c3"><strong>Sub Total :</strong></span></p>
                        <p class="c4 c2"><span class="c3"></span></p>
                    </td>
                    <td class="c8" colspan="1" rowspan="1">
                        <p class="c4"><span class="c3"><strong>Sub Total</strong></span></p>
                    </td>
                </tr>
            </table>
            <p class="c4 c2"><span class="c3"></span></p>
        </td>
    </tr>
    <tr class="c5">
        <td class="c13" colspan="1" rowspan="1">
            <p class="c0 c2"><span class="c3"></span></p>
        </td>
        <td class="c10" colspan="1" rowspan="1">
            <p class="c4"><span class="c3">Uang Muka : Rp. {{$purchase->total_amount_paid}}</span></p>
        </td>
    </tr>
    <tr class="c5">
        <td class="c13" colspan="1" rowspan="1">
            <p class="c0 c2"><span class="c3"></span></p>
        </td>
        <td class="c10" colspan="1" rowspan="1">
            <p class="c4"><span class="c3"><strong>Total Order : Rp. {{$purchase->total_amount}}</strong></span></p>
        </td>
    </tr>
</table>
<p class="c0 c2">
    <span class="c3"><br /></span>
</p>
<a id="t.56f006efa823e6a17387f11933c49e58f634140e"></a><a id="t.5"></a>
<table class="c1">
    <tr class="c5">
        <td class="c12" colspan="1" rowspan="1">
            <p class="c4"><span class="c3">Prepared By</span></p>
            <p class="c2 c4"><span class="c3"></span></p>
            <p class="c2 c4"><span class="c3"></span></p>
            <p class="c2 c4"><span class="c3"></span></p>
            <p class="c4 c2"><span class="c3"><hr></span></p>
            <p class="c4"><span class="c3">{{$purchase->purchase_date}}</span></p>
        </td>
        <td class="c12" colspan="1" rowspan="1">
            <p class="c4"><span class="c3">Approved By</span></p>
            <p class="c4 c2"><span class="c3"></span></p>
            <p class="c4 c2"><span class="c3"></span></p>
            <p class="c4 c2"><span class="c3"></span></p>
            <p class="c4 c2"><span class="c3"><hr></span></p>
            <p class="c4"><span class="c3">{{$purchase->purchase_date}}</span></p>
        </td>
    </tr>
</table>
<p class="c0 c2"><span class="c3"></span></p>
<p class="c0 c2"><span class="c3"></span></p>
<p class="c0 c2"><span class="c3"></span></p>
<p class="c0 c2"><span class="c3"></span></p>

<div class="invoice-btn-section clearfix d-print-none">
    <a href="javascript:window.print()" class="btn btn-lg btn-print">
        <i class="fa fa-print"></i> Print Invoice
    </a>
    <a id="invoice_download_btn" class="btn btn-lg btn-download">
        <i class="fa fa-download"></i> Download Invoice
    </a>
</div>
</body>
</html>
