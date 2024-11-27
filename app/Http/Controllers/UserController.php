<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

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
