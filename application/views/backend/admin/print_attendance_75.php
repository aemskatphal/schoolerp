<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>75% Attendance - <?php echo html_escape($student['name']); ?></title>
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
    .head-rule { border-bottom: 0.2pt solid #333; margin: 5mm -14mm 8mm -14mm; }
    .doc-title { text-align: center; font-size: 17pt; font-weight: bold; letter-spacing: 2px; margin: 0 0 4mm 0; }
    .school-line { text-align: center; font-size: 12pt; font-weight: bold; margin: 5mm 0 8mm 0; }
    .body-text { font-size: 12pt; line-height: 1.7; margin: 0 0 3mm 0; text-align: justify; }
    .place-date { font-size: 12pt; margin: 14mm 0 0 0; }
    .on-demand { font-size: 11pt; font-weight: bold; margin: 10mm 0 0 0; }
    .principal-text { text-align: right; font-size: 12pt; margin: 26mm 0 0 0; }
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

    <div class="doc-title">ATTENDANCE CERTIFICATE</div>

    <div class="school-line">Acharya English Medium School &amp; Jr. College Suryanagari, Jalochi,<br>Tal - Baramati, District - Pune.</div>

    <div class="body-text">
        A student <strong><?php echo html_escape($student['name']); ?></strong> was studying in <strong><?php echo html_escape($student['prev_class_name']); ?></strong> Std. His / her attendance was <strong><?php echo intval($att_percent); ?>%</strong> In the academic year <strong><?php echo html_escape($student['prev_year']); ?></strong>.
    </div>

    <div class="on-demand">Certificate is given on demand</div>

    <div class="place-date">
        Place: Baramati<br>
        Date: <?php echo html_escape($print_date); ?>
    </div>

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
