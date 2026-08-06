<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="Student Details">
<link rel="icon" sizes="16x16" href="<?php echo base_url();?>uploads/logo.png">
<title><?php echo $page_title; ?> - <?php echo $this->db->get_where('settings', array('type' => 'system_name'))->row()->description; ?></title>
<link href="<?php echo base_url();?>optimum/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>optimum/plugins/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet">
<style type="text/css">
  body { background: #f4f6f9; font-family: Arial, Helvetica, sans-serif; margin: 0; padding: 0; }
  .verify-bar { background: #f9c74f; color: #0b3d66; text-align: center; padding: 7px 0; font-weight: 700; font-size: 13px; text-transform: uppercase; letter-spacing: 1px; }
  .school-header { background: #0b3d66; color: #fff; padding: 22px 0; border-bottom: 4px solid #f9c74f; }
  .school-header .letterhead { display: flex; align-items: center; justify-content: center; flex-wrap: wrap; gap: 0.3cm; }
  .school-header .logo { max-height: 109px; background: #fff; border-radius: 12px; padding: 6px; box-shadow: 0 2px 8px rgba(0,0,0,.25); }
  .school-header .head-text { text-align: center; }
  .school-header .tagline { margin: 0 0 8px 0; font-size: 14px; font-weight: 700; letter-spacing: 2px; text-transform: uppercase; }
  .school-header h3 { margin: 0 0 4px 0; font-size: 16px; font-weight: 400; text-transform: uppercase; }
  .school-header h1 { margin: 4px 0 6px 0; font-size: 22px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; }
  .school-header p { margin: 0; font-size: 13px; opacity: .9; }
  .wrapper { max-width: 640px; margin: 25px auto 40px auto; padding: 0 15px; }
  .detail-panel { background: #fff; border: 1px solid #dee2e6; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 12px rgba(0,0,0,.08); }
  .detail-panel .panel-head { background: #0b3d66; color: #fff; padding: 13px 18px; font-size: 16px; font-weight: 700; text-transform: uppercase; letter-spacing: .5px; }
  .detail-panel .panel-head i { margin-right: 6px; }
  table.detail-table { width: 100%; border-collapse: collapse; text-transform: uppercase; }
  table.detail-table td { padding: 11px 16px; border: 1px solid #e5e8ec; font-size: 14px; vertical-align: top; }
  table.detail-table td.label-cell { width: 40%; background: #f7f9fc; color: #0b3d66; font-weight: 700; }
  table.detail-table td.value-cell { color: #222; word-break: break-word; }
  .verified-stamp { text-align: center; padding: 14px 0; background: #eaf6ec; border-top: 2px solid #28a745; color: #1e7e34; font-weight: 700; font-size: 13px; text-transform: uppercase; letter-spacing: 1px; }
  .not-found { text-align: center; padding: 40px 20px; }
  .not-found h3 { color: #c0392b; }
  .school-footer { background: #0b3d66; color: #fff; text-align: center; padding: 16px 0; font-size: 12px; }
  .school-footer p { margin: 0; }
  @media (max-width: 575px){
    .school-header { padding: 16px 0; }
    .school-header .letterhead { flex-wrap: nowrap; gap: 0.3cm; }
    .school-header .logo { max-height: 58px; padding: 4px; }
    .school-header .head-text { text-align: left; }
    .school-header .tagline { font-size: 10px; letter-spacing: 1px; margin-bottom: 4px; }
    .school-header h3 { font-size: 11px; }
    .school-header h1 { font-size: 14px; margin: 2px 0 3px 0; }
    .school-header p { font-size: 10px; }
  }
</style>
</head>
<body>

<div class="verify-bar">
  <i class="fa fa-check-circle"></i> Student Identity Verification
</div>

<div class="school-header">
  <div class="container">
    <div class="letterhead">
      <img src="<?php echo base_url();?>uploads/logo.png" class="logo" alt="School Logo">
      <div class="head-text">
        <p class="tagline">YOU ARE THE SCULPTOR OF YOUR LIFE</p>
        <h3>Sadguru Shree Wamanrao Pai Shikshan Sanstha's</h3>
        <h1>ACHARYA ENGLISH MEDIUM SCHOOL AND JR. COLLEGE</h1>
        <p>Suryanagari, Jalochi, Tal-Baramati, Dist-Pune</p>
      </div>
    </div>
  </div>
</div>

<div class="wrapper">
  <div class="detail-panel">
    <div class="panel-head"><i class="fa fa-graduation-cap"></i> Student Details:</div>

    <?php if(empty($student)): ?>
      <div class="not-found">
        <h3><i class="fa fa-exclamation-triangle"></i> Student Not Found</h3>
        <p>The scanned QR code does not belong to any registered student of this school.</p>
        <p>Please contact the school office for assistance.</p>
      </div>
    <?php else: ?>
      <div style="overflow-x:auto;">
        <table class="detail-table">
          <tbody>
            <tr>
              <td class="label-cell"><b>Name of Student</b></td>
              <td class="value-cell"><?php echo html_escape($student['name']); ?></td>
            </tr>
            <tr>
              <td class="label-cell"><b>Academic Year</b></td>
              <td class="value-cell"><?php echo html_escape($student['ad_year']); ?></td>
            </tr>
            <tr>
              <td class="label-cell"><b>General Register Number</b></td>
              <td class="value-cell"><?php echo html_escape($student['gen_reg_no']); ?></td>
            </tr>
            <tr>
              <td class="label-cell"><b>Standard</b></td>
              <td class="value-cell"><?php echo html_escape($student['class_name']); ?></td>
            </tr>
            <tr>
              <td class="label-cell"><b>Gender</b></td>
              <td class="value-cell"><?php echo html_escape($student['sex']); ?></td>
            </tr>
            <tr>
              <td class="label-cell"><b>Mother Name</b></td>
              <td class="value-cell"><?php echo html_escape($student['mother_name']); ?></td>
            </tr>
            <tr>
              <td class="label-cell"><b>Religion</b></td>
              <td class="value-cell"><?php echo html_escape($student['religion_name']); ?></td>
            </tr>
            <tr>
              <td class="label-cell"><b>Cast</b></td>
              <td class="value-cell"><?php echo html_escape($student['cast_name']); ?></td>
            </tr>
            <tr>
              <td class="label-cell"><b>Birth Date</b></td>
              <td class="value-cell"><?php echo !empty($student['birthday']) ? date('d-m-Y', strtotime($student['birthday'])) : ''; ?></td>
            </tr>
            <tr>
              <td class="label-cell"><b>Place of Birth</b></td>
              <td class="value-cell"><?php echo html_escape($student['place_birth']); ?></td>
            </tr>
            <tr>
              <td class="label-cell"><b>UID</b></td>
              <td class="value-cell"><?php echo html_escape($student['uid']); ?></td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="verified-stamp">
        <i class="fa fa-shield"></i> Verified &nbsp;|&nbsp; ACHARYA ENGLISH MEDIUM SCHOOL AND JR. COLLEGE, BARAMATI
      </div>
    <?php endif; ?>
  </div>
</div>

<div class="school-footer">
  <div class="container">
    <p>&copy; Copyright <?php echo date('Y'); ?> All Rights Reserved by <?php echo $this->db->get_where('settings', array('type' => 'footer'))->row()->description; ?></p>
  </div>
</div>

</body>
</html>
