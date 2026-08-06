<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="admission_form_success">
<link rel="icon" sizes="16x16" href="<?php echo base_url();?>uploads/logo.png">
<title>Admission Submitted - ACHARYA ENGLISH MEDIUM SCHOOL AND JR.COLLEGE, BARAMATI</title>
<link href="<?php echo base_url();?>optimum/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>optimum/plugins/bower_components/bootstrap-extension/css/bootstrap-extension.css" rel="stylesheet">
<link href="<?php echo base_url();?>optimum/css/animate.css" rel="stylesheet">
<link href="<?php echo base_url();?>optimum/css/style.css" rel="stylesheet">
<link href="<?php echo base_url();?>optimum/css/colors/megna.css" id="theme" rel="stylesheet">
<link href="<?php echo base_url();?>optimum/plugins/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet">
<style type="text/css">
  @media (max-width:768px){
    .panel-blue, .panel-info { box-shadow: unset; }
    .alogo{ width: auto!important; }
    .panel .panel-body { padding: 5px !important; }
    .headr{ padding: 5px !important; }
  }
  .note{ color: #333; }
  .form-control { border: 1px solid #9E9E9E; border-radius: 4px; }
  .form-control:focus { box-shadow: none; border-color: #2b2b2b; background: #faebd74d; }
  .status-box{ background:#fff3cd; border:1px solid #ffc107; border-radius:8px; padding:15px; margin:15px 0; }
  .status-box .label{ font-size:14px; padding:5px 15px; }
</style>
</head>
<body>
<div class="preloader"><div class="cssload-speeding-wheel"></div></div>
<div class="container">
  <div class="row mt-5">
    <div class="col-sm-12">
      <div class="panel panel-info">
        <div class="panel-wrapper collapse in" aria-expanded="true">
          <div class="panel-body table-responsive" style="padding: 0px;overflow-x: hidden;">
            <div class="row headr" style="padding: 15px 25px 0px 25px;">
              <div class="col-sm-2 text-center">
                <img src="<?php echo base_url();?>uploads/logo.png" class="alogo" style="width: 100%;height: 125px;"/>
              </div>
              <div class="col-sm-10">
                <h2 align="center" style="display: inline;">ACHARYA ENGLISH MEDIUM SCHOOL AND JR.COLLEGE, BARAMATI</h2>
              </div>
            </div>

            <div class="row panel-body">
              <div class="col-sm-12">
                <div class="panel-heading" style="padding: 10px 15px;"> <i class="fa fa-check-circle-o"></i>&nbsp;&nbsp;Admission Status</div>
              </div>
            </div>

            <div class="row panel-body pt-0">
              <div class="col-sm-12 text-center" style="padding: 20px 0;">
                <h3 style="color: #4CAF50;margin-top:15px;"><i class="fa fa-check-circle"></i>&nbsp;Admission Form Submitted Successfully!</h3>
                <div class="status-box">
                  <p style="font-size:16px;margin-bottom:5px;"><b>Application ID:</b> #<?php echo $inserted_id; ?></p>
                  <p style="font-size:16px;margin-bottom:0;"><b>Admission Status:</b>&nbsp;<span class="label label-warning">Pending</span></p>
                </div>
                <p style="font-size:14px;color:#666;">Your application has been submitted and is pending for admin approval.</p>
                <p style="font-size:14px;color:#666;">Please visit the school office with original documents for verification.</p>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="<?php echo base_url();?>optimum/plugins/bower_components/jquery/dist/jquery.min.js"></script>
<script src="<?php echo base_url();?>optimum/bootstrap/dist/js/tether.min.js"></script>
<script src="<?php echo base_url();?>optimum/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>optimum/plugins/bower_components/bootstrap-extension/js/bootstrap-extension.min.js"></script>
<script>$(window).load(function(){ $(".preloader").fadeOut(); });</script>
</body>
</html>
