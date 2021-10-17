<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    
    public function getById($id){
        return User::where('id', $id)
        ->get();
    }


    public function getAll(){
        return User::get();
    }

    public function update(Request $request){

        $user = User::find($request->id);
       
        $request->validate([
            'name' => 'required|max:25',
            'email' => 'required',
            'password' => 'required|min:6'
        ]);

      

        
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
        
           return $user->update();
    }

    public function delete($id){
        
        return User::find($id)->delete();
    }
}
