<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Http\Requests\User\ProfileRequest;

class UserController extends Controller
{
    public function paginate()
    {
        $users = User::orderBy('name', 'ASC')
            ->paginate(request('limit', 20));

        return response()->json($users);
    }

    public function profile(ProfileRequest $request)
    {
        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return response()->json([
            'status' => true,
            'user' => $user
        ]);
    }

    public function view()
    {
        $user = User::whereId(request('id'))
            ->first();

        if (empty($user)) {
            return response()->json(['status' => false], 404);
        }

        return response()->json([
            'status' => true,
            'user' => $user
        ]);
    }
}
