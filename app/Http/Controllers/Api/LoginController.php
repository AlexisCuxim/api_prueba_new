<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    public function login(Request $request){
        $this->validateLogin($request);

        if (!Auth::attempt($request->only('email', 'password'))){
            return response()->json([
                'message' => 'No autorizado'
            ]);
        }

        return response()->json([
            'token' => $request->user()->createToken('device_name')->plainTextToken,
            'message' => 'Token creado exitosamente'
        ]);
        
    }

    public function validateLogin($request){
        return $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required'
        ]);
    }
}
