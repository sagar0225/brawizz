<?php

namespace App\Http\Controllers;
use App\Models\Register;
use App\Services\RegisterService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
class RegisterController extends Controller
{
    
    public $registerService;
    public function __construct()
    {
        $this->registerService = new RegisterService();
    }
    public function store(Request $request)    //Register user 
    {
        try {
            $validateUser = Register::make(
                $request->all(),
                [
                    'name'=> 'required',
                    'email'=>'requird',
                    'mobile' => 'required',
                    'password' => 'required',
                ]
            );
            if (!$validateUser) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }
            $input = $request->all();
            $registerService = Register::where('email', $input['email'])->first();
            if ($registerService) {
                return response()->json([
                    'status' => false,
                    'message' => 'Email  is already exists',
                ], 400);
            }
            $result = $this-> registerService->storeRegisteruser($input);
            if ($result['status']) {
                return response()->json([
                    'status' => true,
                    'message' => $result['message'],
                ], 200);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => $result['message'],
                ], 500);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
    public function edit($id)    //show by id 
    {
        $registeruser = $this->registerService->registeruserRecord($id);
       // dd( $registeruser);
        if ( $registeruser) {
            return response()->json([
                'status' => true,
                'message' => 'Find record',
                'response' =>$registeruser,
            ],200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Record not found',
                'response' =>$registeruser,
            ],404);
        }
    }
    public function registeruserlist(Request $request)     //all data show list
    {
        $input=$request->all();
        
        $registeruser = $this->registerService-> registerusershow($input);
        return response()->json([
            'status' => 'true',
            'message' => 'registeruser List',
            'data'=> $registeruser
        ]);
    }
    public function updateuser(Request $request)
    {
        try {
            $validateUser = Register::make(
                $request->all(),
                [
                    'id' => 'required',
                    'name'=> 'required',
                    'email'=>'requird',
                    'mobile'=> 'required',
                    'password' => 'required',
                ]
                
            );
           // dd($validateUser);
            if (!$validateUser) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            $input = $request->all();
           // dd($input);
          $registeruser= $this->registerService->updateUser($input);
          //dd($registeruser);

            if ($registeruser) {
                //$result = $this->registerService->updateUser($input);
                //dd($result);
                if ($registeruser['status']) {
                    return response()->json([
                        'status' => true,
                        'message' => $registeruser['message'],
                    ], 200);
                } else {
                    return response()->json([
                        'status' => false,
                        'message' => $registeruser['message'],
                    ], 500);
                }

            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'Record not found',
                    'response' => $registeruser,
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
    // public function registeruserlist(Request $request)     //all data show list
    // {
    //     $input=$request->all();
    //     $registeruser = $this->registerService-> registerusershow($input);
    //     return response()->json([
    //         'status' => 'true',
    //         'message' => 'registeruser List',
    //         'data'=> $registeruser
    //     ]);
    // }
    public function loginUser(Request $request)
    {
        try {
            $validateUser = Validator::make($request->all(), 
            [
                'email' => 'required|email',
                'password' => 'required'
            ]);

            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            $result = $this->registerService->loginUser($request->only(['email', 'password']));

            if ($result['status']) {
                return response()->json([
                    'status' => true,
                    'message' => $result['message'],
                    'token'=>$result['token']
                ], 400);
                
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Record does not match with register user',
                ], 400);
            }

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}

