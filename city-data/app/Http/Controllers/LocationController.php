<?php

namespace App\Http\Controllers;
use Exception;
use Illuminate\Http\Request;
use App\Services\LocationService;
use App\Models\City;
use App\Models\State;
use App\Models\Country;
use Illuminate\Support\Facades\Validator;
class LocationController extends Controller
{
    public $locationservice;
    public function __construct()
    {
        $this->locationservice = new LocationService();
    }
    public function edit($id)
    {
        $input = $this->locationservice->CountryRecord($id); //data show by id
       // dd( $Emp);
        if ( $input) {
            return response()->json([
                'status' => true,
                'message' => 'Find record',
                'response' =>$input,
            ],200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Record not found',
                'response' =>$input,
            ],404);
        }
    }
    public function stateMasterList(Request $request) {

        try{

            $validateUser = Validator::make(
                $request->all(),[
                    'country_id' => 'required',
                ]
            );
           // dd( $validateUser);

            if ($validateUser->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 422);
            }

            $input = $request->all();           

            $stateMasterList = $this->locationservice->stateMasterList($input);
           
            return response()->json([
                'status' => true,
                'message' => 'state Master List',
                'data'=> $stateMasterList
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' =>   __('messages.ERROR')
            ], 500);
        }
        
        
    }
    public function cityMasterList(Request $request) {

        try{

            $validateUser = Validator::make(
                $request->all(),[
                    'fk_state_id' => 'required',
                ]
            );
        // dd( $validateUser);

            if ($validateUser->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 422);
            }

            $input = $request->all();           
          //dd($input);
            $cityMasterList = $this->locationservice->cityMasterList($input);
           //dd($input);
            return response()->json([
                'status' => true,
                'message' => 'City Master List',
                'input'=>$input,
                'data'=> $cityMasterList
               
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' =>   __('messages.ERROR')
            ], 500);
        }
        
        
    }
}
