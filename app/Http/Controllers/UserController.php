<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Stud_final_with_fee_jee;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\CryptAES;
use App\Http\Controllers\Pay;
use Exception;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum', ['except' => ['loginUser', 'loginTest', 'getData', 'TokenError', 'loginApi', 'sanctum/csrf-cookie']]); // auth:sanctum
    }

    //
    // public function getDetails() {

    //     $stud_final_with_fee = DB::connection('mysql')->table('stud_final_with_fee')->get(); // stud_final_with_fee
        
    //         if(count($stud_final_with_fee) > 0) {
                
    //             return response()->json([
    //                 'status' => true,
    //                 'message' => 'states fetched successfully',
    //                 'errors' => '',
    //                 'data' => $stud_final_with_fee
    //             ], 200);
    //         }
    //         else {
                
    //             return response()->json([
    //                 'status' => false,
    //                 'message' => 'no data found',
    //                 'errors' => 'no data found'
    //             ], 200);
    //         }

    // }
    public function getDetails() {
        // $users = DB::table('parent_users')->get();
         $users = DB::select('select * from stud_final_with_fee where reg_id = ?', ['121012']);
         return response()->json([
             'message' => 'User data',
             'data' => $users
         ], 200);
         # echo '<pre>'; print_r($users); echo '</pre>';
     }
    # xxxxxxxxxxxxxxxxxxxxxxxxxxxxx Start working from here xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
    public function loginApi(Request $request) {

        $validateUser = Validator::make($request->all(), 
            [
                'reg_id' => 'required',
                'contact_no' => 'required',
                'email' => 'required'
            ]);

            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 200);
            }

            # echo "<pre>"; print_r($request->all()); exit;
            
            if(!Auth::loginUsingId($request->reg_id)){
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid UserName',
                ], 200);
            }
            else {
                $reg_id = $request->reg_id;
                $contact_no = $request->contact_no;
                $email = $request->email;
                $user = Auth::user();
                $sql = "SELECT COUNT(*) AS row_cnt FROM  stud_final_with_fee_jee p where p.contact_no='$contact_no'
                and p.reg_id='$reg_id' AND p.email='$email'";
                $rows = DB::select($sql);

                if ($rows[0]->row_cnt > 0) 
                {
                    $success['token'] = $token =  $user->createToken('API TOKEN', ['server:update'])->plainTextToken;
                    $success['user_details'] = $this->getUser($reg_id);

                    $response = [
                        'status' => true,
                        'responseCode' => 200,
                        'token' => $success['token'],
                        'message' => 'Login Successfully',
                        'userData'    => $success['user_details'],
                        'timestamp' => date('d-m-Y H:s:i a')
                    ];
            
                    return response()->json($response, 200);
                } 
                else 
                {
                    return response()->json([
                        'status' => false,
                        'message' => 'Credential did not match',
                    ], 200);
                }
            }   

    }
    private function getUser($reg_id)
    {
        return $users = DB::select("SELECT `sl_no` , `auth` , `reg_id` , `first_name`, `middle_name`, `last_name` , `contact_no` , `email` , `admn_type` , `form_status`
       FROM stud_final_with_fee_jee a
       WHERE a.reg_id='$reg_id'");
    }


}
