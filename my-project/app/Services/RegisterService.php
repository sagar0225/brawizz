<?php 

namespace App\Services;
use Exception;
use App\Models\Register;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Input\Input;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;

class RegisterService
{
    public $registeruser;
    public function __construct()
	{
		$this-> registeruser = new Register ();	
	}
    public function storeRegisteruser($input){
        try {
			
            $registeruserObj = new Register();
		    $registeruserObj->name = $input['name'];
            $registeruserObj->email =  $input['email'];
            $registeruserObj->mobile =  $input['mobile'];
            $registeruserObj->password =  $input['password']; 
			$token = $registeruserObj->createToken('api-token')->plainTextToken;
            $response = $registeruserObj->save();
            if ($response) {
				return [
					'status' => true,
					'message' => 'User Register successfully',
					'data' => $response,
				];
		    } else {
				return [
					'status' => false,
					'message' => 'Unable to User Register record',
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
    public function registeruserRecord($id)
    {
    	$record = Register::find($id);
    	return $record;
    }
    public function registerusershow($input)
    {
        $query = Register::select('id','name','email','mobile','password');
    	$response = $query->get();
		return $response;
    }
	public function updateUser($input)
	{
		try {
		
			$empObj = new Register();
			$empObj->exists = true;
			$empObj->id = $input['id'];
			$empObj->name = $input['name'];
			$empObj->email =  $input['email'];
			$empObj->mobile =  $input['mobile']; 
			$empObj->password =  $input['password']; 
				$response = $empObj->save();
	
			if ($response) {
				return [
					'status' => true,
					'message' => 'Register user update successfully',
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
	
	public function loginUser($credentials)
    {
        try {
            if (!Auth::attempt($credentials)) {
                return [
                    'status' => false,
                    'message' => 'Email & Password do not match our records.',
                ];
            }

            $user = Register::where('email', $credentials['email'])->first();

            return [
                'status' => true,
                'message' => 'User Logged In Successfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ];
        } catch (\Throwable $th) {
            return [
                'status' => false,
                'message' => $th->getMessage()
            ];
        }
    }
}

    




































?>