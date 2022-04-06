<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\parents;
use App\Models\student;
use App\Models\eVoucher;
use App\Models\relationship;
use App\Models\eVoucherPaymentDetails;
use App\Models\User;


class ParentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $parents =  parents::all();

        return response()->json([
            'status'=>'200',
            'parents'=>$parents
        ]);
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
        parents::create([
            'firstname'=>$request->firstname,
            'lastname'=>$request->lastname,
            'gender'=>$request->gender,
            'identificationCard'=>$request->identificationCard,
            'trn'=>$request->trn,
            'address'=>$request->address,
            'email'=>$request->email,
            'password'=>$request->password,
            // 'birthCertificate'=>$request->birthCertificate,
        ]);

        return response()->json([
            'status'=>'201',
            'message'=>'Parent Added Sucessfully'
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
        $parent = parents::find($id);
        return $parent;
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
        $parent = parents::find($id);
        return $parent;
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
        parents::find($id)->update([
            'firstname'=>$request->firstname,
            'lastname'=>$request->lastname,
            'gender'=>$request->gender,
            'identificationCard'=>$request->identificationCard,
            'trn'=>$request->trn,
            'address'=>$request->address,
            'email'=>$request->email,
            'password'=>$request->password,
            'birthCertificate'=>$request->birthCertificate,
            'approvedBy'=>$request->approvedBy,
        ]);

        return response()->json([
            'status'=>'200',
            'message'=>'Parent Updated Sucessfully'
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
        parents::destroy($id);

        return response()->json([
            'status'=>'200',
            'message'=>'Parent Deleted Successfully'
        ]);
    }

    public function searchChild(Request $request)
    {

           $resultCount= student::where('identificationNumber',$request->childIDN)->count();
           if($resultCount>0){
               $result= student::where('identificationNumber',$request->childIDN)->get();
               return response()->json([
                'status'=>'200',
                'message'=>$result
            ]); 
           }
            return response()->json([
                'status'=>'404',
                'message'=>'Not found'
            ]); 
           
    }

    public function findRelationship($pId,$cId){
        $relationship = relationship::where('parentID',$pId)->where('studentID',$cId)->count();
        return $relationship;
    }

    public function addChild(Request $request)
    {
        relationship::create([
            'studentID'=> $request->childID,
            'parentID'=> $request->parentID,
            'relationID'=> $request->relation,
            'birthCertificate'=> $request->childBirthCert,
        ]);
        return response()->json([
            'status'=>'201',
            'message'=>'Relationship Created Sucessfully'
        ]);
    }

    public function allRelationship(){
        $relationships = relationship::with('student','parent','relation')->get();
        return response()->json([
            'status'=>'200',
            'relationships'=>$relationships
        ]);
    }

    public function verifyRelationship($id,$uID){
        $admin=User::find($uID);
        $admin= $admin->name;
        relationship::where('id',$id)->update([
            'status'=>'Approved',
            'admin'=> $admin
        ]);
        return response()->json([
            'status'=>'200',
            'message'=>'Update Successful'
        ]);
    }

    public function verifyRelationshipDeny($id,$uID){
        $admin=User::find($uID);
        $admin= $admin->name;
        relationship::where('id',$id)->update([
            'status'=>'Denied',
            'admin'=> $admin
        ]);
        return response()->json([
            'status'=>'200',
            'message'=>'Update Successful'
        ]);
    }

    public function findAllRelationships($id){
        $relationships = relationship::with('student','parent')->where('parentID',$id)->where('status','Approved')->get();
        return $relationships;
    }
    public function eVoucherDetails(){
        $data = eVoucher::all();
        return $data;
    }

    function allEV($id){
        $evpd = eVoucherPaymentDetails::with('trackVouchers')->where('relationshipID',$id)->get();
        // return $evpd;
        return response()->json([
            'status'=>'200',
            'evpd'=>$evpd
        ]);
    }
}
