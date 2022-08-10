<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth:api', ['except' => ['login', 'register']]);
    // }

    // protected function guard () {
    //     return Auth:: guard();
    // }

    public function register(Request $request) {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            // return response()->json($validator->errors()->toJson(), 400);
            return response()->json([
                'validation_errors'=>$validator->messages(),
            ]);
        }else{
            $user = User::create([ 
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            $token= $user->createToken($user-> email.'_Token')->plainTextToken;

            return response()->json([
                'status' => 200,
                'username' => $user->name,
                'token' => $token,
                'message' => 'User successfully registered',
        //     '
            ]);
        }

       

        // return response()->json([
        //     'message' => 'User successfully registered',
        //     'state' => true
        // ], 201);
    }//end register()



    public function login(Request $request) {
       
       
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            // return response()->json($validator->errors(), 400);
            return response()->json([
                'validation_errors'=>$validator->messages(),
            ]);
        }
        else{
            $user = User::where('email', $request->email)->first();
 
            if (! $user || ! Hash::check($request->password, $user->password)) {
                return response()->json([
                    'status' => 401,
                    'message' => 'Invalide Credentials',
            //     '
                ]);
            }else{
                $token= $user->createToken($user-> email.'_Token')->plainTextToken;
                return response()->json([
                    'status' => 200,
                    'username' => $user->name,
                    'token' => $token,
                    'message' => 'Logged in successfully',
            //     '
                ]);
            }
        
            
        }
        // $token_validity = 24 * 60;
        // $this->guard()->factory()->setTTL($token_validity);

        // if (!$token = $this->guard()->attempt($validator->validated())) {
        //     return response()->json(['error' => 'Unauthorized'], 401);
        // }

    //    return $this->responseWithToken($token);
        
    }//end login()



    public function logout() {

        auth()->user()->token()->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Logged out successfully',
    
        ]);
    

        // $this->guard()->logout();
        // return response()->json(['message' => 'User successfully signed out']);

    }//end logout()

    public function profil() {

        // return response()->json($this->guard()->user());

    }//end profil()

    // public function refresh() {
    //     return $this->responseWithToken($this->guard()->refresh());
    // }//end refresh()

    // protected function responseWithToken($token){
    //     return response()->json([
    //         'access_token' => $token,
    //         'token_type' => 'bearer',
    //         'token_validity' => $this->guard()->factory()->getTTL() * 60,
    //         'user' => auth()->user()
    //     ]);
    // }

    
}
