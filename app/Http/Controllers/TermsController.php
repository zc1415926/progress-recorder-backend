<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
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
    
    public function create(Request $request)
    {
        $validator = Validator::make($request['data'], [
            'year' => 'required',
            'season' => 'required',
        ]);

        //validate input data
        if ($validator->passes()) {
            
            $term = Term::create([
                'term_code' => $request['data']['year'] . $request['data']['season'],
                'year'      => $request['data']['year'],
                'season'      => $request['data']['season'],
            ]);
            
            //if term created successfully
            if($term)
            {
                $response = [
                    'message' => 'create term success',
                    'term' => $term
                ];
                
                $statusCode = 200;
            }
            else
            {
                $response = [
                    'message' => 'create term failure'
                ];
                
                $statusCode = 400;
            }
        }
        else
        {
            $response = [
                    'message' => 'create term failure',
                    'errors'  => $validator->errors(),
                    'input'   => $request['data']
                ];
                
            $statusCode = 422;
        }

        return response()->json($response, $statusCode);
    }
}
