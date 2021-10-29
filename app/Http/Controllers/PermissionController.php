<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function changePermission(Request $request){
        $permissions = Permission::find($request->id);
        $permissions->permissions = $request->permissions;
        $permissions->save();

        return true;
    }

    public function getPermission($id){

        return User::where('id', $id)->with(['permission'])->get();
    }
}
