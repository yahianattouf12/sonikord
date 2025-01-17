<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     * just send the token ...
     */
    public function index(Request $req)
    {
        $user = $req->user();
        $arr = array();
        foreach($user->orders as $o)
        {
            array_push($arr, array('order_id' => $o->id, 
                                          'total_price' => $o->total_price,
                                          'status' => $o->status,
                                          'payment_method' => $o->payment_method
            ));
        }
        return $arr;
    }


    /**
     **you should to send the list of products id with request..
     * 
     * request 
     * {
     *      token
     *      products: [ {id, quantity} ]
     *      payment_method
     * }
     * Store a newly created resource in storage.
     */
    public function store(Request $req)
    {
        $valid = Validator::make($req->all(), [
            'products' => 'required|array|min:1',
            'payment_method' => Rule::in(['cash', 'credit card']),
        ]);
        if($valid->fails()) return response()->json(['errors' => $valid->errors()]);

        $products = $req->products;
        $user = $req->user();

        foreach($products as $p)
        {
            $valid = Validator::make($p, [
                'quantity' => 'required|integer|min:1',
                'id' => 'required|exists:products,id',
            ]);
            if($valid->fails()) return response()->json(['errors' => $valid->errors()]);
        }
        
        $total = 0;
        foreach($products as $p) 
        {
            $total += Product::where('id', '=', $p['id'])->first()->price * $p['quantity'];
        }
        $order = new Order();
        $order->user_id = $user->id;
        $order->total_price = $total;
        $order->status = 'pending';
        $order->payment_method = $req->payment_method; // cash ?? credit card ??
        $order->save();
        
        foreach($products as $p)
        {
            $order->products()->attach(
                $p['id'], [
                'quantity' => $p['quantity'],
                'price' => Product::where('id', '=', $p['id'])->first()->price * $p['quantity'],
            ]);
        }
        
        return response()->json(['message' => 'order created successfully', 'order' => $order], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $req, string $id)
    {
        $user = $req->user();
        $order = $user->orders->where('id', '=', $id)->first();
        $res = array('order_id' => $order['id'], 
                     'total_price' => $order->total_price,
                     'status' => $order->status,
                     'payment_method' =>  $order->payment_method
        );
        return $res;
    }

    /**
     * Update the specified resource in storage.
     * 
     * token
     * products : [{product_id, quantity}]
     * payment_method
     */
    public function update(Request $req, string $id)
    {
        $valid = Validator::make($req->all(), [
            'products' => 'required|array|min:1',
            'payment_method' => Rule::in(['cash', 'credit card']),
        ]);
        if($valid->fails()) return response()->json(['errors' => $valid->errors()]);
        
        $user = $req->user();
        $order = $user->orders->where('id', '=', $id)->first();
        $products = $req->products;
        
        if(!isset($order)) return response()->json(['message' => 'this order is not found']);

        foreach($products as $p)
        {
            $valid = Validator::make($p, [
                'id' => 'required|exists:products,id',
                'quantity' => 'required|integer|min:1',
            ]);
            if($valid->fails()) return response()->json(['errors' => $valid->errors()]);
        }

        $total = 0;
        foreach($products as $p) 
        {
            $total += Product::where('id', '=', $p['id'])->first()->price * $p['quantity'];
        }
        $order->update([
            'total_price' => $total,
            'payment_method' => $req->payment_method
        ]);

        foreach($products as $p)
        {
            $order->products()->updateExistingPivot(
                $p['id'], [
                'quantity' => $p['quantity'],
                'price' => Product::where('id', '=', $p['id'])->first()->price * $p['quantity'],
            ]);
        }

        return response()->json(['message' => 'order updated successfully', 
                                 'order' => $order], 200);
    }

    /**
     * Remove the specified resource from storage.
     * token, order_id
     */
    public function destroy(Request $req, string $id)
    {
        $order = $req->user()->orders->where('id', '=', $id)->first();
        if(!isset($order)) return response()->json(['message' => 'this order is not found']);
        Order::destroy($id);
        return response()->json(['message' => 'order deleted successfully'], 204);
    }

    // authentication
    public function pay(Request $req, string $id)
    {
        $order = $req->user()->orders->where('id', '=', $id)->first();
        if(!isset($order)) return response()->json(['message' => 'this order is not found']);

        $products=$order->products()->get()->map(function($product) {
            return [
                'id'             => $product->id,
                'quantity'       => $product->quantity,
                'name'           => $product->name,
                'order_quantity' => $product->pivot->quantity
            ];
        });

        foreach($products as $product)
        {
            if($product['order_quantity'] > $product['quantity'])
               return response()->json(['message' => "there is not enough quantity of {$product['name']}"], 400); ;
        }

        foreach($products as $product)
        {
            Product::where('id', $product['id'])->decrement('quantity',$product['order_quantity']);
        }
        $order->status = 'paid';
        $order->save();
        return response()->json(['message' => 'payment successful'], 201);
        
    }
}
