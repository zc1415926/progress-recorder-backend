<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Term;

class TermsController extends Controller
{
    public function __construct()
    {
       //$this->middleware('jwt.auth');
    }
    
    public function index()
    {
        $terms = Term::all();
        
        if($terms)
        {
            $response = [
                'message' => 'terms retrieved',
                'terms' => $terms
            ];
            
            return response()->json($response, 200);
        }
        else
        {
            $response = [
                'message' => 'Error with index term',
            ];
            
            return response()->json($response, 400);
        }
    }
    
    public function getCurrentTerm()
    {
        $currentTermCode = ConfigController::getConfig('current_term');
        
        if(count($currentTermCode))
        {
            $currentTerm = Term::where('term_code', $currentTermCode[0]['value'])->get();
        }
        else
        {
            $response = [
                'message' => 'Error with get current term',
            ];
            
            return response()->json($response, 400);
        }
          
        if($currentTerm)
        {
            $response = [
                'message' => 'current term retrieved',
                'currentTerm' => $currentTerm
            ];
            
            return response()->json($response, 200);
        }
        else
        {
            $response = [
                'message' => 'Error with get current term',
            ];
            
            return response()->json($response, 400);
        }
    }
}
