<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Config;

class ConfigController extends Controller
{
    public static function getConfig($key)
    {
        return Config::where('key', $key)->get();
    }
}
