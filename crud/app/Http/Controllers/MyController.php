<?php

namespace App\Http\Controllers;
use App\Models\Crud;
use Illuminate\Http\Request;

class MyController extends Controller
{
    public function index()
    {
        return view('crud.index');
    }
    public function create(){
        return view('crud.insert');
    }
    public function store(Request $request){
        $input=$request->all();
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'mobile'=>'required',
            'password'=>'required',
        ]);
         Crud::create($request->all());
           
         return redirect()->route('view')->with('success','User created successfully.');                        
    }
    public function view(Request $request) {
        $Cruds = Crud::all(); // $Cruds is using forecha loop and Crud::all() -> fetiching all data from crud table 

        return view('crud.view', ['Cruds' => $Cruds]);//-> ['Cruds' => $Cruds] for use onle for echa loop define 
    }
    public function edit($id)
  {
    $post = Crud::find($id);
    return view('crud.edit', compact('cruds'));
  }
  
    public function update(Request $request, $id)
    {
      $request->validate([
        'name' => 'required|max:255',
        'email' => 'required',
      ]);
      $post = Crud::find($id);
      $post->update($request->all());
      return redirect()->route('crud.view')
        ->with('success', 'updated successfully.');
    }

}
