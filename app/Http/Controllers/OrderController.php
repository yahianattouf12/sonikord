<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($user_id)
    {
        //
    }


    /**
     **you should to send the list of products id with request..
     * 
     * Store a newly created resource in storage.
     */
    public function store(Request $req, $user_id)
    {
        //
        $products = $req->products;
        $user = User::findOrFail($user_id);
        
        $user->orders()->create([
            'products' => json_encode($products),
        ]);
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
}
