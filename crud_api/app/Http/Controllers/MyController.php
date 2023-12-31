<?php

namespace App\Http\Controllers;

use App\Models\Crudapi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Hash;

class MyController extends Controller
{
    
    public function index()
         {
        $crudapi = Crudapi::all();
        //For Count All data in Crudapis table
        $datacount =Crudapi::count();

        return response()->json(['data' => $crudapi, 'Toalcount' =>$datacount]);
        }

    public function show($id)
        {
          //for all Data Getting by spcefic givn id 
         $crudapi = Crudapi::find($id);
        if (!$crudapi) {
            return response()->json(['error' => 'Task not found'], 404);
         }else{
            return response()->json(['success' => 'Succefully display'],);
         }
        return response()->json($crudapi);
        }
    public function store(Request $request)
       {

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'file' => 'required|mimes:jpeg,png,jpg,pdf|max:2048',
        ]);
        // Handle the file upload
        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('uploads', $fileName, 'public');        
        // Create a new c$crudapi record
        $crudapi = new Crudapi();
        $crudapi->name = $request->input('name');
        $crudapi->email = $request->input('email');
        $crudapi->password =$request->input('password'); // Hash the password
        $crudapi->file = $fileName; // Adjust the column name according to your database schema
         //dd($crudapi);
        // Save the $crudapi record
        $crudapi->save();       
        // Return a response
        return response()->json(['message' => 'Data created successfully']);
        }
    public function updateUser(Request $request)
        {
         // Validate the request data
         $request->validate([
            'id' => 'required',
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'file' => 'max:2048|mimes:jpeg,png,jpg,pdf',
        ]);
        $id = $request->input('id');      
         $crudapi = Crudapi::find($id);
        if (!$crudapi) {
            return response()->json(['message' => 'Data not found'], 404);
        }
        if ($request->hasFile('file')) {
            // Handle the file upload if a new file is provided
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('uploads', $fileName, 'public');
            $crudapi->file= $fileName;
        }else{

            $fileName =$request->input('file_bk');      
        }
            $crudapi->name = $request->input('name', $crudapi->name);
            $crudapi->email = $request->input('email', $crudapi->email);
            $crudapi->file =  $fileName;
            $crudapi->password = $request->input('password');       
            if($crudapi->save()){
                return response()->json(['message' => 'Data updated successfully']);
            }else{
                return response()->json(['message' => 'error..!']);
            }           
        }
    public function destroy($id)
        {
        $crudapi= Crudapi::find($id);
        if (!$crudapi) {
            return response()->json(['error' => 'Id not found'], 404);
        }
         $crudapi->delete();
         return response()->json(['message' => 'Data delete successfully']);
    }
    
}
