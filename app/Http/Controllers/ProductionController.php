<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ItemProduct;
use App\Models\Product;
use App\Models\Production;
use App\Models\Unit;
use Illuminate\Http\Request;

class ProductionController extends Controller
{
    public function index()
    {
        $row = (int) request('row', 10);

        if ($row < 1 || $row > 100) {
            abort(400, 'The per-page parameter must be an integer between 1 and 100.');
        }

        $productions = Production::with(['unit', 'itemProducts.product','product.supplier'])
            ->filter(request(['search']))
            ->sortable()
            ->paginate($row)
            ->appends(request()->query());
//        dd($productions);

        return view('productions.index', [
            'productions' => $productions,
        ]);
    }

    public function create()
    {
        return view('productions.create', [
            'categories' => Category::all(),
            'units' => Unit::all(),
            'products' => Product::all(),
            'productionId' => Production::latest('id')->pluck('id')->first() + 1,
        ]);
    }

    public function store(Request $request)
    {
        // Validate production details
        $request->validate([
            'name_production' => 'required|string|max:255',
            'unit_id_production' => 'required|integer',
            'date_start_production' => 'required|date',
            'date_end_production' => 'required|date',
            'detail_production' => 'required|string',
            // Other production details to validate
        ]);


        // Store production
        $production = Production::create([
            'name' => $request->input('name_production'),
            'unit_id' => $request->input('unit_id_production'),
            'start_date' => $request->input('date_start_production'),
            'end_date' => $request->input('date_end_production'),
            'detail' => $request->input('detail_production'),
            'stock_production' => $request->input('stock_production'),
            // Other production details to store
        ]);

        // Find the product by name and increase its stock
        $productName = $request->input('name_production');
        $quantityToAdd = $request->input('stock_production'); // You can adjust this value based on your business logic

        $product = Product::where('id', $productName)->first();
        if ($product) {
            $product->stock += $quantityToAdd;
            $product->save();
        }


        // Get item product data from the request
        $productIds = $request->input('product_id');
        $itemCodes = $request->input('item_code');
        $unitIds = $request->input('unit_id');
        $quantities = $request->input('quantity');
        $details = $request->input('detail');

        // Loop through the arrays to process each item product
        for ($i = 0; $i < count($productIds); $i++) {
            $productId = $productIds[$i];
            $itemCode = $itemCodes[$i];
            $quantity = $quantities[$i] * $quantityToAdd;
            $unitId = $unitIds[$i];
            $detail = $details[$i];

            // Create a new item product associated with the production
            ItemProduct::create([
                'production_id' => $production->id,
                'product_id' => $productId,
                'item_code' => $itemCode,
                'unit_id' => $unitId,
                'quantity' => $quantity,
                'detail' => $detail,
                // Other item product details to store
            ]);


            // Subtract the quantity from the product's stock
            Product::where('id', $productId)->decrement('stock', $quantity);
        }

        // Redirect or provide a response indicating success
        return redirect()->route('productions.index')->with('success', 'Production and item products have been stored successfully.');
    }

    public function edit(Production $production)
    {
        return view('productions.edit', [
            'production' => $production,
            'categories' => Category::all(),
            'units' => Unit::all(),
            'products' => Product::all(),
            'itemProducts' => ItemProduct::where('production_id', '=', $production->id)->get(),
        ]);
    }

    public function update(Production $production, Request $request)
    {
        // Validate production details
        $request->validate([
            'name_production' => 'required|string|max:255',
            'unit_id_production' => 'required|integer',
            'date_start_production' => 'required|date',
            'date_end_production' => 'required|date',
            'detail_production' => 'required|string',
            // Other production details to validate
        ]);

        // Update production attributes
        $production->name = $request->input('name_production');
        $production->unit_id = $request->input('unit_id_production');
        $production->start_date = $request->input('date_start_production');
        $production->end_date = $request->input('date_end_production');
        $production->detail = $request->input('detail_production');
        // Update other production details

        $production->save(); // Save the updated production

        // Find the product by name and increase its stock
        $productName = $request->input('name_production');
        $quantityToAdd = $request->input('stock_production'); // You can adjust this value based on your business logic

        $product = Product::where('id', $productName)->first();
        if ($product) {
            $product->stock += $quantityToAdd;
            $product->save();
        }


        // Get item product data from the request
        $productIds = $request->input('product_id');
        $itemCodes = $request->input('item_code');
        $unitIds = $request->input('unit_id');
        $quantities = $request->input('quantity');
        $details = $request->input('detail');

        // Loop through the arrays to process each item product
        for ($i = 0; $i < count($productIds); $i++) {
            $productId = $productIds[$i];
            $itemCode = $itemCodes[$i];
            $quantity = $quantities[$i] * $quantityToAdd;
            $unitId = $unitIds[$i];
            $detail = $details[$i];

            // Create a new item product associated with the production
            ItemProduct::create([
                'production_id' => $production->id,
                'product_id' => $productId,
                'item_code' => $itemCode,
                'unit_id' => $unitId,
                'quantity' => $quantity,
                'detail' => $detail,
                // Other item product details to store
            ]);


            // Subtract the quantity from the product's stock
            Product::where('id', $productId)->decrement('stock', $quantity);
        }

        // Redirect or provide a response indicating success
        return redirect()->route('productions.index')->with('success', 'Production and item products have been stored successfully.');
    }

}
