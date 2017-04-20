<?php

namespace App\Http\Controllers;

use Auth;
use App\Http\Requests\PasswordRequest;

class PasswordController extends Controller
{
    public function update(PasswordRequest $request)
    {
        $user = Auth::user();
        $user->password = bcrypt($request->password);
        $user->save();

        return response()->json(['status' => true]);
    }
}
