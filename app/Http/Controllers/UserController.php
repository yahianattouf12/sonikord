<?php

namespace App\Http\Controllers;

use Closure;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // update user info ...

    public function update(Request $req)
    {
        $user = $req->user();

        //validation
        //———————————————————————————————————————————————
        $valid = Validator::make($req->all(),[
            'first_name' => 'string|min:2|max:50',
            'last_name' => 'string|min:2|max:50',
            'address' => 'string|min:2|max:50',
            'email' => [
                'email|min:6|max:50|string',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
            'phone' => [
                'regex:/^(?:\+9639\d{8}|09\d{8})$/',
                function (string $attribute, mixed $value, Closure $fail) {
                    if(strpos($value, '+963') === 0) $value = '0' . substr($value, 4);
                    if(User::where('phone', $value)->first() !== null) 
                        return $fail("The {$attribute} has already been taken.");
                }
            ],
            //todo make validation on the photo
        ]);
        if($valid->fails()) return response()->json(['errors' => $valid->errors()]);

        //format info
        $fname = $req->first_name;
        $lname = $req->last_name;
        $address = $req->address;
        $email = $req->email;
        $phone = $req->phone;
        if(strpos($phone, '+963') === 0) $phone = '0' . substr($phone, 4);

        //update user info
        $user->update([
            'first_name' => $fname,
            'last_name' => $lname,
            'address'=> $address,
            'email' => $email,
            'phone' => $phone,
        ]);

        //response
        return response()->json(['message' => 'user updated successfully', 
                                 'user' => $user], 200);                         
    }
    //todo optional : make function to reset password ...

    public function orders($user_id)
    {
        $user = User::findOrFail($user_id);
        $orders = $user->orders;
        return response()->json(['orders' => $orders], 200);
    }

    // send product id
    // auth
    public function addToFavorite(Request $req)
    {
        $valid = Validator::make($req->all(), [
            'id' => 'required|exists:products,id',
        ]);
        if($valid->fails()) return response()->json(['errors' => $valid->errors()]);

        $product_id = $req->id;

        $user = $req->user();
        $user->favorite_products()->attach($product_id, []);
        return response()->json(['message' => 'product added successfully'], 200);
    }

    public function favorites(Request $req)
    {
        $user = $req->user();
        $products = $user->favorite_products;
        return response()->json(['favorite products' => $products], 200);
    }

    public function removeFromFavorite(Request $request)
    {
        $product = Product::findOrFail($request->id);
       
       $request->user()->favorite_products()->detach($product);
        return response()->json(['message' => 'product removed successfully'], 200);
    }
}
