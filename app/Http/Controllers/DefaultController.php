<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class DefaultController extends Controller
{
    // Get all products by category
    public function GetProducts(Request $request){
        $category_id = $request->category_id;
        $allProducts = Product::with('supplier')->where('category_id',$category_id)->get();

        $productData = [];

        foreach ($allProducts as $product) {
            $productData[] = [
                'id' => $product->id,
                'product_name' => $product->product_name,
                'supplier_name' => $product->supplier->name,
            ];
        }

        return response()->json($productData);
    }
}
