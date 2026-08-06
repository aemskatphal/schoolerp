<div class="idcard">
    <div class="brand">
        <img src="<?php echo base_url(); ?>uploads/logo.png" class="logo" alt="Logo">
        <div class="brand-text">
            <div class="b-school">ACHARYA ENGLISH MEDIUM SCHOOL &amp; Jr. COLLEGE</div>
            <div class="b-sub">Suryanagari, Jalochi, Baramati, Dist. Pune</div>
        </div>
    </div>
    <div class="body">
        <div class="photo-box">
            <?php if(!empty($student['photo']) && file_exists('uploads/student_image/'.$student['photo'])): ?>
                <img src="<?php echo base_url(); ?>uploads/student_image/<?php echo html_escape($student['photo']); ?>" alt="Student Photo">
            <?php else: ?>
                <img src="<?php echo base_url(); ?>uploads/default.png" alt="Student Photo">
            <?php endif; ?>
        </div>
        <div class="details">
            <div class="sname"><?php echo html_escape($student['name']); ?></div>
            <div class="drow"><span class="dlabel">Class / Div</span><span class="dvalue"><?php echo html_escape($student['class_name']); ?><?php echo !empty($student['section_name']) ? ' - '.html_escape($student['section_name']) : ''; ?></span></div>
            <div class="drow"><span class="dlabel">GR / Std ID</span><span class="dvalue"><?php echo html_escape($student['gen_reg_no']); ?> / <?php echo html_escape($student['student_no']); ?></span></div>
            <div class="drow"><span class="dlabel">UID Number</span><span class="dvalue"><?php echo html_escape($student['uid']); ?></span></div>
            <div class="drow"><span class="dlabel">Blood Group</span><span class="dvalue"><?php echo html_escape($student['blood_group']); ?></span></div>
            <div class="drow"><span class="dlabel">Admission Year</span><span class="dvalue"><?php echo html_escape($student['ad_year']); ?></span></div>
            <div class="drow"><span class="dlabel">Father's Name</span><span class="dvalue"><?php echo html_escape($student['father_name']); ?></span></div>
            <div class="drow"><span class="dlabel">Mobile</span><span class="dvalue"><?php echo html_escape($student['phone']); ?></span></div>
        </div>
    </div>
    <div class="foot">
        <span>Valid for Academic Year <?php echo html_escape($student['ad_year']); ?></span>
        <span>If found please return to the above address</span>
        <?php if(!empty($student['qr_code'])): ?>
            <img src="<?php echo base_url(); ?>uploads/student_qr_code/<?php echo html_escape($student['qr_code']); ?>" class="qr" alt="QR">
        <?php endif; ?>
    </div>
</div>
