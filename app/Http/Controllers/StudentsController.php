<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Students;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Students::all();
    }
    
    public function getStudentByGradeClass($grade, $class)
    {
        $student = Students::where('student_grade', $grade)
            ->where('student_class', $class)->get();
            
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
        return 'update a student';
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
