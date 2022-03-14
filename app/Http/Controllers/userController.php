<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class userController extends Controller
{
    function login(Request $request)
    {

        $user = User::where('email', $request->email)->first();
        // print_r($data);

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response([
                'message' => ['These credentials do not match our records.']
            ], 404);
        }

        $token = $user->createToken('my-app-token')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }
    public function register(Request $request)
    {
        $cheackUser =   User::where('email', $request->email)->first();
        if($cheackUser){
            return 'this is existed already ';
        }
        User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=> Hash::make($request->password)
        ]);
       return 'you signed success';
    }
}
