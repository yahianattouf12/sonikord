<?php

namespace App\Http\Controllers;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Telegram\Bot\Laravel\Facades\Telegram;

class AuthController extends Controller
{
    // register, login and logout ...

    public function register(Request $req)
    {
        //validation
        //————————————————————————————————————————————————————————————————————
        $valid = Validator::make($req->all(), [
            'first_name' => 'required|string|min:2|max:50',
            'last_name' => 'required|string|min:2|max:50',
            'phone' => 
            [
                'required',
                'regex:/^(?:\+9639\d{8}|09\d{8})$/',
                function (string $attribute, mixed $value, Closure $fail) {
                    if(strpos($value, '+963') === 0) $value = '0' . substr($value, 4);
                    if(User::where('phone', $value)->first() !== null) 
                        return $fail("The {$attribute} has already been taken.");
                },
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
        $phone = $req->phone;
        if(strpos($phone, '+963') === 0) $phone = '0' . substr($req->phone, 4);
        if($valid->fails()) return response()->json(['errors' => $valid->errors()], 400);
        
        //return redirect()->away('https://t.me/sonikord_bot');
        //return redirect()->away('https://google.com');
        //header('Location: https://t.me/sonikord_bot');
        //url('https://t.me/sonikord_bot');
        
        $telegram_user_id = Telegram::getLastResponse();
        dd($telegram_user_id);

        //create new user
        //————————————————————————————————————————————————————————————————————
        $user = User::create([
            'first_name' => $req->first_name,
            'last_name' => $req->last_name,
            'phone' => $phone,
            'email' => $req->email,
            'password' => Hash::make($req->password),
            'address' => $req->address,
            'role' => $req->role,
        ]);
        $token = $user->createToken('authToken')->plainTextToken;

        

        //response
        return response()->json(['message' => 'user registered successfully',
                                 'user' => $user,
                                 'token' => $token], 201);
    }

    public function login(Request $req)
    {
        //validation
        //————————————————————————————————————————————————————————————————————
        $valid = Validator::make($req->all(),[
            'phone' => [
                'required',
                'regex:/^(?:\+9639\d{8}|09\d{8})$/',
                function (string $attribute, mixed $value, Closure $fail) {
                    if(strpos($value, '+963') === 0) $value = '0' . substr($value, 4);
                    if(User::where('phone', $value)->first() !== null) 
                        return $fail("The {$attribute} has already been taken.");
                },
            ],
            'password' => 'required|string|min:8|max:60',
        ]);
        if($valid->fails()) return response()->json(['errors' => $valid->errors()]);
        $phone = $req->phone;
        $password = $req->password;
        if(strpos($phone, '+963') === 0) $phone = '0' . substr($req->phone, 4);
        if(!Auth::attempt(array('phone' => $phone, 'password' => $password))) 
            return response()->json(['message' => 'invalid phone number or password'], 401);

        //create token
        //————————————————————————————————————————————————————————————————————    
        $user = User::where('phone', $phone)->firstOrFail();
        $token = $user->createToken('authToken')->plainTextToken;

        //response
        return response()->json(['message' => 'login successfully', 
                                 'user' => $user, 
                                 'token' => $token], 201);
    }

    public function logout(Request $req)
    {
        //delete token
        $req->user()->currentAccessToken()->delete();
        //response
        return response()->json(['message' => 'logout successfully']);
    }
}
