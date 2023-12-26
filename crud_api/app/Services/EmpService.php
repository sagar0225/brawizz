<?php


namespace App\Services;
use Exception;
use App\Models\Emp;
use App\Models\Product;
use App\Http\Controllers\EmpController;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Input\Input;
class EmpService

{
	public $emp;

	//public $emailTemplateTitle;
	//public $emailTemplateType;
	
		
	
	public function __construct()
	{
		$this-> emp = new Emp();
		//$this->emailTemplateTitle = new  Emp ();
		//$this->emailTemplateType = new EmailTemplateType();
	}
    public function saveEmp($input)
	{
		try {
				$empObj = new Emp();
				$empObj->name = $input['name'];
				$empObj->product_id = $input['product_id'];
				$empObj->email =  $input['email'];
                $empObj->amount =  $input['amount'];
                $empObj->address =  $input['address']; 
                $empObj->status =  $input['status'];
                $empObj->flag =  $input['flag'];  
                $empObj->password =  $input['password']; 
				$response = $empObj->save();
	if ($response) {
				return [
					'status' => true,
					'message' => 'Employee added successfully',
					'data' => $response,
				];
			} else {
				return [
					'status' => false,
					'message' => 'Unable to added Employee record',
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
 
public function empRecord($id)
{
	$record = Emp::find($id);
	return $record;
}
public function updateEmp($input)
{
	try {
	
		$empObj = new Emp();
		$empObj->exists = true;
		$empObj->id = $input['id'];
		$empObj->name = $input['name'];
		$empObj->product_id = $input['product_id'];
		$empObj->email =  $input['email'];
		$empObj->amount =  $input['amount'];
		$empObj->address =  $input['address']; 
		$empObj->status =  $input['status'];
		$empObj->flag =  $input['flag'];  
		$empObj->password =  $input['password']; 
			$response = $empObj->save();

		if ($response) {
			return [
				'status' => true,
				'message' => 'Email template update successfully',
				'data' => $response,
			];
		} else {
			return [
				'status' => false,
				'message' => 'Unable to update record',
				'data' => null,
			];
		}
	} catch (Exception $e) {
		return [
			'status' => false,
			'message' => $e->getMessage(),
			'data' => null,
		];
	}
}
public function deleteRecord($id){
		try{
			$deleteResponse = Emp::where('id', $id)->delete();
			if($deleteResponse){
				return [
					'status' => true,
					'message' => 'Record deleted successfully',
				];
			}else{
				return [
					'status' => false,
					'message' => 'Something went wrong',
				];
			}
		}
		catch (Exception $e) {
			return [
				'status' => false,
				'message' => $e->getMessage(),
			];
		}
	}
	public function getAllEmpList($input)
    {
        $noOfRecord = (isset($input['per_page_row']) && !empty($input['per_page_row'])) ? $input['per_page_row'] : 0;
		$page = (isset($input['page']) && !empty($input['page'])) ? $input['page'] : 0;

		if (!empty($page)) {
			$offset = $noOfRecord * ($page - 1);
		}

        $query = Emp::select('id','name','product_id','email','status');
        
       
		if ($noOfRecord) {
			$query->limit($noOfRecord)->offset($offset);
		}

		$response = $query->get();
		return $response;
    }

    public function getEmptiltle($input)
	{
		$query = Emp::select('product_id');
       
        $count = $query->count();
        return $count;
		

}
}

?>