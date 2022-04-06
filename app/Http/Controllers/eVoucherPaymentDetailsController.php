<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\eVoucherPaymentDetails;
use App\Models\student;
use App\Models\relationship;
use App\Models\TrackeVoucher;
use Carbon\Carbon;

class eVoucherPaymentDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $$evpd=eVoucherPaymentDetails::all();

        return response()->json([
            'status'=>'200',
            'evpd'=>$evpd
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
        $data = relationship::with('student','parent')->find($request->RelationshipID);
        $sID = $data->student->identificationNumber;
        $evpd=eVoucherPaymentDetails::create([
            'RelationshipID'=>$request->RelationshipID,
            'totalCost'=>$request->totalCost,
            'amountPaid'=>$request->amountPaid,
            'nameOnCard'=>$request->nameOnCard,
            'cardNum'=>$request->cardNum,
            'expDate'=>$request->expDate,
            'secCode'=>$request->secCode,
            'totalAllotment'=>$request->totalAllotment,
            'voucherNumber'=>$request->voucherNumber.$sID
        ])->id;
        TrackeVoucher::create([
            'eVoucherPaymentDetailsID'=>$evpd,
            'canteenStaffID'=>1,
            'RemainingUsage'=>$request->totalAllotment,
            'date'=>Carbon::now()->format('Y-m-d')
        ]);

        return response()->json([
            '201',
            'message'=>'Voucher Created Sucessfully'
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
       // eVoucherPayment::find($id)->update([
            // 'RelationshipID'=> $request->RelationshipID,
          //  'type'=> $request->type,
           // 'totalCost'=> $request->totalCost,
           // 'amountPaid'=> $request->amountPaid,
            // 'voucherNumber'=> $request->voucherNumber
       // ]);

       // return response()->json([
       //     '201',
       //     'message'=>'Payment updates Sucessfully'
       // ]);
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
    }
}
