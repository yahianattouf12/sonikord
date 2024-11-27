<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // register, login and logout ...

    public function register(Request $req)
    {
        //validation
        //———————————————————————————————————————————————
        $valid = Validator::make($req->all(), [
            'first_name' => 'required|string|min:2|max:50',
            'last_name' => 'required|string|min:2|max:50',
            'phone' => 
            [
                'required',
                // 'unique:users', make sure to change +963 to 09 to check if unique or not
                'min:3',
                'max:20',
                'regex:/^(?:\+9639\d{8}|09\d{8})$/',
            ],
            'email' => 'email|string|unique:users,email|min:6|max:50',
            'password' => 'required|confirmed|string|min:8|max:60',
            'address' => 'required',
            'role' => 
            [
                'required',
                Rule::in(['client', 'admin', 'shop']),
            ],
        ]);
        if($valid->fails()) return response()->json(['errors' => $valid->errors()]);
        $phone = $req->phone;
        if(strpos($phone, '+963') === 0) $phone = '0' . substr($req->phone, 4);
        $v = Validator::make(['phone' => $phone], ['phone' => 'unique:users,phone']);
        if($v->fails()) return response()->json(['errors' => $v->errors()]);
        

        //create new user
        //———————————————————————————————————————————————
        $user = User::create([
            'first_name' => $req->first_name,
            'last_name' => $req->last_name,
            'phone' => $req->phone,
            'email' => $req->email,
            'password' => Hash::make($req->password),
            'address' => $req->address,
            'role' => $req->role,
        ]);

        //response
        return response()->json(['message' => 'user registered successfully',
                                'user' => $user], 201);
    }

    public function login(Request $req)
    {
        $valid = Validator::make($req->all(),[
            'phone' => [
                'required',
                'min:3',
                'max:20',
                'regex:/^(?:\+9639\d{8}|09\d{8})$/',
            ],
            'password' => 'required|string|min:8|max:60',
        ]);
        if($valid->fails()) return response()->json(['errors' => $valid->errors()]);
        $phone = $req->phone;
        $password = $req->password;
        if(strpos($phone, '+963') === 0) $phone = '0' . substr($req->phone, 4);
        if(!Auth::attempt(array('phone' => $phone, 'password' => $password))) 
            return response()->json(['message' => 'invalid phone number or password'], 401);

        $user = User::where('phone', $phone)->firstOrFail();
        $token = $user->createToken('authToken')->plainTextToken;

        return response()->json(['message' => 'login successfully', 
                                 'user' => $user, 
                                 'token' => $token], 201);
    }

    public function logout(Request $req)
    {
        $req->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'logout successfully']);
    }

    public function update(Request $req)
    {
        $user=$req->user();

         //validation
        //———————————————————————————————————————————————
        if($user->email==$req->email)
        {
            $valid = Validator::make($req->all(), [
                'first_name' => 'string|min:2|max:50',
                'last_name' => 'string|min:2|max:50',
                'address' => 'string|min:2|max:50'
                //we have to add choice to change photo don't forget that
            ]);
        }
        else
        {
            $valid = Validator::make($req->all(), [
                'first_name' => 'string|min:2|max:50',
                'last_name' => 'string|min:2|max:50',
               'email' => 'email|string|unique:users,email|min:6|max:50',
                'address' => 'string|min:2|max:50'
                //we have to add choice to change photo don't forget that
            ]);
        }


        if($valid->fails()) return response()->json(['errors' => $valid->errors()]);

        $user->update(
            [
                'first_name' => $req->first_name,
                'last_name' => $req->last_name,
                'address'=> $req->address,
                'email' => $req->email,
            ]
            );

        return response()->json($user,200);
    }

}
