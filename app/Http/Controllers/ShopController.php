<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
            $valid=Validator::make($request->all(),
            [
                'name'=>'required|string|min:2|max:50',
                'city'=>'required|string|min:2|max:50',
                'address'=>'required|string|min:2|max:50',
                'category'=>'string|min:2|max:50',
                'phone' => [
                    'regex:/^(?:\+9639\d{8}|09\d{8})$/',
                ]
                ,
                'image' =>'required|string|min:2|max:50'
                ]);
    
                if($valid->fails()) return response()->json(['errors' => $valid->errors()]);
    
                $phone = $request->phone;
                if(strpos($phone, '+963') === 0) $phone = '0' . substr($request->phone, 4);
    
                $shop=Shop::create(
                    [
                        'name'=>$request->name,
                        'city'=>$request->city,
                        'address'=>$request->address,
                        'category'=>$request->category,
                        'phone'=>$phone,
                        'image'=>$request->image
                    ]
                    );
    
    
                return response()->json(['shop' => $shop], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       $shop=Shop::findOrFail($id);

       return response()->json(['shop' => $shop],200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $valid=Validator::make($request->all(),
        [
            'name'=>'required|string|min:2|max:50',
            'city'=>'required|string|min:2|max:50',
            'address'=>'required|string|min:2|max:50',
            'category'=>'required|string|min:2|max:50',
            'phone' => [
                'required',
                'regex:/^(?:\+9639\d{8}|09\d{8})$/',
            ]
            ,
            'image' =>'required|string|min:2|max:50'
            ]);

            if($valid->fails()) return response()->json(['errors' => $valid->errors()]);

            $phone = $request->phone;
            if(strpos($phone, '+963') === 0) $phone = '0' . substr($request->phone, 4);

            $shop=Shop::findOrfail($id);
            $shop->update(
                [
                    'name'=>$request->name,
                    'city'=>$request->city,
                    'address'=>$request->address,
                    'category'=>$request->category,
                    'phone'=>$phone,
                    'image'=>$request->image
                ]
                );


            return response()->json(['shop' => $shop], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $shop=Shop::findOrFail($id);
        $shop->delete();
        return response()->json(["message" =>"Deleted successfully"],204);
    }


    public function search(Request $request)
    {
        $shops=Shop::SearchShopByName($request->name)->get();
        return response()->json(['shops'=>$shops], 200);
    }

    public function products($shop_id)
    {
        $shop = Shop::findOrFail($shop_id);
        $products = $shop->products;

        return response()->json(['products'=>$products], 200);
    }

}
