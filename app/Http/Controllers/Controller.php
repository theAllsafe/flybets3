<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Hashing\BcryptHasher;
use Illuminate\Support\Facades\Hash;
use Session;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function sendResponse($status,$result, $message)
    {
        $response = [
            'success' => $status,
            'data' => $result,
            'message' => $message,
        ];

        return response()->json($response, 200);
    }

    public function checkemailvalid(Request $request)
    {

        $res=User::where('email',$request->email)->first();
        if($res){
            $hasher = app('hash');
            if ($hasher->check($request->password, $res->password)) {

                if($request->otp)
                {
                    if(Session::get('otp')==$request->otp)
                    {
                        return $this->sendResponse(true,$res,'verified');
                    }else{
                            return $this->sendResponse(false,'','Please check Invalid OTP');
                    }

                    
                }else{
                        $otp = random_int(100000, 999999);
                        $details = [
                            'title' => 'OTP Verification',
                            'body' => 'Your OTP is '.$otp
                        ];
                        Session::put('otp', $otp);
                        \Mail::to($request->email)->send(new \App\Mail\MyTestMail($details));
                        return $this->sendResponse(true,$res,$otp);
                }
               
            }else{
                        return $this->sendResponse(false,'','Password does not match');
            }
        }else{
                return $this->sendResponse(false,'','Please check email and password');
        }  
    }

    public function checkregistervalid(Request $request)
    {
        $res=User::where('email',$request->email)->get()->count();
        if($res=='0'){
            
            if ($request->password == $request->password_confirmation) {

                if($request->otp)
                {
                    if(Session::get('otp')==$request->otp)
                    {
                        return $this->sendResponse(true,$res,'verified');
                    }else{
                            return $this->sendResponse(false,'','Please check Invalid OTP');
                    }

                    
                }else{
                        $otp = random_int(100000, 999999);
                        $details = [
                            'title' => 'OTP Verification',
                            'body' => 'Your OTP is '.$otp
                        ];
                        Session::put('otp', $otp);
                        \Mail::to($request->email)->send(new \App\Mail\MyTestMail($details));
                        return $this->sendResponse(true,$res,$otp);
                }
               
            }else{
                        return $this->sendResponse(false,'','Password and Confirmation does not match');
            }
        }else{
                return $this->sendResponse(false,'','Please check Email is Used try another email');
        } 

    }
    public function checkresetvalid(Request $request)
    {
        $res=User::where('email',$request->email)->first();
        if($res){
            $hasher = app('hash');
            if ($request->password=='') {
                if($request->otp)
                {
                    if(Session::get('otp')==$request->otp)
                    {
                        return $this->sendResponse(true,$res,'verified');
                    }else{
                            return $this->sendResponse(false,'','Please check Invalid OTP');
                    }
                    
                }else{
                        $otp = random_int(100000, 999999);
                        $details = [
                            'title' => 'OTP Verification',
                            'body' => 'Your OTP is '.$otp
                        ];
                        Session::put('otp', $otp);
                        \Mail::to($request->email)->send(new \App\Mail\MyTestMail($details));
                        return $this->sendResponse(true,$res,$otp);
                }
               
            }else{
                        $res=User::where('email',$request->email)->update(['password'=> Hash::make($request->password)]);
                        if($res)
                        {
                            return $this->sendResponse(false,'','password_updated');
                        }else{
                            return $this->sendResponse(false,'','Invalid details');
                        }
                        
            }
        }else{
                return $this->sendResponse(false,'','Please check invalid email');
        }  
        
    }
}
