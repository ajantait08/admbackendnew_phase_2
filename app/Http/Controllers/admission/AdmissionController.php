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

    public $table_name="adm_phdef_registration";
    public $adm_rapl_pro="adm_phdef_reg_appl_program";
    public $dept="adm_phdef_dept";
    public $program="adm_phdef_program_ms";
    public $appl_ms="adm_phdef_appl_ms";
    public $email_log="adm_phdef_email_log";

    public function register_user(Request $request){

     try{

      DB::enableQueryLog();

      // Your Eloquent or Query Builder code here


      $validateUser = Validator::make($request->all(),
            [
                'salutation' => 'required|alpha_num:ascii',
                'first_name' => 'required|alpha_num:ascii',
                'middle_name' => 'nullable|alpha_num:ascii',
                'last_name' => 'nullable|alpha_num:ascii',
                'pwd' => 'required|alpha_num:ascii',
                'category' => 'required|alpha_num:ascii',
                'email' => 'required|email|unique:adm_phdef_registration,email',
                'mobile' => 'required|regex:/[0-9]{10}/|unique:adm_phdef_registration,mobile',
                'gender' => 'required|regex:/^[a-zA-Z]*$/',
                'dob' => 'required|date_format:d-m-Y',
                'father_name' => 'nullable|regex:/^[a-zA-Z0-9\s\.]*$/',
                'blood_group' => 'required|regex:/^[a-zA-Z\+-]*$/',
                'colorblindness' => 'required|alpha_num:ascii'
            ]);

            if($validateUser->fails()){
              return response()->json([
                  'status' => false,
                  'message' => 'validation error',
                  'errors' => $validateUser->errors()
              ], 200);
          }
          else {
              $salutation = trim($request['salutation']);
              $first_name = trim($request['first_name']);
              $middle_name = trim($request['middle_name']);
              $last_name = trim($request['last_name']);
              $pwd = trim($request['pwd']);
              $category = trim($request['category']);
              $email = trim($request['email']);
              $mobile = trim($request['mobile']);
              $gender = trim($request['gender']);
              $dob = date('d-m-Y', strtotime($request['dob']));
              $father_name = trim($request['father_name']);
              $blood_group = trim($request['blood_group']);
              $c_blind = trim($request['colorblindness']);
              $appl_type = 'Full time';

              $m_email = DB::table('adm_phdef_registration')->where('email',$email)->first();
              if ($m_email) {
                return response()->json([
                  'status' => false,
                  'message' => 'Registration already done using same Email !',
                  'error' => 'Email Already Exists'
              ],200);
              }

              if ($c_blind == '') {
                return response()->json([
                  'status' => false,
                  'message' => 'Color Blindness/Uniocularity field is mandatory!',
                  'error' => 'Color Blindness/Uniocularity'
                ],200);
              }

              $m_mobile = DB::table('adm_phdef_registration')->where('mobile',$mobile)->first();
              if ($m_mobile) {
                return response()->json([
                  'status' => false,
                  'message' => 'Registration already done using same Mobile !',
                  'error' => 'Mobile Already Exists'
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
              $registration_no = 'IITISMDREF' . $year . $num;
              $values = array(
                'salutation' => $salutation,
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
               $user['to'] = 'testiitism@gmail.com';
               try {
                   /* mail function start here */
                  $mail_response = Mail::send('mail',$data,function($messages) use ($user){
                  $messages->to($user['to']);
                  $messages->subject('Checking mail sent');
                  $messages->from('noreply-phd@iitism.ac.in');
                  });
                  /* mail function end here */
                  $time_date = date("M,d,Y h:i:s A");
                  $upval = array(
                    'ver_mail_sent' => 'Y',
                    'ver_mail_sent_date_time' => $time_date
                  );
                  $emlog = array(
                    'registration_no' => $registration_no,
                    'email_type' => 'Link verification',
                    'email_from' => 'Noreply-phd@iitism.ac.in',
                    'email_to' => $email,
                    'sent_date' => $time_date,
                    'status' => 1,
                    'created_by' => $email,
                  );
                  try {
                    $result = DB::table($this->table_name)->insert($values);
                  } catch (QueryException $ex) {
                    echo $ex->getMessage();
                  }

                  // $lastQuery = DB::getQueryLog();
                  // $lastQuery = end($lastQuery);
                  // dd($lastQuery);
                  $msgok = DB::table($this->email_log)->insert($emlog);
                  $update_sendmail = DB::table($this->table_name)->where('email',$email)->update($upval);
              } catch (\Exception $e) {
                 echo $e->getMessage();
               }
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

  public function verify_email(Request $request){
    return response()->json([
      'status' => 'success',
      'message' => 'Please Contact Admin',
     ],200);
    try {
      print_r($request); exit;
      //code...
    } catch (QueryException $ex) {
       return response()->json([
        'status' => false,
        'message' => 'Please Contact Admin',
        'errors' => $ex->getMessage()
       ],200);
    }
  }

  public function apply_program(Request $request){

  try {

        $validateEmail = validator::make($request->all(),
          [
              'email' => 'required|email'
          ]
        );
        if ($validateEmail->fails()) {
          return response()->json([
            'status' => false,
            'message' => 'Please Enter Valid Email ID'
          ],200);
          # code...
        }
        else{
          $email = $request->email;
          $count_prog_error = 0;
          $candidate_type_query = DB::select("SELECT p.appl_type FROM adm_phdef_registration p WHERE p.email='".$email."'");
          if (!empty($candidate_type_query)) {
            $data['candidate_type'] = $candidate_type_query;
          }
          $get_reg_no = DB::select("select g.registration_no from adm_phdef_registration g where g.email='".$email."'");
          $get_reg_details=DB::select("select g.* from adm_phdef_registration g where g.email='".$email."'");
        }
        $gate_paper_code_query = DB::select("SELECT g.* FROM adm_phdef_gate_paper g");
        if (!empty($gate_paper_code_query)) {
          $data['gate_paper_code']=$gate_paper_code_query;
        }

        if(!empty($get_reg_details[0]->color_blind))
        {

          if($get_reg_details[0]->color_blind=='Y' And $get_reg_details[0]->pwd=='Y')
          {
            $get_prog_list_of_btech_without_pwd_colorblind = DB::select("SELECT t.* FROM adm_phdef_program_ms t WHERE t.pwd  IS NULL and t.color_blind IS NULL");
            if (!empty($get_prog_list_of_btech_without_pwd_colorblind)) {
              $data['btech_paper'] = $get_prog_list_of_btech_without_pwd_colorblind;
            }
            else {
              $count_prog_error++;
            }
          }

          if($get_reg_details[0]->color_blind=='Y' And $get_reg_details[0]->pwd=='N')
          {
            $get_programme_list_of_btech_without_colorblind = DB::select("SELECT t.* FROM adm_phdef_program_ms t WHERE t.color_blind IS NULL");
            if (!empty($get_programme_list_of_btech_without_colorblind)) {
              $data['btech_paper']=$get_programme_list_of_btech_without_colorblind;
            }
            else{
              $count_prog_error++;
            }
          }

          if($get_reg_details[0]->color_blind=='N' And $get_reg_details[0]->pwd=='N')
          {
            $get_prog_list_of_btech = DB::select("SELECT t.* FROM adm_phdef_program_ms t");
            if (!empty($get_prog_list_of_btech)) {
              $data['btech_paper']=$get_prog_list_of_btech;
            }
            else {
              $count_prog_error++;
            }
          }

          if($get_reg_details[0]->color_blind=='N' And $get_reg_details[0]->pwd=='Y')
          {
            $get_prog_list_of_btech_without_pwd = DB::select("SELECT t.* FROM adm_phdef_program_ms t WHERE t.pwd  IS NULL");
            if (!empty($get_prog_list_of_btech_without_pwd)) {
              $data['btech_paper']=$get_prog_list_of_btech_without_pwd;
            }
            else {
              $count_prog_error++;
            }
          }

        }
        else {
          return response()->json([
            'status' => false,
            'message' => 'Unable to fetch Candidate registration Details'
          ],200);
        }

        if ($count_prog_error > 0) {
           return response()->json([
             'status' => false,
             'message' => 'Unable to fetch relevant program details !'
           ],200);
        }

        $app_fill_details = DB::select("select * from adm_phdef_reg_appl_program g where g.registration_no='".$get_reg_no."'");
        if (!empty($app_fill_details)) {
          $data['fill_appl_details'] = $app_fill_details;
        }
        else{
          return response()->json([
            'status' => false,
            'message' => 'No Program Details Available'
          ],200);
        }

        $data['val']="H";
        $data['remove_apply']='apply_remove';

        //code...
        } catch (QueryException $ex) {
          return response()->json([
            'status' => 'false',
            'message' => 'Please Contact Admin',
            'errors' => $ex->getMessage()
          ],200);
        }
    }

    }

?>