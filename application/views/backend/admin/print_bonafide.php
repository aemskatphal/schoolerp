<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Bonafide Certificate - <?php echo html_escape($student['name']); ?></title>
<style>
    @page { size: A4 portrait; margin: 0; }
    * { box-sizing: border-box; }
    body { font-family: Arial, sans-serif; margin: 0; padding: 0; background: #e9ecef; }
    .no-print { text-align: right; padding: 10px 14px; background: #fff; box-shadow: 0 1px 4px rgba(0,0,0,.25); }
    .no-print button { padding: 8px 20px; border: none; border-radius: 4px; cursor: pointer; font-size: 14px; margin-left: 6px; }
    .certificate {
        width: 190mm; min-height: 277mm; margin: 10mm auto; background: #fff;
        position: relative; padding: 8mm 12mm 10mm 12mm;
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
    .photo-row { display: flex; align-items: flex-start; }
    .details-wrap { display: flex; align-items: flex-start; position: relative; }
    .details-wrap table.details { flex: 1; min-width: 0; }
    .photo { position: absolute; top: -11mm; right: 7mm; width: 30mm; height: 36mm; object-fit: cover; border: 2px solid #333; background: #fff; z-index: 1; }
    .head-rule { border-bottom: 1.5px solid #333; margin: 4mm 0 3mm 0; }
    .contact-line { font-size: 10.5pt; margin: 1.5mm 0; }
    .bordered-block { border-top: 0.2pt solid #333; margin: 3mm -12mm 4mm -12mm; }
    .b-row { display: flex; justify-content: space-between; border-bottom: 0.2pt solid #333; padding: 1.5mm 12mm; font-size: 12pt; }
    .b-row-split { position: relative; align-items: center; }
    .b-row-split .v-line { position: absolute; top: 0; bottom: -0.2pt; left: calc(50% - 20mm); width: 0.2pt; background: #333; }
    .doc-title { text-align: center; font-size: 17pt; font-weight: bold; letter-spacing: 2px; text-decoration: underline; margin: 4mm 0 3mm 0; }
    .outward { font-size: 13pt; margin: -1mm -12mm 0 -12mm; padding: 1.5mm 12mm; border-bottom: 0.2pt solid #333; }
    .certify { font-size: 12pt; margin: 3mm 0 4mm 0; }
    table.details { width: 100%; border-collapse: collapse; font-size: 10.5pt; text-transform: uppercase; }
    table.details td { padding: 2mm 4mm; vertical-align: top; }
    table.details td.lab { width: 82mm; font-weight: normal; white-space: nowrap; }
    table.details td:last-child { padding-left: calc(1mm - 3px); white-space: nowrap; }
    .moral { text-align: center; font-size: 12pt; margin: 6mm -12mm 0 -12mm; padding: 1.5mm 12mm; border-top: 0.2pt solid #333; border-bottom: 0.2pt solid #333; }
    .sign-row { position: relative; margin-top: 28mm; font-size: 11.5pt; }
    .sign-row .clerk { position: absolute; left: 8mm; bottom: 0; }
    .sign-row .principal { position: absolute; right: 8mm; bottom: 0; }
    .sign-row .clerk span, .sign-row .principal span { display: inline-block; }
    .footer { position: absolute; bottom: 10mm; left: 12mm; right: 12mm; display: flex; align-items: center; justify-content: space-between; }
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

    <div class="bordered-block">
        <div class="b-row">UDISE No:</div>
        <div class="b-row b-row-split">
            <span>Contact: 7219091729</span>
            <span class="v-line"></span>
            <span>Email ID: acharyaenglishmediumschool@gmail.com</span>
        </div>
        <div class="b-row">
            <span>No: <?php echo html_escape($cert_no); ?></span>
            <span>Date: <?php echo html_escape($print_date); ?></span>
        </div>
    </div>


    <div class="outward">Outward No: &nbsp;</div>

    <div class="doc-title">BONAFIDE CERTIFICATE</div>

    <div class="certify">This is certify that:</div>

    <div class="details-wrap">
        <table class="details">
            <tr>
                <td class="lab">1. General Register Number</td>
                <td>: <?php echo html_escape($student['gen_reg_no']); ?></td>
            </tr>
            <tr>
                <td class="lab">2. Student ID</td>
                <td>: <?php echo html_escape($student['student_no']); ?></td>
            </tr>
            <tr>
                <td class="lab">3. UID Number</td>
                <td>: <?php echo html_escape($student['uid']); ?></td>
            </tr>
            <tr>
                <td class="lab">4. Student Full Name</td>
                <td>: <?php echo html_escape($student['name']); ?></td>
            </tr>
            <tr>
                <td class="lab">5. Mother Name</td>
                <td>: <?php echo html_escape($student['mother_name']); ?></td>
            </tr>
            <tr>
                <td class="lab">6. Standard &amp; Division</td>
                <td>: <?php echo html_escape($student['class_name']); ?><?php echo !empty($student['section_name']) ? ', Division: '.html_escape($student['section_name']) : ''; ?></td>
            </tr>
            <tr>
                <td class="lab">7. Year of Education</td>
                <td>: <?php echo html_escape($student['ad_year']); ?></td>
            </tr>
            <tr>
                <td class="lab">8. Religion &amp; Cast</td>
                <td>: <?php echo html_escape($student['religion_name']); ?><?php echo !empty($student['cast_name']) ? '-'.html_escape($student['cast_name']) : ''; ?></td>
            </tr>
            <tr>
                <td class="lab">9. Date of Birth (In Figure)</td>
                <td>: <?php echo !empty($student['birthday']) && $student['birthday'] != '0000-00-00' ? date('d-m-Y', strtotime($student['birthday'])) : ''; ?></td>
            </tr>
            <tr>
                <td class="lab">10. Date of Birth (In Words)</td>
                <td>: <?php echo html_escape($dob_words); ?></td>
            </tr>
            <tr>
                <td class="lab">11. Place of Birth</td>
                <td>: <?php echo html_escape($student['place_birth']); ?></td>
            </tr>
        </table>
        <?php if(!empty($student['photo']) && file_exists('uploads/student_image/'.$student['photo'])): ?>
            <img src="<?php echo base_url(); ?>uploads/student_image/<?php echo html_escape($student['photo']); ?>" class="photo" alt="Student Photo">
        <?php else: ?>
            <img src="<?php echo base_url(); ?>uploads/student_image/<?php echo html_escape($student['photo']); ?>" class="photo" alt="Student Photo" style="visibility: hidden;">
        <?php endif; ?>
    </div>

    <div class="moral">To the best of my knowledge he/she bears a good moral character</div>

    <div class="sign-row">
        <div class="clerk"><span>Clerk / Class Teacher</span></div>
        <div class="principal"><span>Principal</span></div>
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
