<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-info">
            <div class="panel-wrapper collapse in" aria-expanded="true">
                <div class="panel-body table-responsive">

                    <?php
                    $current_session = $this->db->get_where('settings', array('type' => 'session'))->row()->description;
                    $current_year = date('Y') . '-' . (date('Y') + 1);
                    $today = date('Y-m-d');
                    $classes = $this->db->order_by('sort_order', 'ASC')->get('class')->result_array();
                    $boards = $this->db->get('board')->result_array();
                    $academies = $this->db->get('academy')->result_array();
                    $religions = $this->db->get('religion')->result_array();
                    $categories = $this->db->get('category')->result_array();
                    $mother_tongues = $this->db->get('mother_tongue')->result_array();
                    $previous_schools = $this->db->order_by('name', 'asc')->get('previous_school')->result_array();
                    $groups = $this->db->get('student_group')->result_array();
                    $banks = $this->db->get('bank')->result_array();
                    ?>

                    <?php echo form_open(base_url() . 'admin/new_student/create/', array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data', 'id' => 'admission_form')); ?>

                    <!-- Admission Information -->
                    <div class="row panel-body">
                        <div class="col-sm-12">
                            <div class="panel-heading"><i class="fa fa-list"></i>&nbsp;&nbsp;Admission Information</div>
                        </div>
                    </div>
                    <div class="row panel-body">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-md-12" for="example-text">Academic Year<span class="bg-require">*</span></label>
                                <div class="col-sm-12">
                                    <select name="ad_year" class="form-control select2" required>
                                        <option value="">Select Academic Year</option>
                                        <?php for($y = date('Y') - 5; $y <= date('Y') + 5; $y++): ?>
                                            <option value="<?php echo $y.'-'.($y+1); ?>" <?php if($current_year == $y.'-'.($y+1)) echo 'selected'; ?>><?php echo $y.'-'.($y+1); ?></option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-9" for="example-text">Type Of Admission<span class="bg-require">*</span></label>
                                <div class="col-sm-12">
                                    <select name="ad_type" class="form-control select2" style="width:100%" required>
                                        <option value="">Select</option>
                                        <option value="1">Regular</option>
                                        <option value="2">RTE</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12" for="example-text">Academy Name<span class="bg-require">*</span></label>
                                <div class="row col-md-12">
                                    <div class="col-sm-10">
                                        <select name="academy_id" id="academy_id" class="form-control" required>
                                            <option value="">Select</option>
                                            <?php foreach($academies as $row): ?>
                                                <option value="<?php echo $row['academy_id']; ?>"><?php echo html_escape($row['academy_name']); ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-2">
                                        <a onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/modal_add_academy');"><button type="button" class="btn btn-info btn-circle btn-xs"><i class="fa fa-plus"></i></button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-md-9" for="example-text">Admission Date<span class="bg-require">*</span></label>
                                <div class="col-sm-12">
                                    <input type="date" class="form-control datepicker" name="ad_date" value="<?php echo $today; ?>" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12" for="example-text">General Register Number<span class="bg-require">*</span></label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" name="gen_reg_no" id="gen_reg_no" required>
                                    <div id="existmsg"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12" for="example-text">Board Name</label>
                                <div class="row col-md-12">
                                    <div class="col-sm-10">
                                        <select name="board_id" id="board_id" class="form-control">
                                            <option value="">Select</option>
                                            <?php foreach($boards as $row): ?>
                                                <option value="<?php echo $row['board_id']; ?>"><?php echo html_escape($row['board_name']); ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-2">
                                        <a onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/modal_add_board');"><button type="button" class="btn btn-info btn-circle btn-xs"><i class="fa fa-plus"></i></button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-md-12" for="example-text">Saral Number<span class="bg-require">*</span></label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" name="student_no" required autofocus>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12" for="example-text">UID Number<span class="bg-require">*</span></label>
                                <div class="col-sm-12">
                                    <input type="number" class="form-control" name="uid" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12" for="example-text">Admission Remarks</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" name="ad_remarks">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Personal Information -->
                    <div class="row panel-body">
                        <div class="col-sm-12">
                            <div class="panel-heading"><i class="fa fa-list"></i>&nbsp;&nbsp;Personal Information</div>
                        </div>
                    </div>
                    <div class="row panel-body">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="col-md-12" for="example-text">Full Name (Surname First)<span class="bg-require">*</span></label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" name="name" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-md-12" for="example-text">Father Name<span class="bg-require">*</span></label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" name="father_name" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-md-12" for="example-text">Mother Name<span class="bg-require">*</span></label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" name="mother_name" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-md-9" for="example-text">Parent Mobile No<span class="bg-require">*</span></label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" name="parent_phone" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-md-9" for="example-text">Gender<span class="bg-require">*</span></label>
                                <div class="col-sm-12">
                                    <select name="sex" class="form-control select2" style="width:100%" required>
                                        <option value="">Select</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-md-9" for="example-text">Date Of Birth<span class="bg-require">*</span></label>
                                <div class="col-sm-12">
                                    <input type="date" class="form-control datepicker" name="birthday" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-md-9" for="example-text">Student Mobile No</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" name="phone">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-md-9" for="example-text">Nationality</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" name="nationality" value="Indian">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-md-12" for="example-text">Birth Place<span class="bg-require">*</span></label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" name="birth_place" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-md-12" for="example-text">Mother Tongue<span class="bg-require">*</span></label>
                                <div class="col-sm-12">
                                    <select name="mt_id" id="mt" class="form-control select2" style="width:100%" required>
                                        <option value="">Select</option>
                                        <?php foreach($mother_tongues as $row): ?>
                                            <option value="<?php echo $row['mother_tongue_id']; ?>"><?php echo html_escape($row['mother_tongue_name']); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-md-12" for="example-text">Religion<span class="bg-require">*</span></label>
                                <div class="col-sm-12">
                                    <select name="re_id" id="rel" class="form-control select2" style="width:100%" onchange="return get_religion_category(this.value)" required>
                                        <option value="">Select</option>
                                        <?php foreach($religions as $row): ?>
                                            <option value="<?php echo $row['religion_id']; ?>"><?php echo html_escape($row['religion_name']); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-md-12" for="example-text">Category<span class="bg-require">*</span></label>
                                <div class="col-sm-12">
                                    <select name="cat_id" id="section_selector_holder_category" class="form-control select2" style="width:100%" onchange="return get_category_cast(this.value)">
                                        <option value="">Select Religion First</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-md-12" for="example-text">Caste<span class="bg-require">*</span></label>
                                <div class="row col-md-12">
                                    <div class="col-sm-10">
                                        <select name="cast_id" id="section_selector_holder_cast" class="form-control select2" style="width:100%">
                                            <option value="">Select Category First</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-2">
                                        <a onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/modal_add_cast');"><button type="button" class="btn btn-info btn-circle btn-xs"><i class="fa fa-plus"></i></button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-md-12" for="example-text">Father's Education</label>
                                <div class="col-sm-12">
                                    <select name="father_edu_id" class="form-control select2" style="width:100%">
                                        <option value="">Select</option>
                                        <option value="1">SSC</option>
                                        <option value="2">HSC</option>
                                        <option value="3">Graduate</option>
                                        <option value="4">Post Graduate</option>
                                        <option value="5">Illiterate</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-md-12" for="example-text">Mother's Education</label>
                                <div class="col-sm-12">
                                    <select name="mother_edu_id" class="form-control select2" style="width:100%">
                                        <option value="">Select</option>
                                        <option value="1">SSC</option>
                                        <option value="2">HSC</option>
                                        <option value="3">Graduate</option>
                                        <option value="4">Post Graduate</option>
                                        <option value="5">Illiterate</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-md-12" for="example-text">Blood Group</label>
                                <div class="col-sm-12">
                                    <select name="blood_gp" class="form-control select2" style="width:100%">
                                        <option value="">Select</option>
                                        <option value="A+">A+</option>
                                        <option value="A-">A-</option>
                                        <option value="B+">B+</option>
                                        <option value="B-">B-</option>
                                        <option value="AB+">AB+</option>
                                        <option value="AB-">AB-</option>
                                        <option value="O+">O+</option>
                                        <option value="O-">O-</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-md-12" for="example-text">Father's Profession</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" name="father_profession">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-md-12" for="example-text">Mother's Profession</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" name="mother_profession">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-md-12" for="example-text">Bank Name</label>
                                <div class="col-sm-12">
                                    <select name="bank_id" class="form-control select2" style="width:100%">
                                        <option value="">Select</option>
                                        <?php foreach($banks as $row): ?>
                                            <option value="<?php echo $row['bank_id']; ?>"><?php echo html_escape($row['bank_name']); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-md-12" for="example-text">Account Number</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" name="account_number">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-md-12" for="example-text">Full Address<span class="bg-require">*</span></label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" name="address" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-md-12" for="example-text">Residential</label>
                                <div class="col-sm-12">
                                    <select name="residential" class="form-control select2" style="width:100%">
                                        <option value="">Select</option>
                                        <option value="Day Scholar">Day Scholar</option>
                                        <option value="Hosteller">Hosteller</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Previous School & Group -->
                    <div class="row panel-body">
                        <div class="col-sm-12">
                            <div class="panel-heading"><i class="fa fa-list"></i>&nbsp;&nbsp;Educational Information</div>
                        </div>
                    </div>
                    <div class="row panel-body">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-md-12" for="example-text">Previous School Attended<span class="bg-require">*</span></label>
                                <div class="row col-md-12">
                                    <div class="col-sm-10">
                                        <select name="ps_id" id="ps_id" class="form-control select2" style="width:100%" required>
                                            <option value="">Select</option>
                                            <?php foreach($previous_schools as $row): ?>
                                                <option value="<?php echo $row['previous_school_id']; ?>"><?php echo html_escape($row['name']); ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-2">
                                        <a onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/modal_add_previous_school');"><button type="button" class="btn btn-info btn-circle btn-xs"><i class="fa fa-plus"></i></button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4" id="group_wrapper" style="display:none;">
                            <div class="form-group">
                                <label class="col-md-12" for="example-text">Group Name</label>
                                <div class="row col-md-12">
                                    <div class="col-sm-10">
                                        <select name="group_id" id="group_id" class="form-control select2" style="width:100%">
                                            <option value="">Select</option>
                                            <?php foreach($groups as $row): ?>
                                                <option value="<?php echo $row['group_id']; ?>"><?php echo html_escape($row['group_name']); ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-2">
                                        <a onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/modal_add_group');"><button type="button" class="btn btn-info btn-circle btn-xs"><i class="fa fa-plus"></i></button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-md-12" for="example-text">Admission Std<span class="bg-require">*</span></label>
                                <div class="col-sm-12">
                                    <select name="class_id" class="form-control select2" style="width:100%" id="class_id" required onchange="return get_class_sections(this.value)">
                                        <option value="">Select</option>
                                        <?php foreach($classes as $row): ?>
                                            <option value="<?php echo $row['class_id']; ?>"><?php echo html_escape($row['name']); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-9" for="example-text">Password</label>
                                <div class="col-sm-12">
                                    <input type="password" autocomplete="new-password" class="form-control" name="password" value="" onkeyup="CheckPasswordStrength(this.value)">
                                    <strong id="password_strength"></strong>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-md-9" for="example-text">Division<span class="bg-require">*</span></label>
                                <div class="col-sm-12">
                                    <select name="section_id" class="form-control select2" style="width:100%" id="section_selector_holder" required>
                                        <option value="">Select Standard First</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-9" for="example-text">Photo (Below 50Kb)</label>
                                <div class="col-sm-12">
                                    <input type="file" name="userfile" onChange="readURL(this);" style="color:red">
                                    <img id="blah" src="<?php echo base_url(); ?>uploads/default_avatar.jpg" alt="your image" height="150" width="150" style="border:1px dotted red">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Submit -->
                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-sm btn-rounded btn-block">
                            <i class="fa fa-plus"></i>&nbsp;Save Student
                        </button>
                        <img id="install_progress" src="<?php echo base_url(); ?>assets/images/loader-2.gif" style="margin-left: 20px; display: none"/>
                    </div>

                    <?php echo form_close(); ?>

                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function get_class_sections(class_id) {
        var classText = $('#class_id option:selected').text().toLowerCase();
        var isHigher = (class_id == "3" || class_id == "15" || classText.indexOf('11') >= 0 || classText.indexOf('12') >= 0 || classText.indexOf('xi') >= 0 || classText.indexOf('xii') >= 0);
        if (isHigher) {
            $('#group_wrapper').show();
        } else {
            $('#group_wrapper').hide();
            $('#group_id').val('');
        }
        $.ajax({
            url: '<?php echo base_url(); ?>admin/get_class_section/' + class_id,
            success: function(response) {
                jQuery('#section_selector_holder').html(response);
            }
        });
    }

    function get_religion_category(re_id) {
        $.ajax({
            url: '<?php echo base_url(); ?>admin/get_religion_category/' + re_id,
            success: function(response) {
                jQuery('#section_selector_holder_category').html(response);
                var cat_id = $('#section_selector_holder_category').val();
                if (cat_id) {
                    get_category_cast(cat_id);
                }
            }
        });
    }

    function get_category_cast(cat_id) {
        $.ajax({
            url: '<?php echo base_url(); ?>admin/get_category_cast/' + cat_id,
            success: function(response) {
                jQuery('#section_selector_holder_cast').html(response);
            }
        });
    }

    function CheckPasswordStrength(password) {
        var password_strength = document.getElementById("password_strength");
        if (password.length == 0) { password_strength.innerHTML = ""; return; }
        var regex = new Array();
        regex.push("[A-Z]");
        regex.push("[a-z]");
        regex.push("[0-9]");
        regex.push("[$@$!%*#?&]");
        var passed = 0;
        for (var i = 0; i < regex.length; i++) {
            if (new RegExp(regex[i]).test(password)) { passed++; }
        }
        var color = "";
        var strength = "";
        switch (passed) {
            case 0: case 1: case 2: strength = "Weak"; color = "red"; break;
            case 3: strength = "Medium"; color = "orange"; break;
            case 4: strength = "Strong"; color = "green"; break;
        }
        password_strength.innerHTML = strength;
        password_strength.style.color = color;
    }

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) { $('#blah').attr('src', e.target.result); }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $(document).ready(function() {
        $("#gen_reg_no").on("blur", function(e) {
            $('#existmsg').hide();
            var grn_no = $('#gen_reg_no').val();
            if (grn_no != null && grn_no != "") {
                $.ajax({
                    url: '<?php echo base_url(); ?>admin/checkforgrn/' + grn_no,
                    dataType: "html",
                    cache: false,
                    success: function(existmsg) {
                        $('#existmsg').show();
                        $("#existmsg").html(existmsg);
                    }
                });
            }
        });
    });
</script>
