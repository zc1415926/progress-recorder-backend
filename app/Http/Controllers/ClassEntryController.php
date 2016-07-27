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
    
    public function gradeClasses()
    {
        $gradeClasses = [];
        $classes = [];
        
        $grades = ClassEntry::select('gradeNum')->distinct()->get();
        
        foreach ($grades as $grade)
        {
            //dump($grade["gradeNum"]);
            $gradeClasses[$grade["gradeNum"]] = [];
            $classes = ClassEntry::select('classNum')->distinct()->get();
            
            foreach($classes as $class)
            {
                array_push($gradeClasses[$grade["gradeNum"]], $class["classNum"]);
            }
        }
        
        return $gradeClasses;
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
