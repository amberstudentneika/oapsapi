<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\parents;
use App\Models\canteenStaff;
use App\Models\student;
use App\Models\User;
use App\Models\relationship;
use Hash;
class HomeController extends Controller
{
    function index(Request $request){
        $email= $request->email;
        $pass= $request->password;

        $pHashedPasswordCount=parents::where('email',$email)->count();
        $cHashedPasswordCount=canteenStaff::where('email',$email)->count();
        $uHashedPasswordCount=User::where('email',$email)->count();

        if($pHashedPasswordCount== 0 && $cHashedPasswordCount== 0 && $uHashedPasswordCount== 0){
            return $res=array(
                'status'=>'404',
                'userType'=>'not found',
            ); 
        }
        if($pHashedPasswordCount!=0){
            $pHashedPassword=parents::where('email',$email)->get('password');
            $pHashedPassword=$pHashedPassword[0]['password'];
            $pID=parents::where('email',$email)->get('id');
            $pID=$pID[0]['id']; 
            
            if(Hash::check($pass, $pHashedPassword))
            {
                $res=array(
                    'status'=>'200',
                    'userType'=>'parent',
                    'userID'=>$pID
                );
                return $res;
            }
        }

        if($cHashedPasswordCount!=0){
            $cHashedPassword=canteenStaff::where('email',$email)->get('password');
            $cHashedPassword=$cHashedPassword[0]['password'];
            $cID=canteenStaff::where('email',$email)->get('id');
            $cStatus=canteenStaff::where('email',$email)->get('status');
            $cID=$cID[0]['id'];
            $cStatus = $cStatus[0]['status'];
        
            if(Hash::check($pass, $cHashedPassword))
        {
            $res=array(
                'status'=>'200',
                'userType'=>'canteenStaff',
                'userID'=>$cID,
                'cStatus'=>$cStatus
            );
            return $res;
        }
            
        }

        if($uHashedPasswordCount!=0){
            $uHashedPassword=User::where('email',$email)->get('password');
            $uHashedPassword=$uHashedPassword[0]['password'];
            $uID=User::where('email',$email)->get('id');
            $uID=$uID[0]['id'];

            if(Hash::check($pass, $uHashedPassword))
            {
                $res=array(
                    'status'=>'200',
                    'userType'=>'user',
                    'userID'=>$uID
                );
                return $res;

            }
        }
        
        $failed = array(
            'status'=> '404',
            'message'=> 'Credentials does not match our records'
        );
        return $failed;
    }

    
    function stats(){
        
        $studentCount=student::where('status','active')->count();
        $parentCount=parents::get()->count();
        $activeCSCount=canteenStaff::where('status','active')->count();
        $newCSCount=canteenStaff::where('status','Newly Opened')->count();
        $pendingVer=relationship::where('admin','not actioned')->count();
        
        if( $studentCount == 0 && $parentCount == 0 & $activeCSCount == 0 && $newCSCount == 0){
           return  response()->json([
                'status'=>'404',
                'message'=>'no stats available'
            ]);
           
        }else
        {
           return $data = array(
                'student'=>$studentCount,
                'parent'=>$parentCount,
                'activeCSCount'=>$activeCSCount,
                'newCSCount'=>$newCSCount,
                'pendingVer'=>$pendingVer,
            );
        }

        
    }

    }
       

      
       
        
        
        
       
    

