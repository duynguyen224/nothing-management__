<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth.role:admin', ['only' => ['blockUser']]);
    }
    public function blockUser(Request $request)
    {
        if($request->user()->tokenCan('admin')){
            return 'This is an admin route.';
        }
        return 'You do not have permission to access this resource';
    }
    public function profile()
    {
        return 'This route is for all users.';
    }
}
