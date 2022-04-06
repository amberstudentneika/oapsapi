<?php

namespace App\Http\Controllers;

use App\Models\student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $studentAll = student::all();
        $studentActive = student::where('status','active')->get();
        $studentNotactive = student::where('status','inactive')->get();
        $studentSuspended = student::where('status','suspended')->get();
        $studentCount = student::all()->count();
        $result = array(
            'studentAll' => $studentAll,
            'studentActive' => $studentActive,
            'studentNotActive' => $studentNotactive,
            'studentSuspended' => $studentSuspended,
            'studentCount' => $studentCount
        );
        return $result;

        // return response()->json([
        //     'status'=>'201',
        //     'students'=>$students
        // ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) 
    {
      
        student::create([
            'identificationNumber'=>$request->input('identificationNumber'),
            'firstname'=>$request->input('firstname'),
            'lastname'=>$request->lastname,
            'gender'=>$request->gender,
            'dob'=>$request->dob,
            'address'=>$request->address,
            'grade'=>$request->grade,
            'class'=>$request->class,
            'birthCertificate'=>$request->birthCertificate,
            'status'=>$request->status
        ]);

        return response()->json([
            'status'=>'201',
            'message'=>'Student Created Succesfully',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\student  $student
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

        $student = find($id);
        
        return response()->json([
            'status'=>'200',
            'student'=>$student
        ]);
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $student = student::find($id);
        
        return response()->json([
            'status'=>'200',
            'student'=>$student
        ]);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        student::find($id)->update([
            'identificationNumber'=>$request->input('identificationNumber'),
            'firstname'=>$request->input('firstname'),
            'lastname'=>$request->lastname,
            'gender'=>$request->gender,
            'dob'=>$request->dob,
            'address'=>$request->address,
            'grade'=>$request->grade,
            'class'=>$request->class,
            'birthCert'=>$request->birthCert,
            'status'=>$request->status
        ]);
        
        return response()->json([
            'status'=>'201',
            'message'=>'Student Updated Succesfully',
        ]);
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        
        student::destroy($id);
        
        return response()->json([
            'status'=>'201',
            'message'=>'Student Deleted Succesfully',
        ]);
    }

}
