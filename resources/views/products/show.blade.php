@extends('dashboard.body.main')

@section('content')
<!-- BEGIN: Header -->
<header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
    <div class="container-xl px-4">
        <div class="page-header-content pt-4">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto mt-4">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i class="fa-solid fa-boxes-stacked"></i></div>
                        Details Product
                    </h1>
                </div>
            </div>

            <nav class="mt-4 rounded" aria-label="breadcrumb">
                <ol class="breadcrumb px-3 py-2 rounded mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Products</a></li>
                    <li class="breadcrumb-item active">Details</li>
                </ol>
            </nav>
        </div>
    </div>
</header>
<!-- END: Header -->

<!-- BEGIN: Main Page Content -->
<div class="container-xl px-2 mt-n10">
        <div class="row">
            <div class="col-xl-4">
                <!-- Product image card-->
                <div class="card mb-4 mb-xl-0">
                    <div class="card-header">Product Image</div>
                    <div class="card-body text-center">
                        <!-- Product image -->
                        <img class="img-account-profile mb-2" src="{{ $product->product_image ? asset('storage/products/'.$product->product_image) : asset('assets/img/products/default.webp') }}" />
                    </div>
                </div>
            </div>

            <div class="col-xl-8">
                <!-- BEGIN: Product Code -->
                <div class="card mb-4">
                    <div class="card-header">
                        Product Code
                    </div>
                    <div class="card-body">
                        <!-- Form Row -->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (type of product category) -->
                            <div class="col-md-6">
                                <label class="small mb-1">Product code</label>
                                <div class="form-control form-control-solid">{{ $product->product_code  }}</div>
                            </div>
                            <!-- Form Group (type of product unit) -->
                            <div class="col-md-6 align-middle">
                                <label class="small mb-1">Barcode</label>
                                <div class="mt-1">
                                  {!! $barcode !!}
                                  </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END: Product Code -->

                <!-- BEGIN: Product Information -->
                <div class="card mb-4">
                    <div class="card-header">
                        Product Information
                    </div>
                    <div class="card-body">
                        <!-- Form Group (product name) -->
                        <div class="mb-3">
                            <label class="small mb-1">Product name</label>
                            <div class="form-control form-control-solid">{{ $product->product_name }}</div>
                        </div>
                        <!-- Form Row -->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (type of product category) -->
                            <div class="col-md-6">
                                <label class="small mb-1">Product category</label>
                                <div class="form-control form-control-solid">{{ $product->category->name  }}</div>
                            </div>
                            <!-- Form Group (type of product unit) -->
                            <div class="col-md-6">
                                <label class="small mb-1">Product unit</label>
                                <div class="form-control form-control-solid">{{ $product->unit->name  }}</div>
                            </div>
                        </div>


                        <!-- Form Row -->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (merek) -->
                            <div class="col-md-6">
                                <label class="small mb-1">Merek</label>
                                <div class="form-control form-control-solid">{{ $product->detailMasterValueBrand->name ?? "Tidak Memilih Merek"}}</div>
                            </div>
                            <!-- Form Group (grades) -->
                            <div class="col-md-6">
                                <label class="small mb-1">Grades</label>
                                <div class="form-control form-control-solid">{{ $product->detailMasterValueGrade->name ?? "Tidak Memilih Jenis Barang/Produk"  }}</div>
                            </div>
                        </div>

                        <!-- Form Row -->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (kelompok) -->
                            <div class="col-md-6">
                                <label class="small mb-1">Kelompok</label>
                                <div class="form-control form-control-solid">{{ $product->detailMasterValueGroup->name ?? "Tidak Memilih Grup"}}</div>
                            </div>
                            <!-- Form Group (tipe) -->
                            <div class="col-md-6">
                                <label class="small mb-1">Tipe</label>
                                <div class="form-control form-control-solid">{{ $product->detailMasterValueType->name ?? "Tidak Memilih Jenis Tipe"  }}</div>
                            </div>
                        </div>

                        <!-- Form Row -->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (item tipe) -->
                            <div class="col-md-6">
                                <label class="small mb-1">Tipe Item</label>
                                <div class="form-control form-control-solid">{{ $product->detailMasterValueItemType->name ?? "Tidak Memilih Tipe Item"}}</div>
                            </div>
                            <!-- Form Group (made in) -->
                            <div class="col-md-6">
                                <label class="small mb-1">Asal Pembuatan</label>
                                <div class="form-control form-control-solid">{{ $product->detailMasterValueMadeIn->name ?? "Tidak Memilih Asal Pembuatan"  }}</div>
                            </div>
                        </div>

                        <!-- Form Row -->
{{--                        <div class="row gx-3 mb-3">--}}
{{--                            <!-- Form Group (buying price) -->--}}
{{--                            <div class="col-md-6">--}}
{{--                                <label class="small mb-1">Buying price</label>--}}
{{--                                <div class="form-control form-control-solid">{{ $product->buying_price  }}</div>--}}
{{--                            </div>--}}
{{--                            <!-- Form Group (selling price) -->--}}
{{--                            <div class="col-md-6">--}}
{{--                                <label class="small mb-1">Selling price</label>--}}
{{--                                <div class="form-control form-control-solid">{{ $product->selling_price  }}</div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="row gx-3 mb-3">--}}
{{--                            <!-- Form Group (stock) -->--}}
{{--                            <div class="mb-3 col-md-6">--}}
{{--                                <label class="small mb-1">Stock</label>--}}
{{--                                <div class="form-control form-control-solid">{{ $product->stock  }}</div>--}}
{{--                            </div>--}}

{{--                            <!-- Form Group (minimum stock) -->--}}
{{--                            <div class="mb-3 col-md-6">--}}
{{--                                <label class="small mb-1">Minimal Stock</label>--}}
{{--                                <div class="form-control form-control-solid">{{ $product->min_stock  }}</div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

                        <!-- Submit button -->
                        <a class="btn btn-primary" href="{{ route('products.index') }}">Back</a>
                    </div>
                </div>
                <!-- END: Product Information -->
            </div>
        </div>

    {{--        List Produk With Supplier        --}}
    <div class="col-lg-12 card">
        <div class="card-header">Daftar Produk dan Supplier</div>
        <div class="table-responsive">
            <table class="table table-striped align-middle">
                <thead class="thead-light">
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Image</th>
                    <th scope="col">@sortablelink('product_name', 'Product Name')</th>
                    <th scope="col">@sortablelink('category.name', 'category')</th>
                    <th scope="col">@sortablelink('stock')</th>
                    <th scope="col">@sortablelink('unit.name', 'unit')</th>
                    <th scope="col">@sortablelink('buying_price', 'Price')</th>
                    <th scope="col">@sortablelink('supplier.name', 'Supplier')</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($products as $product)
                    <tr>
                        <th scope="row">{{ (($products->currentPage() * (request('row') ? request('row') : 10)) - (request('row') ? request('row') : 10)) + $loop->iteration  }}</th>
                        <td>
                            <div style="max-height: 80px; max-width: 80px;">
                                <img class="img-fluid"  src="{{ $product->product_image ? asset('storage/products/'.$product->product_image) : asset('assets/img/products/default.webp') }}">
                            </div>
                        </td>
                        <td>{{ $product->product_name }}</td>
                        <td>{{ $product->category->name }}</td>
                        <td>{{ $product->stock }}</td>
                        <td>{{ $product->unit->name }}</td>
                        <td>{{ $product->buying_price }}</td>
                        <td>{{ $product->supplier->name }}</td>
                        <td>
                            <div class="d-flex">
                                <a href="{{ route('products.show', $product->id) }}" class="btn btn-outline-success btn-sm mx-1"><i class="fa-solid fa-eye"></i></a>
                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-outline-primary btn-sm mx-1"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to delete this record?')">
                                        <i class="far fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- END: Main Page Content -->
@endsection
