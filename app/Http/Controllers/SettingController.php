<?php

namespace App\Http\Controllers;

use Setting;
use App\Http\Requests\SettingRequest;

class SettingController extends Controller
{
    public function all()
    {
        return response()->json([
            'name' => Setting::get('name')
        ]);
    }

    public function update(SettingRequest $request)
    {
        Setting::set('name', request('name'));

        return response()->json([
            'success' => true,
            'settings' => [
                'name' => Setting::get('name')
            ]
        ]);
    }
}
