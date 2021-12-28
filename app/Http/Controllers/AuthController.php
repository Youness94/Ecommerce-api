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
            'name' => 'required|string|between:4,100',
            'email' => 'required|email|max:191|unique:users,email',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()){
            return response()->json([
                'validation_errors'=>$validator->messages(),
            ]);
        }
        else{
            $user = User::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>Hash::make($request->password),
             ]);
              $token = $user->createToken($user->email.'_Token')->plainTextToken;

            return response()->json([
                'satatus'=>200,
                'username'=>$user->name,
                'token'=> $token,
                'message' => 'Registered Successfully',

            ]);
        }
       

        // return response()->json([
        //     'message' => 'User successfully registered',
        //     'user' => $user,
        // ]);


    }//end register()



    public function login(Request $request) {
        $validator = Validator::make($request->all(), [

            'email' => 'required|email',
            'password' => 'required|min:6',

        ]);

        if ($validator->fails())
         {
            response()->json([
                'validation_errors'=>$validator->messages(),
            ]);
         }else{
            $user = User::where('email', $request->email)->first();

            if (! $user || ! Hash::check($request->password, $user->password)) {
                response()->json([
                    'status'=>401,
                    'message'=>'Invalid Credentials',
                ]);
            }else{
                $token = $user->createToken($user->email.'_Token')->plainTextToken;

                return response()->json([
                    'satatus'=>200,
                    'username'=>$user->name,
                    'token'=> $token,
                    'message' => 'Logged In Successfully',
    
                ]);
            }
         }

         $token_validity = 24 * 60;
         $this->guad()->factory()->setTTL($token_validity); 
          
         if (!$token = $this->guad()->attempt($validator->validate())){
             return response()->json(['error'=>'Unauthorized'], 401);
         }
         return $this->responseWithToken($token);
    }//end login()



    public function logout() {

        $this->guard()->logout();

        return response()->json(['message' => 'User successfully signed out']);

    }//end logout()

    public function profil() {

        return response()->json($this->guard()->user());

    }//end profil()

    public function refresh() {
        return $this->responseWithToken($this->guard()->refresh());
    }//end refresh()

    protected function responseWithToken($token){
        return response()->json([
            'token' => $token,
            'token_type' => 'bearer',
            'token_validity' => $this->guard()->factory()->getTTL() * 60,
        ]);
    }

    
}


// public function register (Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'name' => 'required|max:191', 
    //         'email' => 'required|email|max:191|unique:users,email',
    //         'password' => 'required|min:8',
    //     ]);

    //     if ($validator->fails())
    //     {
    //         return response()->json([
    //             'valdation_errors'=>$validator->messages(),
    //         ]);
    //     }
    //     else
    //     {
    //         $user = User::create([
    //             'name'=> $request->name,
    //             'email'=> $request->email,
    //             'password'=>Hash::make($request->password),
    //         ]);

    //          $token = $user->createToken($user->email. '_Token')->plainTextToken; 

    //          return response()->json([
    //             'status' => 200,
    //             'username' => $user->name,
    //             'token' => $token,
    //             'message' => 'Registered Successfully',
    //         ]);
    //     }
    // }