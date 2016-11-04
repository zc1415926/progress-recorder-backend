<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Students;
use App\GradeClass;

class StudentsController extends Controller
{
    public function __construct()
    {
       //$this->middleware('jwt.auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Students::all();
    }
    
    private function getClassCode($grade, $class)
    {
        $classCode = GradeClass::select('classCode')->where('gradeNum', $grade)
                                ->where('classNum', $class)->get();
                                
        return $classCode[0]['classCode'];
    }
    
    public function getStudentByGradeClass($grade, $class)
    {
        $student = Students::where('classCode', StudentsController::getClassCode($grade, $class))->get();
            
        return $student;
    }

    public function create(Request $request)
    {
        $student = Students::create([
            'student_number'        => $request['data']['student_number'],
            'student_name'          => $request['data']['student_name'],
            //'student_password'      => $request['data']['student_password'],
            'student_entry_year'    => $request['data']['student_entry_year'],
            'student_grade'         => $request['data']['student_grade'],
            'student_class'         => $request['data']['student_class'],
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
                           ->update(['student_name' => $request['data']['student_name'],
                                     'student_entry_year' => $request['data']['student_entry_year'],
                                     'student_grade' => $request['data']['student_grade'],
                                     'student_class' => $request['data']['student_class']]);
        
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
