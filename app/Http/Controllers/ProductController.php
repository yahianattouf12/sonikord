<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return response(["products"=>$products],200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req)
    {
        // shop , name , price , quantity , description , image 
        $valid = Validator::make($req->all(), [
            'shop_id' => 'required|string|numeric',
            'name' => 'required|string|min:2|max:50',
            'price' => 'required|string|numeric',
            ''

            //Rule::unique('users', 'email')->ignore($user->id),
            //todo make validation on the photo
        ]);
        if($valid->fails()) return response()->json(['errors' => $valid->errors()]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product=Product::findOrFail($id);
        return response()->json($product,200);
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
        $product=Product::findOrFail($id);
        $product->delete();
        return response()->json(["message" =>"Deleted successfully"],204);
    }

    public function searchInsideShop(Request $request,$shop_id)
    {
        $prodcuts=Product::where('shop_id',$shop_id)->SearchByName($request->name)->get();
        return response()->json(['products'=>$prodcuts],200);
    }

    public function search(Request $request)
    {
        $products=Product::SearchByName($request->name)->get()->map(function($product)
        {
            return
            [
                "id"=>$product->id,
                "shop_id"=>$product->shop_id,
                "name"=>$product->name,
                "price"=>$product->price,
                "description"=>$product->description,
                "image"=>$product->image,
                "shop_image"=>$product->shop->image,
                "shop_name"=>$product->shop->name
            ] ;
        });

        return response()->json(['products'=>$products],200);
    }

}
