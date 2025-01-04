<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shops = Shop::all();
        return response()->json(['shops' => $shops], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function products($shop_id)
    {
        $shop = Shop::findOrFail($shop_id);
        $products = $shop->products;

        return response()->json(['products'=>$products], 200);
    }

    public function search(Request $request)
    {
        $shops=Shop::SearchShopByName($request->name)->get();
        return response()->json(['shops'=>$shops], 200);
    }
}
