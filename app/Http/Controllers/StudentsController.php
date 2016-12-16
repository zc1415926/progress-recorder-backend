<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\GradeClassController;

use App\Students;
use Illuminate\Support\Facades\DB;

class StudentsController extends Controller
{
    public function __construct()
    {
       $this->middleware('jwt.auth');
    }
    
    public function dashboardStudentsByGradeClass($grade, $class, $termCode)
    {
        $classCode = GradeClassController::getClassCode($grade, $class);

        $dashboard = DB::table('students')
                        ->join('performance', 'students.student_number', '=', 'performance.student_number')
                        ->select('students.student_number', 'students.student_name',
                            DB::raw('SUM(performance.delta_score) as total_score'))
                        ->groupBy('performance.student_number')    
                        ->where('students.classCode', $classCode)
                        ->where('term_code', $termCode)
                        ->get();
                        
        //dump($dashboard);
        if($dashboard)
        {
            $response = [
                'message' => 'dashboard student successful',
                'dashboard' => $dashboard,
                'input' => [$grade, $class, $termCode]
            ];
            
            $statusCode = 200;
        }
        else
        {
            $response = [
                'message' => 'dashboard student failed',
                'input' => [$grade, $class, $termCode]
            ];
            
            $statusCode = 400;
        }
        
        return response()->json($response, $statusCode);
    }
    
    public function getStudentByGradeClass($grade, $class)
    {
        $classCode = GradeClassController::getClassCode($grade, $class);
        $student = Students::where('classCode', $classCode)->get();

        if($student)
        {
            return response()->json(['status' => 'success', 'data' => $student]);
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
        $classCode = GradeClassController::getClassCode(
            $request['data']['gradeNum'], 
            $request['data']['classNum']);
        
        $student = Students::create([
            'student_number'        => $request['data']['student_number'],
            'student_name'          => $request['data']['student_name'],
            'classCode'         => $classCode
            ]);
        
        if($student)
        {
            $response = [
                'message' => 'Student Created',
                'student' => $student
            ];
            
            return response()->json($response, 201);
        }
        else
        {
            $response = [
                'message' => 'Error with student create',
            ];
            
            return response()->json($response, 400);
        }
        
    }

    public function update(Request $request)
    {
        //找不到学号的情况
        $student = Students::where('student_number', $request['data']['student_number'])
                           ->update(['student_name' => $request['data']['student_name']]);
        
        if($student)
        {
            $response = [
                'message' => 'Student updated',
                'student' => $student
            ];
            
            return response()->json($response, 201);
        }
        else
        {
            $response = [
                'message' => 'Error with student update',
            ];
            
            return response()->json($response, 400);
        }
    }

  
    public function delete(Request $request)
    {
        $student = Students::where('student_number', $request['data'])->delete();
        
        if($student)
        {
            $response = [
                'message' => 'Student deleted',
            ];
            
            return response()->json($response, 204);
        }
        else
        {
            $response = [
                'message' => 'Error with student delete',
            ];
            
            return response()->json($response, 400);
        }
    }
}
