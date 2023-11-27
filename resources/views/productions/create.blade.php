@extends('dashboard.body.main')

@section('specificpagescripts')
    <script src="{{ asset('assets/js/img-preview.js') }}"></script>
@endsection

@section('content')
    <!-- BEGIN: Header -->
    <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
        <div class="container-xl px-4">
            <div class="page-header-content pt-4">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto mt-4">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i class="fa-solid fa-boxes-stacked"></i></div>
                            Tambah Produk
                        </h1>
                    </div>
                </div>

                <nav class="mt-4 rounded" aria-label="breadcrumb">
                    <ol class="breadcrumb px-3 py-2 rounded mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('productions.index') }}">Produks</a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </nav>
            </div>
        </div>
    </header>
    <!-- END: Header -->

    <!-- BEGIN: Main Page Content -->
    <div class="container-xl px-2 mt-n10 productTableBody">
        <form action="{{ route('productions.store') }}" method="POST" id="productionForm" enctype="multipart/form-data">
            @csrf
            <div class="row">

                <div class="col-xl-12">
                    <!-- BEGIN: Produk Details -->
                    <div class="card mb-4">
                        <div class="card-header">
                            Produk Details
                        </div>
                        <div class="card-body">
                            <!-- Form Group (product name) -->
                            <div class="col-md-6 mb-3">
                                <label class="small mb-1" for="name_production">Nama Produk<span
                                        class="text-danger">*</span></label>
                                <select class="form-select form-control-solid" id="name_production" name="name_production">
                                    @if ($products->isNotEmpty())
                                        @foreach ($products as $product)
                                            <option value="">Pilih Produk</option>
                                            <option value="{{ $product->id }}">{{ $product->product_name }}</option>
                                        @endforeach
                                    @else
                                        <option value="" disabled>Tidak Ditemukan Nama</option>
                                    @endif
                                </select>
                            </div>

                            <!-- Form Row -->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (type of product unit) -->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="unit_id_production">Unit Item<span
                                            class="text-danger">*</span></label>
                                    <select class="form-select form-control-solid" id="unit_id_production" name="unit_id_production">
                                        @if ($units->isNotEmpty())
                                            @foreach ($units as $unit)
                                                <option value="">Pilih Unit</option>
                                                <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                            @endforeach
                                        @else
                                            <option value="" disabled>Tidak Ditemukan Unit</option>
                                        @endif
                                    </select>
                                </div>

                                <!-- Form Group (date_start) -->
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="small mb-1" for="date_start_production">Date Start </label>
                                        <input
                                            class="form-control form-control-solid @error('date_start_production') is-invalid @enderror"
                                            id="date_start_production" name="date_start_production" type="date"
                                            placeholder=""
                                            value="{{ old('date_start_production') }}" autocomplete="off"/>
                                        @error('date_start')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <!-- Form Group (date_end) -->
                                    <div class="mb-3">
                                        <label class="small mb-1" for="date_end_production">Date End </label>
                                        <input
                                            class="form-control form-control-solid @error('date_end_production') is-invalid @enderror"
                                            id="date_end_production" name="date_end_production" type="date"
                                            placeholder=""
                                            value="{{ old('date_end_production') }}" autocomplete="off"/>
                                        @error('date_end_production')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>


                                <div class="row gx-3 mb-3">
                                <!-- Form Group (detail) -->
                                <div class="col-md-6 my-2">
                                    <label class="small mb-1" for="detail_production">Keterangan <span
                                            class="text-danger">*</span></label>
                                    <input type="text"
                                           class="form-control form-control-solid @error('detail_production') is-invalid @enderror"
                                           id="detail_production" name="detail_production">
                                    @error('detail_production')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <!-- Form Group (stock production) -->
                                <div class="col-md-6 my-2">
                                    <label class="small mb-1" for="stock_production">Jumlah Produksi <span
                                            class="text-danger">*</span></label>
                                    <input type="text"
                                           class="form-control form-control-solid @error('stock_production') is-invalid @enderror"
                                           id="stock_production" name="stock_production">
                                    @error('stock_production')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                </div>
                            </div>

                            {{-- modal --}}
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                    data-bs-target="#addItemProductModal">
                                Tambah Produk Item
                            </button>

                            <hr class="my-5">
                            <h3>Daftar Produk</h3>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Product ID</th>
                                    <th>Product Code</th>
                                    <th>Item Unit ID</th>
                                    <th>Quantity</th>
                                    <th>Product Detail</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody id="productTableBody">
                                <!-- Rows will be dynamically added here -->
                                <input type="text" hidden name="production_id" id="production_id"
                                       value="{{ $productionId }}">
                                </tbody>
                            </table>

                            <!-- Submit button -->
                            <button class="btn btn-primary" type="submit">Simpan</button>
                            <a class="btn btn-danger" href="{{ route('productions.index') }}">Cancel</a>
                        </div>
                    </div>
                    <!-- END: Produk Details -->

                </div>
            </div>

        </form>


        <div class="modal fade" id="addItemProductModal" tabindex="-1"
             aria-labelledby="addItemProductModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addItemProductModalLabel">Add Item Product</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Form fields for itemProduct -->
                        <div class="form-group">
                            <label for="product_id">Pilih Produk</label>
                            <select class="form-control select2" id="product_id" name="product_id" onchange="updateItemFields()">
                                <option value="" disabled selected>Select a product</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->product_name }}--{{$product->supplier->name}}--Rp.{{$product->buying_price}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="item_code">Item Code</label>
                            <input type="text" class="form-control" id="item_code" name="item_code">
                        </div>
                        <div class="form-group">
                            <label for="quantity">Quantity</label>
                            <input type="number" class="form-control" id="quantity" name="quantity">
                        </div>
                        <div class="form-group">
                            <label for="detail">Keterangan</label>
                            <input type="text" class="form-control" id="detail" name="detail">
                        </div>
                        <div class="form-group">
                            <label for="unit_id">Unit</label>
                            <select class="form-control" id="unit_id" name="unit_id">
                                <option value="" disabled selected>Select a unit</option>
                                @foreach ($units as $unit)
                                    <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary"  onclick="handleFormSubmit()">Tambah
                            Produk
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- END: Main Page Content -->
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


<script>
    function updateItemFields() {
        const selectedProductId = document.getElementById('product_id').value;
        const selectedProduct = @json($products->keyBy('id'));
        const selectedItem = selectedProduct[selectedProductId];

        document.getElementById('item_code').value = selectedItem.product_code;
        document.getElementById('unit_id').value = selectedItem.unit_id;
        document.getElementById('detail').value = selectedItem.detail;
    }

    function handleFormSubmit() {
        const productId = document.getElementById('product_id').value;
        const productCode = document.getElementById('item_code').value;
        const productUnitId = document.getElementById('unit_id').value;
        const quantity = document.getElementById('quantity').value; // Corrected the ID here
        const productDetail = document.getElementById('detail').value;

        // Check if any of the required fields is empty
        if (!productId || !productCode || !productUnitId || !quantity) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Tolong isi produk.',
            });
            return;  // Stop further execution if any field is empty
        }

        // Create a new table row
        const newRow = document.createElement('tr');
        newRow.innerHTML = `<td><input type="text" value="${productId}" name="product_id[]" style="border: none;" readonly></td>
                    <td><input type="text" value="${productCode}" name="item_code[]" style="border: none;" readonly></td>
                    <td><input type="text" value="${productUnitId}" name="unit_id[]" style="border: none;" readonly></td>
                    <td><input type="text" value="${quantity}" name="quantity[]" style="border: none;" readonly></td>
                    <td><input type="text" value="${productDetail}" name="detail[]" style="border: none;" readonly></td>
                    <td><button class="btn btn-danger btn-sm" onclick="deleteRow(this)">Delete</button></td>`;

        // Append the new row to the table body
        const tableBody = document.getElementById('productTableBody');
        tableBody.appendChild(newRow);

        // Clear the form fields for the next product
        document.getElementById('product_id').value = '';
        document.getElementById('item_code').value = '';
        document.getElementById('unit_id').value = '';
        document.getElementById('quantity').value = '';
        document.getElementById('detail').value = '';

        // Close the modal using Bootstrap 5
        const myModal = new bootstrap.Modal(document.getElementById('addItemProductModal'));
        myModal.hide();
    }


    // Function to delete a row
    function deleteRow(button) {
        const row = button.parentElement.parentElement;
        row.remove();
    }

    $(document).ready(function () {
        @if ($products->isNotEmpty())
        var detailName = @json($products->first()->product_name);
        var detailId = @json($products->first()->id);
        $('#name_production').select2({
            placeholder: "Pilih Produk",
            allowClear: true,
            data: [{ id: detailId, text: detailName }]
        });
        @else
        $('#name_production').select2();
        @endif
    });


    $(document).ready(function() {
        // Initialize Select2 for product_id dropdown
        $('#product_id').select2({
            dropdownParent: $('#addItemProductModal')
        });

        // Reinitialize Select2 when the modal is shown
        $('#addItemProductModal').on('shown.bs.modal', function () {
            $('#product_id').select2({
                dropdownParent: $('#addItemProductModal')
            });
        });
    });

    {{--$(document).ready(function () {--}}
    {{--    @if ($units->isNotEmpty())--}}
    {{--    var detailName = @json($units->first()->product_name);--}}
    {{--    var detailId = @json($units->first()->id);--}}
    {{--    $('#unit_id_production').select2({--}}
    {{--        placeholder: "Pilih Unit",--}}
    {{--        allowClear: true,--}}
    {{--        data: [{ id: detailId, text: detailName }]--}}
    {{--    });--}}
    {{--    @else--}}
    {{--    $('#unit_id_production').select2();--}}
    {{--    @endif--}}
    {{--});--}}

    // Sweetalert before refresh
    // window.onbeforeunload = function () {
    //     const unsavedData = document.querySelector('#productTableBody').innerHTML.trim();
    //
    //     if (unsavedData.length > 0) {
    //         return 'Data Yang Anda Masukan Belum Tersimpan. Apakah Anda Yakin Ingin Meninggalkan Halaman Ini?';
    //     }
    // };

//     autofill form production
    $(document).ready(function () {
        var productsData = @json($products);

        // Listen for changes in the "name_production" select field
        $('#name_production').on('change', function () {
            var selectedProductId = $(this).val(); // Get the selected product's ID


            if (selectedProductId !== "") {
                // Retrieve the product details from the productsData object
                var productDetails = productsData[selectedProductId];

                // Populate the "unit_id_production" select field with the unit ID
                $('#unit_id_production').val(productDetails.unit_id);

                // Populate the "detail_production" input field with the product details
                $('#detail_production').val(productDetails.detail);
            } else {
                // If no product is selected, clear the "unit_id_production" and "detail_production" fields
                $('#unit_id_production').val('');
                $('#detail_production').val('');
            }

            console.log('Selected Product ID: ' + selectedProductId);
            console.log('Product Details: ', productDetails);
            console.log('Unit ID: ' + productDetails.unit_id);
            console.log('Detail Production: ' + productDetails.detail);
        });
    });
</script>

{{--                            <!-- Form Row -->--}}
{{--                            <div class="row gx-3 mb-3">--}}
{{--                                <!-- Form Group (type of product item type) -->--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <label class="small mb-1" for="item_types_id">Tipe Item <span class="text-danger">*</span></label>--}}
{{--                                    <select class="form-select form-control-solid" id="item_types_id" name="item_type_id">--}}
{{--                                        @if ($item_types->first()->detailValues->isNotEmpty())--}}
{{--                                            @foreach ($item_types->first()->detailValues as $detail)--}}
{{--                                                <option value="{{ $detail->id }}">{{ $detail->name }}</option>--}}
{{--                                            @endforeach--}}
{{--                                        @else--}}
{{--                                            <option value="" disabled>Tidak Ditemukan Merek</option>--}}
{{--                                        @endif--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                                <!-- Form Group (type of product mades) -->--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <label class="small mb-1" for="mades_id">Made In <span class="text-danger">*</span></label>--}}
{{--                                    <select class="form-select form-control-solid" id="mades_id" name="made_in_id">--}}
{{--                                        @if ($mades->first()->detailValues->isNotEmpty())--}}
{{--                                            @foreach ($mades->first()->detailValues as $detail)--}}
{{--                                                <option value="{{ $detail->id }}">{{ $detail->name }}</option>--}}
{{--                                            @endforeach--}}
{{--                                        @else--}}
{{--                                            <option value="" disabled>Tidak Ditemukan Grade</option>--}}
{{--                                        @endif--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                            </div>--}}


{{--<script type="text/javascript">--}}
{{--  brands  --}}


{{--  grades  --}}
{{--    $(document).ready(function () {--}}
{{--        @if ($grades->first()->detailValues->isNotEmpty())--}}
{{--        var detailName = @json($grades->first()->detailValues->first()->name);--}}
{{--        var detailId = @json($grades->first()->detailValues->first()->id);--}}
{{--        $('#grades_id').select2({--}}
{{--            placeholder: "Pilih Grade Produk",--}}
{{--            allowClear: true,--}}
{{--            data: [{ id: detailId, text: detailName }]--}}
{{--        });--}}
{{--        @else--}}
{{--        $('#grades_id').select2();--}}
{{--        @endif--}}
{{--    });--}}

{{--  groups  --}}
{{--    $(document).ready(function () {--}}
{{--        @if ($groups->first()->detailValues->isNotEmpty())--}}
{{--        var detailName = @json($groups->first()->detailValues->first()->name);--}}
{{--        var detailId = @json($groups->first()->detailValues->first()->id);--}}
{{--        $('#groups_id').select2({--}}
{{--            placeholder: "Pilih Merek Produk",--}}
{{--            allowClear: true,--}}
{{--            data: [{ id: detailId, text: detailName }]--}}
{{--        });--}}
{{--        @else--}}
{{--        $('#groups_id').select2();--}}
{{--        @endif--}}
{{--    });--}}

{{--  types  --}}
{{--    $(document).ready(function () {--}}
{{--        @if ($types->first()->detailValues->isNotEmpty())--}}
{{--        var detailName = @json($types->first()->detailValues->first()->name);--}}
{{--        var detailId = @json($types->first()->detailValues->first()->id);--}}
{{--        $('#types_id').select2({--}}
{{--            placeholder: "Pilih Grade Produk",--}}
{{--            allowClear: true,--}}
{{--            data: [{ id: detailId, text: detailName }]--}}
{{--        });--}}
{{--        @else--}}
{{--        $('#types_id').select2();--}}
{{--        @endif--}}
{{--    });--}}

{{--  item type  --}}
{{--    $(document).ready(function () {--}}
{{--        @if ($item_types->first()->detailValues->isNotEmpty())--}}
{{--        var detailName = @json($item_types->first()->detailValues->first()->name);--}}
{{--        var detailId = @json($item_types->first()->detailValues->first()->id);--}}
{{--        $('#item_types_id').select2({--}}
{{--            placeholder: "Pilih Merek Produk",--}}
{{--            allowClear: true,--}}
{{--            data: [{ id: detailId, text: detailName }]--}}
{{--        });--}}
{{--        @else--}}
{{--        $('#item_types_id').select2();--}}
{{--        @endif--}}
{{--    });--}}

{{--  made in  --}}
{{--    $(document).ready(function () {--}}
{{--        @if ($mades->first()->detailValues->isNotEmpty())--}}
{{--        var detailName = @json($mades->first()->detailValues->first()->name);--}}
{{--        var detailId = @json($mades->first()->detailValues->first()->id);--}}
{{--        $('#mades_id').select2({--}}
{{--            placeholder: "Pilih Grade Produk",--}}
{{--            allowClear: true,--}}
{{--            data: [{ id: detailId, text: detailName }]--}}
{{--        });--}}
{{--        @else--}}
{{--        $('#mades_id').select2();--}}
{{--        @endif--}}
{{--    });--}}
{{--</script>--}}
