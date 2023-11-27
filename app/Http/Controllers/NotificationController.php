<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class NotificationController extends Controller
{
    public function lowProductNotif(Request $request)
    {
        // Fetch products where stock is less than or equal to the min_stock
        $lowStockProducts = Product::whereRaw('stock <= min_stock')->get();

        // Fetch purchases with due dates earlier than the current date and time
        $dueDatePurchase = Purchase::where('purchase_due_date', '!=', null)
            ->where('purchase_due_date', '<', Carbon::now())->get();

        // Combine low stock products and due date purchases into a single array
        $notifications = array_merge($lowStockProducts->toArray(), $dueDatePurchase->toArray());

        return response()->json(['notifications' => $notifications]);
    }
}
