<?php

namespace App\Http\Controllers;

use App\SMSGateway\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function all()
    {
        $settings = Setting::all()->map(function($setting){

        });

        return response()->json($settings);
    }

    public function update()
    {
        return response()->json([
            'success' => true,
            'settings' => null
        ]);
    }
}
