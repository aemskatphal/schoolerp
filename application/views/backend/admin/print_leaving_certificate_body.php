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
        <div class="b-row">
            <span>UDISE No:</span>
            <span>Medium: English</span>
        </div>
        <div class="b-row b-row-split">
            <span>Contact No: 7219091729</span>
            <span class="v-line"></span>
            <span>Email ID: acharyaenglishmediumschool@gmail.com</span>
        </div>
        <div class="b-row b-row-split3">
            <span>Department: Secondary</span>
            <span class="v-line vl1"></span>
            <span class="original-text">ORIGINAL</span>
            <span class="v-line vl2"></span>
            <span>Board: State Board Maharashtra</span>
        </div>
        <div class="b-row b-row-split3">
            <span>Outword No:</span>
            <span class="v-line vl1"></span>
            <span class="lc-title">LEAVING CERTIFICATE</span>
            <span class="v-line vl2"></span>
            <span>LC No: <?php echo html_escape($cert_no); ?></span>
        </div>
    </div>

    <table class="lc-table">
        <tr>
            <td class="num">1.</td>
            <td class="lab">Student ID</td>
            <td class="val"><?php echo html_escape($student['student_no']); ?></td>
            <td class="right">Gen. Reg. No: <?php echo html_escape($student['gen_reg_no']); ?></td>
        </tr>
        <tr>
            <td class="num">2.</td>
            <td class="lab">UID Number</td>
            <td class="val no-sep"><?php echo html_escape($student['uid']); ?></td>
            <td class="right"></td>
        </tr>
        <tr>
            <td class="num">3.</td>
            <td class="lab">Name of Student(in full)</td>
            <td class="val no-sep nowrap"><?php echo html_escape($student['name']); ?></td>
            <td class="right"></td>
        </tr>
        <tr>
            <td class="num">4.</td>
            <td class="lab">Mother Name</td>
            <td class="val no-sep nowrap"><?php echo html_escape($student['mother_name']); ?></td>
            <td class="right"></td>
        </tr>
        <tr>
            <td class="num">5.</td>
            <td class="lab">Nationality</td>
            <td class="val no-sep"><?php echo html_escape($student['nationality']); ?></td>
            <td class="right"></td>
        </tr>
        <tr>
            <td class="num">6.</td>
            <td class="lab">Religion, Caste, Category</td>
            <td class="val no-sep nowrap"><?php echo html_escape($student['religion_name']); ?><?php echo !empty($student['cast_name']) ? ' '.html_escape($student['cast_name']) : ''; ?></td>
            <td class="right"><?php echo html_escape($student['category_name']); ?></td>
        </tr>
        <tr>
            <td class="num">7.</td>
            <td class="lab">Place of Birth</td>
            <td class="val no-sep nowrap"><?php echo html_escape($student['birth_place']); ?></td>
            <td class="right"></td>
        </tr>
        <tr>
            <td class="num">8.</td>
            <td class="lab">Date of Birth(In Figure)</td>
            <td class="val"><?php echo html_escape($student['birthday']); ?></td>
            <td class="right">Mother Tongue: <?php echo html_escape($student['mother_tongue_name']); ?></td>
        </tr>
        <tr>
            <td class="num">9.</td>
            <td class="lab">Date of Birth(In Words)</td>
            <td class="val no-sep nowrap"><?php echo html_escape($dob_words); ?></td>
            <td class="right"></td>
        </tr>
        <tr>
            <td class="num">10.</td>
            <td class="lab">Last School attended</td>
            <td class="val no-sep nowrap"><?php echo html_escape($student['prev_school_name']); ?></td>
            <td class="right"></td>
        </tr>
        <tr>
            <td class="num">11.</td>
            <td class="lab">Date of Admission &amp; Class</td>
            <td class="val"><?php echo html_escape($student['ad_date']); ?></td>
            <td class="right right5"><?php echo html_escape($student['ad_class_name']); ?></td>
        </tr>
        <tr>
            <td class="num">12.</td>
            <td class="lab">Progress &amp; Conduct</td>
            <td class="val">Good</td>
            <td class="right right5">Good</td>
        </tr>
        <tr>
            <td class="num">13.</td>
            <td class="lab nowrap">Date of Leaving the School</td>
            <td class="val no-sep"><?php echo html_escape($student['leaving_date']); ?></td>
            <td class="right"></td>
        </tr>
        <tr>
            <td class="num">14.</td>
            <td class="lab">Standard in studying</td>
            <td class="val no-sep"><?php echo html_escape($student['std_studying']); ?></td>
            <td class="right"></td>
        </tr>
        <tr>
            <td class="num">15.</td>
            <td class="lab nowrap">Reason of leaving the School</td>
            <td class="val no-sep" colspan="2"><?php echo html_escape($student['leaving_reason']); ?></td>
        </tr>
        <tr>
            <td class="num">16.</td>
            <td class="lab">Remarks</td>
            <td class="val no-sep" colspan="2"><?php echo html_escape($student['remarks']); ?></td>
        </tr>
    </table>

    <?php if(!empty($student['photo']) && file_exists('uploads/student_image/'.$student['photo'])): ?>
        <img src="<?php echo base_url(); ?>uploads/student_image/<?php echo html_escape($student['photo']); ?>" class="photo" alt="Student Photo">
    <?php endif; ?>

    <div class="certified">Certified that the above information is in accordance with the School Register.</div>
    <div class="cert-note">(No changes in any entry in this certificate shall be made except by the authority issuing it and any infringement of this requirement is liable to be dealt with Justification or by other suitable)</div>

    <div class="sign-block">
        <div class="col">
            <div class="date-val"><?php echo html_escape($lc_date); ?></div>
            <div>Date</div>
        </div>
        <div class="col">
            <div class="date-val"></div>
            <div>Class Teacher</div>
        </div>
        <div class="col">
            <div class="date-val"></div>
            <div>Clerk</div>
        </div>
        <div class="col">
            <div class="date-val"></div>
            <div>Head Master / Head Mistress</div>
        </div>
    </div>

    <div class="footer">
        <div class="qr-block">
            <img src="<?php echo base_url(); ?>uploads/student_qr_code/<?php echo html_escape($student['qr_code']); ?>" class="qr-img" alt="QR Code">
            <div class="qr-note">(This QR code can be used to check the authenticity of the certificate)</div>
        </div>
    </div>
</div>
