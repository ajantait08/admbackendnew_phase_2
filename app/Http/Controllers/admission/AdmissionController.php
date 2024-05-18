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
    public $error_log="adm_phdef_error_log";

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
                //'email' => 'required|email|unique:adm_phdef_registration,email',
                'email' => 'required|email',
                //'mobile' => 'required|regex:/[0-9]{10}/|unique:adm_phdef_registration,mobile',
                'mobile' => 'required|numeric|regex:/[0-9]{10}/',
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
                  'message' => 'Email Already Exists',
                  'error' => 'Registration already done using same Email !'
              ],200);
              }

              if ($c_blind == '') {
                return response()->json([
                  'status' => false,
                  'message' => 'Color Blindness/Uniocularity',
                  'error' => 'Color Blindness/Uniocularity field is mandatory!'
                ],200);
              }

              $m_mobile = DB::table('adm_phdef_registration')->where('mobile',$mobile)->first();
              if ($m_mobile) {
                return response()->json([
                  'status' => false,
                  'message' => 'Mobile Already Exists',
                  'error' => 'Registration already done using same Mobile !'
              ],200);
              }

              $get_details_reg = DB::select('SELECT MAX(id) AS `maxid` FROM `adm_phdef_registration`');
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

               //$name = $first_name . " " . $middle_name . " " . $last_name;
               $name = $first_name;
               if ($middle_name != '') {
               $name .= " " . $middle_name;
               }
               if ($last_name != '') {
               $name .= " " . $last_name;
               }
               try {
                 $user = User::create([
                   'name' => $name,
                   'email' => $email,
                   'registration_no' => $registration_no,
                   'password' => bcrypt($password)
                 ]);
                $token = $user->createToken('phdefadmtoken')->plainTextToken;
               } catch (\Exception $e) {
                  return response()->json([
                   'error' => 'User Authentication Failed',
                   'message' => $e->getMessage(),
                   'status' => 'false'
                  ],200);
                }

                  $email_encode = $email;
                  $link = "http://localhost:3000/admission/phd/verify_email/" . $email_encode;
                  $data = ['registration_no' => $registration_no,'password' => $password,'link' => $link];
                  $user['to'] = 'ajanta.au@iitism.ac.in';
                //   try {
                //     /* mail function start here */
                //    $mail_response = Mail::send('mail',$data,function($messages) use ($user){
                //    $messages->to($user['to']);
                //    $messages->subject('Checking mail sent');
                //    $messages->from('noreply.admission.registration@iitism.ac.in');
                //    });
                //      }
                // catch (\Exception $e) {
                //        return response()->json([
                //          'status' => false,
                //          'message' => 'Mail Sending Error',
                //          'errors' => $e->getMessage()
                //      ],200);
                //      }
                  /* mail function end here */
                  $time_date = date("M,d,Y h:i:s A");
                  $upval = array(
                    'ver_mail_sent' => 'Y',
                    'ver_mail_sent_date_time' => $time_date
                  );
                  $emlog = array(
                    'registration_no' => $registration_no,
                    'email_type' => 'Link verification',
                    'email_from' => 'noreply.admission.registration@iitism.ac.in',
                    'email_to' => $email,
                    'sent_date' => $time_date,
                    'status' => 1,
                    'created_by' => $email,
                  );
                  try {
                    $result = DB::table($this->table_name)->insert($values);
                    $msgok = DB::table($this->email_log)->insert($emlog);
                    $update_sendmail = DB::table($this->table_name)->where('email',$email)->update($upval);
                    return response()->json([
                        'status' => true,
                        'message' => 'Registration Successful',
                        'registration_no' => $registration_no,
                        'token' => $token
                    ],200);
                    } catch (QueryException $ex) {
                      $database_error_log = array(
                        'error_type' => 'Database Error',
                        'err_msg' => $ex->getMessage(),
                        'err_location' => 'During initial registration',
                        'registration_no' => $registration_no
                      );
                      DB::table($this->error_log)->insert($database_error_log);
                      return response()->json([
                        'status' => false,
                        'message' => 'Database Error Occured',
                        'errors' => $ex->getMessage()
                    ],200);
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

    try{
      DB::enableQueryLog();
      $validateUser = Validator::make($request->all(),[
         'email' => 'required|email',
      ]);

      if ($validateUser->fails()) {
         return response()->json([
           'status' => false,
           'message' => 'validation error',
           'errors' => $validateUser->errors()
         ],200);
      }
      else {
      $email = $request['email'];
      $check = DB::SELECT("select g.verification from adm_phdef_registration g where g.email='".$email."'");
      if (!empty($check)) {
      $check_mail_id = DB::table('adm_phdef_registration')->where('email', $email)->count();
      if ($check_mail_id > 0) {
         if ($check == 'Y') {
          return response()->json([
            'status' => false,
            'error' => 'Email Verification Failed',
            'message' => 'Sorry! there is error in verifying email'
          ],200);
         }
         else {
          $time_date = date("M,d,Y h:i:s A");
          $vupval = array(
            'verification' => 'Y',
            'verification_date_time' => $time_date,
            'status' => 1
          );
          $affectedRows = DB::table('adm_phdef_registration')
                          ->where('email', $email)
                          ->update($vupval);
          if ($affectedRows > 0) {
            return response()->json([
              'status' => true,
              'message' => 'Email Verification Success',
              //'message' => 'Your Email Address is successfully verified! Please login to access your account!'
            ],200);
          } else {
            return response()->json([
              'status' => false,
              'error' => 'Email Verification Failed',
              'message' => 'Sorry! there is error in verifying email'
            ],200);
          }
         }
      }
      else {
        return response()->json([
          'status' => false,
          'error' => 'Email Verification Failed',
          'message' => 'Sorry! there is error in verifying email'
        ],200);
      }
        }
        else {
          return response()->json([
            'status' => false,
            'error' => 'Email Verification Failed',
            'message' => 'Sorry! there is error in verifying email'
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

  public function user_login(Request $request){
    // return response()->json([
    //   'status' => true,
    //   'message' => 'testing reached here',
    //   'error' => ''
    // ],200);

     $validateUser = validator::make($request->all(),[
        'registration_no' => 'required|alpha_num:ascii',
        'password' => 'required|alpha_num:ascii|between:7,8',
        #'google_captcha' => 'required' /* comment for now open on valid request */
     ]);

     #print_r($request->all()); exit;
     if ($validateUser->fails()) {
        return response()->json([
          'status' => false,
          'message' => 'validation failed',
          'error' => $validateUser->messages()
        ],200);
     }
     else {
      $googlecapturedata = array(
        'secret' => env('GOOGLE_RECAPTCHA_SECRET'),
        'response' => $request['google_captcha'],
        'remoteip' => $request->ip());
        try {
          // $verify = curl_init();
          // curl_setopt($verify, CURLOPT_URL,
          // "https://www.google.com/recaptcha/api/siteverify");
          // curl_setopt($verify, CURLOPT_POST, true);
          // curl_setopt($verify, CURLOPT_POSTFIELDS,
          //             http_build_query($googlecapturedata));
          // curl_setopt($verify, CURLOPT_SSL_VERIFYPEER, false);
          // curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
          // $response = curl_exec($verify);
          // $status = json_decode($response);
          $registration_no = $request['registration_no'];
          $password = $request['password'];
          $check_registration_number = DB::table('adm_phdef_registration')->where('registration_no', $registration_no)->first();
          #print_r($check_registration_number); exit;
          if (empty($check_registration_number)) {
            return response()->json([
              'status' => false,
              'error' => 'You have not done Registeration please first do registration',
              'message' => 'Registration Details Not Found'
            ],200);
          }
          else {
            if ($check_registration_number->verification == '') {
               return response()->json([
                'status' => false,
                'error' => 'You have not verify your email please verified it other wise you not allow to login',
                'message' => 'Email Not Verified'
               ],200);
            }
            else {
              $user = User::where('registration_no', $request['registration_no'])->first();
              if (! $user || ! Hash::check($request['password'], $user->password)) {
                return response()->json([
                  'status' => false,
                  'error' => 'Either Email or Password is Invalid',
                  'message' => 'Invalid login credentials'
                 ],200);
            }
            else {
              try {
              $token = $user->createToken('phdefadmtoken')->plainTextToken;
              $data1 = array(
                'registration_no' => $request['registration_no'],
                'password' => $request['password'],
                'verification' => 'Y'
              );
              $data = array(
                'registration_no' => $request['registration_no']
              );
              $login = DB::table('adm_phdef_registration')->where($data1)->first();
              $val_reg = DB::table('adm_phdef_registration')->where($data)->first();
              $email = $val_reg->email;
              $name = $val_reg->first_name . ' ' . $val_reg->middle_name . ' ' . $val_reg->last_name;
              $registration_no = $val_reg->registration_no;
              if (!empty($login)) {
                $userdata = array(
                  'email' => $email,
                  'status' => 'login',
                  'name' => $name,
                  'registration_no' => $registration_no,
                  'login_type' => 'Phdef',
                  'token' => $token
                );
              }
              $application = DB::table('adm_phdef_appl_ms')->where($data)->first();
              if (!empty($application)) {
              if ($application->payment_status == 'Y') {
                 return response()->json([
                  'status' => true,
                  'message' => 'Payment Success'],200);
              }
              else {
                $currentdate = date("Y/m/d");
                $closedate = "2028-04-28";
                $currentdate = strtotime($currentdate);
                $closedate = strtotime($closedate);
                if ($currentdate > $closedate) {
                return response()->json([
                  'status' => false,
                  'error' => 'The last date of applying in Ph.d. Admission portal is over.There is no fully submitted/paid application form for this application registration number',
                  'message' => 'login failed'
                ]);
                } else {
                  print_r($userdata); exit;
                  return response()->json([
                    'status' => true,
                    'message' => 'user_dashboard',
                    'userdata' => $userdata
                  ],200);
                }
                // $this->session->set_userdata('user_dashboard', 'user_dashboard');
                // redirect('admission/phdef/Adm_phdef_applicant_home');
                // redirect('admission/phdef/Adm_phdef_user_dashboard');
            }
            }
            else {
                $currentdate = date("Y/m/d");
                $closedate = "2028-04-28";
                $currentdate = strtotime($currentdate);
                $closedate = strtotime($closedate);
                if ($currentdate > $closedate) {
                return response()->json([
                  'status' => false,
                  'error' => 'The last date of applying in Ph.d. Admission portal is over.There is no fully submitted/paid application form for this application registration number',
                  'message' => 'login failed'
                ]);
                } else {
                  return response()->json([
                    'status' => true,
                    'message' => 'user_dashboard',
                    'userdata' => $userdata
                  ]);
                }
            }
          }
          catch (Exception $e) {
            $database_error_log = array(
              'error_type' => 'Database Error',
              'err_msg' => $e->getMessage(),
              'err_location' => 'During Login process',
              'registration_no' => $registration_no
            );
            DB::table($this->error_log)->insert($database_error_log);
            return response()->json([
              'status' => false,
              'message' => 'Database Error Occured',
              'errors' => $e->getMessage()
          ],200);
          }
        }
          #echo $check_registration_number->registration_no;
          #$check_registration_number = $this->Add_phdef_registration_model->check_registration_no(trim($this->input->post('user_name')));
        }}} catch (\Exception $e) {
          return response()->json([
            'status' => false,
            'message' => 'Please Contact Admin',
            'error' => $e->getMessage()
          ],200);
        }
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