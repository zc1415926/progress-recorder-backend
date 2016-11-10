<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\GradeClass;

class GradeClassController extends Controller
{
    public function __construct()
    {
       $this->middleware('jwt.auth');
    }
    
    public function index()
    {
        return GradeClass::all();
    }
    
    public function create(Request $request)
    {
        $entryYear = $request['data']['entryYear'];
        $gradeNum = $request['data']['gradeNum'];
        $classNum = $request['data']['classNum'];
        
        if($request['data']['classNum']<10)
        {
            $tempClassNum='0' . $request['data']['classNum'];
            $classCode = (string)($request['data']['entryYear'] . $tempClassNum);
        }
        else
        {
            //$tempClassNum=$request['data']['classNum'];
            $classCode = (string)($request['data']['entryYear'] . $request['data']['classNum']);
        }
       //检查主键是否重复
        $gradeClass = GradeClass::create([
            'classCode' => $classCode,
            'entryYear' => $entryYear,
            'gradeNum'  => $gradeNum,
            'classNum'  => $classNum,
        ]);
            
        
        if($gradeClass)
        {
            return response()->json(['status' => 'success', 'data' => $gradeClass]);
        }
        else
        {
            return response()->json(['status' => 'failure', 'data' => $gradeClass]);
        }
    }
    
    public function update(Request $request)
    {
        $classCode = $request['data']['classCode'];
        
        $gradeClass = GradeClass::where('classCode', $classCode)->update([
                                    'entryYear'     => $request['data']['entryYear'],
                                    'gradeNum'      => $request['data']['gradeNum'],
                                    'classNum'      => $request['data']['classNum']]);
                                    
        if($gradeClass)
        {
            return response()->json(['status' => 'success', 'data' => $request['data']]);
        }
        else 
        {
            return response()->json(['status' => 'failure', 'data' => $gradeClass]);
        }
        
    }
    
    public function delete(Request $request)
    {
        $gradeClass = GradeClass::where('classCode', $request['data'])->delete();
        
        if($gradeClass)
        {
            return response()->json(['status' => 'success', 'data' => $request['data']]);
        }
        else 
        {
            return response()->json(['status' => 'failure', 'data' => $gradeClass]);
        }
    }
    
    public function getGrades()
    {
        $tempGrades = GradeClass::select('gradeNum')->distinct()->orderBy('gradeNum', 'asc')->get();
        $grades = [];
        
        foreach ($tempGrades as $grade) 
        {
            array_push($grades, $grade['gradeNum']);
        }
        
        return $grades;
    }
    public static function getClassCode($grade, $class)
    {
        $classCode = GradeClass::select('classCode')->where('gradeNum', $grade)
                                ->where('classNum', $class)->get();
                                
        return $classCode[0]['classCode'];
    }
    
    public function getClassesByGradeNum(Request $request)
    {
        
        
        $tempClasses = GradeClass::select('classNum')->where('gradeNum', $request['data'])
        ->orderBy('classNum', 'asc')->get();
        
        $classes = [];
        foreach($tempClasses as $class)
        {
            array_push($classes, $class['classNum']);
        }
        
        if($classes)
        {
            return response()->json(['status' => 'success', 'data' => $classes]);
        }
        else 
        {
            return response()->json(['status' => 'failure', 'data' => $gradeClass]);
        }
    }
}