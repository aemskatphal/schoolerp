<?php
function num_to_words($n) {
    $n = (int)$n;
    if ($n < 0) return '';
    $ones = array('', 'One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine', 'Ten', 'Eleven', 'Twelve', 'Thirteen', 'Fourteen', 'Fifteen', 'Sixteen', 'Seventeen', 'Eighteen', 'Nineteen');
    $tens = array('', '', 'Twenty', 'Thirty', 'Forty', 'Fifty', 'Sixty', 'Seventy', 'Eighty', 'Ninety');
    if ($n < 20) return $ones[$n];
    if ($n < 100) return trim($tens[intval($n / 10)] . ' ' . $ones[$n % 10]);
    if ($n < 1000) return trim(num_to_words(intval($n / 100)) . ' Hundred' . (($n % 100) ? ' ' . num_to_words($n % 100) : ''));
    return trim(num_to_words(intval($n / 1000)) . ' Thousand' . (($n % 1000) ? ' ' . num_to_words($n % 1000) : ''));
}

function date_in_words($date) {
    if (empty($date) || $date == '0000-00-00') return '';
    $ts = strtotime($date);
    if ($ts === false) return $date;
    $months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
    return num_to_words((int)date('j', $ts)) . ' ' . $months[(int)date('n', $ts) - 1] . ' ' . num_to_words((int)date('Y', $ts));
}

$fval = function($v) { return !empty(trim((string)$v)) ? html_escape($v) : '&nbsp;'; };
$std_name   = !empty($student['class_name']) ? $student['class_name'] : '';
$sec_name   = !empty($student['section_name']) ? $student['section_name'] : '';
$standard   = trim($std_name . ($sec_name ? ' - ' . $sec_name : ''));
$reg_no     = !empty($student['gen_reg_no']) ? $student['gen_reg_no'] : '';
$student_id = !empty($student['student_id']) ? $student['student_id'] : (isset($student['student_no']) ? $student['student_no'] : '');
$mobile     = !empty($student['phone']) ? $student['phone'] : (isset($student['parent_phone']) ? $student['parent_phone'] : '');
$place_birth = !empty($student['place_birth']) ? $student['place_birth'] : (isset($student['birth_place']) ? $student['birth_place'] : '');
$religion_cat = trim(trim($student['religion_name'] . ' / ' . $student['cat_name'], ' /') . ' / ' . $student['cast_name'], ' /');
$dob_words  = date_in_words($student['birthday']);
$photo_src  = !empty($student['photo']) && file_exists('uploads/student_image/' . $student['photo']) ? base_url() . 'uploads/student_image/' . $student['photo'] : base_url() . 'uploads/default.png';
$qr_src     = !empty($student['qr_code']) && file_exists('uploads/student_qr_code/' . $student['qr_code']) ? base_url() . 'uploads/student_qr_code/' . $student['qr_code'] : '';
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Admission Form - <?php echo html_escape($student['name']); ?></title>
<style>
    @page { size: A4 portrait; margin: 0; }
    * { box-sizing: border-box; }
    body { font-family: Arial, sans-serif; margin: 0; padding: 0; background: #e9ecef; }
    .no-print { text-align: right; padding: 10px 14px; background: #fff; box-shadow: 0 1px 4px rgba(0,0,0,.25); }
    .no-print button { padding: 8px 20px; border: none; border-radius: 4px; cursor: pointer; font-size: 14px; margin-left: 6px; }
    .certificate {
        width: 190mm; min-height: 277mm; margin: 10mm auto; background: #fff;
        position: relative; padding: 6mm 12mm 8mm 12mm;
        border: 3px solid #333;
        box-shadow: 0 3px 12px rgba(0,0,0,.2);
    }
    .letterhead { display: flex; align-items: center; justify-content: center; gap: 8mm; }
    .letterhead .logo { width: 24mm; height: 24mm; object-fit: contain; background: #fff; border-radius: 3mm; padding: 1.5mm; box-shadow: 0 1px 4px rgba(0,0,0,.2); }
    .letterhead .head-text { text-align: center; flex: 1; }
    .letterhead .tagline { font-size: 9pt; font-weight: bold; letter-spacing: 2px; margin: 0 0 1.5mm 0; }
    .letterhead .sanstha { font-size: 11pt; margin: 0 0 1mm 0; }
    .letterhead .school { font-size: 13pt; font-weight: bold; margin: 0 0 1mm 0; white-space: nowrap; }
    .letterhead .address { font-size: 9.5pt; font-style: italic; margin: 0; }
    .bordered-block { border-top: 0.2pt solid #333; margin: 3mm -12mm 0 -12mm; }
    .b-row { display: flex; justify-content: space-between; border-bottom: 0.2pt solid #333; padding: 1.3mm 12mm; font-size: 10.5pt; }
    .b-row-split { position: relative; align-items: center; }
    .b-row-split .v-line { position: absolute; top: 0; bottom: -0.2pt; left: calc(50% - 20mm); width: 0.2pt; background: #333; }
    .doc-title { text-align: center; font-size: 16pt; font-weight: bold; letter-spacing: 2px; text-decoration: underline; margin: 3mm 0 2.5mm 0; }
    .details-wrap { position: relative; }
    table.details { width: calc(100% + 24mm); table-layout: fixed; border-collapse: collapse; font-size: 10pt; margin-left: -12mm; }
    table.details td { padding: 1.1mm 2mm; vertical-align: top; border-bottom: 0.2pt solid #333; }
    table.details td.num { width: 8mm; font-weight: bold; }
    table.details td.lab { width: 76mm; white-space: nowrap; }
    table.details td.val { padding-right: 36mm; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    .photo { position: absolute; top: 1mm; right: 5mm; width: 28mm; height: 34mm; object-fit: cover; border: 2px solid #333; background: #fff; z-index: 1; }
    .declaration { font-size: 10pt; margin: 3mm -12mm 0 -12mm; padding: 2mm 12mm; border-bottom: 0.2pt solid #333; }
    .declaration .d-label { font-weight: bold; }
    .declaration ul { margin: 1.5mm 0 1mm 5mm; }
    .declaration li { margin: 0.8mm 0; }
    .sign-row { position: relative; margin-top: 18mm; font-size: 10.5pt; }
    .sign-row .sig { position: absolute; bottom: 0; text-align: center; }
    .sign-row .sig1 { left: 0; }
    .sign-row .sig2 { left: 35%; }
    .sign-row .sig3 { right: 0; }
    .sign-row .sig-name { border-top: 0.2pt solid #333; padding-top: 1.5mm; min-width: 34mm; font-weight: bold; }
    .footer { position: absolute; bottom: 7mm; left: 12mm; right: 12mm; display: flex; align-items: center; justify-content: space-between; }
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
    <button onclick="window.print();" style="background:#3498db;color:#fff;">Print</button>
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
            <span>Contact No: 7219091729</span>
            <span class="v-line"></span>
            <span>Email ID: acharyaenglishmediumschool@gmail.com</span>
        </div>
        <div class="b-row">
            <span>Student ID: <?php echo html_escape($student_id); ?></span>
            <span>Date: <?php echo date('d/m/Y'); ?></span>
        </div>
    </div>

    <div class="doc-title">ADMISSION FORM</div>

    <div class="details-wrap">
        <table class="details">
            <tr>
                <td class="num">1.</td>
                <td class="lab">Date of Admission</td>
                <td class="val"><?php echo $fval($student['ad_date']); ?></td>
            </tr>
            <tr>
                <td class="num">2.</td>
                <td class="lab">Academic Year</td>
                <td class="val"><?php echo $fval($student['ad_year']); ?></td>
            </tr>
            <tr>
                <td class="num">3.</td>
                <td class="lab">Student ID</td>
                <td class="val"><?php echo $fval($student_id); ?></td>
            </tr>
            <tr>
                <td class="num">4.</td>
                <td class="lab">Name of Student (in full)</td>
                <td class="val"><?php echo $fval($student['name']); ?></td>
            </tr>
            <tr>
                <td class="num">5.</td>
                <td class="lab">Admission Standard</td>
                <td class="val"><?php echo $fval($standard); ?></td>
            </tr>
            <tr>
                <td class="num">6.</td>
                <td class="lab">Gen. Reg. No</td>
                <td class="val"><?php echo $fval($reg_no); ?></td>
            </tr>
            <tr>
                <td class="num">7.</td>
                <td class="lab">UID Number</td>
                <td class="val"><?php echo $fval($student['uid']); ?></td>
            </tr>
            <tr>
                <td class="num">8.</td>
                <td class="lab">Mobile No</td>
                <td class="val"><?php echo $fval($mobile); ?></td>
            </tr>
            <tr>
                <td class="num">9.</td>
                <td class="lab">Mother Name</td>
                <td class="val"><?php echo $fval($student['mother_name']); ?></td>
            </tr>
            <tr>
                <td class="num">10.</td>
                <td class="lab">Mother Tongue</td>
                <td class="val"><?php echo $fval($student['m_tongue']); ?></td>
            </tr>
            <tr>
                <td class="num">11.</td>
                <td class="lab">Nationality</td>
                <td class="val"><?php echo $fval($student['nationality']); ?></td>
            </tr>
            <tr>
                <td class="num">12.</td>
                <td class="lab">Blood Group</td>
                <td class="val"><?php echo $fval($student['blood_group']); ?></td>
            </tr>
            <tr>
                <td class="num">13.</td>
                <td class="lab">Religion, Category, Caste</td>
                <td class="val"><?php echo $fval($religion_cat); ?></td>
            </tr>
            <tr>
                <td class="num">14.</td>
                <td class="lab">Place of Birth</td>
                <td class="val"><?php echo $fval($place_birth); ?></td>
            </tr>
            <tr>
                <td class="num">15.</td>
                <td class="lab">Date of Birth (In Figure)</td>
                <td class="val"><?php echo $fval($student['birthday']); ?></td>
            </tr>
            <tr>
                <td class="num">16.</td>
                <td class="lab">Date of Birth (In Words)</td>
                <td class="val"><?php echo $fval($dob_words); ?></td>
            </tr>
            <tr>
                <td class="num">17.</td>
                <td class="lab">Last School Attended</td>
                <td class="val"><?php echo $fval($student['ps_attended']); ?></td>
            </tr>
        </table>
        <?php if(!empty($student['photo']) && file_exists('uploads/student_image/'.$student['photo'])): ?>
            <img src="<?php echo base_url(); ?>uploads/student_image/<?php echo html_escape($student['photo']); ?>" class="photo" alt="Student Photo">
        <?php else: ?>
            <img src="<?php echo base_url(); ?>uploads/default.png" class="photo" alt="Student Photo">
        <?php endif; ?>
    </div>

    <div class="declaration">
        <span class="d-label">DECLARATION</span>
        <div>Above information is in accordance with the School Register. I undertake to:</div>
        <ul>
            <li>Abide by all the rules and regulations of the school.</li>
            <li>Ensure regular attendance, punctuality, and discipline of my ward.</li>
            <li>Support the school in the academic and overall development of my child.</li>
            <li>Pay all school fees (tuition, transport, and other applicable charges) as per the schedule prescribed by the school.</li>
        </ul>
    </div>

    <div class="sign-row">
        <div class="sig sig1"><div class="sig-name">Parent's Signature</div></div>
        <div class="sig sig2"><div class="sig-name">Clerk</div></div>
        <div class="sig sig3"><div class="sig-name">Head Master / Head Mistress</div></div>
    </div>

    <?php if (!empty($qr_src)): ?>
    <div class="footer">
        <div class="qr-note">(This QR code can be used to check the authenticity of the certificate)</div>
        <img src="<?php echo $qr_src; ?>" class="qr-img" alt="QR Code">
    </div>
    <?php endif; ?>
</div>

<script>
    window.onload = function() {
        setTimeout(function(){ window.print(); }, 600);
    };
</script>
</body>
</html>
