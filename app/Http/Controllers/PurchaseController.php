<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\Models\Product;
use App\Models\Category;
use App\Models\Purchase;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Models\PurchaseDetails;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Barryvdh\DomPDF\Facade\Pdf;

class PurchaseController extends Controller
{
    /**
     * Display an all purchases.
     */
    public function allPurchases()
    {
        $row = (int)request('row', 10);

        if ($row < 1 || $row > 100) {
            abort(400, 'The per-page parameter must be an integer between 1 and 100.');
        }

        $purchases = Purchase::with(['supplier'])
            ->sortable()
            ->paginate($row)
            ->appends(request()->query());

        return view('purchases.purchases', [
            'purchases' => $purchases
        ]);
    }

    /**
     * Display an all approved purchases.
     */
    public function approvedPurchases()
    {
        $row = (int)request('row', 10);

        if ($row < 1 || $row > 100) {
            abort(400, 'The per-page parameter must be an integer between 1 and 100.');
        }

        $purchases = Purchase::with(['supplier'])
            ->where('purchase_status', 1) // 1 = approved
            ->sortable()
            ->paginate($row)
            ->appends(request()->query());

        return view('purchases.approved-purchases', [
            'purchases' => $purchases
        ]);
    }

    /**
     * Display a purchase details.
     */
    public function purchaseDetails(string $purchase_id)
    {
        $purchase = Purchase::with(['supplier', 'user_created', 'user_updated'])
            ->where('id', $purchase_id)
            ->first();

        $purchaseDetails = PurchaseDetails::with('product')
            ->where('purchase_id', $purchase_id)
            ->orderBy('id')
            ->get();

        return view('purchases.details-purchase', [
            'purchase' => $purchase,
            'purchaseDetails' => $purchaseDetails,
        ]);
    }

    public function invoiceBill(string $purchase_id)
    {
        $purchase = Purchase::with(['supplier', 'user_created', 'user_updated'])
            ->where('id', $purchase_id)
            ->first();

        $purchaseDetails = PurchaseDetails::with('product')
            ->where('purchase_id', $purchase_id)
            ->orderBy('id')
            ->get();

        return view('pdf.invoice_bill', [
            'purchase' => $purchase,
            'purchaseDetails' => $purchaseDetails,
        ]);
    }

    public function PO(string $purchase_id)
    {
        $purchase = Purchase::with(['supplier', 'user_created', 'user_updated'])
            ->where('id', $purchase_id)
            ->first();

        $purchaseDetails = PurchaseDetails::with('product')
            ->where('purchase_id', $purchase_id)
            ->orderBy('id')
            ->get();

        return view('purchases.POLetter', [
            'purchase' => $purchase,
            'purchaseDetails' => $purchaseDetails,
        ]);
    }

    public function invoiceBillPdf(string $purchase_id)
    {
        $purchase = Purchase::with(['supplier', 'user_created', 'user_updated'])
            ->where('id', $purchase_id)
            ->first();

        $purchaseDetails = PurchaseDetails::with('product')
            ->where('purchase_id', $purchase_id)
            ->orderBy('id')
            ->get();

        $html = view('pdf.invoice_bill_pdf', [
            'purchase' => $purchase,
            'purchaseDetails' => $purchaseDetails,
        ])->render();

        $pdf = PDF::loadHtml($html);

        // Return the PDF as a response
        return $pdf->stream('invoice_bill.pdf');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createPurchase()
    {
        return view('purchases.create-purchase', [
            'categories' => Category::all(),
            'suppliers' => Supplier::all(),
//            'products' => Product::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storePurchase(Request $request)
    {
        $rules = [
            'supplier_id' => 'required|string',
            'purchase_date' => 'required|string',
            'no_faktur_pajak_pembelian' => 'required|string',
            'purchase_due_date' => 'required|string',
            'total_amount' => 'required|numeric',
            'total_amount_paid' => 'required|numeric',
        ];


        // Assuming you have an array of product IDs in $productIds
//        $productIds = $request->product_id; // Replace with the actual variable name
//        $quantities = $request->quantity; // Assuming you have an array of quantities
//        $totals = $request->total; // Assuming you have an array of totals

// Initialize a flag to check if any product is not registered
//        $productNotRegistered = false;

        $purchase_no = IdGenerator::generate([
            'table' => 'purchases',
            'field' => 'purchase_no',
            'length' => 10,
            'prefix' => 'POD-'
        ]);

        $validatedData = $request->validate($rules);


//dd($purchase_no);

        $validatedData['purchase_status'] = 0; // 0 = pending, 1 = approved
        $validatedData['purchase_no'] = $purchase_no;
        $validatedData['created_by'] = auth()->user()->id;
        $validatedData['created_at'] = Carbon::now();

        $purchase_id = Purchase::insertGetId($validatedData);

        // Create Purchase Details
        $pDetails = array();
        $products = count($request->product_id);
        for ($i = 0; $i < $products; $i++) {
            $pDetails['purchase_id'] = $purchase_id;
            $pDetails['product_id'] = $request->product_id[$i];
            $pDetails['quantity'] = $request->quantity[$i];
            $pDetails['unitcost'] = $request->unitcost[$i];
            $pDetails['total'] = $request->total[$i];
            $pDetails['created_at'] = Carbon::now();

            PurchaseDetails::insert($pDetails);
        }

        //        validation supplier and product in products table


// Loop through each product ID
//        foreach ($productIds as $key => $productId) {
//            // Check if the product with the specified ID exists
//            $productCheck = DB::table('products')
//                ->where('id', $productId)
//                ->first();
//
//            if ($productCheck) {
//                // Product with the specified ID exists
//                $productName = $productCheck->product_name;
//
//                // Check if the product already exists for the given supplier
//                $product = DB::table('products')
//                    ->where('supplier_id', $validatedData['supplier_id'])
//                    ->where('product_name', $productName) // Use the retrieved product name
//                    ->first();
//
//                if ($product) {
//                    // Product already exists, update its stock and price
//                    DB::table('products')
//                        ->where('id', $product->id)
//                        ->increment('stock', $quantities[$key]);
//                } else {
//
//                    // Product with the specified ID does not exist
//                    $productNotRegistered = true;
//
//
//                    // Product doesn't exist, create a new one and set its stock and price
////                    $productId = DB::table('products')->insertGetId([
////                        'supplier_id' => $validatedData['supplier_id'],
////                        'product_name' => $productName,
////                        'stock' => $quantities[$key],
////                        'price' => $totals[$key]
//                    // You might want to add other fields as needed
////                    ]);
//                }
//            } else {
//                // Product with the specified ID does not exist
//                // Handle this case as needed
//            }
//        }

//        if ($productNotRegistered) {
//            // Redirect back to the previous page with an alert message
//            return redirect()->back()->with('alert', 'Some products were not registered.');
//        }

        return Redirect::route('purchases.allPurchases')->with('success', 'Purchase has been created!');
    }

    /**
     * Handle update a status purchase
     */
    public function updatePurchase(Request $request)
    {
        $purchase_id = $request->id;

        // after purchase approved, add stock product
        $products = PurchaseDetails::where('purchase_id', $purchase_id)->get();

        foreach ($products as $product) {
            Product::where('id', $product->product_id)
                ->update(['stock' => DB::raw('stock+' . $product->quantity)]);
        }

        Purchase::findOrFail($purchase_id)
            ->update([
                'purchase_status' => 1,
                'arrival_date' => now(),
                'updated_by' => auth()->user()->id,
            ]); // 1 = approved, 0 = pending

        return Redirect::route('purchases.allPurchases')->with('success', 'Purchase has been approved!');
    }
    public function updatePurchasePaid(Request $request)
    {
        $purchase_id = $request->id;

        $purchase = Purchase::findOrFail($purchase_id);
        $inputAmountPaid = $request->input('amount_paid');



        // Increment the total_amount_paid by the input amount
        $newTotalAmountPaid = $purchase->total_amount_paid + $inputAmountPaid;

        $purchase->update([
            'purchase_status' => ($purchase->paid >= $purchase->total_amount) ? 2 : 1,
            'arrival_date' => now(),
            'updated_by' => auth()->user()->id,
            'total_amount_paid' => $newTotalAmountPaid
        ]);

        return Redirect::route('purchases.allPurchases')->with('success', 'Purchase has been approved!');
    }

//    Handle Return Purchase
    public function returnPurchase(string $purchase_id)
    {
        $purchase = Purchase::with(['supplier', 'user_created', 'user_updated'])
            ->where('id', $purchase_id)
            ->first();

        $purchaseDetails = PurchaseDetails::with('product')
            ->where('purchase_id', $purchase_id)
            ->orderBy('id')
            ->get();

        return view('purchases.return-purchase', [
            'purchase' => $purchase,
            'purchaseDetails' => $purchaseDetails,
        ]);
    }

    /**
     * Handle delete a purchase
     */
    public function deletePurchase(string $purchase_id)
    {
        Purchase::where([
            'id' => $purchase_id,
            'purchase_status' => '0'
        ])->delete();

        PurchaseDetails::where('purchase_id', $purchase_id)->delete();

        return Redirect::route('purchases.allPurchases')->with('success', 'Purchase has been deleted!');
    }

    /**
     * Display an all purchases.
     */
    public function dailyPurchaseReport()
    {
        $row = (int)request('row', 10);

        if ($row < 1 || $row > 100) {
            abort(400, 'The per-page parameter must be an integer between 1 and 100.');
        }

        $purchases = Purchase::with(['supplier'])
            ->where('purchase_date', Carbon::now()->format('Y-m-d')) // 1 = approved
            ->sortable()
            ->paginate($row)
            ->appends(request()->query());

        return view('purchases.purchases', [
            'purchases' => $purchases
        ]);
    }
    public function dueDateReport()
    {
        $row = (int)request('row', 10);

        if ($row < 1 || $row > 100) {
            abort(400, 'The per-page parameter must be an integer between 1 and 100.');
        }

        $purchases = Purchase::with(['supplier'])
            ->whereDate('purchase_due_date', '<', Carbon::now()->format('Y-m-d')) // Filter purchases after the due date from now
//            ->where('purchase_status', 1) // Additional condition for approved purchases
            ->sortable()
            ->paginate($row)
            ->appends(request()->query());

        return view('purchases.purchases', [
            'purchases' => $purchases
        ]);
    }

    /**
     * Show the form input date for purchase report.
     */
    public function getPurchaseReport()
    {
        return view('purchases.report-purchase');
    }

    /**
     * Handle request to get purchase report
     */
    public function exportPurchaseReport(Request $request)
    {
        $rules = [
            'start_date' => 'required|string|date_format:Y-m-d',
            'end_date' => 'required|string|date_format:Y-m-d',
        ];

        $validatedData = $request->validate($rules);

        $sDate = $validatedData['start_date'];
        $eDate = $validatedData['end_date'];

        // $purchaseDetails = DB::table('purchases')
        //     ->whereBetween('purchases.purchase_date',[$sDate,$eDate])
        //     ->where('purchases.purchase_status','1')
        //     ->join('purchase_details', 'purchases.id', '=', 'purchase_details.purchase_id')
        //     ->get();

        $purchases = DB::table('purchase_details')
            ->join('products', 'purchase_details.product_id', '=', 'products.id')
            ->join('purchases', 'purchase_details.purchase_id', '=', 'purchases.id')
            ->whereBetween('purchases.purchase_date', [$sDate, $eDate])
            ->where('purchases.purchase_status', '1')
            ->select('purchases.purchase_no', 'purchases.purchase_date', 'purchases.supplier_id', 'products.product_code', 'products.product_name', 'purchase_details.quantity', 'purchase_details.unitcost', 'purchase_details.total')
            ->get();


        $purchase_array [] = array(
            'Date',
            'No Purchase',
            'Supplier',
            'Product Code',
            'Product',
            'Quantity',
            'Unitcost',
            'Total',
        );

        foreach ($purchases as $purchase) {
            $purchase_array[] = array(
                'Date' => $purchase->purchase_date,
                'No Purchase' => $purchase->purchase_no,
                'Supplier' => $purchase->supplier_id,
                'Product Code' => $purchase->product_code,
                'Product' => $purchase->product_name,
                'Quantity' => $purchase->quantity,
                'Unitcost' => $purchase->unitcost,
                'Total' => $purchase->total,
            );
        }

        $this->exportExcel($purchase_array);
    }

    /**
     *This function loads the customer data from the database then converts it
     * into an Array that will be exported to Excel
     */
    public function exportExcel($products)
    {
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '4000M');

        try {
            $spreadSheet = new Spreadsheet();
            $spreadSheet->getActiveSheet()->getDefaultColumnDimension()->setWidth(20);
            $spreadSheet->getActiveSheet()->fromArray($products);
            $Excel_writer = new Xls($spreadSheet);
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="purchase-report.xls"');
            header('Cache-Control: max-age=0');
            ob_end_clean();
            $Excel_writer->save('php://output');
            exit();
        } catch (Exception $e) {
            return;
        }
    }
}
