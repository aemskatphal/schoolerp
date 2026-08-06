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
                        $photo_src = !empty($student['photo']) ? base_url().'uploads/student_image/'.$student['photo'] : base_url().'uploads/default.png';
                        ?>
                        <img src="<?php echo $photo_src; ?>">
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-8 col-xl-8">
                <h5><?php echo html_escape($student['name']); ?></h5>
                <p>Student / <?php echo ($student['ad_type'] == 2) ? 'RTE' : 'Regular'; ?></p>
                <ul>
                    <li>
                        <div class="icon-holder" data-toggle="tooltip" data-original-title="Guardian Name"><i class="fa fa-user"></i></div> <?php echo html_escape($student['father_name']); ?></li>
                    <li>
                        <div class="icon-holder" data-toggle="tooltip" data-original-title="Class"><i class="fa fa-institution"></i></div> <?php echo html_escape($student['class_name']); ?>&nbsp;&nbsp;|&nbsp;&nbsp;<?php echo html_escape($student['ad_year']); ?></li>
                    <li>
                        <div class="icon-holder" data-toggle="tooltip" data-original-title="Mobile No"><i class="fa fa-phone"></i></div> <?php echo html_escape($student['parent_phone']); ?></li>
                    <li>
                        <div class="icon-holder" data-toggle="tooltip" data-original-title="Present Address"><i class="fa fa-home"></i></div> <?php echo html_escape($student['address']); ?></li>
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
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#profile">
                            <i class="fa fa-pencil"></i> Edit Details</a>
                    </h4>
                </div>
                <div id="profile" class="accordion-body collapse in">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="panel panel-info">
                                <div class="panel-wrapper collapse in" aria-expanded="true">
                                    <div class="panel-body table-responsive">
                                        <form action="<?php echo base_url();?>admin/view_student_update/<?php echo $student['student_id'];?>" class="form-horizontal form-groups-bordered validate" enctype="multipart/form-data" method="post" accept-charset="utf-8" novalidate>

                                            <!-- Admission Information -->
                                            <div class="row panel-body">
                                                <div class="col-sm-12">
                                                    <div class="panel-heading"><i class="fa fa-list"></i>&nbsp;&nbsp;Admission Information</div>
                                                </div>
                                            </div>
                                            <div class="row panel-body">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label class="col-md-12">Academic Year<span class="bg-require">*</span></label>
                                                        <div class="col-sm-12">
                                                            <select name="ad_year" class="form-control select2" id="ad_year" readonly>
                                                                <option value="<?php echo html_escape($student['ad_year']); ?>"><?php echo html_escape($student['ad_year']); ?></option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-9">Type Of Admission<span class="bg-require">*</span></label>
                                                        <div class="col-sm-12">
                                                            <select name="ad_type" class="form-control select2" style="width:100%">
                                                                <option value="">Select</option>
                                                                <option value="1" <?php if($student['ad_type']==1) echo 'selected';?>>Regular</option>
                                                                <option value="2" <?php if($student['ad_type']==2) echo 'selected';?>>RTE</option>
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
                                                                        <option value="<?php echo $acd['academy_id'];?>" <?php if($student['academy_id']==$acd['academy_id']) echo 'selected';?>><?php echo html_escape($acd['academy_name']);?></option>
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
                                                            <input type="date" class="form-control datepicker" name="ad_date" value="<?php echo html_escape($student['ad_date']); ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-12">General Register Number<span class="bg-require">*</span></label>
                                                        <div class="col-sm-12">
                                                            <input type="text" value="<?php echo html_escape($student['gen_reg_no']); ?>" class="form-control" name="gen_reg_no" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-12">Board Name</label>
                                                        <div class="row col-md-12">
                                                            <div class="col-sm-10">
                                                                <select name="board_id" id="board_id" class="form-control">
                                                                    <option value="">Select</option>
                                                                    <?php foreach($boards as $brd): ?>
                                                                        <option value="<?php echo $brd['board_id'];?>" <?php if($student['board_id']==$brd['board_id']) echo 'selected';?>><?php echo html_escape($brd['board_name']);?></option>
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
                                                        <label class="col-md-12">Saral Number<span class="bg-require">*</span></label>
                                                        <div class="col-sm-12">
                                                            <input type="text" value="<?php echo html_escape($student['student_no']); ?>" class="form-control" name="student_no" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-12">UID Number<span class="bg-require">*</span></label>
                                                        <div class="col-sm-12">
                                                            <input type="text" value="<?php echo html_escape($student['uid']); ?>" class="form-control" name="uid" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-12">Admission Remarks</label>
                                                        <div class="col-sm-12">
                                                            <input type="text" value="<?php echo html_escape($student['ad_remarks']); ?>" class="form-control" name="ad_remarks">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label class="col-md-9">School Leaving Date</label>
                                                        <div class="col-sm-12">
                                                            <input type="date" value="<?php echo html_escape($student['leaving_date']); ?>" class="form-control datepicker" name="leaving_date">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-8">
                                                    <div class="form-group">
                                                        <label class="col-md-12">School Leaving Reason</label>
                                                        <div class="col-sm-12">
                                                            <input type="text" value="<?php echo html_escape($student['leaving_reason']); ?>" class="form-control" name="leaving_reason">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label class="col-md-12">LC Remarks</label>
                                                        <div class="col-sm-12">
                                                            <input type="text" value="<?php echo html_escape($student['remarks']); ?>" class="form-control" name="remarks">
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
                                                            <input type="text" value="<?php echo html_escape($student['name']); ?>" class="form-control" name="name" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label class="col-md-12">Full Name Of Father<span class="bg-require">*</span></label>
                                                        <div class="col-sm-12">
                                                            <input type="text" value="<?php echo html_escape($student['father_name']); ?>" class="form-control" name="father_name" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-12">Mother Name<span class="bg-require">*</span></label>
                                                        <div class="col-sm-12">
                                                            <input type="text" value="<?php echo html_escape($student['mother_name']); ?>" class="form-control" name="mother_name" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-9">Parent Mobile No<span class="bg-require">*</span></label>
                                                        <div class="col-sm-12">
                                                            <input type="text" value="<?php echo html_escape($student['parent_phone']); ?>" class="form-control" name="parent_phone" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-9">Gender<span class="bg-require">*</span></label>
                                                        <div class="col-sm-12">
                                                            <select name="sex" class="form-control select2" style="width:100%">
                                                                <option value="">Select</option>
                                                                <option value="male" <?php if($student['sex']=='male') echo 'selected';?>>Male</option>
                                                                <option value="female" <?php if($student['sex']=='female') echo 'selected';?>>Female</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-9">Date Of Birth<span class="bg-require">*</span></label>
                                                        <div class="col-sm-12">
                                                            <input type="date" value="<?php echo html_escape($student['birthday']); ?>" class="form-control datepicker" name="birthday" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-12">Religion<span class="bg-require">*</span></label>
                                                        <div class="col-sm-12">
                                                            <select name="re_id" id="rel" class="form-control select2" onchange="return get_religion_category(this.value)">
                                                                <option value="">Select</option>
                                                                <?php foreach($religions as $rel): ?>
                                                                    <option value="<?php echo $rel['religion_id'];?>" <?php if($student['re_id']==$rel['religion_id']) echo 'selected';?>><?php echo html_escape($rel['religion_name']);?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-12">Parent UID(Aadhar Card)<span class="bg-require">*</span></label>
                                                        <div class="col-sm-12">
                                                            <input type="number" class="form-control" value="<?php echo html_escape($student['parent_uid']); ?>" name="parent_uid" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-12">Bank Name</label>
                                                        <div class="col-sm-12">
                                                            <select name="bank_id" class="form-control select2">
                                                                <option value="">Select</option>
                                                                <?php foreach($banks as $bank): ?>
                                                                    <option value="<?php echo $bank['bank_id'];?>" <?php if($student['bank_id']==$bank['bank_id']) echo 'selected';?>><?php echo html_escape($bank['bank_name']);?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label class="col-md-12">Profession Of Father</label>
                                                        <div class="col-sm-12">
                                                            <input type="text" value="<?php echo html_escape($student['father_profession']); ?>" class="form-control" name="father_profession">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-12">Profession Of Mother</label>
                                                        <div class="col-sm-12">
                                                            <input type="text" value="<?php echo html_escape($student['mother_profession']); ?>" class="form-control" name="mother_profession">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-9">Student Mobile No</label>
                                                        <div class="col-sm-12">
                                                            <input type="text" value="<?php echo html_escape($student['phone']); ?>" class="form-control" name="phone">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-9">Nationality<span class="bg-require">*</span></label>
                                                        <div class="col-sm-12">
                                                            <select name="nationality" class="form-control select2" style="width:100%">
                                                                <option value="">Select</option>
                                                                <option value="Indian" <?php if($student['nationality']=='Indian') echo 'selected';?>>Indian</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-9">Birth Place</label>
                                                        <div class="col-sm-12">
                                                            <input type="text" value="<?php echo html_escape($student['place_birth']); ?>" class="form-control" name="birth_place">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-12">Category<span class="bg-require">*</span></label>
                                                        <div class="col-sm-12">
                                                            <select name="cat_id" id="cat" class="form-control select2" onchange="return get_category_cast(this.value)">
                                                                <option value="">Select Religion First</option>
                                                                <?php foreach($categories as $cat): ?>
                                                                    <option value="<?php echo $cat['category_id'];?>" <?php if($student['cat_id']==$cat['category_id']) echo 'selected';?>><?php echo html_escape($cat['cat_name']);?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-12">Account Number</label>
                                                        <div class="col-sm-12">
                                                            <input type="text" value="<?php echo html_escape($student['account_number']); ?>" class="form-control" name="account_number" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label class="col-md-12">Education Of Father</label>
                                                        <div class="col-sm-12">
                                                            <input type="text" value="<?php echo html_escape($student['father_edu_id']); ?>" class="form-control" name="father_edu_id">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-12">Education Of Mother</label>
                                                        <div class="col-sm-12">
                                                            <input type="text" value="<?php echo html_escape($student['mother_edu_id']); ?>" class="form-control" name="mother_edu_id">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-12">Blood Group</label>
                                                        <div class="col-sm-12">
                                                            <input type="text" value="<?php echo html_escape($student['blood_group']); ?>" class="form-control" name="blood_gp">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-12">Mother Tongue<span class="bg-require">*</span></label>
                                                        <div class="col-sm-12">
                                                            <select name="mt_id" id="mt" class="form-control select2">
                                                                <option value="">Select</option>
                                                                <?php foreach($mother_tongues as $mt): ?>
                                                                    <option value="<?php echo $mt['mother_tongue_id'];?>" <?php if($student['m_tongue']==$mt['mother_tongue_id']) echo 'selected';?>><?php echo html_escape($mt['mother_tongue_name']);?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-9">Full Address<span class="bg-require">*</span></label>
                                                        <div class="col-sm-12">
                                                            <input type="text" value="<?php echo html_escape($student['address']); ?>" name="address" class="form-control" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-9">Caste<span class="bg-require">*</span></label>
                                                        <div class="row col-md-12">
                                                            <div class="col-sm-10">
                                                                <select name="cast_id" class="form-control select2" id="section_selector_holder_cast">
                                                                    <option value="">Select</option>
                                                                    <?php foreach($casts as $cst): ?>
                                                                        <option value="<?php echo $cst['cast_id'];?>" <?php if($student['cast_id']==$cst['cast_id']) echo 'selected';?>><?php echo html_escape($cst['cast_name']);?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                            <div class="col-sm-2">
                                                                <a href="#" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/modal_add_cast');"><button type="button" class="btn btn-info btn-circle btn-xs"><i class="fa fa-plus"></i></button></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-9">Residential</label>
                                                        <div class="col-sm-12">
                                                            <select name="residential" class="form-control select2" style="width:100%">
                                                                <option value="">Select</option>
                                                                <option value="yes" <?php if($student['residential']=='yes') echo 'selected';?>>Yes</option>
                                                                <option value="no" <?php if($student['residential']=='no') echo 'selected';?>>No</option>
                                                            </select>
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
                                                                    <option value="<?php echo $ps['previous_school_id'];?>" <?php if($student['ps_attended']==$ps['previous_school_id']) echo 'selected';?>><?php echo html_escape($ps['name']);?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                            <div class="col-sm-2">
                                                                <a href="#" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/modal_add_previous_school');"><button type="button" class="btn btn-info btn-circle btn-xs"><i class="fa fa-plus"></i></button></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group" id="group_wrapper" <?php $cls_name = strtolower($student['class_name']); if(!(strpos($cls_name, '11') !== false || strpos($cls_name, '12') !== false || strpos($cls_name, 'xi') !== false || strpos($cls_name, 'xii') !== false)) echo 'style="display:none;"';?>>
                                                        <label class="col-md-12">Group Name</label>
                                                        <div class="row col-md-12">
                                                            <div class="col-sm-10">
                                                                <select name="group_id" class="form-control select2" id="group_id">
                                                                    <option value="">Select</option>
                                                                    <?php foreach($student_groups as $grp): ?>
                                                                        <option value="<?php echo $grp['group_id'];?>" <?php if($student['group_id']==$grp['group_id']) echo 'selected';?>><?php echo html_escape($grp['group_name']);?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                            <div class="col-sm-2">
                                                                <a href="#" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/modal_add_group');"><button type="button" class="btn btn-info btn-circle btn-xs"><i class="fa fa-plus"></i></button></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-12">Current Std<span class="bg-require">*</span></label>
                                                        <div class="col-sm-12">
                                                            <input type="text" class="form-control" value="<?php echo html_escape($student['class_name']); ?>" readonly style="background:#f5f5f5;">
                                                            <input type="hidden" name="class_id" value="<?php echo html_escape($student['class_id']); ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label class="col-md-12">Admission Std<span class="bg-require">*</span></label>
                                                        <div class="col-sm-12">
                                                            <select name="ad_class_id" class="form-control select2" style="width:100%" id="ad_class_id">
                                                                <option value="">Select</option>
                                                                <?php foreach($classes as $cls): ?>
                                                                    <option value="<?php echo $cls['class_id'];?>" <?php if($student['ad_class_id']==$cls['class_id']) echo 'selected';?>><?php echo html_escape($cls['name']);?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-12">Password</label>
                                                        <div class="col-sm-12">
                                                            <input type="password" class="form-control" name="password" onkeyup="CheckPasswordStrength(this.value)">
                                                            <span id="password_strength"></span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-12">Division<span class="bg-require">*</span></label>
                                                        <div class="col-sm-12">
                                                            <select name="section_id" id="section_selector_holder" class="form-control select2">
                                                                <option value="">Select</option>
                                                                <?php foreach($sections as $sec): ?>
                                                                    <option value="<?php echo $sec['section_id'];?>" <?php if($student['section_id']==$sec['section_id']) echo 'selected';?>><?php echo html_escape($sec['name']);?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label class="col-md-12">Status<span class="bg-require">*</span></label>
                                                        <div class="col-sm-12">
                                                            <select name="status" class="form-control select2">
                                                                <option value="0" <?php if($student['status']==0) echo 'selected';?>>Active</option>
                                                                <option value="1" <?php if($student['status']==1) echo 'selected';?>>Inactive</option>
                                                                <option value="2" <?php if($student['status']==2) echo 'selected';?>>Out Of School</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-12">Photo(File Size Below 50Kb)</label>
                                                        <div class="col-sm-12">
                                                            <input type="file" name="userfile" accept="image/*" onchange="readURL(this);" style="color:red">
                                                            <img id="blah" src="<?php echo $photo_src;?>" alt="your image" height="150" width="150" style="border:1px dotted red; margin-top:10px;">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <button type="submit" class="btn btn-success btn-sm btn-rounded btn-block" id="show"><i class="fa fa-plus"></i>&nbsp; Update Student</button>
                                                <img id="install_progress" src="<?php echo base_url();?>assets/images/loader-2.gif" style="margin-left: 20px; display: none" />
                                            </div>

                                        </form>
                                        <script>
                                        $('form').on('submit', function(e){
                                            var errors = [];
                                            var firstEmpty = null;

                                            var genReg = $('input[name="gen_reg_no"]').val().trim();
                                            if(!genReg){ errors.push('General Register Number'); if(!firstEmpty) firstEmpty = $('input[name="gen_reg_no"]'); }

                                            var uid = $('input[name="uid"]').val().trim();
                                            if(!uid){ errors.push('UID Number'); if(!firstEmpty) firstEmpty = $('input[name="uid"]'); }

                                            var name = $('input[name="name"]').val().trim();
                                            if(!name){ errors.push('Full Name'); if(!firstEmpty) firstEmpty = $('input[name="name"]'); }

                                            var fatherName = $('input[name="father_name"]').val().trim();
                                            if(!fatherName){ errors.push('Father Name'); if(!firstEmpty) firstEmpty = $('input[name="father_name"]'); }

                                            var motherName = $('input[name="mother_name"]').val().trim();
                                            if(!motherName){ errors.push('Mother Name'); if(!firstEmpty) firstEmpty = $('input[name="mother_name"]'); }

                                            var phone = $('input[name="phone"]').val().trim();
                                            if(!phone){ errors.push('Student Mobile Number'); if(!firstEmpty) firstEmpty = $('input[name="phone"]'); }

                                            var parentPhone = $('input[name="parent_phone"]').val().trim();
                                            if(!parentPhone){ errors.push('Parent Mobile Number'); if(!firstEmpty) firstEmpty = $('input[name="parent_phone"]'); }

                                            var birthPlace = $('input[name="birth_place"]').val().trim();
                                            if(!birthPlace){ errors.push('Birth Place'); if(!firstEmpty) firstEmpty = $('input[name="birth_place"]'); }

                                            var address = $('input[name="address"]').val().trim();
                                            if(!address){ errors.push('Full Address'); if(!firstEmpty) firstEmpty = $('input[name="address"]'); }

                                            var religion = $('select[name="re_id"]').val();
                                            if(!religion){ errors.push('Religion'); if(!firstEmpty) firstEmpty = $('select[name="re_id"]'); }

                                            var category = $('select[name="cat_id"]').val();
                                            if(!category){ errors.push('Category'); if(!firstEmpty) firstEmpty = $('select[name="cat_id"]'); }

                                            var cast = $('select[name="cast_id"]').val();
                                            if(!cast){ errors.push('Caste'); if(!firstEmpty) firstEmpty = $('select[name="cast_id"]'); }

                                            var parentUid = $('input[name="parent_uid"]').val().trim();
                                            if(!parentUid){ errors.push('Parent UID'); if(!firstEmpty) firstEmpty = $('input[name="parent_uid"]'); }

                                            var classId = $('input[name="class_id"]').val();
                                            if(!classId){ errors.push('Current Standard'); }

                                            if(errors.length > 0){
                                                e.preventDefault();
                                                showWarningToast('Please fill in all mandatory fields.');
                                                if(firstEmpty) firstEmpty.focus();
                                                return false;
                                            }
                                        });
                                        </script>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Panel 2: Promotion History -->
            <div class="panel panel-accordion">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#promotion">
                            <i class="fa fa-arrow-up"></i> Promotion History</a>
                    </h4>
                </div>
                <div id="promotion" class="accordion-body collapse in">
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

            <!-- Panel 3: Documents History -->
            <div class="panel panel-accordion">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#documenthistory">
                            <i class="fa fa-file"></i> Documents History</a>
                    </h4>
                </div>
                <div id="documenthistory" class="accordion-body collapse in">
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
                                    <?php else: ?>
                                    <tr><td colspan="8" class="text-center">No printed document history</td></tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Panel 4: Fees -->
            <?php
                $all_invoices = $this->db->order_by('invoice_id', 'DESC')->get_where('invoice', array('student_id' => $student['student_id']))->result_array();
                $student_invoices = array();
                $carry_invoices = array();
                foreach($all_invoices as $inv){
                    if($inv['status'] == '3'){
                        $carry_invoices[] = $inv;
                    } else {
                        $student_invoices[] = $inv;
                    }
                }
                $student_invoices = array_merge($student_invoices, $carry_invoices);
                $has_invoices = !empty($student_invoices);
            ?>
            <div class="panel panel-accordion">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#fees">
                            <i class="fa fa-credit-card"></i> Fees</a>
                    </h4>
                </div>
                <div id="fees" class="accordion-body collapse in">
                    <div class="panel-body">
                        <div class="pull-left mb-3">
                            <?php if(!$has_invoices): ?>
                                <a href="<?php echo base_url('admin/student_payment_single/'.$student['student_id']); ?>" class="btn btn-inverse btn-sm btn-rounded" style="color:#fff"><i class="fa fa-plus ti-plus"></i> Create Invoice</a>
                            <?php endif; ?>
                        </div>
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
                                    <?php $count = 1; foreach($student_invoices as $inv): ?>
                                    <tr>
                                        <td><?php echo $count++;?></td>
                                        <td><?php echo date('d-m-Y', strtotime($inv['creation_timestamp']));?></td>
                                        <td>
                                            <?php if($inv['status'] == '1'): ?>
                                                <span class="label label-success">Paid</span>
                                            <?php elseif($inv['status'] == '2'): ?>
                                                <span class="label label-danger">Unpaid</span>
                                            <?php elseif($inv['status'] == '3'): ?>
                                                <span class="label label-primary">Carry</span>
                                            <?php else: ?>
                                                <span class="label label-warning">Partial</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo number_format($inv['amount'], 0, '.', ','); ?></td>
                                        <td><?php echo number_format($inv['amount_paid'], 0, '.', ','); ?></td>
                                        <td><?php echo number_format($inv['due'], 0, '.', ','); ?></td>
                                        <td>-</td>
                                        <td><?php echo $inv['entry_user'];?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                    <?php if(empty($student_invoices)): ?>
                                    <tr>
                                        <td colspan="8" class="text-center">No invoices found</td>
                                    </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Panel 5: Other Documents -->
            <div class="panel panel-accordion">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#documents">
                            <i class="fa fa-folder-open"></i> Other Documents</a>
                    </h4>
                </div>
                <div id="documents" class="accordion-body collapse in">
                    <div class="panel-body">
                        <div class="pull-left mb-3">
                            <a class="btn btn-inverse btn-sm btn-rounded btn-block preport" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/modal_add_document/<?php echo $student['student_id'];?>');"><i class="fa fa-plus ti-plus"></i> Add Document</a>
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
                                    <?php if(!empty($student_documents)): ?>
                                    <?php $doc_num = 1; foreach($student_documents as $doc): ?>
                                    <tr>
                                        <td><?php echo $doc_num++; ?></td>
                                        <td><?php echo date('d-m-Y', strtotime($doc['created_at'])); ?></td>
                                        <td><?php echo html_escape($doc['document_type']); ?></td>
                                        <td><?php echo html_escape($doc['remarks']); ?></td>
                                        <td class="min-w-c">
                                            <?php if(!empty($doc['document_file'])): ?>
                                            <a href="<?php echo base_url();?>uploads/std_document/<?php echo $doc['document_file']; ?>" target="_blank" class="btn btn-default btn-circle icon"><i class="fa fa-eye"></i></a>
                                            <?php endif; ?>
                                            <a onclick="showAjaxModal('<?php echo base_url();?>modal/popup/modal_edit_document/<?php echo $doc['id']; ?>');" class="btn btn-info btn-circle icon"><i class="fa fa-pencil"></i></a>
                                            <button class="btn btn-danger icon btn-circle" onclick="confirm_modal('<?php echo base_url();?>admin/view_student_delete_document/<?php echo $doc['id']; ?>/<?php echo $student['student_id']; ?>');"><i class="fa fa-trash-o"></i></button>
                                        </td>
                                        <td><?php echo html_escape($doc['entry_user']); ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                    <?php else: ?>
                                    <tr><td colspan="6" class="text-center">No documents uploaded</td></tr>
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
    var color = ""; var strength = "";
    switch (passed) {
        case 0: case 1: case 2: strength = "Weak"; color = "red"; break;
        case 3: strength = "Medium"; color = "orange"; break;
        case 4: strength = "Strong"; color = "green"; break;
    }
    password_strength.innerHTML = strength;
    password_strength.style.color = color;
    if (passed <= 2) { document.getElementById('show').disabled = true; }
    else { document.getElementById('show').disabled = false; }
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

