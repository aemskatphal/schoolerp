<?php 
$edit_staff = $this->db->get_where('teacher', array('teacher_id' => $teacher_id))->result_array();
foreach ($edit_staff as $key => $row):
    $bank = $this->db->get_where('bank', array('bank_id' => $row['bank_id']))->row();
    $allowances = $this->db->get_where('salary_allowance', array('teacher_id' => $row['teacher_id']))->result_array();
    $allowances_count = count($allowances);
?>

<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-info">
            <div class="panel-heading"> Edit Staff</div>
            <div class="panel-wrapper collapse in" aria-expanded="true">
                <div class="panel-body">
                    <?php echo form_open(base_url() . 'admin/staff_list/update/'. $row['teacher_id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top', 'enctype' => 'multipart/form-data'));?>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="alert alert-dark">PERSONAL INFORMATION</div>
                            <hr>
                            <div class="form-group">
                                <label class="col-md-12">Full Name<span class="bg-require">*</span></label>
                                <div class="col-sm-12">
                                    <input type="text" value="<?php echo $row['name'];?>" class="form-control" name="name" required>
                                    <input type="hidden" class="form-control" value="<?php echo $row['teacher_number'];?>" name="teacher_number" readonly="true">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Education</label>
                                <div class="col-sm-12">
                                    <input type="text" value="<?php echo $row['edu_id'];?>" class="form-control" name="edu_id" autofocus>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Full Address<span class="bg-require">*</span></label>
                                <div class="col-sm-12">
                                    <textarea class="form-control" name="address" rows="3" required><?php echo $row['address'];?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Birthday<span class="bg-require">*</span></label>
                                <div class="col-sm-12">
                                    <input class="form-control m-r-10 datepicker" value="<?php echo $row['birthday'];?>" name="birthday" type="date" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Gender<span class="bg-require">*</span></label>
                                <div class="col-sm-12">
                                    <select name="sex" class="form-control select2" style="width:100%" required>
                                        <option value="">Select</option>
                                        <option value="male" <?php if($row['sex'] == 'male')echo 'selected';?>>Male</option>
                                        <option value="female" <?php if($row['sex'] == 'female')echo 'selected';?>>Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">UID No</label>
                                <div class="col-sm-12">
                                    <input type="text" value="<?php echo $row['uidno'];?>" class="form-control" name="uidno">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Phone<span class="bg-require">*</span></label>
                                <div class="col-sm-12">
                                    <input type="text" value="<?php echo $row['phone'];?>" class="form-control" name="phone" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Email</label>
                                <div class="col-sm-12">
                                    <input type="email" value="<?php echo $row['email'];?>" class="form-control" name="email">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Religion</label>
                                <div class="col-sm-12">
                                    <select name="re_id" class="form-control select2" style="width:100%" id="class_id"
                                        onchange="return get_religion_cast(this.value)">
                                        <option value="">Select</option>
                                        <?php
                                        $religions = $this->db->get('religion')->result_array();
                                        foreach($religions as $rel): ?>
                                            <option value="<?php echo $rel['religion_id'];?>" <?php if($row['re_id'] == $rel['religion_id'])echo 'selected';?>>
                                                <?php echo $rel['religion_name'];?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-9">Caste</label>
                                <div class="row col-md-12">
                                    <div class="col-sm-10">
                                        <select name="cast_id" class="form-control select2" style="width:100%" id="section_selector_holder_cast">
                                            <option value="">Select Religion First</option>
                                            <?php
                                            if(!empty($row['re_id'])){
                                                $casts = $this->db->get_where('cast', array('re_id' => $row['re_id']))->result_array();
                                                foreach($casts as $c): ?>
                                                    <option value="<?php echo $c['cast_id'];?>" <?php if($row['cast_id'] == $c['cast_id'])echo 'selected';?>>
                                                        <?php echo $c['cast_name'];?>
                                                    </option>
                                                <?php endforeach;
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-2">
                                        <a href="#" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/modal_add_cast/');"><button type="button" class="btn btn-info btn-circle btn-xs"><i class="fa fa-plus"></i></button></a>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Mother Tongue</label>
                                <div class="col-sm-12">
                                    <select name="mt_id" class="form-control select2">
                                        <option value="">Select</option>
                                        <?php
                                        $mother_tongues = $this->db->get('mother_tongue')->result_array();
                                        foreach($mother_tongues as $mt): ?>
                                            <option value="<?php echo $mt['mother_tongue_id'];?>" <?php if($row['mt_id'] == $mt['mother_tongue_id'])echo 'selected';?>>
                                                <?php echo $mt['mother_tongue_name'];?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Blood Group</label>
                                <div class="col-sm-12">
                                    <input type="text" value="<?php echo $row['blood_group'];?>" class="form-control" name="blood_group">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-12">Marital Status</label>
                                <div class="col-sm-12">
                                    <select class="form-control select2" name="marital_status" style="width:100%">
                                        <option value="">Select Marital Status</option>
                                        <option value="Married" <?php if($row['marital_status'] == 'Married')echo 'selected';?>>Married</option>
                                        <option value="Single" <?php if($row['marital_status'] == 'Single')echo 'selected';?>>Single</option>
                                        <option value="Divorced" <?php if($row['marital_status'] == 'Divorced')echo 'selected';?>>Divorced</option>
                                        <option value="Engaged" <?php if($row['marital_status'] == 'Engaged')echo 'selected';?>>Engaged</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Password</label>
                                <div class="col-sm-12">
                                    <input type="password" class="form-control" name="password" value="" onkeyup="CheckPasswordStrength(this.value)">
                                    <strong id="password_strength"></strong>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-12">Browse Image</label>        
                                <div class="col-sm-12">
                                    <input type='file' class="form-control" name="userfile"/>
                                    <img id="blah" src="<?php echo $this->crud_model->get_image_url('teacher',$row['teacher_id']);?>" alt="" height="200" width="200"/>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="alert alert-primary">HUMAN RESOURCES INFORMATION</div>
                            <hr>
                            <div class="form-group">
                                <label class="col-sm-12">Department<span class="bg-require">*</span></label>
                                <div class="col-sm-12">
                                    <select name="department_id" class="form-control select2" onchange="get_designation_val(this.value)" required>
                                        <option value="">Select A Department</option>
                                        <?php
                                        $departments = $this->db->get('department')->result_array();
                                        foreach($departments as $dept): ?>
                                            <option value="<?php echo $dept['department_id'];?>" <?php if($row['department_id'] == $dept['department_id'])echo 'selected';?>>
                                                <?php echo $dept['name'];?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-12">Designation<span class="bg-require">*</span></label>
                                <div class="col-sm-12">
                                    <select name="designation_id" class="form-control select2" id="designation_holder" required>
                                        <option value="">Select A Department First</option>
                                        <?php
                                        if(!empty($row['department_id'])){
                                            $designations = $this->db->get_where('designation', array('department_id' => $row['department_id']))->result_array();
                                            foreach($designations as $des): ?>
                                                <option value="<?php echo $des['designation_id'];?>" <?php if($row['designation_id'] == $des['designation_id'])echo 'selected';?>>
                                                    <?php echo $des['name'];?>
                                                </option>
                                            <?php endforeach;
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-12">Date Of Joining<span class="bg-require">*</span></label>
                                <div class="col-sm-12">
                                    <input type="date" class="form-control datepicker" name="date_of_joining" value="<?php echo $row['date_of_joining'];?>" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-12">Date Of Leaving</label>
                                <div class="col-sm-12">
                                    <input type="date" value="<?php echo $row['date_of_leaving'];?>" class="form-control datepicker" name="date_of_leaving">
                                </div>
                            </div>
                            <hr>
                            <div class="alert alert-primary">BANK ACCOUNT DETAILS</div>
                            <hr>
                            <div class="form-group">
                                <label class="col-sm-12">Account Holder Name</label>
                                <div class="col-sm-12">
                                    <input type="text" value="<?php echo $bank->account_holder_name;?>" class="form-control" name="account_holder_name"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-12">Account Number</label>
                                <div class="col-sm-12">
                                    <input type="text" value="<?php echo $bank->account_number;?>" class="form-control" name="account_number"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-12">IFSC Code</label>
                                <div class="col-sm-12">
                                    <input type="text" value="<?php echo $bank->ifsc_code;?>" class="form-control" name="ifsc_code"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Bank Name</label>
                                <div class="col-sm-12">
                                    <input type="text" value="<?php echo $bank->bank_name;?>" class="form-control" name="bank_name"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-12">Branch</label>
                                <div class="col-sm-12">
                                    <input type="text" value="<?php echo $bank->branch;?>" class="form-control" name="branch">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-12">Account Type</label>
                                <div class="col-sm-12">
                                    <select class="form-control select2" name="account_type" style="width:100%">
                                        <option value="">Select</option>
                                        <option value="1" <?php if(isset($bank->account_type) && $bank->account_type == '1')echo 'selected';?>>Current Account</option>
                                        <option value="2" <?php if(isset($bank->account_type) && $bank->account_type == '2')echo 'selected';?>>Saving Account</option>
                                        <option value="3" <?php if(isset($bank->account_type) && $bank->account_type == '3')echo 'selected';?>>Salary Account</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-12">City</label>
                                <div class="col-sm-12">
                                    <input type="text" value="<?php echo $bank->city;?>" class="form-control" name="city">
                                </div>
                            </div>
                            <div class="alert alert-primary">Salary Allowances</div>
                            <hr>
                            <?php if(!empty($allowances)){
                                foreach($allowances as $idx => $allow): ?>
                                    <div class="row" id="al_row_<?php echo $idx;?>">
                                        <div class="col-md-6 mt-4">
                                            <input type="text" class="form-control" name="allowance[<?php echo $idx;?>][name]" value="<?php echo $allow['name'];?>" readonly/>
                                        </div>
                                        <div class="col-md-5 mt-4">
                                            <input type="number" class="allowance form-control" name="allowance[<?php echo $idx;?>][amount]" value="<?php echo $allow['amount'];?>" required/>
                                        </div>
                                        <div class="col-md-1 mt-4 text-right">
                                            <button type="button" class="btn btn-danger" onclick="deleteAllowancRow('<?php echo $idx;?>')"><i class="fa fa-times"></i></button>
                                        </div>
                                    </div>
                                <?php endforeach;
                            }else{ ?>
                                <div class="row" id="al_row_0">
                                    <div class="col-md-6 mt-4">
                                        <input type="text" class="form-control" name="allowance[0][name]" value="Basic Pay" readonly/>
                                    </div>
                                    <div class="col-md-5 mt-4">
                                        <input type="number" class="allowance form-control" name="allowance[0][amount]" placeholder="Amount" required/>
                                    </div>
                                    <div class="col-md-1 mt-4 text-right">
                                        <button type="button" class="btn btn-danger" onclick="deleteAllowancRow('0')"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                            <?php } ?>
                            <div id="add_new_allowance"></div>
                            <button type="button" class="btn btn-default mt-4" onclick="addAllowanceRows()">
                                <i class="fa fa-plus-circle"></i> Add Rows
                            </button>
                            <div class="row mt-4">
                                <table class="table h5 text-dark tbr-middle">
                                    <tbody>
                                        <tr>
                                            <td colspan="2"><b>Total Salary</b></td>
                                            <td class="text-left">
                                                <div class="input-group">
                                                    <span class="input-group-addon">&#8377;</span>
                                                    <input type="text" class="form-control" name="net_salary" readonly="" id="net_salary" value="0">
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-info btn-block btn-rounded btn-sm"><i class="fa fa-edit"></i>&nbsp;&nbsp;Update Staff</button>
                    </div>
                    <?php echo form_close();?>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function get_designation_val(department_id) {
        if(department_id != '')
            $.ajax({
                url: '<?php echo base_url();?>admin/get_designation/' + department_id,
                success: function(response)
                {
                    jQuery('#designation_holder').html(response);
                }
            });
        else
            jQuery('#designation_holder').html('<option value="">Select A Department First</option>');
    }
    function get_religion_cast(re_id) {
        $.ajax({
            url: '<?php echo base_url();?>admin/get_religion_cast/' + re_id,
            success: function(response)
            {
                jQuery('#section_selector_holder_cast').html(response);
            }
        });
    }
    function CheckPasswordStrength(password) {
        var password_strength = document.getElementById("password_strength");
        if (password.length == 0) {
            password_strength.innerHTML = "";
            return;
        }
        var regex = new Array();
        regex.push("[A-Z]");
        regex.push("[a-z]");
        regex.push("[0-9]");
        regex.push("[$@$!%*#?&]");
        var passed = 0;
        for (var i = 0; i < regex.length; i++) {
            if (new RegExp(regex[i]).test(password)) {
                passed++;
            }
        }
        var color = "";
        var strength = "";
        switch (passed) {
            case 0: case 1: case 2:
                strength = "Weak"; color = "red"; break;
            case 3:
                strength = "Medium"; color = "orange"; break;
            case 4:
                strength = "Strong"; color = "green"; break;
        }
        password_strength.innerHTML = strength;
        password_strength.style.color = color;
        if(passed <= 2){
            document.getElementById('show').disabled = true;
        }else{
            document.getElementById('show').disabled = false;
        }
    }
</script>

<script type="text/javascript">
    var iAllowance = <?php echo $allowances_count > 0 ? $allowances_count : 4;?>;
    function addAllowanceRows() {
        var html_row = "";
        html_row += '<div class="row" id="al_row_' + iAllowance + '"><div class="col-md-6 mt-4">';
        html_row += '<input class="form-control" name="allowance[' + iAllowance + '][name]" placeholder="Name Of Allowance" type="text">';
        html_row += '</div>';
        html_row += '<div class="col-md-5 mt-4"> <input type="number" class="allowance form-control" name="allowance[' + iAllowance + '][amount]" placeholder="Amount"></div>';
        html_row += '<div class="col-md-1 mt-4 text-right"><button type="button" class="btn btn-danger" onclick="deleteAllowancRow(' + iAllowance + ')"><i class="fa fa-times"></i> </button></div></div>';
        $("#add_new_allowance").append(html_row);
        iAllowance++;
    }

    function deleteAllowancRow(id) {
        $("#al_row_" + id).remove();
        totalCalculate();
    }

    $(document).on("change", function () {
        totalCalculate();
    });

    function totalCalculate() {
        var total_allowance = 0;
        $(".allowance").each(function () {
            total_allowance += Number($(this).val());
        });
        $("#net_salary").val(total_allowance);
    }

    $(document).ready(function(){
        totalCalculate();
    });
</script>

<?php endforeach;?>
