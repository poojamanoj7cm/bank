<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;



class RegisterController extends Controller
{
    public function  viewregister()
    {
     return view('register');
 
    } 
    public function insertregister(Request $request)
    {
     $validatedData=validator($request->all(),[
         'name'=>'required',
         'email'=>'required',
         'password'=>'required',
         
         
 
     ]);
     if($validatedData->fails())
     {
         return response()->json([
             "code"=>401, "message"=>"Validation failed",
              "errors"=>$validatedData->errors(),
 
         ]);
     }
     else{
             $register=new User;
             $register->name=$request->name;
             $register->email=$request->email;
             // $admin->password = Hash::make($request->password); 
             $register->password = Hash::make($request->password);
             $register->save();
             if($register)
             {
                 return redirect()->route('login')->with('success', 'Registration successful. Please log in.');
             }
             else
             {
                 return response()->json(["code"=>401, "message"=>"Insertion failed"]);
             } 
 
         }
    }
}
