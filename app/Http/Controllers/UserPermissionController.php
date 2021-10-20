<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;

class UserPermissionController extends Controller
{
    public function changePermission(Request $request){
        $permissions = Permission::find($request->id);
        $permissions->permissions = $request->permissions;
        $permissions->save();

        return true;
    }
}
