<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use JWTAuth;
use Tymon\JWTAuthExceptions\JWTException;
use App\User;
use App\Students;
use Illuminate\Support\Facades\Log;
use Hash;

class AuthenticateController extends Controller
{

    public function __construct()
    {
       // $this->middleware('jwt.auth', ['except' => ['authenticate']]);
    }
    
    public function index()
    {
        // Retrieve all the users in the database and return them
        $users = User::all();
        return $users;
    }
    
    public function users()
    {
        $users = User::all();
        return $users;
    }
  
    public function authenticate(Request $request)
    {
        $credentials = $request->only('username', 'password');

        try {
            // verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        // if no errors are encountered we can return a JWT
        return response()->json(compact('token'));
    }
    
    //student auth by student_number and student_number
    public function student(Request $request)
    {
        $credentials = $request->only('username', 'password');
       
        if($credentials['username'] == $credentials['password']){
            
            $student = Students::where('student_number', $credentials['username'])->get();
            
            if($student){
                $token = Hash::make($credentials['username']);
            }else{
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        }else{
            return response()->json(['error' => 'invalid_credentials'], 401);
        }
            
        $student = ['token' => $token];
        
        return response()->json(compact('student'));
    }
    
    public function getUserFromToken(Request $request)
    {
        $token = $request->only('token')['token'];

        try {

            if (! $user = JWTAuth::parseToken()->authenticate($token)) {
                return response()->json(['user_not_found'], 404);
            }

        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
    
            return response()->json(['token_expired'], $e->getStatusCode());
    
        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
    
            return response()->json(['token_invalid'], $e->getStatusCode());
    
        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
    
            return response()->json(['token_absent'], $e->getStatusCode());
    
        }
    
        // the token is valid and we have found the user via the sub claim
        return response()->json(compact('user'));
    }
}