<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ClassEntry;

class ClassEntryController extends Controller
{
    public function index()
    {
        return ClassEntry::all();
    }
    
    public function create(Request $request)
    {
        
    }
    
    public function update(Request $request)
    {
        
    }
    
    public function destory($classCode)
    {
        
    }
}
