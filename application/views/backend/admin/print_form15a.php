<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Form-15A - <?php echo html_escape($student['name']); ?></title>
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
    .head-rule { border-bottom: 0.2pt solid #333; margin: 5mm -14mm 6mm -14mm; }
    .doc-title { text-align: center; font-size: 19pt; font-weight: bold; letter-spacing: 2px; margin: 0 0 5mm 0; }
    .doc-sub { text-align: center; font-size: 13pt; font-weight: bold; margin: 0 0 8mm 0; }
    .body-text { font-size: 12pt; line-height: 1.35; margin: 0 0 3mm 0; }
    .place-date { font-size: 12pt; margin: 10mm 0 0 0; }
    .seal-text { text-align: right; font-size: 12pt; margin: 14mm 0 0 0; }
    .instructions { margin-top: 14mm; }
    .instructions .inst-title { font-size: 13pt; font-weight: bold; margin: 0 0 2mm 0; }
    .instructions ol { margin: 0; padding-left: 8mm; font-size: 11.5pt; line-height: 1.6; }
    .instructions ol li { margin: 1mm 0; }
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

    <div class="doc-title">Form-15A</div>
    <div class="doc-sub">Certificate to be given by Principal of the School/College</div>

    <div class="body-text">
        This is to Certify that Shri/Kum <strong><?php echo html_escape($student['name']); ?></strong> is Student of this School / College in Year <strong><?php echo html_escape($student['ad_year']); ?></strong> and he/she is studying in Std 11th /12th <strong>Science/</strong> Engineering / Medical / Management <strong>Science</strong> faculty. His/her name and other information is as per mentioned at number <strong><?php echo html_escape($student['gen_reg_no']); ?></strong> in general register. And the Caste stated as per our general register is <strong><?php echo html_escape($student['religion_name']); ?><?php echo !empty($student['cast_name']) ? '-'.html_escape($student['cast_name']) : ''; ?></strong>. (Strike out of if not applicable).
    </div>

    <div class="place-date">
        Place: Baramati<br>
        Date: <?php echo html_escape($print_date); ?>
    </div>

    <div class="seal-text">Seal and Signature of the Principal/Head Master</div>

    <div class="instructions">
        <div class="inst-title">Important Instructions: -</div>
        <ol>
            <li>If Claim for Scheduled Caste, Caste evidences should be prior to 10th August 1950.</li>
            <li>If Claim for De-Notified Tribes (Vimukta Jatis), Nomadic Tribes Caste evidences should be prior to 21st November 1961.</li>
            <li>If Claim for Other Backward Class and Special Backward Category, Caste evidences should be prior to 13th October 1967.</li>
            <li>In addition, evidence of residents of above mentioned prior is essential for applicant who has migrated in Maharashtra from other State.</li>
            <li>Migrants from other State to Maharashtra after above mention period whose Caste Certificate is in "Migrants" format should not apply to committee.</li>
        </ol>
    </div>

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
