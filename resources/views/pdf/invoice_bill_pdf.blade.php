<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>PDF</title>


{{--    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">--}}
    <!-- Icons -->
{{--    <script data-search-pseudo-elements="" defer="" src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" crossorigin="anonymous"></script>--}}
    <style>
        body{
            margin-top:20px;
            background:#ffffff;
        }

        /*Invoice*/
        .invoice .top-left {
            font-size:65px;
            color:#3ba0ff;
        }

        .invoice .top-right {
            text-align:right;
            padding-right:20px;
        }

        .invoice .table-row {
            margin-left:-15px;
            margin-right:-15px;
            margin-top:25px;
        }

        .invoice .payment-info {
            font-weight:500;
        }

        .invoice .table-row .table>thead {
            border-top:1px solid #ddd;
        }

        .invoice .table-row .table>thead>tr>th {
            border-bottom:none;
        }

        .invoice .table>tbody>tr>td {
            padding:8px 20px;
        }

        .invoice .invoice-total {
            margin-right:-10px;
            font-size:16px;
        }

        .invoice .last-row {
            border-bottom:1px solid #ddd;
        }

        .invoice-ribbon {
            width:85px;
            height:88px;
            overflow:hidden;
            position:absolute;
            top:-1px;
            right:14px;
        }

        .ribbon-inner {
            text-align:center;
            -webkit-transform:rotate(45deg);
            -moz-transform:rotate(45deg);
            -ms-transform:rotate(45deg);
            -o-transform:rotate(45deg);
            position:relative;
            padding:7px 0;
            left:-5px;
            top:11px;
            width:120px;
            background-color:#66c591;
            font-size:15px;
            color:#fff;
        }

        .ribbon-inner:before,.ribbon-inner:after {
            content:"";
            position:absolute;
        }

        .ribbon-inner:before {
            left:0;
        }

        .ribbon-inner:after {
            right:0;
        }

        @media(max-width:575px) {
            .invoice .top-left,.invoice .top-right,.invoice .payment-details {
                text-align:center;
            }

            .invoice .from,.invoice .to,.invoice .payment-details {
                float:none;
                width:100%;
                text-align:center;
                margin-bottom:25px;
            }

            .invoice p.lead,.invoice .from p.lead,.invoice .to p.lead,.invoice .payment-details p.lead {
                font-size:22px;
            }

            .invoice .btn {
                margin-top:10px;
            }
        }

        @media print {
            .invoice {
                width:900px;
                height:800px;
            }
        }

    /*    table*/

        .table-invoice-product {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .table-invoice-product th,
        .table-invoice-product td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .table-invoice-product th {
            background-color: #f2f2f2;
            text-align: center;
        }

        .table-invoice-product th:nth-child(2) {
            width: 50%;
        }

        .table-invoice-product th:nth-child(3),
        .table-invoice-product th:nth-child(4),
        .table-invoice-product th:nth-child(5),
        .table-invoice-product td:nth-child(3),
        .table-invoice-product td:nth-child(4),
        .table-invoice-product td:nth-child(5) {
            text-align: right;
        }
    </style>
</head>
<body>


<div class="container bootstrap snippets bootdeys">
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default invoice" id="invoice">
                <div class="panel-body">
                    <div class="invoice-ribbon"><div class="ribbon-inner">Terbayar</div></div>
                    <div class="row">

                        <div class="col-sm-6 top-left">
                            <i class="fa fa-rocket"></i>
                        </div>

                        <div class="col-sm-6 top-right">
                            <h3 class="marginright">{{$purchase->purchase_no}}</h3>
                            <span class="marginright">{{$purchase->updated_at->format('l, F j, Y')}}</span>
                        </div>

                    </div>
                    <hr>
                    <table class="table" style="font-size: 14px;">
                        <tr>
                            <td class="col-4 to">
                                <p class="lead marginbottom"  style="font-size: 14px;">Dari : Nama PT</p>
                                <p>Alamat PT</p>
                                <p>Phone: +62</p>
                                <p>Email: mail@com</p>
                            </td>
                            <td class="col-4 from">
                                <p class="lead marginbottom" style="font-size: 14px;" >Untuk : {{$purchase->supplier->name}}, </p>
                                <p>{{$purchase->supplier->address}}</p>
                                <p>{{$purchase->supplier->npwp}}</p>
                                <p>Phone: {{$purchase->supplier->phone}}</p>
                            </td>
                            <td class="col-4 text-right payment-details">
                                <p class="lead marginbottom payment-info" style="font-size: 14px;">Detail Pembelian</p>
                                <p>Date: {{$purchase->purchase_date}}</p>
                                <p>No Faktur Pajak: {{$purchase->no_faktur_pajak}} </p>
                                <p>Total Dibayar: Rp {{ number_format($purchase->total_amount, 0, ',', '.') }}</p>
                                <p>Account Name: {{$purchase->supplier->account_holder}}</p>
                            </td>
                        </tr>
                    </table>


                    <div class="row table-row">
{{--                        table product invoice--}}

                        <table class="table-invoice-product">
                            <thead>
                            <tr>
                                <th class="text-center" style="width:5%">#</th>
                                <th style="width:30%">Item</th>
                                <th class="text-right" style="width:15%">Jumlah</th>
                                <th class="text-right" style="width:15%">Harga Unit</th>
                                <th class="text-right" style="width:15%">Harga Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($purchaseDetails as $key => $item)
                                <tr>
                                    <td class="text-center">{{$key+1}}</td>
                                    <td>{{$item->product->product_name}}</td>
                                    <td class="text-right">{{$item->quantity}}</td>
                                    <td class="text-right">{{$item->unitcost}}</td>
                                    <td class="text-right">{{$item->total}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="row">
                        <div class="col-xs-6 margintop">
{{--                            <p class="lead marginbottom">TERIMA KASIH!</p>--}}

{{--                            <button class="btn btn-success" id="invoice-print" onclick="window.location='{{ route('purchases.invoiceBillPdf', $purchase->id) }}'">--}}
{{--                                <i class="fa fa-print"></i> Print Invoice--}}
{{--                            </button>--}}

                            {{--                            <button class="btn btn-danger"><i class="fa fa-envelope-o"></i> Mail Invoice</button>--}}
                        </div>
                        <div class="col-xs-6 text-right pull-right invoice-total mt-5 ">
                            <p>Subtotal : Rp {{ number_format($purchase->total_amount, 0, ',', '.') }}</p>
                            {{--                            <p>Discount (10%) : $101 </p>--}}
                            {{--                            <p>VAT (8%) : $73 </p>--}}
                            <p>Total : Rp {{ number_format($purchase->total_amount, 0, ',', '.') }} </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>


