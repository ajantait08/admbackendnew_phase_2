<?php
// print_r($hidden['f_year']);
// exit;
?>
<style>
body{ font-size: 11px; }
h2{ font:16px; font-weight:bold;}
table{ width:100%;}

.form-control{ width:50px;}
/* table {
    border-collapse: collapse;
} */
/* .header { position: fixed; left: 0px; top: -100px; right: 0px; height: 150px; text-align: center; } */
/* table {page-break-after:always;} */
</style>

   <?php
//   if(!empty($receipt_payment))
//                           {

                              ?>
<div class="header" >

<div class="registration" >


<table width="100%" border="0">
 <tr>
      <!-- <td width="5%" rowspan="2" valign="center"><img src="<?php echo base_url() ?>assets/images/ism/ismlogo.png" width="85" height="70" /></td>
 <td align="center"><img src="<?php echo base_url() ?>assets/images/ism/ismiit1.jpg" width="370" height="25" /><br><img src="<?php echo base_url() ?>assets/images/ism/ismiittext.jpg" width="450" height="35" /><br><img src="<?php echo base_url() ?>assets/images/ism/dh1.jpg" width="270" height="20"/></td> -->
<td><img src="<?php echo base_url() ?>assets/images/ism/IITISM_Form_Header_blue.png" class="img-fluid" style="margin-bottom:10px; width:720px;"/></td>
</tr>
    <tr>
         <td><h2 style="text-align: center;font-size: 16px;">MIS Registration Slip</h1></td>
    </tr>
   </table>

   <div class="panel panel-default">
     <div class="panel-body">

 <p><b><u>For Office Details</u></b></p>

 <table width="100%" border="1" >
 <tr>
   <td width="9%"><b>Admission Number</b></td>
   <td width="15%"><?php echo strtoupper($admn_no); ?></td>

   <td width="16%" rowspan="4" valign="top" style="text-align: center;"><img src="<?php echo $photopath;?>" width="120" height="150" ><br><img src="<?php echo $signpath; ?>" width="220" height="50" ></td>
 </tr>
 <tr>
  <?php if($admn_type!='jrf'){?>
   <td><b>Course</b></td>
   <td><?php echo strtoupper($course); ?></td>
   <?php }
   else {?>
    <td><b>Department</b></td>
   <td><?php echo strtoupper($department); ?></td>
 <?php } ?>
 </tr>
 <tr>
  <?php if($admn_type!='jrf'){?>
   <td><b>Branch</b></td>
   <td><?php echo strtoupper($branch); ?></td>
    <?php }
    else {?>
      <td><b>Course(JRF)</b></td>
       <td><?php echo strtoupper($this->Phd_mis_reg->get_branch_name_by_id($branch_id)); ?></td>
     <?php }?>
 </tr>
 <tr>
   <td><b>Hostel Room Details</b></td>
   <td><?php echo ($present_address_line2=='NA' || $present_address_line2=='na') ? 'Not Allocated': ucwords($present_address_line1).','.ucwords($present_address_line2).','.ucwords($present_address_city).','.ucwords($present_address_state); ?></td>

 </tr>
 </table>

 <div class="info">
 <p><strong><u>Admission Details</u></strong></p>
 </div>
 <table width="100%" border="0">
   <tr>
     <td width="25%">Admission Based On</td>
     <td width="25%"><?php echo strtoupper($admn_based_on);?></td>
     <td width="25%">Registration Date</td>
     <td width="25%">  <?php echo date("d M Y", strtotime($admn_date)); ?></td>
   </tr>
 </table>


<div class="info">
<p><strong><u>Personal Details</u></strong></p>
</div>
   <table width="100%" border="0">
   <tr>
     <td width="25%">Name</td>
     <td width="25%"><?php echo strtoupper($first_name).' '.strtoupper($middle_name).' '.strtoupper($last_name); ?></td>
     <td width="25%">Date of Birth</td>
     <td width="25%"><?php echo date("d M Y", strtotime($dob)); ?></td>
   </tr>
   <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
   </tr>
   <tr>
     <td width="25%">Gender</td>
     <td width="25%"><?php if($sex=='m') echo "MALE";else if($sex=='f') echo "FEMALE";else echo "TRANSGENDER" ?></td>
     <td width="25%">Category</td>
     <td width="25%">  <?php echo ucwords($category); ?></td>
   </tr>
   <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
   </tr>
   <tr>
     <td width="25%">Divyang</td>
     <td width="25%">  <?php echo ucwords($pd_status); ?></td>
     <td width="25%">Religion</td>
     <td width="25%">  <?php echo ucwords($religion); ?></td>
   </tr>
   <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
   </tr>
   <tr>
     <td width="25%">Permanent Address</td>
     <td width="25%">   <?php echo ucwords($permanent_address_line1).','.ucwords($permanent_address_line2); ?></td>
     <td width="25%">City</td>
     <td width="25%">  <?php echo ucwords($permanent_address_city); ?></td>
   </tr>
   <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
   </tr>
   <tr>
     <td width="25%">State</td>
     <td width="25%">  <?php echo ucwords($permanent_address_state).','.ucwords($permanent_address_country); ?></td>
     <td width="25%">Pincode</td>
     <td width="25%">   <?php echo $permanent_address_pincode; ?></td>
   </tr>
   <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
   </tr>
   <tr>
      <?php if ($aadhar_no != '') { ?>
        <td width="25%">Aadhaar No</td>
     <td width="25%">  <?php echo $aadhar_no; ?></td>
   <?php  } ?>
   <?php if ($passport_no != '') { ?>
        <td width="25%">Passport No</td>
     <td width="25%">  <?php echo $passport_no; ?></td>
   <?php  } ?>

     <td width="25%">Parent Email</td>
     <td width="25%">  <?php echo $parent_email_id; ?></td>
   </tr>
 </table>

 <div class="info">
 <p><strong><u>Parent Details</u></strong></p>
 </div>
 <table width="100%" border="0">
 <tr>
     <td width="25%">Father Name</td>
     <td width="25%"> <?php echo ucwords($father_name); ?></td>
     <td width="25%">Mother Name</td>
     <td width="25%">  <?php echo ucwords($mother_name); ?></td>
   </tr>
   <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
   </tr>

 </table>

 <div class="info">
 <p><strong><u>MIS Credentials</u></strong></p>
 </div>
 <table width="100%" border="0">
 <tr>
     <td width="25%">Username</td>
     <td width="25%"><?php echo $admn_no;?></td>
     <td width="25%">Password</td>
     <td width="25%"><?php echo $reg_id; ?></td>
   </tr>
   <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
   </tr>
</table>

 <div class="info">
 <p><strong><u>Parent Portal Credentials</u></strong></p>
 </div>
 <table width="100%" border="0">
 <tr>
     <td width="15%">Parent Account Number</td>
     <td width="20%"><?php echo ucwords($account_no);?></td>
     <td width="15%">Parent Contact</td>
     <td width="20%">  <?php echo $parent_mobile_no; ?></td>
     <td width="15%">Admission No</td>
     <td width="15%">  <?php echo $admn_no; ?></td>
   </tr>
   <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
   </tr>
</table>

<div class="info">
 <p><strong><u>Email Credentials</u></strong></p>
 </div>
 <table width="100%" border="0">
 <tr>
     <td width="25%">Email ( IITISM )</td>
     <td width="25%"><?php echo $domain_name;?></td>
     <td width="25%">Password</td>
     <td width="25%"><?php echo $domain_password; ?></td>
   </tr>
   <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
   </tr>
</table>


<div class="info">
 <p><strong><u>Fee Details</u></strong></p>
 </div>
 <table width="100%" border="0">
 <tr>
     <td width="25%">Fee Mode</td>
     <td width="25%"><?php echo $fee_mode;?></td>
     <td width="25%">Fee Amount</td>
     <td width="25%"><?php echo $fee_amount; ?></td>
   </tr>
   <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>

   </tr>
   <tr>
     <td width="25%">Transaction Id</td>
     <td width="25%"><?php echo $transaction_id;?></td>
     <td width="25%">Fee Date</td>
     <td width="25%"><?php echo date("d M Y", strtotime($fee_date)); ?></td>
   </tr>
   <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
   </tr>
</table>

<h4 style="text-align:center;">I hereby declare that the information furnished above is true to the best of my knowledge.   </h4>
<br>
<h4 style="text-align:center;">I ,hereby, give my consent to make some or all my data in IITISM website and various other portals of IITISM as and when required by IITISM   </h4>
<br>
 <table width="100%" border="0">
  <tr>
    <td width="25%">Date</td>
    <td width="27%">&nbsp;</td>
    <td width="12%">&nbsp;</td>
    <td width="12%">&nbsp;</td>
    <td>Signature of Student</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
   </tr>
</table>



<hr style="height:1px;border-width:0;color:gray;background-color:gray">
 <!--<div class="info">
 <p><strong>Declaration</strong></p>
 </div>-->
 <table width="100%" border="0" style="page-break-after:always;">
  <tr>
    <td style="font-size: 11px;">
    <br>
      Note : 1. In Case your Date of Birth is showing wrong please submit print out of this form alongwith proof of your DoB in the Academic section
      after your admission process is over.
      <br>
      <!-- Your Admission Number will become your MIS user name and your Registration ID will be your default password.
      <br> -->
      2. In case you have any issue with your credentials you may contact at Academic section with ID Proof within 7 days of registration. This form is to
      be submitted at the time of admission.
<!-- <br>
3. You can also send mail to office.ac@iitism.ac.in in case of above two points with proper proof -->
      <br>
      3. Keep one copy of this print-out for future reference after reporting date is over, this document may not be generated.
      <br>
      <!-- <h4 style="text-align:center;">This form is to be submitted at the time of admission. </h4> -->
    </td>
  </tr>
</table>


<!-- <hr style="height:1px;border-width:0;color:gray;background-color:gray"> -->
<table width="100%" border="0">
  <tr>
    <td style="font-size: 10px; text-align:center;">
      <!-- <strong>NB : Parents can have to login in parent portal using these fields.(Admission No , Account no , Parent mobile).</strong>&nbsp;
<a href="https://www.iitism.ac.in/" ><strong style="color:blue;">https://www.iitism.ac.in/</strong></a> -->
    </td>
  </tr>
</table>
</div>


<!-- Hostel Allotment Form -->
<div class="hostel">
<br><br>
<table width="100%" border="0">
 <tr>
      <!-- <td width="5%" rowspan="2" valign="center"><img src="<?php echo base_url() ?>assets/images/ism/ismlogo.png" width="85" height="70" /></td>
 <td align="center"><img src="<?php echo base_url() ?>assets/images/ism/ismiit1.jpg" width="370" height="25" /><br><img src="<?php echo base_url() ?>assets/images/ism/ismiittext.jpg" width="450" height="35" /><br><img src="<?php echo base_url() ?>assets/images/ism/dh1.jpg" width="270" height="20"/></td> -->
 <td><img src="<?php echo base_url() ?>assets/images/ism/IITISM_Form_Header_blue.png" class="img-fluid" style="margin-bottom:10px; width:720px;"/></td>
    </tr>
    <tr>
         <td><h2 style="text-align: center;font-size: 16px;"><strong>Hostel Allotment Form</strong></h1>

         <!-- <h4 style="text-align: center;font-size: 12px;">PART ONE - STUDENTS PARTICULARS</h4> -->
         </td>

    </tr>
    <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
   </tr>
   </table>



   <div class="panel panel-default">
     <div class="panel-body">


 <table width="100%" border="0" >
 <tr>
   <td width="9%"><b>Name</b></td>
   <td width="15%"><?php echo strtoupper($first_name).' '.strtoupper($middle_name).' '.strtoupper($last_name); ?></td>

   <td width="16%" rowspan="4" valign="top" style="text-align: center;"><img src="<?php echo $photopath;?>" width="120" height="150" ><br><img src="<?php echo $signpath;?>" width="220" height="50" ></td>
 </tr>
 <tr>
 <td><b>Admission Number</b></td>
   <td><?php echo strtoupper($admn_no); ?></td>
 </tr>
 <tr>
   <td><b>Mobile Number</b></td>
   <td><?php echo ucwords($contact_no); ?></td>
 </tr>
 <tr>
   <td><b>Blood Group</b></td>
   <td><?php echo ucwords($blood_group); ?></td>
 </tr>
 </table>


   <table width="100%" border="0">
   <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
   </tr>
   <tr>
   <td width="25%"><b>Course</b></td>
     <td width="25%"> <?php echo ucwords($course); ?></td>
     <td width="25%"><b>Email</b></td>
     <td width="25%">  <?php echo $email; ?></td>
   </tr>
   <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
   </tr>
   <tr>
   <td width="25%"><b>Father Name</b></td>
     <td width="25%"> <?php echo ucwords($father_name); ?></td>
     <td width="25%"><b>Home City</b></td>
     <td width="25%">  <?php echo ucwords($permanent_address_city); ?></td>
   </tr>
   <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
   </tr>
   <tr>
     <td width="25%"><b>Home Address</b></td>
     <td width="50%"><?php echo ucwords($permanent_address_line1).','.ucwords($permanent_address_line2).','.ucwords($permanent_address_city).','.ucwords($permanent_address_state).','.ucwords($permanent_address_pincode); ?></td>

   </tr>
   <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
   </tr>
   <tr>
   <td width="25%"><b>Hostel Name</b></td>
     <td width="25%">  <?php echo ($present_address_line2=='NA' || $present_address_line2=='na') ? 'Not Allocated': ucwords($present_address_line2); ?></td>
     <td width="25%"><b>Hostel Details</b></td>
     <td width="25%">   <?php echo $present_address_line1; ?></td>
   </tr>
   <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
   </tr>
   <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
   </tr>
   <tr>
   <td width="25%"><b>Food Habit</b></td>
     <td width="25%"><?php echo ucwords($food_habit); ?>&nbsp;<input type="checkbox" name="t" class="form-control" checked></td>
     <td width="25%"><b>If Having laptop (Give Details) Make</b></td>
     <td width="25%"><?php echo ucwords($laptop_make); ?></td>
   </tr>
   <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
   </tr>
   <tr>
     <td width="25%"><b>Model Number</b></td>
     <td width="25%"><?php echo $laptop_model; ?></td>
     <td width="25%"><b>Serial Number</b></td>
     <td width="25%"><?php echo $laptop_sl_no; ?></td>
   </tr>
   <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
   </tr>
 </table>

 <hr style="height:1px;border-width:0;color:gray;background-color:gray">
 <!--<div class="info">
 <p><strong>Declaration</strong></p>
 </div>-->
 <table width="100%" border="0">
  <tr>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
    <td style="font-size: 11px;">I will follow all rules governing maintenance of discipline at IITISM and observe the general rules framed for hostel residents.
      <br>
      I also undertake the responsibilities of not possessing / using any two-wheeler  / four-wheelers during my stay at the hostel of the institute. <br>
      <br>
      <h4 style="text-align:center;">This form is to be submitted at the time of admission. ( Not required if Hostel is not allocated) </h4>
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
   </tr>
</table>

 <table width="100%" border="0">
  <tr>
    <td width="25%">(Signature of Father/Guardian with date)</td>
    <td width="27%">&nbsp;</td>
    <td width="12%">&nbsp;</td>
    <td width="12%">&nbsp;</td>
    <td>(Signature of  Student with date)</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
   </tr>
</table>

<hr style="height:1px;border-width:0;color:gray;background-color:gray">
<table width="100%" border="0">
  <tr>
    <td style="font-size: 10px; text-align:center;">
      <!-- <strong>NB : Parents can have to login in parent portal using these fields.(Admission No , Account no , Parent mobile).</strong>&nbsp;
      <a href="https://www.iitism.ac.in/" ><strong style="color:blue;">https://www.iitism.ac.in/</strong></a> -->
    </td>
  </tr>
</table>
</div>