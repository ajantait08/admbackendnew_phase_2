<?php

namespace App\Http\Controllers\admission;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Mail;
use App\Mail\EMailClass;
use Exception;
use Illuminate\Support\Facades\View;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Hash;
use Illuminate\Database\QueryException;

$google_recaptcha_url = 'https://www.google.com/recaptcha/admin/';
$google_recaptcha_secret = '6Lf8isYkAAAAAOfbFb9gtMSO7lgBUCjM7PdHzq3b';

class AdmissionController extends Controller
{
    public function __construct(){

    }

    public function register_user(Request $request){

     try{

      $validateUser = Validator::make($request->all(),
            [
                'firstname' => 'required',
                'middlename' => 'required',
                'lastname' => 'required',
                'pwd' => 'required',
                'category' => 'required',
                'email' => 'required|email',
                'mobile' => 'required|regex:/[0-9]{10}/',
                'gender' => 'required',
                'dob' => 'required',
                'fathername' => 'required',
                'bloodgroup' => 'required',
                'colorblindness' => 'required'
            ]);

            if($validateUser->fails()){
              return response()->json([
                  'status' => false,
                  'message' => 'validation error',
                  'errors' => $validateUser->errors()
              ], 200);
          }

          else {
              $first_name = $request['firstname'];
              $middle_name = $request['middlename'];
              $last_name = $request['lastname'];
              $pwd = $request['pwd'];
              $category = $request['category'];
              $email = $request['email'];
              $mobile = $request['mobile'];
              $gender = $request['gender'];
              $dob = $request['dob'];
              $father_name = $request['fathername'];
              $blood_group = $request['bloodgroup'];
              $c_blind = $request['colorblindness'];
              $appl_type = 'Full time';

              $m_email = DB::table('adm_phd_registration')->where('email',$email)->first();
              if ($m_email) {
                return response()->json([
                  'status' => false,
                  'message' => 'Registration already done using same Email !',
              ],200);
              }

              $m_mobile = DB::table('adm_phd_registration')->where('mobile',$mobile)->first();
              if ($m_email) {
                return response()->json([
                  'status' => false,
                  'message' => 'Registration already done using same Mobile !',
              ],200);
              }

              $get_details_reg = DB::select('SELECT MAX(id) AS `maxid` FROM `adm_phd_registration`');
              if (!empty($get_details_reg)) {
              $maxid = $get_details_reg[0]->maxid;
              $nemax = $maxid + 1;
              $year=date("y");
              //$year = 22;
              $num = sprintf("%05d", $maxid);
              $password = $this->randomPassword();
              $registration_no = 'IITISMWDR' . $year . $num;
              $values = array(
                'appl_type' => $appl_type,
                'first_name' => $first_name,
                'middle_name' => $middle_name,
                'last_name' => $last_name,
                'category' => $category,
                'blood_group' => $blood_group,
                'father_name' => $father_name,
                'pwd' => $pwd,
                'mobile' => $mobile,
                'email' => $email,
                'dob' => $dob,
                'gender' => $gender,
                'color_blind' => $c_blind,
                'registration_no' => $registration_no,
                'password' => $password,
                'status' => '0',
                'created_by' => $email
              );

              $name = $first_name . " " . $middle_name . " " . $last_name;

              /* send mail using smtp */
               $email_encode = rawurlencode($email);
               $link = "http://localhost:3000/admission/phd/verify_email/" . $email_encode;
               $data = ['registration_no' => $registration_no,'password' => $password,'link' => $link];
               $user['to'] = 'ajanta.au@iitism.ac.in';
               $mail_response = Mail::send('mail',$data,function($messages) use ($user){
                  $messages->to($user['to']);
                  $messages->subject('Checking mail sent');
               });
               echo 'echo mail response'.$mail_response;
              /* send mail using smtp */
            }
            else {
              return response()->json([
                'status' => false,
                'message' => 'Unable to Fetch Required Details Now , Please Try again Later !',
            ],200);
            }
            }
     }
     catch(QueryException $ex)
     {
        return response()->json([
            'status' => false,
            'message' => 'Please Contact Admin',
            'errors' => $ex->getMessage()
        ],200);

    }
  }

  public function randomPassword()
  {
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
      $n = rand(0, $alphaLength);
      $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
  }
}

?>