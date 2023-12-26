<?php 
namespace App\Services;
use Exception;
use App\Models\City;
use App\Models\State;
use App\Models\Country;
use App\Http\Controllers\LocationController;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Input\Input;

class LocationService

{
	public $city;
    public $state;
    //public $country;
	public function __construct()
	{
		$this-> city = new City();
        $this-> state = new State();
        //$this-> country = new Country();
		
	}
       
    public function CountryRecord($id)
    {
    	  $record =Country::with('State')->find($id);   
    	  return $record;
    }
	public function stateMasterList($input)
    {
        //dd($input);
        $response = State::select('id','name','country_id')
        ->where('country_id', $input['country_id'])
        ->orderBy('name', 'ASC')
        ->pluck('name','id');

      
        return $response;
    }
    public function cityMasterList($input)
    {
        //dd($input);
        // $response = City::select('id','city_name','fk_state_id	')
        // ->Where('fk_state_id', $input['fk_state_id'])
        // ->OrderBy('city_name', 'ASC')
        // ->Pluck('city_name','id');


        $response = City::select('id', 'city_name', 'fk_state_id')
    ->Where('fk_state_id',$input['fk_state_id'])
    ->orderBy('city_name', 'ASC')
    ->pluck('city_name', 'id');

      //dd($response);
        return $response;
    }



















}




?>