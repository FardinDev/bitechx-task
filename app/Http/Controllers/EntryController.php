<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Entry;

class EntryController extends Controller
{
    public function index(){

        $entries = Entry::all();

        return view('entries.home', compact('entries'));
    }
    public function store(Request $request){

        $validatedData = $request->validate([
            'email' => 'required|email|unique:entries|max:255',
            'password' => 'required|min:6',
            'file' => 'required|file',
        ]);


        $fileName = "BitechX-entry-".time().'.'.request()->file->getClientOriginalExtension();
        $request->file->storeAs('public/files', $fileName);

        $data = [];
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);
        $data['file'] = $fileName;

        $entry = Entry::create($data);

        if ($entry) {
           $type = 'success';
           $meassage = 'Entry Added Successfully!';
        }else{
            $type = 'error';
            $meassage = 'Failed! Please Try Again.';
        }

        return redirect()->route('entry.index')->with($type, $meassage);
    }

    public function edit($id){

        $entry = Entry::find($id);

        if ($entry) {

            return view('entries.edit', compact('entry'));

         }else{

             $type = 'error';
             $meassage = 'Entry Not Found!';
             return redirect()->route('entry.index')->with($type, $meassage);
         }

    }

    public function update(Request $request, $id){

        $validatedData = $request->validate([
            'email' => 'sometimes|email|unique:entries,email,'.$id,
            'password' => 'nullable|min:6',
            'file' => 'nullable|file',
        ]);

        

        $model = Entry::find($id);
      
        $password = $request->password ? Hash::make($request->password) : $model->password;
        
        if($request->hasFile('file')){ 

            $fileName = "BitechX-entry-".time().'.'.request()->file->getClientOriginalExtension();
            $request->file->storeAs('public/files', $fileName);

            if(file_exists(storage_path('app/public/files/'.$model->file))){
                unlink(storage_path('app/public/files/'.$model->file));
            }

        }else{
            
            $fileName = $model->file;
        }
        
        $model->fill([
            'email' => $request->email,
            'password' => $password,
            'file' => $fileName
            ]);
        if($model->isDirty()){

            $changedData = $model->getDirty();
            $model->save();

            $type = 'success';
            $meassage = 'Entry Updated Successfully!';
            
         
        }else{
            $type = 'info';
            $meassage = 'No Changes Made!';
        }

        return redirect()->route('entry.index')->with($type, $meassage);
            

    }

    public function delete($id){

        $entry = Entry::find($id);

        if ($entry) {

            if(file_exists(storage_path('app/public/files/'.$entry->file))){
                unlink(storage_path('app/public/files/'.$entry->file));
            }
    
            $delete = Entry::destroy($id);
    
            if ($delete) {
    
                $type = 'success';
                $meassage = 'Entry Deleted Successfully!';
            }else{
                $type = 'error';
                $meassage = 'Delete Failed! Please Try Again.';
            }
           
         }else{

             $type = 'error';
             $meassage = 'Entry Not Found!';
        }
            
        return redirect()->route('entry.index')->with($type, $meassage);
        
    }

}
