<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\LoginController as AuthLoginController;
use App\Models\User;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{

    public static function CheckAuth(){
        return Response( Auth::user());
    }


    public function login(Request $request){
        
        
       
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

       if(Auth::attempt($request->only('email', 'password'))){
           $user = Auth::user();
           response()->json($user,200);
           return json_encode([
            'csrfToken' => csrf_token(),
        ]);
           return  LoginController::CheckAuth();
        }
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorect.']
        ]);
    }

   
    
    public function logout()
    {
        Auth::logout();
    }
}
