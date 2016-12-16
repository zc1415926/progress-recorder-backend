<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use App\Term;
use App\Config;

class TermController extends Controller
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
                
                $statusCode = 201;
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
                ];
                
            $statusCode = 422;
        }

        return response()->json($response, $statusCode);
    }
    
    public function delete(Request $request)
    {
        $validator = Validator::make($request['data'], [
            'term_code' => 'required',
        ]);

        //validate input data
        if ($validator->passes()) {
            
            $term = Term::where('term_code', $request['data']['term_code'])->delete();
   
            if($term)
            {
                $response = [
                    'message' => 'term deletion successful',
                ];
                
                $statusCode = 204;
            }
            else
            {
                $response = [
                    'message' => 'term deletion failed'
                ];
                
                $statusCode = 400;
            }
        }
        else
        {
            $response = [
                    'message' => 'data validation failed',
                    'errors'  => $validator->errors(),
                    'input'   => $request['data']
                ];
                
            $statusCode = 422;
        }

        return response()->json($response, $statusCode);
    }
    
    public function setCurrent(Request $request)
    {
        
        $validator = Validator::make($request['data'], [
            'term_code' => 'required',
            'year' => 'required',
            'season' => 'required',
        ]);

        //validate input data
        if ($validator->passes()) {
            
            $currentTerm = Config::where('key', 'current_term')
                                 ->update(['value' => $request['data']['term_code']]);
            
            if($currentTerm)
            {
                $response = [
                    'message' => 'currentTerm update successful',
                    'currentTerm' => $currentTerm
                ];
                
                $statusCode = 201;
            }
            else
            {
                $response = [
                    'message' => 'currentTerm update failed'
                ];
                
                $statusCode = 400;
            }
        }
        else
        {
            $response = [
                    'message' => 'currentTerm validation failed',
                    'errors'  => $validator->errors(),
                    'input'   => $request['data']
                ];
                
            $statusCode = 422;
        }

        return response()->json($response, $statusCode);
    }
}