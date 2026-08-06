<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="admission_form">
<link rel="icon" sizes="16x16" href="<?php echo base_url();?>uploads/logo.png">
<title>Admission Form - <?php echo $this->db->get_where('settings', array('type' => 'school_name'))->row()->description; ?></title>
<link href="<?php echo base_url();?>optimum/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>optimum/plugins/bower_components/bootstrap-extension/css/bootstrap-extension.css" rel="stylesheet">
<link href="<?php echo base_url();?>optimum/css/animate.css" rel="stylesheet">
<link href="<?php echo base_url();?>optimum/css/style.css" rel="stylesheet">
<link href="<?php echo base_url();?>optimum/css/colors/megna.css" id="theme" rel="stylesheet">
<link href="<?php echo base_url();?>optimum/plugins/bower_components/toast-master/css/jquery.toast.css" rel="stylesheet">
<link href="<?php echo base_url();?>optimum/plugins/bower_components/bootstrap-select/bootstrap-select.min.css" rel="stylesheet">
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
                <p><?php echo $this->db->get_where('settings', array('type' => 'school_name'))->row()->description; ?></p>
                <h2 align="center" style="display: inline;"><?php echo $this->db->get_where('settings', array('type' => 'school_name'))->row()->description; ?></h2>
                <p><?php echo $this->db->get_where('settings', array('type' => 'address'))->row()->description; ?></p>
              </div>
            </div>

            <form action="<?php echo base_url();?>pre_student/create/<?php echo $qr_token; ?>" class="form-horizontal form-groups-bordered validate" enctype="multipart/form-data" method="post" accept-charset="utf-8">

              <div class="row panel-body">
                <div class="col-sm-12">
                  <div class="panel-heading" style="padding: 10px 15px;"> <i class="fa fa-list"></i>&nbsp;&nbsp;Admission Form&nbsp;-&nbsp;<span style="color: #E91E63;">विद्यार्थ्यांनी शाळा सोडल्याच्या मूळ दाखल्यामधील माहिती जशीच्या तशी फॉर्ममध्ये भरावी. दाखल्यावरील कोणत्याही तपशीलात बदल करू नये.</span></div>
                </div>
              </div>

              <div class="row panel-body pb-0">
                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="col-md-12">Academic Year<span class="bg-require">*</span></label>
                    <div class="col-sm-12">
                      <select name="ad_year" class="form-control select2" required readonly>
                        <option value="<?php echo $current_year; ?>"><?php echo $current_year; ?></option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-12">Admission Std<span class="bg-require">*</span></label>
                    <div class="col-sm-12">
                      <select name="class_id" class="form-control" id="class_id" onchange="return get_class_sections(this.value)" required>
                        <option value="">Select</option>
                        <?php foreach($classes as $cls): ?>
                        <option value="<?php echo $cls['class_id']; ?>"><?php echo $cls['name']; ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-9">Division<span class="bg-require">*</span></label>
                    <div class="col-sm-12">
                      <select name="section_id" class="form-control select2" style="width:100%" id="section_selector_holder" required readonly>
                        <option value="">Select Standard First</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="col-md-12">Board Name<span class="bg-require">*</span></label>
                    <div class="col-sm-12">
                      <select name="board_id" id="board_id" class="form-control" onchange="return set_document()" required>
                        <option value="">Select</option>
                        <?php foreach($boards as $brd): ?>
                        <option value="<?php echo $brd['board_id']; ?>"><?php echo $brd['board_name']; ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group" id="ifShow" style="display: none;">
                    <label class="col-md-9">Select Your Group And Subject<span class="bg-require">*</span></label>
                    <div class="col-sm-12">
                      <select name="group_id" id="group_id" class="form-control" required readonly>
                        <option value="">Select Standard First</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-12">Saral Number</label>
                    <div class="col-sm-12">
                      <input type="text" class="form-control" name="student_no">
                    </div>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="col-md-12">Student UID Number(Aadhar Card)<span class="bg-require">*</span></label>
                    <div class="col-sm-12">
                      <input type="number" class="form-control" name="uid" minlength="12" maxlength="12" required>
                    </div>
                  </div>
                </div>
              </div>
            </div>

              <div class="row panel-body pt-0 pb-0">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label class="col-md-12">Full Name(Surname First)<span class="bg-require">*</span></label>
                    <div class="col-sm-12">
                      <input type="text" class="form-control" name="name" required>
                    </div>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="col-md-12">Full Name Of Father<span class="bg-require">*</span></label>
                    <div class="col-sm-12">
                      <input type="text" class="form-control" name="father_name" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-12">Mother Name<span class="bg-require">*</span></label>
                    <div class="col-sm-12">
                      <input type="text" class="form-control" name="mother_name" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-9">Parent Mobile No<span class="bg-require">*</span></label>
                    <div class="col-sm-12">
                      <input type="text" class="form-control" name="parent_phone" maxlength="10" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-12">Religion<span class="bg-require">*</span></label>
                    <div class="col-sm-12">
                      <select name="re_id" id="rel" class="form-control select2" onchange="return get_religion_category(this.value)" required>
                        <option value="">Select</option>
                        <?php foreach($religions as $rel): ?>
                        <option value="<?php echo $rel['religion_id']; ?>"><?php echo $rel['religion_name']; ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-12">Category<span class="bg-require">*</span></label>
                    <div class="col-sm-12">
                      <select name="cat_id" id="cat" class="form-control select2" onchange="return get_category_cast(this.value)" required>
                        <option value="">Select</option>
                        <?php foreach($categories as $cat): ?>
                        <option value="<?php echo $cat['category_id']; ?>"><?php echo $cat['cat_name']; ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-9">Caste<span class="bg-require">*</span></label>
                    <div class="col-sm-12">
                      <select name="cast_id" class="form-control select2" id="section_selector_holder_cast">
                        <option value="">Select Category First</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="col-md-9">Student Mobile No<span class="bg-require">*</span></label>
                    <div class="col-sm-12">
                      <input type="number" class="form-control" name="phone" maxlength="10" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-9">Nationality<span class="bg-require">*</span></label>
                    <div class="col-sm-12">
                      <select name="nationality" class="form-control select2" style="width:100%" required>
                        <option value="">Select</option>
                        <option value="Indian" selected>Indian</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-9">Birth Place<span class="bg-require">*</span></label>
                    <div class="col-sm-12">
                      <input type="text" class="form-control" name="birth_place" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-9">Gender<span class="bg-require">*</span></label>
                    <div class="col-sm-12">
                      <select name="sex" class="form-control select2" style="width:100%" required>
                        <option value="">Select</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-12">Prev School Name<span class="bg-require">*</span></label>
                    <div class="col-sm-12">
                      <input type="text" name="ps_id" class="form-control" required list="prev_school_list" placeholder="Type or select Previous School">
                      <datalist id="prev_school_list">
                        <?php if(!empty($previous_schools)): foreach($previous_schools as $ps): ?>
                          <option value="<?php echo htmlspecialchars($ps['name']); ?>">
                        <?php endforeach; endif; ?>
                      </datalist>
                    </div>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="col-md-12">Blood Group</label>
                    <div class="col-sm-12">
                      <input type="text" class="form-control" name="blood_gp">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-12">Mother Tongue<span class="bg-require">*</span></label>
                    <div class="col-sm-12">
                      <select name="mt_id" id="mt" class="form-control select2" required>
                        <option value="">Select</option>
                        <?php foreach($mother_tongues as $mt): ?>
                        <option value="<?php echo $mt['mother_tongue_id']; ?>"><?php echo $mt['mother_tongue_name']; ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-9">Full Address<span class="bg-require">*</span></label>
                    <div class="col-sm-12">
                      <input type="text" name="address" class="form-control" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-9">Date Of Birth<span class="bg-require">*</span></label>
                    <div class="col-sm-12">
                      <input type="date" class="form-control datepicker" name="birthday" required>
                      <input type="hidden" name="src" value="1">
                    </div>
                  </div>
                </div>
              </div>

              <div class="row panel-body pt-0">
                <div class="col-sm-12 pb-4">
                  <div class="panel-heading" style="padding: 10px 0px;background: #fff;"> <i class="fa fa-file"></i>&nbsp;&nbsp;Documents</div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="col-md-9">Leaving Certificate (Original)<span class="bg-require">*</span></label>
                    <div class="col-sm-12">
                      <input type="file" name="leaving_certificate" onChange="readURL(this);" style="color:red" accept=".pdf,.png,.jpeg,.jpg" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-9">Marksheet<span class="bg-require">*</span></label>
                    <div class="col-sm-12">
                      <input type="file" name="marksheet" onChange="readURL(this);" style="color:red" accept=".pdf,.png,.jpeg,.jpg" required>
                    </div>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="col-md-9">Aadhar Card (Student)<span class="bg-require">*</span></label>
                    <div class="col-sm-12">
                      <input type="file" name="aadhar_card_student" onChange="readURL(this);" style="color:red" accept=".pdf,.png,.jpeg,.jpg" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-9">Student Photo(Passport Size)</label>
                    <div class="col-sm-12">
                      <input type="file" name="userfile" onChange="readURL(this);" style="color:red">
                      <img id="blah" src="<?php echo base_url();?>uploads/default_avatar.jpg" alt="your image" height="150" width="150" style="border:1px dotted red">
                    </div>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="col-md-9">Aadhar Card (Father/Mother)</label>
                    <div class="col-sm-12">
                      <input type="file" name="aadhar_card_parent" onChange="readURL(this);" style="color:red" accept=".pdf,.png,.jpeg,.jpg">
                    </div>
                  </div>
                  <div class="form-group" id="forcbse" style="display: none;">
                    <label class="col-md-9" id="forcbse">Migration/Eligibility Certificate</label>
                    <div class="col-sm-12">
                      <input type="file" id="ifYes" name="migration_certificate" onChange="readURL(this);" style="color:red" accept=".pdf,.png,.jpeg,.jpg">
                    </div>
                  </div>
                </div>
                <div class="col-sm-12 note">
                  <p><b>प्रवेशासाठी आवश्यक कागदपत्रे:</b></p>
                  <ol>
                    <li>शाळा सोडल्याचा मूळ दाखला</li>
                    <li>Migration Certificate फक्त मूळ प्रतीत स्वीकारले जाईल, SSC Board सोडुन Other State Board असल्यास E.g- CBSC, ICSC, Other</li>
                    <li>गुणपत्रिकेची झेरॉक्स प्रत</li>
                    <li>जात प्रमाणपत्राची झेरॉक्स प्रत (अनुसूचित जाती, जमाती, ओ.बी.सी. इत्यादींसाठी)</li>
                    <li>विद्यार्थीच्या आधार कार्डची झेरॉक्स प्रत</li>
                    <li>आई-वडिलांच्या आधार कार्डची झेरॉक्स प्रत</li>
                    <li>विद्यार्थ्याचे पासपोर्ट साइज छायाचित्र (2 प्रती)</li>
                  </ol>
                  <p><b>टीप:</b> शाळा सोडल्याचा मूळ दाखला आणि मायग्रेशन सर्टिफिकेट (असेल तर) मूळ स्वरूपात जमा केल्याशिवाय प्रवेश निश्चित केला जाणार नाही.</p>
                </div>
              </div>

              <div class="form-group">
                <input type="hidden" name="academy_id" value="<?php echo $academy_id; ?>">
                <?php if(!empty($academy_name)): ?>
                <div class="col-sm-12 text-center" style="margin-bottom:10px;">
                  <span style="background:#E91E63;color:#fff;padding:6px 20px;border-radius:20px;font-size:14px;font-weight:bold;"><i class="fa fa-graduation-cap"></i>&nbsp;<?php echo html_escape($academy_name); ?></span>
                </div>
                <?php endif; ?>
                <button type="submit" class="btn btn-success btn-sm btn-rounded btn-block"> <i class="fa fa-plus"></i>&nbsp;Save Student</button>
                <img id="install_progress" src="<?php echo base_url();?>assets/images/loader-2.gif" style="margin-left: 20px; display: none"/>
              </div>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="<?php echo base_url();?>optimum/plugins/bower_components/jquery/dist/jquery.min.js"></script>
<script src="<?php echo base_url();?>optimum/plugins/bower_components/bootstrap-select/bootstrap-select.min.js"></script>
<script src="<?php echo base_url();?>optimum/bootstrap/dist/js/tether.min.js"></script>
<script src="<?php echo base_url();?>optimum/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>optimum/plugins/bower_components/bootstrap-extension/js/bootstrap-extension.min.js"></script>
<script src="<?php echo base_url();?>optimum/plugins/bower_components/toast-master/js/jquery.toast.js"></script>
<script src="<?php echo base_url();?>optimum/js/custom.min.js"></script>
<script type="text/javascript">
function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) { $('#blah').attr('src', e.target.result); }
    reader.readAsDataURL(input.files[0]);
  }
}
function get_class_sections(class_id) {
  var classText = $('#class_id option:selected').text().toLowerCase();
  var isHigher = (class_id == "3" || class_id == "15" || classText.indexOf('11') >= 0 || classText.indexOf('12') >= 0 || classText.indexOf('xi') >= 0 || classText.indexOf('xii') >= 0);
  if (isHigher) {
    document.getElementById("ifShow").style.display = "block";
    var board_id = $("#board_id").val();
    if (board_id && board_id != "1") {
      document.getElementById("forcbse").style.display = "block";
    }
    $('#group_id').prop("required", true);
    if (board_id) {
      get_board_groups(board_id);
    }
  } else {
    $('#group_id').prop("required", false);
    document.getElementById("ifShow").style.display = "none";
    document.getElementById("forcbse").style.display = "none";
  }
  $.ajax({
    url: '<?php echo base_url();?>pre_student/get_class_section/' + class_id,
    success: function(response) {
      jQuery('#section_selector_holder').html(response);
    }
  });
}
function get_religion_category(re_id) {
  $.ajax({
    url: '<?php echo base_url();?>pre_student/get_religion_category/' + re_id,
    success: function(response) {
      jQuery('#cat').html(response);
    }
  });
}
function get_category_cast(cat_id) {
  $.ajax({
    url: '<?php echo base_url();?>pre_student/get_category_cast/' + cat_id,
    success: function(response) {
      jQuery('#section_selector_holder_cast').html(response);
    }
  });
}
function get_board_groups(board_id) {
  if (!board_id) {
    jQuery('#group_id').html('<option value="">Select</option>');
    return;
  }
  $.ajax({
    url: '<?php echo base_url();?>pre_student/get_board_groups/' + board_id,
    success: function(response) {
      jQuery('#group_id').html(response);
    }
  });
}
function set_document() {
  var board_id = $("#board_id").val();
  var boardText = $('#board_id option:selected').text().toLowerCase();
  var isNonSSC = (board_id && board_id != "1");
  var classText = $('#class_id option:selected').text().toLowerCase();
  var isHigher = (classText.indexOf('11') >= 0 || classText.indexOf('12') >= 0 || classText.indexOf('xi') >= 0 || classText.indexOf('xii') >= 0);
  if (isNonSSC && isHigher) {
    $('#ifYes').prop("required", true);
    document.getElementById("forcbse").style.display = "block";
    document.getElementById("forcbse").style.color = "red";
  } else {
    $('#ifYes').prop("required", false);
    document.getElementById("forcbse").style.display = "none";
  }
  if (document.getElementById("ifShow").style.display !== "none") {
    get_board_groups(board_id);
  }
}
$(function() {
  $('#rel').select2();
  $('#cat').select2();
  $('#mt').select2();
  $('#class_id').select2();
  $('#section_selector_holder').select2();
  $('#group_id').select2();
  $('#section_selector_holder_cast').select2();
  $('#nationality').select2();
  $('#sex').select2();
  $('#ifShow').hide();
  $('#forcbse').hide();
});
</script>
<script>$(window).load(function(){ $(".preloader").fadeOut(); });</script>
</body>
</html>
