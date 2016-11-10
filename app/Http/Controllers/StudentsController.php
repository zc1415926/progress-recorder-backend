<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\GradeClassController;

use App\Students;

class StudentsController extends Controller
{
    public function __construct()
    {
       $this->middleware('jwt.auth');
    }
    
    public function getStudentByGradeClass($grade, $class)
    {
        $classCode = GradeClassController::getClassCode($grade, $class);
        $student = Students::where('classCode', $classCode)->get();

        if($classCode && $student)
        {
            return response()->json(['status' => 'success', 'data' => compact('classCode', 'student')]);
        }
        else 
        {
            return response()->json(['status' => 'failure', 'data' => '']);
        }
    }
    
    public function getStudentByClassCode($classCode)
    {
        $student = Students::where('classCode', $classCode)->get();

        if($classCode && $student)
        {
            return response()->json(['status' => 'success', 'data' => compact('classCode', 'student')]);
        }
        else 
        {
            return response()->json(['status' => 'failure', 'data' => '']);
        }
    }

    public function create(Request $request)
    {
        //如果主键重复的处理
        $student = Students::create([
            'student_number'        => $request['data']['student_number'],
            'student_name'          => $request['data']['student_name'],
            'classCode'         => $request['data']['classCode']
            ]);
            
        if($student)
        {
            return response()->json(['status' => 'success', 'data' => $student]);
        }
        else
        {
            return response()->json(['status' => 'failure', 'data' => $student]);
        }
        
    }

    public function update(Request $request)
    {
        $student = Students::where('student_number', $request['data']['student_number'])
                           ->update(['student_name' => $request['data']['student_name']]);
        
        if($student)
        {
            return response()->json(['status' => 'success', 'data' => $request['data']]);
        }
        else 
        {
            return response()->json(['status' => 'failure', 'data' => $student]);
        }
    }

  
    public function delete(Request $request)
    {
        $student = Students::where('student_number', $request['data'])->delete();
        
        if($student)
        {
            return response()->json(['status' => 'success', 'data' => $request['data']]);
        }
        else 
        {
            return response()->json(['status' => 'failure', 'data' => $student]);
        }
    }
}
