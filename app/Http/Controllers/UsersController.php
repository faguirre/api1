<?php

namespace App\Http\Controllers; 

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    function index(Request $request) 
    {
        if ($request->isJson() == false) {
            return response()->json(['error' => 'Unauthorized'], 401, []);
        }
        $users = User::all();
        return response()->json([$users], 200);
    }

    function createUser(Request $request) 
    {
        if ($request->isJson() == false) {
            return response()->json(['error' => 'Unauthorized'], 401, []);
        }

        $data = $request->json()->all();
        $user = User::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'api_token' => str_random(60)
        ]);

        return response()->json($user, 200);
    }

    function getToken(Request $request)
    {
        if ($request->isJson() == false) {
            return response()->json(['error' => 'Unauthorized'], 401, []);
        }
        
        try {
            //code...
            $data = $request->json()->all();
            $user = User::where('username', $data['username'])->first();
            if ($user && Hash::check($data['password'], $user->password)) {
                return response()->json($user, 200);
            } else {
                return response()->json(['error' => 'no content'], 406);
            }
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'no content'], 406);
        }
        
        
        
        
        
        
        
        
        
        
    }
}