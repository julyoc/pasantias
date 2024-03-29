<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Validator;
use App\User;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $v = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password'  => 'required|min:3|confirmed',
            'role' => 'required'
        ]);
        if ($v->fails())
        {
            return response()->json([
                'status' => 'error',
                'errors' => $v->errors()
            ], 422);
        }
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role = $request->role;
        $user->save();
        return response()->json(['status' => 'success'], 200);
    }
    
    
    public function updatePassword(Request $request)
    {
        
        $user = User::find(Auth::user()->id);
        $user->password = bcrypt($request->password);
        if($user->save()){
            return response()->json(['status' => 'successs'], 200);
        }
        else{
            return response()->json(['error' => 'login_error'], 401);
        }
        
        
    }

    public function login(Request $request)
    {
        $credentials = $request->only('name', 'password');
        if ($token = $this->guard()->attempt($credentials)) {
            return response()->json(['status' => 'success'], 200)->header('Authorization', $token);
        }
        return response()->json(['error' => 'login_error'], 401);
    }

    public function logout()
    {
        $this->guard()->logout();
        return response()->json([
            'status' => 'success',
            'msg' => 'Logged out Successfully.'
        ], 200);
    }

    public function user(Request $request)
    {
        $user = User::find(Auth::user()->id);
        return response()->json([ 
            'status' => 'success',
            'data' => $user
        ]);
    }

    public function refresh()
    {
        if ($token = $this->guard()->refresh()) {
            return response()
                ->json(['status' => 'successs'], 200)
                ->header('Authorization', $token);
        }
        return response()->json(['error' => 'refresh_token_error'], 401);
    }

    //if a user is loged in it returns the list of all the other users
    public function userList()
    {
        $users = User::orderBy('name', 'asc')->get();  
        return response()->json([
            'status' => 'success',
            'data' => $users
        ]);
    }

    public function adminpassword(Request $request)
    {
        $user = User::where('name',$request->name)->first();
        $user->password = bcrypt($request->password);
        if($user->save()){
            return response()->json(['status' => 'successs'], 200);
        }
        else{
            return response()->json(['error' => 'login_error'], 401);
        } 
    }

    //Laravel function that changes role in database
    public function requestAdmin(Request $request)
    {
        $user =User::where('name',$request->name)->first();
        $user->role = $request->role;
        if($user->save()){
            return response()->json(['status' => 'successs'], 200);
        }
        else{
            return response()->json(['error' => 'login_error'], 401);
        } 
    }
    
    private function guard()
    {
        return Auth::guard();
    }
}
