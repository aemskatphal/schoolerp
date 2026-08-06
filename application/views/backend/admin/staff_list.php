<div class="row">
   <div class="col-sm-12">
      <div class="panel panel-info">
         <div class="panel-heading">
            New Staff
            <div class="pull-right"><a href="#" data-perform="panel-collapse"><i class="fa fa-plus"></i>&nbsp;&nbsp;ADD NEW STAFF HERE<i class="btn btn-info btn-xs"></i></a> <a href="#" data-perform="panel-dismiss"></a> </div>
         </div>
         <div class="panel-wrapper collapse out" aria-expanded="true">
            <div class="panel-body">
               <?php echo form_open(base_url() . 'admin/staff_list/insert/' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
               <div class="row">
                  <div class="col-sm-6">
                     <div class="alert alert-dark">PERSONAL INFORMATION</div>
                     <hr>
                     <div class="form-group">
                        <label class="col-md-12" for="example-text">Full Name<span class="bg-require">*</span></label>
                        <div class="col-sm-12">
                           <input type="text" class="form-control" name="name" required>
                           <input type="hidden" class="form-control" value="<?php echo substr(md5(uniqid(rand(), true)), 0, 7); ?>" name="teacher_number" readonly="true">
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-md-12" for="example-text">Education</label>
                        <div class="col-sm-12">
                           <input type="text" class="form-control" name="edu_id" autofocus>
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-md-12" for="example-text">Full Address<span class="bg-require">*</span></label>
                        <div class="col-sm-12">
                           <textarea class="form-control" name="address" rows="3" required></textarea>
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-md-12" for="example-text">Birthday<span class="bg-require">*</span></label>
                        <div class="col-sm-12">
                           <input class="form-control m-r-10" name="birthday" type="date" id="example-date-input" required="">
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-md-12" for="example-text">Gender<span class="bg-require">*</span></label>
                        <div class="col-sm-12">
                           <select name="sex" class="form-control select2" style="width:100%" required="">
                              <option value="">Select</option>
                              <option value="male">Male</option>
                              <option value="female">Female</option>
                           </select>
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-md-12" for="example-text">UID No</label>
                        <div class="col-sm-12">
                           <input type="text" class="form-control" name="uidno">
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-md-12" for="example-text">Phone<span class="bg-require">*</span></label>
                        <div class="col-sm-12">
                           <input type="number" id="mobile" class="form-control" name="phone" required>
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-md-12" for="example-text">Email</label>
                        <div class="col-sm-12">
                           <input type="email" class="form-control" name="email">
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-md-12" for="example-text">Religion</label>
                        <div class="col-sm-12">
                           <select name="re_id" class="form-control select2" style="width:100%" id="class_id"
                              data-message-required="Value Required"
                              onchange="return get_religion_cast(this.value)">
                              <option value="">Select</option>
                              <?php
                              $religions = $this->db->get('religion')->result_array();
                              foreach($religions as $rel): ?>
                                 <option value="<?php echo $rel['religion_id']; ?>"><?php echo $rel['religion_name']; ?></option>
                              <?php endforeach; ?>
                           </select>
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-md-9" for="example-text">Caste</label>
                        <div class="row col-md-12">
                           <div class="col-sm-10">
                              <select name="cast_id" class="form-control select2" style="width:100%" id="section_selector_holder_cast">
                                 <option value="">Select Religion First</option>
                              </select>
                           </div>
                           <div class="col-sm-2">
                              <a href="#" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/modal_add_cast/');"><button type="button" class="btn btn-info btn-circle btn-xs"><i class="fa fa-plus"></i></button></a>
                           </div>
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-md-12" for="example-text">Mother Tongue<span class="bg-require">*</span></label>
                        <div class="col-sm-12">
                           <select name="mt_id" class="form-control select2" required>
                              <option value="">Select</option>
                              <?php
                              $mother_tongues = $this->db->get('mother_tongue')->result_array();
                              foreach($mother_tongues as $mt): ?>
                                 <option value="<?php echo $mt['mother_tongue_id']; ?>"><?php echo $mt['mother_tongue_name']; ?></option>
                              <?php endforeach; ?>
                           </select>
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-md-12" for="example-text">Blood Group</label>
                        <div class="col-sm-12">
                           <input type="text" class="form-control" name="blood_group">
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-sm-12">Marital Status</label>
                        <div class="col-sm-12">
                           <select class="form-control select2" name="marital_status" style="width:100%">
                              <option value="">Select Marital Status</option>
                              <option value="Married">Married</option>
                              <option value="Single">Single</option>
                              <option value="Divorced">Divorced</option>
                              <option value="Engaged">Engaged</option>
                           </select>
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-md-12" for="example-text">Password</label>
                        <div class="col-sm-12">
                           <input type="password" class="form-control" autocomplete="new-password" name="password" onkeyup="CheckPasswordStrength(this.value)">
                           <strong id="password_strength"></strong>
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-sm-12">Browse Image</label>
                        <div class="col-sm-12">
                           <input type='file' name="userfile" class="dropify" onChange="readURL(this);" />
                        </div>
                     </div>
                  </div>
                  <div class="col-sm-6">
                     <div class="alert alert-primary">HUMAN RESOURCES INFORMATION</div>
                     <hr>
                     <div class="form-group">
                        <label class="col-sm-12">Department<span class="bg-require">*</span></label>
                        <div class="col-sm-12">
                           <select name="department_id" class="form-control select2" onchange="get_designation_val(this.value)" required="">
                              <option value="">Select A Department</option>
                              <?php
                              $departments = $this->db->get('department')->result_array();
                              foreach($departments as $dept): ?>
                                 <option value="<?php echo $dept['department_id']; ?>"><?php echo $dept['name']; ?></option>
                              <?php endforeach; ?>
                           </select>
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-sm-12">Designation<span class="bg-require">*</span></label>
                        <div class="col-sm-12">
                           <select name="designation_id" class="form-control select2" id="designation_holder" required="">
                              <option value="">Select A Department First</option>
                           </select>
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-sm-12">Date Of Joining<span class="bg-require">*</span></label>
                        <div class="col-sm-12">
                           <input type="date" class="form-control datepicker" name="date_of_joining" value="<?php echo date('Y-m-d');?>" required>
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-sm-12">Date Of Leaving</label>
                        <div class="col-sm-12">
                           <input type="date" class="form-control datepicker" name="date_of_leaving">
                        </div>
                     </div>
                     <hr>
                     <div class="alert alert-primary">BANK ACCOUNT DETAILS</div>
                     <hr>
                     <div class="form-group">
                        <label class="col-sm-12">Account Holder Name<span class="bg-require">*</span></label>
                        <div class="col-sm-12">
                           <input type="text" class="form-control" name="account_holder_name" required="" />
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-sm-12">Account Number<span class="bg-require">*</span></label>
                        <div class="col-sm-12">
                           <input type="text" class="form-control" name="account_number" required="" />
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-sm-12">IFSC Code<span class="bg-require">*</span></label>
                        <div class="col-sm-12">
                           <input type="text" class="form-control" name="ifsc_code" required="" />
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-md-12" for="example-text">Bank Name<span class="bg-require">*</span></label>
                        <div class="col-sm-12">
                           <input type="text" class="form-control" name="bank_name" required="">
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-sm-12">Branch<span class="bg-require">*</span></label>
                        <div class="col-sm-12">
                           <input type="text" class="form-control" name="branch" required="">
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-sm-12">Account Type<span class="bg-require">*</span></label>
                        <div class="col-sm-12">
                           <select class="form-control select2" name="account_type" style="width:100%" required="">
                              <option value="">Select</option>
                              <option value="1">Current Account</option>
                              <option value="2">Saving Account</option>
                              <option value="3">Salary Account</option>
                           </select>
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-sm-12">City<span class="bg-require">*</span></label>
                        <div class="col-sm-12">
                           <input type="text" class="form-control" name="city" required="">
                        </div>
                     </div>
                     <div class="alert alert-primary">Salary Allowances</div>
                     <hr>
                     <div class="row">
                        <div class="col-md-6 mt-sm">
                           <input type="text" class="form-control" name="allowance[0][name]" value="Basic Pay" placeholder="Name Of Allowance" readonly/>
                        </div>
                        <div class="col-md-6 mt-sm">
                           <input type="number" class="allowance form-control" name="allowance[0][amount]" id="basic_salary" placeholder="Amount" required/>
                        </div>
                     </div>
                     <div class="row" id="al_row_da">
                        <div class="col-md-6 mt-4">
                           <input type="text" class="form-control" name="allowance[1][name]" value="Dearness Allowance" placeholder="Name Of Allowance" readonly />
                        </div>
                        <div class="col-md-5 mt-4">
                           <input type="number" class="allowance form-control" name="allowance[1][amount]" placeholder="Amount" required/>
                        </div>
                        <div class="col-md-1 mt-4 text-right"><button type="button" class="btn btn-danger" onclick="deleteAllowancRow('da')"><i class="fa fa-times"></i> </button></div>
                     </div>
                     <div class="row" id="al_row_hrent">
                        <div class="col-md-6 mt-4">
                           <input type="text" class="form-control" name="allowance[2][name]" value="House Rent Allowance" placeholder="Name Of Allowance" readonly />
                        </div>
                        <div class="col-md-5 mt-4">
                           <input type="number" class="allowance form-control" name="allowance[2][amount]" placeholder="Amount" required/>
                        </div>
                        <div class="col-md-1 mt-4 text-right"><button type="button" class="btn btn-danger" onclick="deleteAllowancRow('hrent')"><i class="fa fa-times"></i> </button></div>
                     </div>
                     <div class="row" id="al_row_ta">
                        <div class="col-md-6 mt-4">
                           <input type="text" class="form-control" name="allowance[3][name]" value="Transport Allowance" placeholder="Name Of Allowance" readonly />
                        </div>
                        <div class="col-md-5 mt-4">
                           <input type="number" class="allowance form-control" name="allowance[3][amount]" placeholder="Amount" required/>
                        </div>
                        <div class="col-md-1 mt-4 text-right"><button type="button" class="btn btn-danger" onclick="deleteAllowancRow('ta')"><i class="fa fa-times"></i> </button></div>
                     </div>
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
                  <button type="submit" class="btn btn-primary btn-rounded btn-block btn-sm"> <i class="fa fa-plus"></i>&nbsp;Add Staff</button>
                  <img id="install_progress" src="<?php echo base_url(); ?>assets/images/loader-2.gif" style="margin-left: 20px; display: none"/>
               </div>
               <?php echo form_close();?>
            </div>
         </div>
      </div>
   </div>
</div>

<div class="row">
   <div class="col-sm-12">
      <div class="panel panel-info">
         <div class="panel-heading"> <i class="fa fa-list"></i>&nbsp;&nbsp;Staff List</div>
         <div class="panel-wrapper collapse in" aria-expanded="true">
            <div class="panel-body table-responsive">
               <table id="example30" class="display nowrap" cellspacing="0" width="100%">
                  <thead>
                     <tr>
                        <th width="80"><div>#</div></th>
                        <th><div>Status</div></th>
                        <th><div>Options</div></th>
                        <th><div>Photo</div></th>
                        <th><div>ID Card</div></th>
                        <th><div>Name</div></th>
                        <th><div>Gender</div></th>
                        <th><div>Department</div></th>
                        <th><div>Designation</div></th>
                        <th><div>Mobile</div></th>
                        <th><div>Email</div></th>
                        <th><div>Address</div></th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php $i = 1; foreach($select_teacher as $key => $teacher){
                        $dept_name = $this->db->get_where('department', array('department_id' => $teacher['department_id']))->row();
                        $desig_name = $this->db->get_where('designation', array('designation_id' => $teacher['designation_id']))->row();
                     ?>
                     <tr>
                        <td><?php echo $i++;?></td>
                        <td>
                           <?php if($teacher['status'] == 1){ ?>
                              <span class="btn btn-success btn-sm btn-rounded" title="Click here to Inactive" onclick="status_modal('<?php echo base_url();?>admin/staff_status/<?php echo $teacher['teacher_id'];?>');">
                                 Active
                              </span>
                           <?php }else{ ?>
                              <span class="btn btn-danger btn-sm btn-rounded" title="Click here to Active" onclick="status_modal('<?php echo base_url();?>admin/staff_status/<?php echo $teacher['teacher_id'];?>');">
                                 Inactive
                              </span>
                           <?php } ?>
                        </td>
                        <td>
                           <?php if (has_action('hr', 'staff_list', 'edit')): ?>
                           <a href="<?php echo base_url();?>admin/edit_staff/<?php echo $teacher['teacher_id'];?>"><button class="btn btn-info btn-circle btn-xs"><i class="fa fa-edit"></i></button></a>
                           <?php endif; ?>
                           <?php if (has_action('hr', 'staff_list', 'delete')): ?>
                           <a href="#" onclick="confirm_modal('<?php echo base_url();?>admin/staff_list/delete/<?php echo $teacher['teacher_id'];?>');"><button type="button" class="btn btn-danger btn-circle btn-xs"><i class="fa fa-trash"></i></button></a>
                           <?php endif; ?>
                        </td>
                        <td><img src="<?php echo $this->crud_model->get_image_url('teacher', $teacher['teacher_id']);?>" width="30px"></td>
                        <td><button type="button" onclick="confirm_print('<?php echo base_url();?>report/staffIdCard/<?php echo $teacher['teacher_id'];?>');" class="btn btn-inverse btn-circle btn-xs" title="Staff IdCard"><i class="fa fa fa-user"></i></button></td>
                        <td><?php echo $teacher['name'];?></td>
                        <td><?php echo ucfirst($teacher['sex']);?></td>
                        <td><?php echo isset($dept_name->name) ? $dept_name->name : '';?></td>
                        <td><?php echo isset($desig_name->name) ? $desig_name->name : '';?></td>
                        <td><?php echo $teacher['phone'];?></td>
                        <td><?php echo $teacher['email'];?></td>
                        <td><?php echo $teacher['address'];?></td>
                     </tr>
                     <?php } ?>
                  </tbody>
               </table>
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
</script>

<script type="text/javascript">
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
   var iAllowance = 4;
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

<script type="text/javascript">
   function readURL(input) {
       if (input.files && input.files[0]) {
           var reader = new FileReader();
           reader.onload = function (e) {
               $('#blah').attr('src', e.target.result);
           }
           reader.readAsDataURL(input.files[0]);
       }
   }
</script>

<script type="text/javascript">
$(document).ready(function() {
    $('#example30').DataTable({
        dom: 'Bfrtip',
        buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
    });
});
</script>
