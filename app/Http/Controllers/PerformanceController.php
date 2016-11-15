<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Performance;

class PerformanceController extends Controller
{
    function index()
    {
        return \App\Performance::all();
    }
    
    public function getRecordsByStudentNumber($studentNumber)
    {
        $records = Performance::where('student_number', $studentNumber)->get();
        
        $response = [
            'msg' => 'Performances retrived',
            'records' => $records
        ];
        
        return response()->json($response, 200);
    }
}
