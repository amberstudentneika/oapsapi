<?php

namespace App\Http\Controllers;
use App\Models\relation;

use Illuminate\Http\Request;
use App\Models\eVoucherPaymentDetails;
use App\Models\TrackeVoucher;
use App\Models\canteenStaff;

use Hash;

class NecessaryController extends Controller
{
    //
    //
    public function relationType(){
        $relation = relation::all();
        return $relation;
    }

    public function searchStudID($search){
        $res = student::where('identificationNumber',$search)->get();
        return $res;
    }

    public function searchVN($id)
    {

           $result= eVoucherPaymentDetails::where('voucherNumber',$id)->get();
           if(sizeof($result)>0){
            $res= TrackeVoucher::with('eVoucherPaymentDetails')->where('eVoucherPaymentDetailsID',$result[0]['id'])->get();
               return response()->json([
                'status'=>'200',
                'message'=>$res
            ]); 
           }
            return response()->json([
                'status'=>'404',
                'message'=>'Not found'
            ]); 
           
    }

    public function clock($csID,$id){

        $res= TrackeVoucher::with('eVoucherPaymentDetails')->find($id);
        
        $res->canteenStaffID = $csID;
        $res->save();
        if($res->RemainingUsage!=0){
            $oldRU = $res->RemainingUsage;
            $newRU = $oldRU - 1;
            $res->RemainingUsage = $newRU;
            $res->save();
        }
        if($res->RemainingUsage==0){
            $res->status = 'Expired';
            $res->save();
        }
        return response()->json([
            'status'=>'201',
            'message'=>'Success'
        ]);
    }

    public function changePassword(Request $request,$id){
        $canteenStaff = canteenStaff::find($id);
        $canteenStaff->password = Hash::make($request->newPassword);
        $canteenStaff->status = 'active';
        $canteenStaff->Save();
        
        return response()->json([
            'status'=>'201',
        ]);
    }

}
