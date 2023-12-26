<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Services\StudentService;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TableDataExport;
use Maatwebsite\Excel\Concerns\FromCollection;


class StudentController extends Controller
{
    public $studentService;

	public function __construct()
	{
		$this-> studentService = new StudentService();
		
	}
    public function store(Request $request)
    {
        try {
            $validateUser = Student::make(
                $request->all(),
                [
                    'name'=> 'required',
                    'email'=>'requird',
                    'mobile'=>'requird',
                    
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
            $studentService = Student::where('email', $input['email'])->first();
           //dd( $workrService);
            if ($studentService) {
                return response()->json([
                    'status' => false,
                    'message' => 'Email  is already exists',
                ], 400);
            }
                //dd($input);
                $result = $this->studentService->saveStudent($input);
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
   
//    public function exportExcel()
//     {
//         $filename = 'students.xlsx';
//         return $this->studentService->exportToExcel($filename);
//     }
    // public function exportStudents()
    // {
    //     $students = $this->studentService->getAllStudents();

    //     return Excel::download('students_data', function($excel) use ($students) {
    //         $excel->sheet('Sheet 1', function($sheet) use ($students) {
    //             $sheet->fromArray($students);
    //         });
    //     })->export('xlsx');
    // }
    
   
    // public function exportStudents()
    // {
    //      $result =$this->studentService->exportToExcel();
    //      dd($result);
    //      return $result;
    // }


    // public function exportCsv()
    // {
    //     $filename = 'students.csv';
    //     $data = $this->studentService->getAllStudents(); // Modify this method based on your needs

    //     $headers = array(
    //         "Content-type" => "text/csv",
    //         "Content-Disposition" => "attachment; filename=$filename",
    //         "Pragma" => "no-cache",
    //         "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
    //         "Expires" => "0"
    //     );

    //     $handle = fopen('php://output', 'w');
    //     fputcsv($handle, array('id', 'name', 'email')); // Add more fields as needed

    //     foreach ($data as $student) {
    //         fputcsv($handle, array($student->id, $student->name, $student->email)); // Adjust fields accordingly
    //     }

    //     fclose($handle);

    //     return response()->stream(
    //         function () use ($handle) {
    //             fclose($handle);
    //         },
    //         200,
    //         $headers
    //     );
    // }



    public function exportStudents()
    {
        $filePath = $this->studentService->exportStudentsToCSV();

        return response()->download(storage_path("app/{$filePath}"))
            ->deleteFileAfterSend(true);
    }


}
