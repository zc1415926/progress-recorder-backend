<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\PerformanceScore;

class PerformanceScoreController extends Controller
{
    function index()
    {
        return \App\PerformanceScore::all();
    }
    
    public function getRecordsByStudentNumber($studentNumber)
    {
        $records = PerformanceScore::where('student_number', $studentNumber)->get();
        
        if($records)
        {
            return response()->json(['status' => 'success', 'data' => $records]);
        }
        else
        {
            return response()->json(['status' => 'failure']);
        }
    }
}
