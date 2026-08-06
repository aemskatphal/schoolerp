<?php if(!empty($pre_student)): ?>
<style>
.profile-head {
    padding: 30px 0;
    border-radius: 8px;
    position: relative;
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
    overflow: hidden;
    color: #fff;
    margin-bottom: 10px;
}
.profile-head::before {
    content: "";
    position: absolute;
    height: 100%;
    width: 80%;
    background: #ab8ce4;
    opacity: .40;
    top: 0;
}
.profile-head h5 {
    width: 100%;
    padding: 5px 5px 0px 5px;
    font-weight: bold;
    color: #000;
    font-size: 25px;
    text-transform: capitalize;
    margin-bottom: 0;
}
.profile-head p {
    width: 100%;
    text-align: justify;
    padding: 5px;
    color: #000;
    font-size: 17px;
    text-transform: capitalize;
    margin: 0;
}
.profile-head ul {
    list-style: none;
    padding: 0;
}
.profile-head ul li {
    display: block;
    color: #000;
    padding: 7px;
    font-weight: 400;
    font-size: 15px;
}
.profile-head ul li .icon-holder {
    display: inline-block;
    height: 27px;
    width: 27px;
    line-height: 25px;
    text-align: center;
    background: transparent;
    border-radius: 15px;
    transform: rotate(0deg);
    z-index: 1;
    margin-right: 10px;
}
.profile-head ul li .icon-holder:before {
    position: absolute;
    margin: 0 auto;
    display: block;
    height: 27px;
    width: 27px;
    background: #ffbd2e;
    border-radius: 3px;
    transform: rotate(45deg);
    content: "";
    z-index: -1;
    transition: all 500ms ease;
    box-shadow: 0 2px 4px #3c3a3a;
}
.profile-head ul li:hover .icon-holder:before {
    transform: rotate(0deg);
}
.profile-head ul li .icon-holder i:before {
    font-size: 14px;
    color: #313536;
    line-height: 27px;
    display: block;
    z-index: 1;
}
.image-content-center {
    display: block;
    position: relative;
    overflow: hidden;
    width: 100%;
    max-width: 100%;
    padding: 5px 10px;
    font-size: 14px;
    line-height: 22px;
    border: 1px solid #E5E5E5;
    border-radius: 5px;
}
.image-content-center.user-pro {
    height: 200px;
    max-width: 60%;
    margin: 0 auto;
    border: none;
}
.image-content-center .preview {
    position: absolute;
    z-index: 1;
    padding: 10px;
    width: 100%;
    height: 100%;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    overflow: hidden;
    text-align: center;
}
.image-content-center .preview img {
    top: 50%;
    transform: translate(0, -50%);
    position: relative;
    max-width: 100%;
    height: inherit;
}
@media only screen and (max-width: 1600px) {
    .profile-head::before { width: 100%; }
}
@media only screen and (max-width: 991px) {
    .profile-head::before { width: 100%; left: 0; right: 0; transform: none; }
}
</style>

<div class="row">
    <div class="col-md-12 mb-lg">
        <div class="profile-head">
            <div class="col-md-12 col-lg-4 col-xl-3">
                <div class="image-content-center user-pro">
                    <div class="preview">
                        <?php
                        $photo_src = !empty($pre_student['userfile']) ? base_url().'uploads/pre_student/'.$pre_student['userfile'] : base_url().'uploads/default.png';
                        ?>
                        <img src="<?php echo $photo_src; ?>">
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-8 col-xl-8">
                <h5><?php echo html_escape($pre_student['name']); ?></h5>
                <p>Pending Admission / <?php echo ($pre_student['ad_type'] == 'RTE') ? 'RTE' : 'Regular'; ?></p>
                <ul>
                    <li>
                        <div class="icon-holder" data-toggle="tooltip" data-original-title="Guardian Name"><i class="fa fa-user"></i></div> <?php echo html_escape($pre_student['father_name']); ?></li>
                    <li>
                        <div class="icon-holder" data-toggle="tooltip" data-original-title="Class"><i class="fa fa-institution"></i></div> <?php echo $pre_student['class_name']; ?>&nbsp;&nbsp;|&nbsp;&nbsp;<?php echo html_escape($pre_student['ad_year']); ?></li>
                    <li>
                        <div class="icon-holder" data-toggle="tooltip" data-original-title="Mobile No"><i class="fa fa-phone"></i></div> <?php echo html_escape($pre_student['parent_phone']); ?></li>
                    <li>
                        <div class="icon-holder" data-toggle="tooltip" data-original-title="Address"><i class="fa fa-home"></i></div> <?php echo html_escape($pre_student['address']); ?></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="panel-group" id="accordion">

            <!-- Panel 1: Edit Details -->
            <div class="panel panel-accordion">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#editdetails">
                            <i class="fa fa-pencil"></i> Edit Details</a>
                    </h4>
                </div>
                <div id="editdetails" class="accordion-body collapse in">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="panel panel-info">
                                <div class="panel-wrapper collapse in" aria-expanded="true">
                                    <div class="panel-body table-responsive">
                                        <form action="<?php echo base_url();?>admin/view_pre_student_update/<?php echo $pre_student['pre_student_id'];?>" class="form-horizontal form-groups-bordered validate" enctype="multipart/form-data" method="post" accept-charset="utf-8" novalidate>

                                            <!-- Admission Information -->
                                            <div class="row panel-body">
                                                <div class="col-sm-12">
                                                    <div class="panel-heading"><i class="fa fa-list"></i>&nbsp;&nbsp;Admission Information</div>
                                                </div>
                                            </div>
                                            <div class="row panel-body">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label class="col-md-12">Admission Status<span class="bg-require">*</span></label>
                                                        <div class="col-sm-12">
                                                            <select name="status" class="form-control select2" style="width:100%" id="pre_student_status">
                                                                <option value="pending" <?php if($pre_student['status']=='pending') echo 'selected';?>>Pending</option>
                                                                <option value="approved" <?php if($pre_student['status']=='approved') echo 'selected';?>>Confirm (Approved)</option>
                                                                <option value="rejected" <?php if($pre_student['status']=='rejected') echo 'selected';?>>Rejected</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-12">Academic Year<span class="bg-require">*</span></label>
                                                        <div class="col-sm-12">
                                                            <select name="ad_year" class="form-control select2" readonly>
                                                                <option value="<?php echo html_escape($pre_student['ad_year']); ?>"><?php echo html_escape($pre_student['ad_year']); ?></option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-9">Type Of Admission<span class="bg-require">*</span></label>
                                                        <div class="col-sm-12">
                                                            <select name="ad_type" class="form-control select2" style="width:100%">
                                                                <option value="Regular" <?php if(empty($pre_student['ad_type']) || $pre_student['ad_type']=='Regular') echo 'selected';?>>Regular</option>
                                                                <option value="RTE" <?php if($pre_student['ad_type']=='RTE') echo 'selected';?>>RTE</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-12">Academy Name</label>
                                                        <div class="row col-md-12">
                                                            <div class="col-sm-10">
                                                                <select name="academy_id" id="academy_id" class="form-control">
                                                                    <option value="">Select</option>
                                                                    <?php foreach($academies as $acd): ?>
                                                                        <option value="<?php echo $acd['academy_id'];?>" <?php if($pre_student['academy_id']==$acd['academy_id']) echo 'selected';?>><?php echo html_escape($acd['academy_name']);?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                            <div class="col-sm-2">
                                                                <a onclick="showAjaxModal('<?php echo base_url();?>modal/popup/modal_add_academy');"><button type="button" class="btn btn-info btn-circle btn-xs"><i class="fa fa-plus"></i></button></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label class="col-md-9">Admission Date<span class="bg-require">*</span></label>
                                                        <div class="col-sm-12">
                                                            <input type="date" class="form-control datepicker" name="ad_date" value="<?php echo html_escape($pre_student['ad_date']); ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-12">General Register Number</label>
                                                        <div class="col-sm-12">
                                                            <input type="text" value="<?php echo html_escape($pre_student['gen_reg_no']); ?>" class="form-control" name="gen_reg_no" id="gen_reg_no" required>
                                                            <span style="color:#e74c3c; font-size:11px;">* General Register Number is mandatory for approval</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-12">Board Name</label>
                                                        <div class="row col-md-12">
                                                            <div class="col-sm-10">
                                                                <select name="board_id" id="board_id" class="form-control">
                                                                    <option value="">Select</option>
                                                                    <?php foreach($boards as $brd): ?>
                                                                        <option value="<?php echo $brd['board_id'];?>" <?php if($pre_student['board_id']==$brd['board_id']) echo 'selected';?>><?php echo html_escape($brd['board_name']);?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                            <div class="col-sm-2">
                                                                <a onclick="showAjaxModal('<?php echo base_url();?>modal/popup/modal_add_board');"><button type="button" class="btn btn-info btn-circle btn-xs"><i class="fa fa-plus"></i></button></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label class="col-md-12">Saral Number</label>
                                                        <div class="col-sm-12">
                                                            <input type="text" value="<?php echo html_escape($pre_student['student_no']); ?>" class="form-control" name="student_no">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-12">UID Number</label>
                                                        <div class="col-sm-12">
                                                            <input type="text" value="<?php echo html_escape($pre_student['uid']); ?>" class="form-control" name="uid">
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
                                                        <label class="col-md-12">Full Name<span class="bg-require">*</span></label>
                                                        <div class="col-sm-12">
                                                            <input type="text" value="<?php echo html_escape($pre_student['name']); ?>" class="form-control" name="name" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label class="col-md-12">Full Name Of Father<span class="bg-require">*</span></label>
                                                        <div class="col-sm-12">
                                                            <input type="text" value="<?php echo html_escape($pre_student['father_name']); ?>" class="form-control" name="father_name" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-12">Mother Name<span class="bg-require">*</span></label>
                                                        <div class="col-sm-12">
                                                            <input type="text" value="<?php echo html_escape($pre_student['mother_name']); ?>" class="form-control" name="mother_name" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-9">Parent Mobile No</label>
                                                        <div class="col-sm-12">
                                                            <input type="text" value="<?php echo html_escape($pre_student['parent_phone']); ?>" class="form-control" name="parent_phone">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-9">Gender<span class="bg-require">*</span></label>
                                                        <div class="col-sm-12">
                                                            <select name="sex" class="form-control select2" style="width:100%">
                                                                <option value="">Select</option>
                                                                <option value="male" <?php if($pre_student['sex']=='male') echo 'selected';?>>Male</option>
                                                                <option value="female" <?php if($pre_student['sex']=='female') echo 'selected';?>>Female</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-9">Date Of Birth</label>
                                                        <div class="col-sm-12">
                                                            <input type="date" value="<?php echo html_escape($pre_student['birthday']); ?>" class="form-control datepicker" name="birthday">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-12">Religion</label>
                                                        <div class="col-sm-12">
                                                            <select name="re_id" id="rel" class="form-control select2" onchange="return get_religion_category(this.value)">
                                                                <option value="">Select</option>
                                                                <?php foreach($religions as $rel): ?>
                                                                    <option value="<?php echo $rel['religion_id'];?>" <?php if($pre_student['re_id']==$rel['religion_id']) echo 'selected';?>><?php echo html_escape($rel['religion_name']);?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-12">Parent UID (Aadhar Card)</label>
                                                        <div class="col-sm-12">
                                                            <input type="number" class="form-control" value="<?php echo html_escape($pre_student['parent_uid']); ?>" name="parent_uid">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label class="col-md-12">Student Mobile No</label>
                                                        <div class="col-sm-12">
                                                            <input type="text" value="<?php echo html_escape($pre_student['phone']); ?>" class="form-control" name="phone">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-9">Nationality</label>
                                                        <div class="col-sm-12">
                                                            <select name="nationality" class="form-control select2" style="width:100%">
                                                                <option value="">Select</option>
                                                                <option value="Indian" <?php if($pre_student['nationality']=='Indian') echo 'selected';?>>Indian</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-9">Birth Place</label>
                                                        <div class="col-sm-12">
                                                            <input type="text" value="<?php echo html_escape($pre_student['birth_place']); ?>" class="form-control" name="birth_place">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-12">Category</label>
                                                        <div class="col-sm-12">
                                                            <select name="cat_id" id="cat" class="form-control select2" onchange="return get_category_cast(this.value)">
                                                                <option value="">Select Religion First</option>
                                                                <?php foreach($categories as $cat): ?>
                                                                    <option value="<?php echo $cat['category_id'];?>" <?php if($pre_student['cat_id']==$cat['category_id']) echo 'selected';?>><?php echo html_escape($cat['cat_name']);?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label class="col-md-12">Blood Group</label>
                                                        <div class="col-sm-12">
                                                            <input type="text" value="<?php echo html_escape($pre_student['blood_gp']); ?>" class="form-control" name="blood_gp">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-12">Mother Tongue</label>
                                                        <div class="col-sm-12">
                                                            <select name="mt_id" id="mt" class="form-control select2">
                                                                <option value="">Select</option>
                                                                <?php foreach($mother_tongues as $mt): ?>
                                                                    <option value="<?php echo $mt['mother_tongue_id'];?>" <?php if($pre_student['mt_id']==$mt['mother_tongue_id']) echo 'selected';?>><?php echo html_escape($mt['mother_tongue_name']);?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-9">Full Address</label>
                                                        <div class="col-sm-12">
                                                            <input type="text" value="<?php echo html_escape($pre_student['address']); ?>" name="address" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-9">Caste</label>
                                                        <div class="row col-md-12">
                                                            <div class="col-sm-10">
                                                                <select name="cast_id" class="form-control select2" id="section_selector_holder_cast">
                                                                    <option value="">Select</option>
                                                                    <?php foreach($casts as $cst): ?>
                                                                        <option value="<?php echo $cst['cast_id'];?>" <?php if($pre_student['cast_id']==$cst['cast_id']) echo 'selected';?>><?php echo html_escape($cst['cast_name']);?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                            <div class="col-sm-2">
                                                                <a href="#" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/modal_add_cast');"><button type="button" class="btn btn-info btn-circle btn-xs"><i class="fa fa-plus"></i></button></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Educational Information -->
                                            <div class="row panel-body">
                                                <div class="col-sm-12">
                                                    <div class="panel-heading"><i class="fa fa-list"></i>&nbsp;&nbsp;Educational Information</div>
                                                </div>
                                            </div>
                                            <div class="row panel-body">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label class="col-md-12">Prev School Name</label>
                                                        <div class="row col-md-12">
                                                            <div class="col-sm-10">
                                                                <select name="ps_id" class="form-control select2" id="ps_id">
                                                                    <option value="">Select</option>
                                                                    <?php foreach($previous_schools as $ps): ?>
                                                                        <option value="<?php echo $ps['previous_school_id'];?>" <?php if($pre_student['ps_id']==$ps['previous_school_id']) echo 'selected';?>><?php echo html_escape($ps['name']);?></option>
                                                                    <?php endforeach; ?>
                                                                    <?php
                                                                    $ps_val = $pre_student['ps_id'];
                                                                    if(!empty($ps_val) && !is_numeric($ps_val)){
                                                                        $ps_match = false;
                                                                        foreach($previous_schools as $ps){
                                                                            if($ps['previous_school_id'] == $ps_val){ $ps_match = true; break; }
                                                                        }
                                                                        if(!$ps_match){
                                                                            echo '<option value="'.html_escape($ps_val).'" selected>'.html_escape($ps_val).'</option>';
                                                                        }
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="col-sm-2">
                                                                <a href="#" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/modal_add_previous_school');"><button type="button" class="btn btn-info btn-circle btn-xs"><i class="fa fa-plus"></i></button></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group" id="group_wrapper" <?php $cls_name = strtolower($pre_student['class_name']); if(!(strpos($cls_name, '11') !== false || strpos($cls_name, '12') !== false || strpos($cls_name, 'xi') !== false || strpos($cls_name, 'xii') !== false)) echo 'style="display:none;"';?>>
                                                        <label class="col-md-12">Group Name</label>
                                                        <div class="row col-md-12">
                                                            <div class="col-sm-10">
                                                                <select name="group_id" class="form-control select2" id="group_id">
                                                                    <option value="">Select</option>
                                                                    <?php foreach($student_groups as $grp): ?>
                                                                        <option value="<?php echo $grp['group_id'];?>" <?php if($pre_student['group_id']==$grp['group_id']) echo 'selected';?>><?php echo html_escape($grp['group_name']);?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                            <div class="col-sm-2">
                                                                <a href="#" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/modal_add_group');"><button type="button" class="btn btn-info btn-circle btn-xs"><i class="fa fa-plus"></i></button></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-12">Current Std</label>
                                                        <div class="col-sm-12">
                                                            <?php
                                                            $current_class_name = '';
                                                            foreach($classes as $cls){
                                                                if($cls['class_id'] == $pre_student['class_id']){ $current_class_name = $cls['name']; break; }
                                                            }
                                                            ?>
                                                            <input type="text" class="form-control" value="<?php echo html_escape($current_class_name); ?>" readonly style="background:#f5f5f5;">
                                                            <input type="hidden" name="class_id" value="<?php echo html_escape($pre_student['class_id']); ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-12">Admission Std</label>
                                                        <div class="col-sm-12">
                                                            <select name="ad_class_id" class="form-control select2" style="width:100%" id="ad_class_id">
                                                                <option value="">Select</option>
                                                                <?php foreach($classes as $cls): ?>
                                                                    <option value="<?php echo $cls['class_id'];?>" <?php if($pre_student['ad_class_id']==$cls['class_id']) echo 'selected';?>><?php echo html_escape($cls['name']);?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label class="col-md-12">Division</label>
                                                        <div class="col-sm-12">
                                                            <select name="section_id" id="section_selector_holder" class="form-control select2">
                                                                <option value="">Select</option>
                                                                <?php foreach($sections as $sec): ?>
                                                                    <option value="<?php echo $sec['section_id'];?>" <?php if($pre_student['section_id']==$sec['section_id']) echo 'selected';?>><?php echo html_escape($sec['name']);?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label class="col-md-12">Photo (File Size Below 50Kb)</label>
                                                        <div class="col-sm-12">
                                                            <input type="file" name="userfile" accept="image/*" onchange="readURL(this);" style="color:red">
                                                            <img id="blah" src="<?php echo $photo_src;?>" alt="your image" height="150" width="150" style="border:1px dotted red; margin-top:10px;">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <button type="submit" class="btn btn-success btn-sm btn-rounded btn-block" id="show"><i class="fa fa-plus"></i>&nbsp; Update & Save</button>
                                                <img id="install_progress" src="<?php echo base_url();?>assets/images/loader-2.gif" style="margin-left: 20px; display: none" />
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

                <script>
                                    $('form').on('submit', function(e){
                                        var errors = [];
                                        var firstEmpty = null;

                                        var adType = $('select[name="ad_type"]').val();
                                        if(!adType){ errors.push('Type Of Admission'); if(!firstEmpty) firstEmpty = $('select[name="ad_type"]'); }

                                        var adDate = $('input[name="ad_date"]').val();
                                        if(!adDate){ errors.push('Admission Date'); if(!firstEmpty) firstEmpty = $('input[name="ad_date"]'); }

                                        var name = $('input[name="name"]').val().trim();
                                        if(!name){ errors.push('Full Name'); if(!firstEmpty) firstEmpty = $('input[name="name"]'); }

                                        var fatherName = $('input[name="father_name"]').val().trim();
                                        if(!fatherName){ errors.push('Father Name'); if(!firstEmpty) firstEmpty = $('input[name="father_name"]'); }

                                        var motherName = $('input[name="mother_name"]').val().trim();
                                        if(!motherName){ errors.push('Mother Name'); if(!firstEmpty) firstEmpty = $('input[name="mother_name"]'); }

                                        var gender = $('select[name="sex"]').val();
                                        if(!gender){ errors.push('Gender'); if(!firstEmpty) firstEmpty = $('select[name="sex"]'); }

                                        var status = $('#pre_student_status').val();
                                        var genReg = $('#gen_reg_no').val().trim();
                                        if(status === 'approved' && genReg === ''){
                                            errors.push('General Register Number (required for approval)');
                                            if(!firstEmpty) firstEmpty = $('#gen_reg_no');
                                        }

                                        if(errors.length > 0){
                                            e.preventDefault();
                                            showWarningToast('Please fill in all mandatory fields.');
                                            if(firstEmpty) firstEmpty.focus();
                                            return false;
                                        }
                                    });
                                </script>

                                <!-- Panel 2: Uploaded Documents -->
            <div class="panel panel-accordion">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#uploaddocs">
                            <i class="fa fa-file"></i> Uploaded Documents</a>
                    </h4>
                </div>
                <div id="uploaddocs" class="accordion-body collapse in">
                    <div class="panel-body">
                        <div class="row" style="padding:0 15px;">
                            <?php
                            $docs = array(
                                'leaving_certificate' => 'Leaving Certificate',
                                'marksheet' => 'Marksheet',
                                'aadhar_card_student' => 'Aadhar Card (Student)',
                                'aadhar_card_parent' => 'Aadhar Card (Parent)',
                                'migration_certificate' => 'Migration Certificate'
                            );
                            $has_docs = false;
                            foreach($docs as $field => $label):
                                if(!empty($pre_student[$field])):
                                    $has_docs = true;
                            ?>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label style="font-weight:bold;color:#333;"><?php echo $label; ?></label><br>
                                    <a href="<?php echo base_url();?>uploads/pre_student/<?php echo $pre_student[$field]; ?>" target="_blank">
                                        <?php if(pathinfo($pre_student[$field], PATHINFO_EXTENSION) == 'pdf'): ?>
                                            <i class="fa fa-file-pdf-o fa-3x"></i>&nbsp;View PDF
                                        <?php else: ?>
                                            <img src="<?php echo base_url();?>uploads/pre_student/<?php echo $pre_student[$field]; ?>" style="max-width:200px;max-height:200px;border:1px solid #ddd;border-radius:4px;margin:5px;">
                                        <?php endif; ?>
                                    </a>
                                </div>
                            </div>
                            <?php
                                endif;
                            endforeach;
                            if(!$has_docs):
                            ?>
                            <div class="col-md-12">
                                <p style="color:#999;font-style:italic;">No documents uploaded yet.</p>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Panel 3: Promotion History -->
            <div class="panel panel-accordion">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#promotion">
                            <i class="fa fa-arrow-up"></i> Promotion History</a>
                    </h4>
                </div>
                <div id="promotion" class="accordion-body collapse">
                    <div class="panel-body">
                        <div class="table-responsive mb-md">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Promoted Date</th>
                                        <th>Student Name</th>
                                        <th>Promotion Details</th>
                                        <th>Remark</th>
                                        <th>Entry User</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(!empty($promotion_history)): ?>
                                        <?php $i = 1; foreach($promotion_history as $ph): ?>
                                        <tr>
                                            <td><?php echo $i++; ?></td>
                                            <td><?php echo date('d-m-Y', strtotime($ph['promoted_at'])); ?></td>
                                            <td><?php echo $ph['student_name']; ?></td>
                                            <td><?php echo $ph['old_class_name'].' - '.$ph['new_class_name']; ?></td>
                                            <td><?php echo $ph['session'] ? $ph['session'] : '-'; ?></td>
                                            <td><?php echo $ph['promoted_by']; ?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Panel 4: Documents History -->
            <div class="panel panel-accordion">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#documenthistory">
                            <i class="fa fa-file"></i> Documents History</a>
                    </h4>
                </div>
                <div id="documenthistory" class="accordion-body collapse">
                    <div class="panel-body">
                        <div class="table-responsive mb-md">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Created At</th>
                                        <th>Sr. No.</th>
                                        <th>Document Type</th>
                                        <th>Document Version</th>
                                        <th>Document Charges</th>
                                        <th>Fee Remark</th>
                                        <th>Entry User</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(!empty($documents)): ?>
                                        <?php $i = 1; foreach($documents as $doc): ?>
                                        <tr>
                                            <td><?php echo $i++; ?></td>
                                            <td><?php echo date('d-m-Y', strtotime($doc['created_at'])); ?></td>
                                            <td><?php echo $doc['sr_no']; ?></td>
                                            <td><?php echo $doc['document_type']; ?></td>
                                            <td><?php echo $doc['document_version']; ?></td>
                                            <td><?php echo $doc['document_charges']; ?></td>
                                            <td><?php echo $doc['fee_remark']; ?></td>
                                            <td><?php echo $doc['entry_user']; ?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Panel 5: Fees -->
            <div class="panel panel-accordion">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#fees">
                            <i class="fa fa-credit-card"></i> Fees</a>
                    </h4>
                </div>
                <div id="fees" class="accordion-body collapse">
                    <div class="panel-body">
                        <div class="table-responsive mt-md mb-md">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Created At</th>
                                        <th>Status</th>
                                        <th>Total</th>
                                        <th>Paid</th>
                                        <th>Due</th>
                                        <th>Action</th>
                                        <th>Entry User</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Panel 6: Other Documents -->
            <div class="panel panel-accordion">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#otherdocs">
                            <i class="fa fa-folder-open"></i> Other Documents</a>
                    </h4>
                </div>
                <div id="otherdocs" class="accordion-body collapse">
                    <div class="panel-body">
                        <div class="pull-left mb-3">
                            <a class="btn btn-inverse btn-sm btn-rounded btn-block" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/modal_add_document/<?php echo $pre_student['pre_student_id'];?>');"><i class="fa fa-plus ti-plus"></i> Add Document</a>
                        </div>
                        <div class="table-responsive mb-md">
                            <table class="table table-bordered table-hover table-condensed mb-none">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Created At</th>
                                        <th>Document Type</th>
                                        <th>Remarks</th>
                                        <th>Actions</th>
                                        <th>Entry User</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(!empty($documents)): ?>
                                    <?php $doc_num = 1; foreach($documents as $doc): ?>
                                    <tr>
                                        <td><?php echo $doc_num++; ?></td>
                                        <td><?php echo date('d-m-Y', strtotime($doc['created_at'])); ?></td>
                                        <td><?php echo html_escape($doc['document_type']); ?></td>
                                        <td><?php echo html_escape($doc['remarks']); ?></td>
                                        <td class="min-w-c">
                                            <?php if(!empty($doc['document_file'])): ?>
                                            <a href="<?php echo base_url();?>uploads/std_document/<?php echo $doc['document_file']; ?>" target="_blank" class="btn btn-default btn-circle icon"><i class="fa fa-eye"></i></a>
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo html_escape($doc['entry_user']); ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
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
        url: baseUrl + 'admin/get_class_section/' + class_id,
        success: function(response) {
            jQuery('#section_selector_holder').html(response);
        }
    });
}
</script>
<script type="text/javascript">
function get_religion_category(re_id) {
    $.ajax({
        url: baseUrl + 'admin/get_religion_category/' + re_id,
        success: function(response) {
            jQuery('#section_selector_holder_category').html(response);
            var cat_id = $('#section_selector_holder_category').val();
            if(cat_id) {
                $.ajax({
                    url: baseUrl + 'admin/get_category_cast/' + cat_id,
                    success: function(response) {
                        jQuery('#section_selector_holder_cast').html(response);
                    }
                });
            }
        }
    });
}
function get_category_cast(cat_id) {
    $.ajax({
        url: baseUrl + 'admin/get_category_cast/' + cat_id,
        success: function(response) {
            jQuery('#section_selector_holder_cast').html(response);
        }
    });
}
</script>
<script type="text/javascript">
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) { $('#blah').attr('src', e.target.result); }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
<?php endif; ?>
