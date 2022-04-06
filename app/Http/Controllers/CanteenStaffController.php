<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\canteenStaff;
class CanteenStaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $csActive = canteenStaff::where('status','active')->orWhere('status','Newly Opened')->get();
        $csActiveCount = canteenStaff::where('status','active')->count();
        $csInactive = canteenStaff::where('status','inactive')->get();
        $cs=array(
            'csActive'=>$csActive,
            'csInactive'=>$csInactive,
            'csActiveCount'=>$csActiveCount,
        );
        return $cs;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        canteenStaff::create([
            'firstname'=>$request->firstname,
            'lastname'=>$request->lastname,
            'gender'=>$request->gender,
            'email'=>$request->email,
            'password'=>$request->password,
            'status'=>'Newly Opened',
        ]);

        return response()->json([
            '201',
            'message'=>'Canteen Staff Created Sucessfully'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $cs = find($id);

        return response()->json([
            'status'=>'200',
            'cs'=>$cs
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $cs = canteenStaff::find($id);
        
        return response()->json([
            'status'=>'200',
            'cs'=>$cs
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        canteenStaff::find($id)->update([
            'firstname'=>$request->firstname,
            'lastname'=>$request->lastname,
            'gender'=>$request->gender,
            'status'=>$request->status,
        ]);

        return response()->json([
            '200',
            'message'=>'Canteen Staff Updated Sucessfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        canteenStaff::destroy($id);

        return response()->json([
            'status'=>'200',
            'message'=>'Deletion Successfully'
        ]);
    }
}
