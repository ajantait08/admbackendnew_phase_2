<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <style type="text/css">
    .center {
  display: block;
  margin-left: auto;
  margin-right: auto;
  width: 30%;
}
    img{
  border: 1px solid #ddd;
  border-radius: 4px;
  padding: 5px;
}
.info {
  background-color: #e7f3fe;
  border-left: 6px solid #2196F3;
}
div {
  //margin-bottom: 15px;
  padding: 4px 12px;
  //clear: both;
}
.form-group{
  margin-bottom: 0;
}
label {
margin-bottom: 0;
}

#overlay
{
    display:none;
    position: fixed;
    top: 0px;
    bottom: 0;
    left: 0;
    right: 0;
    margin: auto;
    width: 100%;
    height: 100%;
    z-index: 999;
    background-color: rgba(0,0,0,0.85);

}

#overlay #loading {
    z-index: 9999;
    position: fixed;
    top: 0px;
    bottom: 0;
    left: 0;
    right: 0;
    margin: auto;
    width: 300px;
    height: 300px;
    background-size: 100% 100%;
    opacity: 1;
}
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

#overlay1
{
    display:none;
    position: fixed;
    top: 0px;
    bottom: 0;
    left: 0;
    right: 0;
    margin: auto;
    width: 100%;
    height: 100%;
    z-index: 999;
    background-color: rgba(0,0,0,0.85);

}

#overlay1 #loading1 {
    z-index: 9999;
    position: fixed;
    top: 0px;
    bottom: 0;
    left: 0;
    right: 0;
    margin: auto;
    width: 300px;
    height: 300px;
    background-size: 100% 100%;
    opacity: 1;
}
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

.loading:after {
  content: ' .';
  animation: dots 1s steps(5, end) infinite;
}
@keyframes dots {
  0%, 20% {
    color: rgba(0,0,0,0);
    text-shadow:
      .25em 0 0 rgba(0,0,0,0),
      .5em 0 0 rgba(0,0,0,0);}
  40% {
    color: white;
    text-shadow:
      .25em 0 0 rgba(0,0,0,0),
      .5em 0 0 rgba(0,0,0,0);}
  60% {
    text-shadow:
      .25em 0 0 white,
      .5em 0 0 rgba(0,0,0,0);}
  80%, 100% {
    text-shadow:
      .25em 0 0 white,
      .5em 0 0 white;}}
  </style>
   <!--
  <style type="text/css">
    #disabledbutton {
    pointer-events: none;
    opacity: 1;

}
.form-group.required .control-label:after {
  content:"*";
  color:red;
}
.center {
  display: block;
  margin-left: auto;
  margin-right: auto;
  width: 30%;
}
  </style>

  <--
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.js"></script>
  <--<script type="text/javascript" src="<? //echo base_url(); ?>/assets/js/new_admission_website/dynamic_add.js"></script>-->


<!-- Include Date Range Picker --
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="<?= base_url() ?>assets/js/secure.js"></script>
</head>
<body>

<!-- <nav class="navbar navbar-default navbar-static-top">
    <div class="container-fluid">
		 Brand and toggle get grouped for better mobile display
		<div class="navbar-header" style="float:right">
		<a class="navbar-brand" class="btn btn-primary" href="<?php echo base_url('index.php/new_admission_common/new_admission_common/BtnLogout'); ?>"><span class="glyphicon glyphicon-log-out"></span> Logout</a>
		</div> -->

		<!-- </div> -->
        <!-- /.container-fluid -->
	<!-- </nav> -->
      <div id ="content">
     <div class="container">

<br>
<br>

  <div align="center">
   <img src="<?php echo base_url() ?>assets/images/ism/ismlogo.png" class="img-fluid" width="120px" />
            <h4 id="clg_name">भारतीय प्रौद्योगिकी संस्थान  (भारतीय खनि विद्यापीठ), धनबाद <br>
            Indian Institute of Technology (ISM) Dhanbad</h4>
          </div>
        <!--<img src="<?php //echo base_url() ?>assets/images/ism/iitism_full.png"  width="90%" height="200pxs" class="img-fluid center">-->

    <br>
    <br>
    <div class="panel panel-default">
      <div class="panel-body">
        <div class="info">
  <p><strong>For Office Details</strong></p>
</div>
<table width="100%" border="0">
  <tr>
    <td width="15%"><b>Admission Number</b></td>
    <td width="15%"><?php echo strtoupper($admn_no); ?></td>
    <td width="15%">&nbsp;</td>
    <td width="10%" rowspan="7" valign="top" style="text-align: center;"><img src="<?php echo $photopath;?>" width="150" height="180" ><img src="<?php echo $signpath;?>" width="240" height="60" ></td>
  </tr>
  <tr><?php if($admn_type!='jrf'){?>
    <td><b>Course</b></td>
    <td><?php echo strtoupper($course); ?></td>
    <td>&nbsp;</td>
  <?php }
  else {?>
     <td><b>Department</b></td>
    <td><?php echo strtoupper($department); ?></td>
    <td>&nbsp;</td>
  <?php }?>
  </tr>
  <tr>
    <?php if($admn_type!='jrf'){?>
    <td><b>Branch</b></td>

    <td><?php
       echo strtoupper($branch);
         ?></td>
        <?php }else {?>
          <td><b>Course(JRF)</b></td>
         <td> <?php
           echo strtoupper($this->Phd_mis_reg->get_branch_name_by_id($branch_id)); }
          ?>
      </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><b>Hostel Room Details</b></td>
    <td><?php echo ucwords($present_address_line1).','.ucwords($present_address_line2).','.ucwords($present_address_city).','.ucwords($present_address_state); ?></td>
    <td>&nbsp;</td>
  </tr>
</table>


<div class="info">
<p><strong>Personal Details</strong></p>
</div>
<!--1-->
<div class="row">
<div class="col-md-3">
            <div class="form-group">
              <label for="adult">Name</label>
            </div>
</div>
<div class="col-md-3">
            <div class="form-group">
              <?php echo strtoupper($first_name).' '.strtoupper($middle_name).' '.strtoupper($last_name); ?>
            </div>
</div>
<div class="col-md-3">
            <div class="form-group">
              <label for="adult">नाम</label>
            </div>
</div>
<div class="col-md-3">
            <div class="form-group">
              <?php echo ($name_in_hindi); ?>
            </div>
</div>

</div>
<!--2-->

  <!--3-->
<div class="row">
  <div class="col-md-3">
                <div class="form-group">
                  <label for="adult">Preparatory</label>
                </div>
  </div>
  <div class="col-md-3">
                <div class="form-group">
                <?php echo ucwords($is_prep); ?>
                </div>
  </div>
  <div class="col-md-3">
                <div class="form-group">
                  <label for="adult">Date of Birth</label>
                </div>
  </div>
  <div class="col-md-3">
                <div class="form-group">
                <?php echo date("d M Y", strtotime($dob)); ?>

                </div>
  </div>
</div>
<!--4-->
<div class="row">
<div class="col-md-3">
              <div class="form-group">
                <label for="adult">Mobile Number</label>
              </div>
</div>
<div class="col-md-3">
              <div class="form-group">
              <?php echo ucwords($contact_no); ?>
              </div>
</div>
<div class="col-md-3">
              <div class="form-group">
                <label for="adult">Gender</label>
              </div>
</div>
<div class="col-md-3">
              <div class="form-group">
            <?php if($sex=='m') echo "MALE";else if($sex=='f') echo "FEMALE";else echo "TRANSGENDER" ?>

              </div>
</div>
</div>
<!--5-->
<div class="row">
<div class="col-md-3">
              <div class="form-group">
                <label for="adult">Nationality</label>
              </div>
</div>
<div class="col-md-3">
              <div class="form-group">
              <?php echo ucwords($nationality); ?>
              </div>
</div>
<div class="col-md-3">
              <div class="form-group">
                <label for="adult">Category</label>
              </div>
</div>
<div class="col-md-3">
              <div class="form-group">
            <?php echo $category; ?>

              </div>
</div>
</div>
<!--6-->
<div class="row">
<div class="col-md-3">
              <div class="form-group">
                <label for="adult">Allocated Category</label>
              </div>
</div>
<div class="col-md-3">
              <div class="form-group">
              <?php echo ucwords($allocated_category); ?>
              </div>
</div>
<?php if ($aadhar_no != '') { ?>

<div class="col-md-3">
              <div class="form-group">
                <label for="adult">Aadhaar No</label>
              </div>
</div>
<div class="col-md-3">
              <div class="form-group">
            <?php echo $aadhar_no; ?>

              </div>
</div>

<?php } ?>

<?php if ($passport_no != '') { ?>

  <div class="col-md-3">
                <div class="form-group">
                  <label for="adult">Passport No</label>
                </div>
  </div>
  <div class="col-md-3">
                <div class="form-group">
              <?php echo $passport_no; ?>

                </div>
  </div>

  <?php } ?>
</div>

<!--7-->
<div class="row">
<div class="col-md-3">
              <div class="form-group">
                <label for="adult">Divyang</label>
              </div>
</div>
<div class="col-md-3">
              <div class="form-group">
              <?php echo ucwords($pd_status); ?>
              </div>
</div>
<div class="col-md-3">
              <div class="form-group">
                <label for="adult">Marital Status</label>
              </div>
</div>
<div class="col-md-3">
              <div class="form-group">
              <?php echo ucwords($marital_status); ?>
              </div>
</div>
</div>
<div class="row">
<div class="col-md-3">
              <div class="form-group">
                <label for="adult">Blood Group</label>
              </div>
</div>
<div class="col-md-3">
              <div class="form-group">
              <?php echo ucwords($blood_group); ?>
              </div>
</div>
<div class="col-md-3">
              <div class="form-group">
                <label for="adult">Religion</label>
              </div>
</div>
<div class="col-md-3">
              <div class="form-group">
              <?php echo ucwords($religion); ?>
              </div>
</div>
</div>
<div class="row">
<div class="col-md-3">
              <div class="form-group">
                <label for="adult">Kashmiri Immigrant</label>
              </div>
</div>
<div class="col-md-3">
              <div class="form-group">
              <?php echo ucwords($kashmiri_immigrant); ?>
              </div>
</div>
<div class="col-md-3">
              <div class="form-group">
                <label for="adult">Birth Place</label>
              </div>
</div>
<div class="col-md-3">
              <div class="form-group">
              <?php echo ucwords($birth_place); ?>
              </div>
</div>

</div>
<div class="info">
<p><strong>Family Details</strong></p>
</div>
<div class="row">
<div class="col-md-3">
              <div class="form-group">
                <label for="adult">Father Name</label>
              </div>
</div>
<div class="col-md-3">
              <div class="form-group">
              <?php echo ucwords($father_name); ?>
              </div>
</div>
<div class="col-md-3">
              <div class="form-group">
                <label for="adult">Mother Name</label>
              </div>
</div>
<div class="col-md-3">
              <div class="form-group">
              <?php echo ucwords($mother_name); ?>
              </div>
</div>
</div>
<div class="row">
<div class="col-md-3">
              <div class="form-group">
                <label for="adult">Father Occupation</label>
              </div>
</div>
<div class="col-md-3">
              <div class="form-group">
              <?php echo ucwords($fathers_occupation); ?>
              </div>
</div>
<div class="col-md-3">
              <div class="form-group">
                <label for="adult">Mother Occupation</label>
              </div>
</div>
<div class="col-md-3">
              <div class="form-group">
              <?php echo ucwords($mothers_occupation); ?>
              </div>
</div>
</div>
<div class="row">
<div class="col-md-3">
              <div class="form-group">
                <label for="adult">Father Income</label>
              </div>
</div>
<div class="col-md-3">
              <div class="form-group">
              <?php echo ucwords($father_income); ?>
              </div>
</div>
<div class="col-md-3">
              <div class="form-group">
                <label for="adult">Mother Income</label>
              </div>
</div>
<div class="col-md-3">
              <div class="form-group">
              <?php echo ucwords($mother_income); ?>
              </div>
</div>
</div>
<div class="row">
<div class="col-md-3">
              <div class="form-group">
                <label for="adult">Parent Mobile No</label>
              </div>
</div>
<div class="col-md-3">
              <div class="form-group">
              <?php echo ucwords($parent_mobile_no); ?>
              </div>
</div>
<div class="col-md-3">
              <div class="form-group">
                <label for="adult">Parent Email Id</label>
              </div>
</div>
<div class="col-md-3">
              <div class="form-group">
              <?php echo ucwords($parent_email_id); ?>
              </div>
</div>
</div>
<div class="row">
<div class="col-md-3">
              <div class="form-group">
                <label for="adult">Guardian Name</label>
              </div>
</div>
<div class="col-md-3">
              <div class="form-group">
              <?php echo ucwords($guardian_name); ?>
              </div>
</div>
<div class="col-md-3">
              <div class="form-group">
                <label for="adult">Guardian Relation</label>
              </div>
</div>
<div class="col-md-3">
              <div class="form-group">
              <?php echo ucwords($guardian_relation); ?>
              </div>
</div>
</div>
<div class="info">
<p><strong>Permanent Address</strong></p>
</div>

<div class="row">
<div class="col-md-3">
              <div class="form-group">
                <label for="adult">Permanent Address</label>
              </div>
</div>
<div class="col-md-3">
              <div class="form-group">
              <?php echo ucwords($permanent_address_line1).','.ucwords($permanent_address_line2); ?>
              </div>
</div>
<div class="col-md-3">
              <div class="form-group">
                <label for="adult">City</label>
              </div>
</div>
<div class="col-md-3">
              <div class="form-group">
              <?php echo ucwords($permanent_address_city); ?>
              </div>
</div>
</div>
<div class="row">
<div class="col-md-3">
              <div class="form-group">
                <label for="adult">State</label>
              </div>
</div>
<div class="col-md-3">
              <div class="form-group">
            <?php echo ucwords($permanent_address_state).','.ucwords($permanent_address_country); ?>
              </div>
</div>
<div class="col-md-3">
              <div class="form-group">
                <label for="adult">Pincode</label>
              </div>
</div>
<div class="col-md-3">
              <div class="form-group">
              <?php echo $permanent_address_pincode; ?>
              </div>
</div>
</div>

<div class="info">
<p><strong>Admission Details </strong></p>
</div>

<div class="row">
  <div class="col-md-3">
              <div class="form-group">
                <label for="adult">Admission Based On</label>
              </div>
  </div>
  <div class="col-md-3">
              <div class="form-group">
              <?php echo strtoupper($admn_based_on);?>
              </div>
  </div>
  <div class="col-md-3">
              <div class="form-group">
                   <?php if($admn_type=='jee'){?>
                <label for="adult">JEE Main Application Number</label>
              <?php }
              else if($admn_type=='msc'){?>
                <label for="adult">Registration Number</label>
              <?php }
              else if($admn_type=='msctech'){?>
                <label for="adult">Registration Number</label>
                <?php }
                else if($admn_type=='mtech'){?>
                 <label for="adult">IITISM Registration Number</label>
                <?php }
                else if($admn_type=='jrf'){?>
                 <label for="adult">Registration Number</label>
                <?php }
                else if($admn_type=='mba'){?>
                 <label for="adult">Registration Number</label>
                <?php }
                else if($admn_type=='mtech_3yr'){?>
                <label for="adult">MTECH_3YR Registration Number</label>
                <?php } ?>
              </div>
  </div>
  <div class="col-md-3">
              <div class="form-group">
              <?php if($admn_type=='jee'){echo strtoupper($reg_id)?>
              <?php }
              elseif($admn_type=='jrf') {
                echo strtoupper($registration_no);
              }elseif($admn_type=='mtech') {
                echo strtoupper($registration_no);
              } else {echo strtoupper($jam_reg_id);}?>
              </div>
  </div>
 <!-- <div style="clear:both"></div> -->
<div class="col-md-3">
              <div class="form-group">
                  <?php if($admn_type=='jee'){?>
                <label for="adult">JEE Rank</label>
              <?php }
              else if($admn_type=='msc'){?>
                <label for="adult">Rank</label>
              <?php }
              else if($admn_type=='msctech'){?>
                <label for="adult">Rank</label>
                <?php }
                else if($admn_type=='mtech'){
               if(strtolower($admn_based_on)=='gate'){?>
                 <label for="adult">Gate Score</label>
               <?php }else { ?>
                <label for="adult">Rank</label>
               <?php }
              }
                else if($admn_type=='jrf'){
                  if(strtolower($admn_based_on)=='gate'){?>
                 <label for="adult">Gate Score</label>
               <?php }
               else {?>

                 <label for="adult">Rank</label>
                <?php } }
                else if($admn_type=='mba'){?>
                 <label for="adult">Cat Score</label>
                <?php }
                else if($admn_type=='mtech_3yr'){?>
                <label for="adult">Rank</label>
                <?php } ?>

              </div>
</div>
<div class="col-md-3">
              <div class="form-group">
               <?php if($admn_type=='jee'){?>
                <?php echo $iit_jee_rank; ?>
              <?php }
              else if($admn_type=='msc'){?>
                <?php echo $other_rank; ?>
              <?php }
              else if($admn_type=='msctech'){?>
                <?php echo $other_rank; ?>
                <?php }
                else if($admn_type=='mtech'){?>
                 <?php if($admn_based_on=='gate'){echo $gate_score;}
                 else if($admn_based_on=='ismee'){echo $other_rank;}
                 else {echo $other_rank;}
                 ?>
                <?php }
                else if($admn_type=='jrf'){?>

                 <?php if($admn_based_on=='gate'){echo $gate_score;}
                 else {echo $other_rank;} ?>
                <?php }
                else if($admn_type=='mba'){?>
                  <?php if($admn_based_on=='cat'){echo $cat_score;}
                 else {echo $other_rank;} ?>
                <?php }
                else if($admn_type=='mtech_3yr'){?>
                 <?php if($admn_based_on=='gate'){echo $gate_score;}
                 else if($admn_based_on=='ismee'){echo $other_rank;} ?>
                <?php } ?>
              </div>
</div>
<div class="col-md-3">
              <div class="form-group">
                <?php if($admn_type=='jee'){?>
                <label for="adult">JEE Category Rank</label>
              <?php }
              else if($admn_type=='mba' || $admn_type=='jrf' || $admn_type=='mtech'){?>
                <label for="adult">Type</label>
              <?php }
              else if($admn_type=='msc' || $admn_type=='msctech'){?>
                <label for="adult">Application Id</label>
              <?php }
              else{?>
              <label for="adult">Application Id</label>
            <?php }?>

              </div>
</div>
<div class="col-md-3">
              <div class="form-group">
                <?php if($admn_type=='jee'){?>
              <?php echo $iit_jee_cat_rank; ?>
                 <?php }
              else {?>
                <?php echo ucwords($enrollment_no); }?>

              </div>
</div>
 <!-- <div style="clear:both"></div> -->
<div class="col-md-3">
            <div class="form-group">
              <label for="adult">Admission Date</label>
            </div>
</div>


<div class="col-md-3">
            <div class="form-group">
                <?php echo date("d M Y", strtotime($admn_date)); ?>
            </div>
</div>
<div class="col-md-3">
            <div class="form-group">
              <label for="adult">Migration Certificate Number</label>
            </div>
</div>


<div class="col-md-3">
            <div class="form-group">
              <?php if($migration_cert1){ echo $migration_cert1; } else { echo 'NA';} ?>
            </div>
</div>

</div>

<!-- Academic Table -->
<div class="info">
<p><strong>Academic Details</strong></p>
</div>
<table class="table">
    <thead>
      <tr>
        <th class="text-center">Examination</th>
        <th class="text-center">Board | Institution</th>
        <th>Year of Passing</th>
        <th class="text-center">Grade/Percentage</th>
        <th class="text-center">Division</th>
        <th class="text-center">Subject</th>
      </tr>
    </thead>
    <tbody>
<?php
foreach($stu_prev_education as $key => $education)
{
?>
      <tr>
        <td><?= $education['specialization']; ?></td>
        <td><?= $education['exam']; ?> | <?= $education['institute']; ?></td>
        <td><?= $education['year']; ?></td>
        <td><?= $education['grade']; ?></td>
        <td><?= $education['division']; ?></td>
        <td><?= $stu_prev_certificate[$key]['sub']; ?></td>
      </tr>
      <tr>
<?php
}
?>
    </tbody>
  </table>
  <!-- Academic Table -->

<!-- Stop for academic details -->
<!-- <div class="info">
<p><strong>Academic Details</strong></p>
</div>

<div class="row">
<div class="col-md-2">
              <div class="form-group">
                <label for="adult">Examination</label>
              </div>
</div>
<div class="col-md-2">
              <div class="form-group">
                <label for="adult">Board | Institution</label>
              </div>
</div>
<div class="col-md-2">
              <div class="form-group">
                <label for="adult">Year of Passing</label>
              </div>
</div>
<div class="col-md-2">
              <div class="form-group">
                <label for="adult">Grade/Percentage</label>
              </div>
</div>
<div class="col-md-2">
              <div class="form-group">
                <label for="adult">Division</label>
              </div>
</div>
<div class="col-md-2">
              <div class="form-group">
                <label for="adult">Subject</label>
              </div>
</div> -->

<?php
/*
foreach($stu_prev_education as $key => $education)
{
?>

<div class="col-md-2">
              <div class="form-group">
                <?php echo $education['specialization']; ?>
              </div>
</div>
<div class="col-md-2">
              <div class="form-group">
              <?php echo $education['exam']; ?> | <?php echo $education['institute']; ?>
              </div>
</div>
<div class="col-md-2">
              <div class="form-group">
                <?php echo $education['year']; ?>
              </div>
</div>
<div class="col-md-2">
              <div class="form-group">
              <?php echo $education['grade']; ?>
              </div>
</div>
<div class="col-md-2">
              <div class="form-group">
              <?php echo $education['division']; ?>
              </div>
</div>
<div class="col-md-2">
              <div class="form-group">
              <?php echo $stu_prev_certificate[$key]['sub']; ?>
              </div>
</div>

<?php
}
/*
?>
<div class="col-md-2">
              <div class="form-group">
                <?php echo $exam0; ?>
              </div>
</div>
<div class="col-md-2">
              <div class="form-group">
                <?php echo $institute0; ?>
              </div>
</div>
<div class="col-md-2">
              <div class="form-group">
                <?php echo $year0; ?>
              </div>
</div>
<div class="col-md-2">
              <div class="form-group">
              <?php echo $grade0; ?>
              </div>
</div>
<div class="col-md-2">
              <div class="form-group">
              <?php echo $division0; ?>
              </div>
</div>
<div class="col-md-2">
              <div class="form-group">
              <?php echo $sub0; ?>
              </div>
</div>
<div class="col-md-2">
              <div class="form-group">
                <?php echo $exam1; ?>
              </div>
</div>
<div class="col-md-2">
              <div class="form-group">
                <?php echo $institute1; ?>
              </div>
</div>
<div class="col-md-2">
              <div class="form-group">
                <?php echo $year1; ?>
              </div>
</div>
<div class="col-md-2">
              <div class="form-group">
              <?php echo $grade1; ?>
              </div>
</div>
<div class="col-md-2">
              <div class="form-group">
              <?php echo $division1; ?>
              </div>
</div>
<div class="col-md-2">
              <div class="form-group">
              <?php echo $sub1; ?>
              </div>
</div>
<?php */ ?>
</div>





<div class="info">
<p><strong>Parent Bank Details</strong></p>
</div>
<div class="row">
<div class="col-md-3">
              <div class="form-group">
                <label for="adult">Bank Name</label>
              </div>
</div>
<div class="col-md-3">
              <div class="form-group">
            <?php echo $bank_name; ?>
              </div>
</div>
<div class="col-md-3">
              <div class="form-group">
                <label for="adult">Account Number</label>
              </div>
</div>
<div class="col-md-3">
              <div class="form-group">
            <?php echo $account_no; ?>
              </div>
</div>
</div>






<div class="info">
<p><strong>Fees Details</strong></p>
</div>

<div class="row">
<div class="col-md-3">
              <div class="form-group">
                <label for="adult">Fee Mode</label>
              </div>
</div>
<div class="col-md-3">
              <div class="form-group">
            <?php echo $fee_mode; ?>
              </div>
</div>
<div class="col-md-3">
              <div class="form-group">
                <label for="adult">Fee Amount</label>
              </div>
</div>
<div class="col-md-3">
              <div class="form-group">
            <?php echo $fee_amount; ?>
              </div>
</div>
</div>
<div class="row">
<div class="col-md-3">
              <div class="form-group">
                <label for="adult">Fee Date</label>
              </div>
</div>
<div class="col-md-3">
              <div class="form-group">

                <?php echo date("d M Y", strtotime($fee_date)); ?>

              </div>
</div>

<div class="col-md-3">
              <div class="form-group">
                <label for="adult">Transaction Id</label>
              </div>
</div>
<div class="col-md-3">
              <div class="form-group">
            <?php echo $transaction_id; ?>
              </div>
</div>
</div>








<div class="info">
<p><strong>Other Details</strong></p>
</div>
<div class="row">
<div class="col-md-3">
              <div class="form-group">
                <label for="adult">Identification Mark</label>
              </div>
</div>
<div class="col-md-3">
              <div class="form-group">
            <?php echo $identification_mark; ?>
              </div>
</div>
<div class="col-md-3">
              <div class="form-group">
                <label for="adult">Favourite Past Time</label>
              </div>
</div>
<div class="col-md-3">
              <div class="form-group">
            <?php echo $fav_past_time; ?>
              </div>
</div>
</div>
<div class="row">
<div class="col-md-3">
              <div class="form-group">
                <label for="adult">Extra Curricular Activity</label>
              </div>
</div>
<div class="col-md-3">
              <div class="form-group">
            <?php echo $extra_curricular_activity; ?>
              </div>
</div>
<div class="col-md-3">
              <div class="form-group">
                <label for="adult">Other Relevant Info</label>
              </div>
</div>
<div class="col-md-3">
              <div class="form-group">
            <?php echo $other_relevant_info; ?>
              </div>
</div>
</div>
<div class="row">
<div class="col-md-3">
              <div class="form-group">
                <label for="adult">Alternate Mobile No</label>
              </div>
</div>
<div class="col-md-3">
              <div class="form-group">
            <?php echo $alternate_mobile_no; ?>
              </div>
</div>
<div class="col-md-3">
              <div class="form-group">
                <label for="adult">Alternate Email Id</label>
              </div>
</div>
<div class="col-md-3">
              <div class="form-group">
            <?php echo $alternate_email_id; ?>
              </div>
</div>
 <div style="clear:both"></div>
<div class="col-md-3">
              <div class="form-group">
                <label for="adult">Hobbies</label>
              </div>
</div>

<div class="col-md-3">
              <div class="form-group">
            <?php echo $hobbies; ?>
              </div>
</div>
</div>




</div><!-- body panel-->

<!---------------- END ------------------------>

<!-- </div> -->
<!-- </div> -->

<div class="form-group">
      <div class="col-sm-offset-2 col-sm-10" align="center">
        <!--<button type="submit" name="action" value="submit" class="btn btn-primary">Download</button>-->
    <?php
    echo '<center>';
echo '<a class="btn btn-primary" href="'.base_url().'index.php/admission/phd/Adm_phd_mis_registration_other_details/download_pdf/'.$admn_no.'/'.$admn_type.'/'.$registration_no.'">Download</a>';
?>
&nbsp;
<?php
echo '<a class="btn btn-default" href="'.base_url().'index.php/admission/phd/Adm_phd_application_preview'.'">Back To HomePage</a>';
    echo '</center>';

    ?>
    </div>
 </div>
</div>
</div>
</body>
</html>


<script type="text/javascript">

        document.onreadystatechange = function() {
            //console.log(document.readyState);
            if (document.readyState !== 'complete') {
                $('#content').css('display', 'none');
                $('#overlay').css('display', 'block');
                  //alert('Page loading is not complete');
//                 document.querySelector(
//                   "body").style.visibility = "hidden";
//                 document.querySelector(
//                   "#overlay").style.visibility = "visible";
            } else {
                $('#content').css('display', 'block');
                $('#overlay').css('display', 'none');
                 //alert('Page loading complete');
//                 document.querySelector(
//                   "#loader").style.display = "none";
//                 document.querySelector(
//                   "body").style.visibility = "visible";
            }
        };
    
</script>
