<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\PurchaseDetails;
use App\Models\ReturnPurchase;
use App\Models\ReturnPurchaseDetail;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ReturnPurchaseController extends Controller
{
    public function clonePurchaseToReturn(Request $request)
    {
        $purchaseId = $request->input('purchase_id');
        $purchase = Purchase::find($purchaseId);

        $return_no = IdGenerator::generate([
            'table' => 'return_purchases',
            'field' => 'return_no',
            'length' => 10,
            'prefix' => 'RET-'
        ]);

        // Clone data to create a new return record
        $return = new ReturnPurchase;
        $return->supplier_id = $purchase->supplier_id;
        $return->purchase_id = $purchase->id;
        $return->no_faktur_pajak_pembelian = $purchase->no_faktur_pajak_pembelian;
        $return->return_no = $return_no;
        $return->return_date = now();

        // Calculate total amount
        $totalAmount = 0;
        foreach ($request->input('return_quantity') as $productId => $quantity) {
            if ($quantity > 0) {
                $unitCost = $request->input("unit_cost.$productId");
                $totalCost = $unitCost * $quantity;
                $totalAmount += $totalCost;
            }
        }

        // Set the total amount for the return
        $return->total_amount = $totalAmount;
        $return->created_by = auth()->user()->id;
        $return->updated_by = auth()->user()->id;
        $return->save();

        // Validate the form data
        $request->validate([
            'return_quantity' => 'required|array',
            'return_reason' => 'required|array',
            'return_quantity.*' => 'integer|min:0',
            'return_reason.*' => 'string|nullable',
        ]);

        // Retrieve unit_cost and total_cost arrays
        $unitCosts = $request->input('unit_cost');
        $totalCosts = $request->input('total_cost');

        // Process return details
        foreach ($request->input('return_quantity') as $productId => $quantity) {
            if ($quantity > 0) {
                $unitCost = $request->input("unit_cost.$productId");
                // Calculate total cost
                $totalCost = $unitCost * $quantity;

                // Create a new ReturnDetail record
                $returnDetail = new ReturnPurchaseDetail;
                $returnDetail->purchase_id = $purchaseId;
                $returnDetail->product_id = $productId;
                $returnDetail->quantity = $quantity;
                $returnDetail->unitcost = $unitCost;
                $returnDetail->total = $totalCost;
                $returnDetail->return_reason = $request->input("return_reason.$productId");
                $returnDetail->save();

                // Update the corresponding PurchaseDetail record
                $purchaseDetail = PurchaseDetails::where('purchase_id', $purchaseId)
                    ->where('product_id', $productId)
                    ->first();

                if ($purchaseDetail) {
                    // Deduct the returned quantity from the original quantity
                    $purchaseDetail->quantity -= $quantity;

                    // Ensure the quantity doesn't go below 0
                    $purchaseDetail->quantity = max(0, $purchaseDetail->quantity);

                    $purchaseDetail->save();
                }

            }
        }

        return redirect()->route('purchases.allPurchases')->with('success', 'Return has been created!');
    }

}
