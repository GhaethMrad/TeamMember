<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {
        $users = User::all();
        return response()->json([
            'status' => (count($users) > 0) 
            ? 'OK' 
            : 'Not Found' , 
            'users' => $users
        ], count($users) > 0 ? 200 : 404);
    }
    public function show($id) {
        $user = User::find($id);
        return response()->json([
            'status' => $user ? 'OK' : 'Not Found', 
            'user' => $user
        ], $user ? 200 : 404);
    }
}
