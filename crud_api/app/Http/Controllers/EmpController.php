<?php

namespace App\Http\Controllers;

use App\Services\EmpService;
use Illuminate\Http\Request;
use App\Http\Controllers\Validator;
use App\Models\Emp;

class EmpController extends Controller
{
    public $empService;
    // public $emplist;
    public function __construct()
    {
        $this->empService = new EmpService();
        //$this->emplist=new EmpService();
    }
    public function store(Request $request)
    {
        try {
            $validateUser = Emp::make(
                $request->all(),
                [
                    'name'=> 'required',
                    'product_id'=>'required',
                    'email'=>'requird',
                    'amount'=> 'required',
                    'address' => 'required',
                    'status' => 'required',
                    'flag' => 'required',
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
            //dd( $input);
            $empService = Emp::where('email', $input['email'])->first();
            //dd( $empService);
            if ($empService) {
                return response()->json([
                    'status' => false,
                    'message' => 'Email  is already exists',
                ], 400);
            }
            $result = $this-> empService->saveEmp($input);
           // dd($result);
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
    public function edit($id)
    {
        $Emp = $this->empService->empRecord($id);
       // dd( $Emp);
        if ( $Emp) {
            return response()->json([
                'status' => true,
                'message' => 'Find record',
                'response' =>$Emp,
            ],200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Record not found',
                'response' =>$Emp,
            ],404);
        }
    }
    public function update(Request $request)
    {
        try {
            $validateUser = Emp::make(
                $request->all(),
                [
                    'id' => 'required',
                    'name'=> 'required',
                    'product_id'=>'required',
                    'email'=>'requird',
                    'amount'=> 'required',
                    'address' => 'required',
                    'status' => 'required',
                    'flag' => 'required',
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
            //dd($input);
          $emp= $this->empService->empRecord($input['id']);
          //dd($emp);

            if ($emp) {
                $result = $this->empService->updateEmp($input);
                //dd($result);
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

            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'Record not found',
                    'response' => $emp,
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
    public function destroy($id)
    {   
        $checkRecord = $this->empService->empRecord($id);
        if ($checkRecord) {
            $response = $this->empService->deleteRecord($id);
            if($response['status']){
                return response()->json([
                    'status' => true,
                    'message' => $response['message'],
               
                ],200);
            }else{
                return response()->json([
                    'status' => false,
                    'message' => $response['message'],
               
                ],404);
            }
           
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Record not found',
            ],404);
        }  
    }
    public function emplist(Request $request)
    {
        $input=$request->all();
        //dd($input);
        $emplist = $this->empService-> getAllEmpList($input);
        //dd($emplist);
        return response()->json([
            'status' => 'true',
            'message' => 'Emp  List',
            'data'=> $emplist
        ]);
    }
    public function emptitle(Request $request)
    {
        $input=$request->all();
        $emailTemplateTitleList = $this->empService->getEmptiltle($input);
        return response()->json([
            'status' => 'true',
            'message' => 'Emp List',
            'data'=> $emailTemplateTitleList
        ]);
    
}
}
