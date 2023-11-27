@extends('dashboard.body.main')

@section('content')
    <!-- BEGIN: Header -->
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-xl px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="feather feather-file">
                                    <path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                    <polyline points="13 2 13 9 20 9"></polyline>
                                </svg>
                            </div>
                            Purchase Details
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- END: Header -->

    <!-- BEGIN: Main Page Content -->
    <div class="container-xl px-4">
        <div class="row">

            <!-- BEGIN: Information Supplier -->
            <div class="col-xl-12">
                <div class="card mb-4">
                    <div class="card-header">
                        Information Supplier
                    </div>
                    <div class="card-body">
                        <!-- Form Row -->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (supplier name) -->
                            <div class="col-md-6">
                                <label class="small mb-1">Name</label>
                                <div class="form-control form-control-solid">{{ $purchase->supplier->name }}</div>
                            </div>
                            <!-- Form Group (supplier email) -->
                            <div class="col-md-6">
                                <label class="small mb-1">Email</label>
                                <div class="form-control form-control-solid">{{ $purchase->supplier->email }}</div>
                            </div>
                        </div>
                        <!-- Form Row -->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (supplier phone number) -->
                            <div class="col-md-6">
                                <label class="small mb-1">Phone</label>
                                <div class="form-control form-control-solid">{{ $purchase->supplier->phone }}</div>
                            </div>
                            <!-- Form Group (order date) -->
                            <div class="col-md-6">
                                <label class="small mb-1">Order Date</label>
                                <div class="form-control form-control-solid">{{ $purchase->purchase_date }}</div>
                            </div>
                        </div>
                        <!-- Form Row -->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (no invoice) -->
                            <div class="col-md-6">
                                <label class="small mb-1">No Purchase</label>
                                <div class="form-control form-control-solid">{{ $purchase->purchase_no }}</div>
                            </div>
                            <!-- Form Group (paid amount) -->
                            <div class="col-md-6">
                                <label class="small mb-1">Total</label>
                                <div class="form-control form-control-solid">{{ $purchase->total_amount }}</div>
                            </div>
                        </div>
                        <!-- Form Row -->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (due amount) -->
                            <div class="col-md-6">
                                <label class="small mb-1">Created By</label>
                                <div class="form-control form-control-solid">{{ $purchase->user_created->name }}</div>
                            </div>
                            <!-- Form Group (paid amount) -->
                            <div class="col-md-6">
                                <label class="small mb-1">Updated By</label>
                                <div
                                    class="form-control form-control-solid">{{ $purchase->user_updated ? $purchase->user_updated->name : '-' }}</div>
                            </div>
                        </div>
                        <!-- Form Group (address) -->
                        <div class="mb-3">
                            <label class="small mb-1">Address</label>
                            <div class="form-control form-control-solid">{{ $purchase->supplier->address }}</div>
                        </div>

                        @if ($purchase->purchase_status == 0)
                            <form action="{{ route('purchases.returnProduct') }}" method="POST">
                                @csrf
                                <input type="hidden" name="purchase_id" value="{{ $purchase->id }}">
                                <!-- Submit button -->
                                <button type="submit" class="btn btn-success"
                                        onclick="return confirm('Are you sure you want to approve this purchase?')">
                                    Menyetujui Barang Datang
                                </button>
                                <a class="btn btn-primary" href="{{ URL::previous() }}">Back</a>
                            </form>
                        @else
                            <a class="btn btn-primary" href="{{ URL::previous() }}">Back</a>

                            <a class="btn btn-danger" href="{{ route('purchases.invoiceBill', $purchase->id) }}">Retur</a>

                        @endif
                        @if($purchase->arrival_date != null)
                            <a class="btn btn-success" href="{{ route('purchases.invoiceBill', $purchase->id) }}">Tagihan</a>
                        @endif
                    </div>
                </div>
            </div>
            <!-- END: Information Supplier -->


            <!-- BEGIN: Table Product -->
            <div class="col-lg-12">
                <div class="table-responsive">
                    <form action="{{ route('purchases.returnProduct') }}" method="POST">
                        @csrf
                        <input type="hidden" name="purchase_id" value="{{ $purchase->id }}">
                        <table class="table table-striped align-middle">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Foto Produk</th>
                                <th scope="col">Nama Produk</th>
                                <th scope="col">Product Code</th>
                                <th scope="col">Sisa Stok Saat Ini</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Total Harga Retur</th>
                                <th scope="col">Jumlah Retur</th>
                                <th scope="col">Alasan</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($purchaseDetails as $item)
                                <tr>
                                    <td scope="row">{{ $loop->iteration }}</td>
                                    <td scope="row">
                                        <div style="max-height: 80px; max-width: 80px;">
                                            <img class="img-fluid"
                                                 src="{{ $item->product->product_image ? asset('storage/products/'.$item->product->product_image) : asset('assets/img/products/default.webp') }}">
                                        </div>
                                    </td>
                                    <td scope="row">{{ $item->product->product_name }}</td>
                                    <td scope="row">{{ $item->product->product_code }}</td>
                                    <td scope="row">
                                        <span class="btn btn-warning">{{ $item->product->stock }}</span>
                                    </td>
                                    <td scope="row">
                                        <span class="btn btn-success">{{ $item->quantity }}</span>
                                    </td>
                                    <td scope="row">{{ $item->unitcost }}</td>
                                    <td scope="row">
                                        <span class="btn btn-primary return-price-total">{{ $item->total }}</span>
                                    </td>
                                    <!-- Additional hidden fields -->
                                    <input type="hidden" name="product_id[{{ $item->product->id }}]" value="{{ $item->product->id }}">
                                    <input type="hidden" name="unit_cost[{{ $item->product->id }}]" value="{{ $item->unitcost }}">
                                        <input type="hidden" name="total_amount[{{ $item->product->id }}]" value="{{ $item->total }}">
                                    <td>
                                        <input type="number" name="return_quantity[{{ $item->product->id }}]" class="form-control form-control-solid" min="0" max="{{ $item->quantity }}" step="1">
                                    </td>
                                    <td>
                                        <textarea name="return_reason[{{ $item->product->id }}]" class="form-control form-control-solid"></textarea>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <button type="submit" class="btn btn-primary">Submit Returns</button>
                    </form>
                </div>
            </div>
            <!-- END: Products List -->

            <!-- JavaScript to calculate return price total dynamically -->
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script>
                $(document).ready(function () {
                    $('input[name^="return_quantity"]').on('input', function () {
                        var productId = $(this).attr('name').match(/\d+/)[0];
                        var unitCost = parseFloat($(`td:eq(6)`, $(this).closest('tr')).text());
                        var returnQuantity = parseInt($(this).val()) || 0;
                        var totalAmount = unitCost * returnQuantity;
                        $(`input[name="total_amount[${productId}]"]`, $(this).closest('tr')).val(totalAmount);
                    });
                });
            </script>


            <!-- END: Table Product -->
        </div>
    </div>
    <!-- END: Main Page Content -->
@endsection
