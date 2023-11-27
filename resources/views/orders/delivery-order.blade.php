<html>
<head>
    <title>Inventory</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">

    <!-- External CSS libraries -->
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/invoice/css/bootstrap.min.css') }}">
    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Custom Stylesheet -->
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/invoice/css/style.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/css/delivery-order.css') }}">
    <meta content="text/html; charset=UTF-8" http-equiv="content-type"/>
</head>



<body class="c6 c26 doc-content">
<p class="c13">
    <span class="c5">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
</p>
<a id="t.cf094ba00230af59aff7987542c32b8a4d7f3db8"></a><a id="t.0"></a>
<table class="c17">
    <tr class="c11">
        <td class="c27" colspan="1" rowspan="1">
            <p class="c0"><span class="c5"></span></p>
        </td>
        <td class="c28" colspan="1" rowspan="1">
            <p class="c13"><span class="c5">Company Name</span></p>
            <p class="c13"><span>Company Address</span></p>
        </td>
        <td class="c7" colspan="1" rowspan="1">
            <p class="c24"><span class="c3">DELIVERY ORDER</span></p>
        </td>
    </tr>
    <tr class="c16">
        <td class="c22" colspan="2" rowspan="1">
            <p class="c0"><span class="c5"></span></p>
            <a id="t.95be8ce597f4c43e8c3dece023df73796163a61c"></a
            ><a id="t.1"></a>
            <table class="c17">
                <tr class="c8">
                    <td class="c2" colspan="1" rowspan="1">
                        <p class="c13"><span class="c5">Bill To : </span></p>
                    </td>
                    <td class="c14" colspan="1" rowspan="1">
                        <p class="c10"><span class="c5">{{$order->order->customer->name}}</span></p>
                        <p class="c1"><span class="c5"></span></p>
                        <p class="c1"><span class="c5"></span></p>
                    </td>
                </tr>
                <tr class="c8">
                    <td class="c2" colspan="1" rowspan="1">
                        <p class="c10"><span class="c5">Ship To :</span></p>
                    </td>
                    <td class="c14" colspan="1" rowspan="1">
                        <p class="c1"><span class="c5"></span></p>
                        <p class="c1"><span class="c5"></span></p>
                        <p class="c1"><span class="c5"></span></p>
                    </td>
                </tr>
            </table>
            <p class="c0"><span class="c5"></span></p>
        </td>
        <td class="c7" colspan="1" rowspan="1">
            <p class="c0"><span class="c5"></span></p>
            <a id="t.c9389c5610acc6130335b2f43e7bcb9d9474dbf3"></a
            ><a id="t.2"></a>
            <table class="c17">
                <tr class="c8">
                    <td class="c9" colspan="1" rowspan="1">
                        <p class="c10"><span class="c5">Delivery Date :</span></p>
                    </td>
                    <td class="c9" colspan="1" rowspan="1">
                        <p class="c10"><span class="c5">Delivery No</span></p>
                    </td>
                </tr>
                <tr class="c8">
                    <td class="c9" colspan="1" rowspan="1">
                        <p class="c10"><span class="c5">{{$order->delivery_date}}</span></p>
                    </td>
                    <td class="c9" colspan="1" rowspan="1">
                        <p class="c10"><span class="c5">{{$order->delivery_number}}</span></p>
                    </td>
                </tr>
                <tr class="c8">
                    <td class="c9" colspan="1" rowspan="1">
                        <p class="c1"><span class="c5"></span></p>
                    </td>
                    <td class="c9" colspan="1" rowspan="1">
                        <p class="c1"><span class="c5"></span></p>
                    </td>
                </tr>
                <tr class="c8">
                    <td class="c9" colspan="1" rowspan="1">
                        <p class="c10"><span class="c5">Ship Via</span></p>
                    </td>
                    <td class="c9" colspan="1" rowspan="1">
                        <p class="c10"><span class="c5">PO No.</span></p>
                    </td>
                </tr>
                <tr class="c8">
                    <td class="c9" colspan="1" rowspan="1">
                        <p class="c10"><span class="c5">{{$order->ship_via}}</span></p>
                    </td>
                    <td class="c9" colspan="1" rowspan="1">
                        <p class="c10"><span class="c5">{{$order->order->invoice_no}}</span></p>
                    </td>
                </tr>
            </table>
            <p class="c0"><span class="c5"></span></p>
        </td>
    </tr>
</table>
<p class="c0"><span class="c5"></span></p>
<p class="c0"><span class="c5"></span></p>
<a id="t.cfd0e44ea732160ff18edf682f4eeafa86a28cca"></a><a id="t.3"></a>
<table class="c17">
    <tr class="c8">
        <td class="c23 c25" colspan="1" rowspan="1">
            <p class="c10"><span class="c5">Item</span></p>
        </td>
        <td class="c4 c25" colspan="1" rowspan="1">
            <p class="c10"><span class="c5">Item Desc</span></p>
        </td>
        <td class="c19" colspan="1" rowspan="1">
            <p class="c10"><span class="c5">Qty</span></p>
        </td>
        <td class="c12" colspan="1" rowspan="1">
            <p class="c10"><span class="c5">Serial Number</span></p>
        </td>
    </tr>
    @foreach($orderDetails as $item)
    <tr class="c8">
        <td class="c23" colspan="1" rowspan="1">
            <p class="c1"><span class="c5">{{$item->product->product_name}}</span></p>
        </td>
        <td class="c4" colspan="1" rowspan="1">
            <p class="c1"><span class="c5">{{$item->product->detail}}</span></p>
        </td>
        <td class="c21" colspan="1" rowspan="1">
            <p class="c1"><span class="c5">{{$item->quantity}}</span></p>
        </td>
        <td class="c18" colspan="1" rowspan="1">
            <p class="c1"><span class="c5">{{$item->product->product_code}}</span></p>
        </td>
    </tr>
    @endforeach
    <tr class="c8">
        <td class="c23" colspan="1" rowspan="1">
            <p class="c1"><span class="c5"></span></p>
        </td>
        <td class="c4" colspan="1" rowspan="1">
            <p class="c1"><span class="c5"></span></p>
        </td>
        <td class="c21" colspan="1" rowspan="1">
            <p class="c1"><span class="c5"></span></p>
        </td>
        <td class="c18" colspan="1" rowspan="1">
            <p class="c1"><span class="c5"></span></p>
        </td>
    </tr>
</table>
<p class="c0"><span class="c5"></span></p>
<p class="c0">
    <span class="c5"><br /></span>
</p>
<a id="t.8126ef5af3c7405f3d3731b7f65c09c170a91b88"></a><a id="t.4"></a>
<table class="c17">
    <tr class="c8">
        <td class="c15" colspan="1" rowspan="1">
            <p class="c10"><span class="c5">Prepared By</span></p>
            <p class="c1"><span class="c5"></span></p>
            <p class="c1"><span class="c5"></span></p>
            <p class="c1"><span class="c5"></span></p>
            <hr />
            <p class="c1"><span class="c5"></span></p>
            <p class="c10"><span class="c5">Date</span></p>
        </td>
        <td class="c15" colspan="1" rowspan="1">
            <p class="c10"><span class="c5">Approved By</span></p>
            <p class="c1"><span class="c5"></span></p>
            <p class="c1"><span class="c5"></span></p>
            <p class="c1"><span class="c5"></span></p>
            <hr />
            <p class="c1"><span class="c5"></span></p>
            <p class="c10"><span class="c5">Date</span></p>
        </td>
        <td class="c15" colspan="1" rowspan="1">
            <p class="c10"><span class="c5">Approved By</span></p>
            <p class="c1"><span class="c5"></span></p>
            <p class="c1"><span class="c5"></span></p>
            <p class="c1"><span class="c5"></span></p>
            <hr />
            <p class="c1"><span class="c5"></span></p>
            <p class="c10"><span class="c5">Date</span></p>
        </td>
        <td class="c15" colspan="1" rowspan="1">
            <p class="c10"><span class="c5">Approved By</span></p>
            <p class="c1"><span class="c5"></span></p>
            <p class="c1"><span class="c5"></span></p>
            <p class="c1"><span class="c5"></span></p>
            <hr />
            <p class="c1"><span class="c5"></span></p>
            <p class="c10"><span class="c5">Date</span></p>
        </td>
        <td class="c20" colspan="1" rowspan="1">
            <p class="c10"><span class="c5">Description Invoice: {{$order->invoice_description}}</span></p>
        </td>
    </tr>
</table>
<p class="c0"><span class="c5"></span></p>


<div class="invoice-btn-section clearfix d-print-none">
    <a href="javascript:window.print()" class="btn btn-lg btn-print">
        <i class="fa fa-print"></i> Print Invoice
    </a>
    <a id="invoice_download_btn" class="btn btn-lg btn-download">
        <i class="fa fa-download"></i> Download Invoice
    </a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>


</body>


</html>
