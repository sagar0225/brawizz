<?php 


namespace App\Services;
use Exception;
use App\Models\Student;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Input\Input;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
	
	
	class StudentService

{
	public $student;

	public function __construct()
	{
		$this-> student = new Student();
		
	}
    public function saveStudent($input)
	{
		try {
				$studentObj = new Student();
				$studentObj->name = $input['name'];
                $studentObj->email =  $input['email'];
                $studentObj->mobile =  $input['mobile'];
				$response = $studentObj->save();
                //dd($response);
	if ($response) {
				return [
					'status' => true,
					'message' => 'students added successfully',
					'data' => $response,
				];
			} else {
				return [
					'status' => false,
					'message' => 'Unable to added student record',
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



public function exportStudentsToCSV()
    {
        $students = Student::all();

        $csvHeader = ['id', 'name', 'email'];
        $csvData = [$csvHeader];

        foreach ($students as $student) {
            $csvData[] = [
                $student->id,
                $student->name,
                $student->email,
              
            ];
        }

        $csvContent = implode(PHP_EOL, array_map(function ($row) {
            return implode(',', $row);
        }, $csvData));

        $filePath = 'exports/students.csv';

        Storage::put($filePath, $csvContent);

        return $filePath;
    }




}

?>