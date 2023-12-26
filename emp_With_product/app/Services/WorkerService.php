<?php

namespace App\Services;
use Exception;
use App\Models\Task;
use App\Models\Worker;
use App\Http\Controllers\workrController;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Input\Input;

class WorkerService

{
	public $worker;

	public function __construct()
	{
		$this-> worker = new Worker();
		
	}
    public function saveW($input)
	{
		try {
				$workerObj = new Worker();
				$workerObj->name = $input['name'];
                $workerObj->email =  $input['email'];
                $workerObj->mobile =  $input['mobile'];
				$workerObj->task_id = $input['task_id']; 
                $workerObj->password =  $input['password']; 
				$response = $workerObj->save();
                //dd($response);
	if ($response) {
				return [
					'status' => true,
					'message' => 'workers added successfully',
					'data' => $response,
				];
			} else {
				return [
					'status' => false,
					'message' => 'Unable to added worker record',
					'data' => null,
				];
			}
		}catch(Exception $e) {
			return [
				'status' => false,
				'message' => $e->getMessage(),
				'data' => null,
			];
		}
    }
     
    public function workerRecord($id)
    {
    	  $record =Worker::with('task')->find($id);
    	  return $record;
    }

}
?>