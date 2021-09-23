<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\PermissionResource;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use App\Http\Controllers\API\BaseController as BaseController;



class PermissionController extends BaseController
{
    public function __invoke(Request $request)
    {
        $permissions = Permission::all();
       // $permissions = User::whereDoesntHave("admin")->get();
        return $this->sendResponse(PermissionResource::collection($permissions), "succés.");
    }
}
