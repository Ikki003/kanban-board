<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function getUsers(Request $request) {
        $users = User::where('name', 'like', "%$request->name%")
            ->where('id', '!=', auth()->user()->id)
            ->get()
            ->toArray();

        return response()->json(['users' => $users]);
    }
}
