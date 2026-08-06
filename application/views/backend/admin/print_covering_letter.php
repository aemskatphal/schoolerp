<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>School Covering Letter - <?php echo html_escape($student['name']); ?></title>
<style>
    @page { size: A4 portrait; margin: 0; }
    * { box-sizing: border-box; }
    body { font-family: Arial, sans-serif; margin: 0; padding: 0; background: #e9ecef; }
    .no-print { text-align: right; padding: 10px 14px; background: #fff; box-shadow: 0 1px 4px rgba(0,0,0,.25); }
    .no-print button { padding: 8px 20px; border: none; border-radius: 4px; cursor: pointer; font-size: 14px; margin-left: 6px; }
    .certificate {
        width: 190mm; min-height: 277mm; margin: 10mm auto; background: #fff;
        position: relative; padding: 8mm 14mm 10mm 14mm;
        border: 3px solid #333;
        box-shadow: 0 3px 12px rgba(0,0,0,.2);
    }
    .letterhead { display: flex; align-items: center; justify-content: center; gap: 8mm; }
    .letterhead .logo { width: 27mm; height: 27mm; object-fit: contain; background: #fff; border-radius: 3mm; padding: 1.5mm; box-shadow: 0 1px 4px rgba(0,0,0,.2); }
    .letterhead .head-text { text-align: center; flex: 1; }
    .letterhead .tagline { font-size: 10pt; font-weight: bold; letter-spacing: 2px; margin: 0 0 2mm 0; }
    .letterhead .sanstha { font-size: 12.1pt; margin: 0 0 1mm 0; }
    .letterhead .school { font-size: 14pt; font-weight: bold; margin: 0 0 1.5mm 0; white-space: nowrap; }
    .letterhead .address { font-size: 10pt; font-style: italic; margin: 0; }
    .head-rule { border-bottom: 0.2pt solid #333; margin: 5mm -14mm 7mm -14mm; }
    .doc-title { text-align: center; font-size: 17pt; font-weight: bold; letter-spacing: 1px; margin: 0 0 8mm 0; }
    .ref-row { display: flex; justify-content: space-between; font-size: 12pt; margin: 0 0 6mm 0; }
    .address-block { font-size: 12pt; line-height: 1.5; margin: 0 0 8mm 0; }
    .subject { font-size: 12pt; font-weight: bold; text-align: center; margin: 0 0 8mm 0; }
    .body-text { font-size: 12pt; line-height: 1.6; margin: 0 0 3mm 0; }
    .faithful { font-size: 12pt; margin: 12mm 0 0 0; }
    .principal-text { text-align: right; font-size: 12pt; margin: 20mm 0 0 0; }
    .footer { position: absolute; bottom: 10mm; left: 14mm; right: 14mm; display: flex; align-items: center; justify-content: space-between; }
    .footer .qr-note { font-size: 9pt; max-width: 100mm; }
    .footer .qr-img { width: 26mm; height: 26mm; object-fit: contain; }
    @media print {
        body { background: #fff; }
        .no-print { display: none; }
        .certificate { margin: 10mm auto; box-shadow: none; }
    }
</style>
</head>
<body>

<div class="no-print">
    <button onclick="window.print();" style="background:#3498db;color:#fff;"><i class="fa fa-print"></i> Print</button>
    <button onclick="window.close();" style="background:#e74c3c;color:#fff;">Close</button>
</div>

<div class="certificate">
    <div class="letterhead">
        <img src="<?php echo base_url(); ?>uploads/logo.png" class="logo" alt="School Logo">
        <div class="head-text">
            <div class="tagline">YOU ARE THE SCULPTOR OF YOUR LIFE</div>
            <div class="sanstha">Sadguru Shree Wamanrao Pai Shikshan Sansthas</div>
            <div class="school">ACHARYA ENGLISH MEDIUM SCHOOL &amp; Jr. COLLEGE</div>
            <div class="address">Suryanagari, Jalochi Tal. Baramati, Dist. Pune</div>
        </div>
    </div>

    <div class="head-rule"></div>

    <div class="doc-title">School Covering Letter</div>

    <div class="ref-row">
        <span>Ref No.</span>
        <span>Date: <?php echo html_escape($print_date); ?></span>
    </div>

    <div class="address-block">
        To,<br><br>
        Member Secretary / Research Officer,<br>
        Divisional Caste Verification Committee,
    </div>

    <div class="subject">Subject: Regarding verification of caste of students.</div>

    <div class="body-text">
        Respected Sir/Madam,
    </div>

    <div class="body-text">
        According to the above subject Mr./Ms. <strong><?php echo html_escape($student['name']); ?></strong> this student is studying in Junior college/school class <strong><?php echo html_escape($student['class_name']); ?></strong> science branch, in the year <strong><?php echo html_escape($student['ad_year']); ?></strong> and his general register number is <strong><?php echo html_escape($student['gen_reg_no']); ?></strong>. As per the general register entry in the college his/her caste is <strong><?php echo html_escape($student['religion_name']); ?><?php echo !empty($student['cast_name']) ? '-'.html_escape($student['cast_name']) : ''; ?></strong>, So please verify the caste of the student and give his/her certificate.
    </div>

    <div class="faithful">Your faithful</div>

    <div class="principal-text">Principal</div>

    <div class="footer">
        <div class="qr-note">(This QR code can be used to check the authenticity of the certificate)</div>
        <img src="<?php echo base_url(); ?>uploads/student_qr_code/<?php echo html_escape($student['qr_code']); ?>" class="qr-img" alt="QR Code">
    </div>
</div>

<script>
    window.onload = function() {
        setTimeout(function(){ window.print(); }, 600);
    };
</script>
</body>
</html>
