<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class FormController extends Controller
{
    public function returnFormData(Request $request)
    {
        return $request->all();
    }
}
