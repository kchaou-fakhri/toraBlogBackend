<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    
    public function getById($id){
        return User::where('id', $id)
        ->get();
    }

    
    public function getAll(){
        return User::get();
    }
}
