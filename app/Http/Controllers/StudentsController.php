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
        if(Students::create([
            'student_number'        => $request['student_number'],
            'student_name'          => $request['student_name'],
            'student_password'      => $request['student_password'],
            'student_entry_year'    => $request['student_entry_year'],
            'student_grade'         => $request['student_grade'],
            'student_class'         => $request['student_class'],
            ]))
        {
            return 'success';
        }
        else
        {
            return 'failure';
        }
        
    }

    public function update(Request $request)
    {
        return 'update a student';
    }

  
    public function destory($id)
    {
        return 'destory a student';
    }
}
