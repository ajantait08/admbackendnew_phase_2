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


class ApplicantHomeController extends Controller {
    public function __construct(){

    }
    public $table_name="adm_phdef_registration";
    public $adm_rapl_pro="adm_phdef_reg_appl_program";
    public $dept="adm_phdef_dept";
    public $program="adm_phdef_program_ms";
    public $appl_ms="adm_phdef_appl_ms";
    public $email_log="adm_phdef_email_log";
    public $error_log="adm_phdef_error_log";
    public $tab = "adm_phdef_tab";

    public function getAppHomeDetails(Request $request){
        try{
            DB::enableQueryLog();
            $validateUser = validator::make($request->all(),[
                'registration_no' => 'required|alpha_num:ascii',
                'email' => 'required|email'
            ]);

            if ($validateUser->fails()) {
                return response()->json([
                   'status' => false,
                   'message' => 'validation error',
                   'errors' => $validateUser->messages()
                ],200);
            }
            else {
                $email = $request['email'];
                $registration_no = $request['registration_no'];
                $data_fetch_prog_details = DB::select("select prog.* from adm_phdef_reg_appl_program prog where registration_no = '".$registration_no."'");
                if (!empty($data_fetch_prog_details)) {
                    $appl_program = $data_fetch_prog_details;
                }
                else {
                    $appl_program = "";
                }

               $check_program_apply_details_count = DB::table($this->tab)->where('registration_no',$registration_no)->where('prom_apply_status','program applied')->count();
               $get_program_details_apply = DB::table($this->tab)->where('registration_no',$registration_no)->where('prom_apply_status','program applied')->get();
               /* how to process the last query */
            //    // Retrieve the query log
            //    $queryLog = DB::getQueryLog();
            //    // Get the last query
            //    $lastQuery = end($queryLog);
            //    // Output the last query
            //    dd($lastQuery);
               /* how to process the last query */
               if ($check_program_apply_details_count > 0) {
                $check_program_apply = $get_program_details_apply;
               }
               else{
                $check_program_apply = '';
               }

              $check_tab_position_details = DB::table($this->tab)->where('registration_no',$registration_no)->get();
              if (!empty($check_tab_position_details)) {
                 $tab_position = $check_tab_position_details;
              }
              else {
                $tab_position = '';
              }

              $tab= DB::select("select GREATEST(IFNULL(tab1,0),IFNULL(tab2,0),IFNULL(tab3,0),IFNULL(tab4,0)) hightest from adm_phdef_tab where registration_no = '".$registration_no."'");
              $get_applicant_name = DB::table("adm_phdef_registration")->select('first_name','middle_name','last_name')->where('registration_no',$registration_no)->get();
              $applicant_name = $get_applicant_name[0]->first_name;
              if ($get_applicant_name[0]->middle_name != '') {
                $applicant_name .= ' '.$get_applicant_name[0]->middle_name;
              }
              if ($get_applicant_name[0]->last_name != '') {
                $applicant_name .= ' '.$get_applicant_name[0]->last_name;
              }
            //   echo $applicant_name; exit;
              echo '<pre>';
              print_r($tab[0]);
              echo '</pre>';
              exit;
            //      // Retrieve the query log
            //    $queryLog = DB::getQueryLog();
            //    // Get the last query
            //    $lastQuery = end($queryLog);
            //    // Output the last query
            //    dd($lastQuery);
            // echo '<pre>';
            // print_r($tab);
            // echo '</pre>';
            // exit;
            //$applicant_name =
              if (!empty($tab)) {
                $value = $tab[0]->highest;
                $data['tab'] = $tab[0]->highest;
                $data['name'] = $applicant_name;
                $data['p_apply'] = $tab_position[0]->prom_apply_status;
              }
              else {
                $data = array();
              }

              //exit;

              #$data['val'] = "H";
              $data['gate_paper_code'] = DB::table("adm_phdef_gate_paper")->get()->toArray();
              $data['btech_paper'] = DB::table("adm_phdef_program_ms")->get()->toArray();
              $get_candidate_type = DB::table("adm_phdef_registration")->select('appl_type')->where('registration_no',$registration_no)->first();
              $data['candidate_type'] = $get_candidate_type->appl_type;
              $data['appl_ms'] = DB::table("adm_phdef_appl_ms")->where('registration_no',$registration_no)->get()->toArray();
              $data['program_ms'] = DB::table("adm_phdef_reg_appl_program")->where('registration_no',$registration_no)->get()->toArray();
              $data['login_type'] = 'phdef';

            //   if (empty($data['appl_ms'])) {
            //       echo "appl ms data is empty"; //exit;
            //   }

            //   if (empty($data['program_ms'])) {
            //      echo "program ms data is empty"; //exit;
            //   }

            //   exit;

              if (empty($data['appl_ms'])) {
                 $data['val'] = "H";
                 $this->applications_track($applicant_name,$email,$registration_no,$data['login_type']); // For Testing purpose!!
              }
              else {

              }

              #print_r($data); exit;
              return response()->json([
                'status' => true,
                'message' => 'user_dashboard_details',
                'data' => $data
              ]);

            }
        }
        catch(QueryException $ex){
            return response()->json([
                'status' => false,
                'message' => 'Please Contact Admin',
                'errors' => $ex->getMessage()
            ]);

          }
      }

      public function applications_track($applicant_name,$email,$registration_no,$login_type){

         try {
           if (empty($applicant_name) && empty($email) && empty($registration_no) && empty($login_type)) {
              throw new Exception('Please provide valid candidate details');
           }
           else {

             $gettabdetails = DB::table($this->tab)->select(DB::raw('count(*) as row_count'))->where('registration_no',$registration_no)->get()->toArray();
             #$gettabdetailscount = DB::table($this->tab)->where('registration_no',$registration_no)->count();

             if ($gettabdetailscount > 0) {
                $data['tabdetails'] = $gettabdetails;
             }
           }
         } catch (Exception $ex) {
             echo $ex->getMessage();
         }


      }

    }
