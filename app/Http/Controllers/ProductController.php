<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return response()->json(Product::with('vendor')->latest()->get());
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'currency' => 'required|string',
            'image' => 'nullable|string'
        ]);

        $vendor = $request->user()->vendor;
        if (!$vendor) {
            return response()->json(['message' => 'User is not a vendor'], 403);
        }

        $priceField = 'price_' . strtolower($request->currency);

        $product = Product::create([
            'vendor_id' => $vendor->id,
            'name' => $request->name,
            'description' => $request->description,
            $priceField => $request->price,
            'currency' => $request->currency,
            'image' => $request->image,
        ]);

        return response()->json($product->load('vendor'), 201);
    }
}
