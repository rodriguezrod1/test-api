<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Models\Products;


class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Products::all();

        return response()->json(['response' => $products]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        Products::create(['name' => $request->name]);

        return response()->json(['response' => 'Product Created OK']);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = Products::find($id);

        return response()->json(['data' => $product]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreProductRequest $request, $id)
    {
        $product = Products::find($id);
        $product->name = $request->name;
        $product->save();

        return response()->json(['response' => 'Product Edit OK']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Products::find($id);
        $product->delete();

        return response()->json(['response' => 'Product delete OK']);
    }
}
