<?php

namespace App\Http\Controllers;

use App\Services\WorkerService;
use Illuminate\Http\Request;
use App\Models\Worker;

class workerController extends Controller
{
   
    public $WorkerService;
    public function __construct()
    {
        $this->WorkerService = new WorkerService();
    }
    public function store(Request $request)
    {
        try {
            $validateUser = Worker::make(
                $request->all(),
                [
                    'name'=> 'required',
                    'email'=>'requird',
                    'mobile'=>'requird',
                    'task_id'=>'required',
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
            $workerService = Worker::where('email', $input['email'])->first();
           //dd( $workrService);
            if ($workerService) {
                return response()->json([
                    'status' => false,
                    'message' => 'Email  is already exists',
                ], 400);
            }
                //dd($input);
                $result = $this->WorkerService->saveW($input);
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
        $workers = $this->WorkerService->workerRecord($id);
       // dd( $Emp);
        if ( $workers) {
            return response()->json([
                'status' => true,
                'message' => 'Find record',
                'response' =>$workers,
            ],200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Record not found',
                'response' =>$workers,
            ],404);
        }
    }
    public function index()
    {
        // Retrieve all workers with their associated tasks
        $workers = Worker::with('task')->get();  
        return [
            'status' => true,
            'message' => 'workers show successfully',
            'data' => $workers,
        ];
        
    }
    
}