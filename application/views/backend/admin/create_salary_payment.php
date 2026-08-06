<?php if($is_paid):?>
<div class="row">
   <div class="col-sm-12">
      <div class="panel">
         <div class="panel-wrapper collapse in" aria-expanded="true">
            <div class="panel-body">
               <div class="alert alert-success">
                  <i class="fa fa-check-circle"></i> <?php echo get_phrase('Salary for this staff member has already been paid for this month.');?>
               </div>
               <a href="<?php echo base_url('payroll/salary_payment');?>" class="btn btn-info btn-sm btn-rounded"><i class="fa fa-arrow-left"></i> <?php echo get_phrase('Back to Salary Payment');?></a>
            </div>
         </div>
      </div>
   </div>
</div>
<?php else:?>
<div class="row">
   <div class="col-sm-12">
      <div class="panel">
         <div class="panel-wrapper collapse in" aria-expanded="true">
            <div class="panel-body">
               <?php echo form_open(current_url(), array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>

                  <div class="row mb-4">
                     <div class="col-md-3 mt-sm">
                        <center>
                           <?php
                              $photo = 'uploads/user.jpg';
                              if(!empty($teacher->file_name)){
                                  $photo = 'uploads/teacher_image/' . $teacher->file_name;
                              } elseif(file_exists(FCPATH . 'uploads/teacher_image/' . $teacher->teacher_id . '.jpg')){
                                  $photo = 'uploads/teacher_image/' . $teacher->teacher_id . '.jpg';
                              }
                           ?>
                           <img class="img-thumbnail" width="132px" height="132px" src="<?php echo base_url($photo);?>">
                           <input type="hidden" name="staff_id" value="<?php echo $teacher->teacher_id;?>">
                           <input type="hidden" name="month" value="<?php echo $month;?>">
                           <input type="hidden" name="year" value="<?php echo $year;?>">
                        </center>
                     </div>
                     <div class="col-md-7 mt-md">
                        <div class="table-responsive">
                           <table class="table table-condensed text-dark tbl-salary">
                              <tbody>
                                 <tr>
                                    <th class="top-b-none"><?php echo get_phrase('Name');?>:</th>
                                    <td class="top-b-none"><?php echo $teacher->name;?></td>
                                 </tr>
                                 <tr>
                                    <th><?php echo get_phrase('Joining Date');?>:</th>
                                    <td><?php echo $teacher->date_of_joining ? date('d/m/Y', strtotime($teacher->date_of_joining)) : '-';?></td>
                                 </tr>
                                 <tr>
                                    <th><?php echo get_phrase('Designation');?>:</th>
                                    <td><?php
                                       $desig = $this->db->get_where('designation', array('designation_id' => $teacher->designation_id))->row();
                                       echo $desig ? $desig->name : '-';
                                    ?></td>
                                 </tr>
                                 <tr>
                                    <th><?php echo get_phrase('Department');?>:</th>
                                    <td><?php echo $this->payroll_model->getDepartmentName($teacher->department_id);?></td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>

                  <div class="row">
                     <div class="col-md-6 mt-lg">
                        <section class="panel panel-custom">
                           <header class="panel-heading panel-heading-custom">
                              <h4 class="panel-title"><?php echo get_phrase('Allowances');?></h4>
                           </header>
                           <div class="panel-body">
                              <div class="row">
                                 <div class="col-md-6 mt-4">
                                    <input type="text" class="form-control" name="allowance[0][name]" value="Basic Pay" readonly/>
                                 </div>
                                 <div class="col-md-6 mt-4">
                                    <input type="number" class="allowance form-control" name="allowance[0][amount]" id="basic_salary" value="<?php echo $teacher->joining_salary;?>" required/>
                                 </div>
                              </div>
                              <?php if(!empty($allowances)): $idx = 1; foreach($allowances as $allow):?>
                              <div class="row">
                                 <div class="col-md-6 mt-4">
                                    <input type="text" class="form-control" name="allowance[<?php echo $idx;?>][name]" value="<?php echo $allow['name'];?>" readonly/>
                                 </div>
                                 <div class="col-md-6 mt-4">
                                    <input type="number" class="allowance form-control" name="allowance[<?php echo $idx;?>][amount]" value="<?php echo $allow['amount'];?>" required/>
                                 </div>
                              </div>
                              <?php $idx++; endforeach; endif;?>
                              <div id="add_new_allowance"></div>
                              <button type="button" class="btn btn-default mt-4" onclick="addAllowanceRows()">
                                 <i class="fa fa-plus-circle"></i> <?php echo get_phrase('Add Rows');?>
                              </button>
                           </div>
                        </section>
                     </div>

                     <div class="col-md-6 mt-lg">
                        <section class="panel panel-custom">
                           <header class="panel-heading panel-heading-custom">
                              <h4 class="panel-title"><?php echo get_phrase('Deductions');?></h4>
                           </header>
                           <div class="panel-body">
                              <div class="row" id="de_row_leave">
                                 <div class="col-md-3 mt-sm">
                                    <input type="text" class="form-control" id="total_leave" name="deduction[1][name]" value="Leave" placeholder="Name Of Deductions" readonly/>
                                 </div>
                                 <div class="col-md-3 mt-sm">
                                    <input type="number" id="number_of_leave" class="form-control" placeholder="Number"/>
                                 </div>
                                 <div class="col-md-5 mt-sm">
                                    <input type="number" class="deduction form-control" name="deduction[1][amount]" placeholder="Amount" id="leave_amount" readonly/>
                                 </div>
                                 <div class="col-md-1 mt-sm text-right">
                                    <button type="button" class="btn btn-danger" onclick="deleteDeductionRow('leave')"><i class="fa fa-times"></i></button>
                                 </div>
                              </div>
                              <?php if(!empty($deductions)): $didx = 2; foreach($deductions as $ded):?>
                              <div class="row" id="de_row_<?php echo $didx;?>">
                                 <div class="col-md-6 mt-4">
                                    <input class="form-control" name="deduction[<?php echo $didx;?>][name]" value="<?php echo $ded['deduction_name'];?>" type="text" readonly>
                                 </div>
                                 <div class="col-md-5 mt-4">
                                    <input type="number" class="deduction form-control" name="deduction[<?php echo $didx;?>][amount]" value="<?php echo $ded['deduction_amount'];?>">
                                 </div>
                                 <div class="col-md-1 mt-4 text-right">
                                    <button type="button" class="btn btn-danger" onclick="deleteDeductionRow(<?php echo $didx;?>)"><i class="fa fa-times"></i></button>
                                 </div>
                              </div>
                              <?php $didx++; endforeach; endif;?>
                              <div id="add_new_deduction"></div>
                              <button type="button" class="btn btn-default mt-4" onclick="addDeductionRows()">
                                 <i class="fa fa-plus-circle"></i> <?php echo get_phrase('Add Rows');?>
                              </button>
                           </div>
                        </section>
                     </div>
                  </div>

                  <div class="row">
                     <div class="col-md-6 offset-md-6">
                        <section class="panel panel-custom">
                           <header class="panel-heading panel-heading-custom">
                              <h4 class="panel-title"><?php echo get_phrase('Salary Details');?></h4>
                           </header>
                           <div class="panel-body">
                              <table class="table h5 text-dark tbr-middle">
                                 <tbody>
                                    <tr>
                                       <td colspan="2"><?php echo get_phrase('Total Allowance');?></td>
                                       <td class="text-left">
                                          <div class="input-group">
                                             <span class="input-group-addon">&#2547;</span>
                                             <input type="text" class="form-control" name="total_allowance" readonly id="total_allowance" value="0"/>
                                          </div>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td colspan="2"><?php echo get_phrase('Total Deduction');?></td>
                                       <td class="text-left">
                                          <div class="input-group">
                                             <span class="input-group-addon">&#2547;</span>
                                             <input type="text" class="form-control" name="total_deduction" readonly id="total_deduction" value="0"/>
                                          </div>
                                       </td>
                                    </tr>
                                    <tr class="h4">
                                       <td colspan="2"><?php echo get_phrase('Net Salary');?></td>
                                       <td class="text-left">
                                          <div class="input-group">
                                             <span class="input-group-addon"></span>
                                             <input type="text" class="form-control" name="net_salary" readonly id="net_salary" value="0"/>
                                          </div>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td colspan="2"><?php echo get_phrase('Remarks');?></td>
                                       <td class="text-left">
                                          <textarea class="form-control" name="remarks" rows="2" maxlength="50"></textarea>
                                       </td>
                                    </tr>
                                 </tbody>
                              </table>
                           </div>
                        </section>
                     </div>
                  </div>

                  <footer class="panel-footer">
                     <div class="row">
                        <div class="offset-md-9 col-md-3">
                           <button type="submit" name="paid" value="1" class="btn btn-success btn-sm btn-rounded btn-block">
                              <i class="fa fa-plus-circle"></i> <?php echo get_phrase('Save');?>
                           </button>
                        </div>
                     </div>
                  </footer>

               <?php echo form_close();?>
            </div>
         </div>
      </div>
   </div>
</div>

<script type="text/javascript">
var iAllowance = <?php echo !empty($allowances) ? count($allowances) + 1 : 1;?>;
function addAllowanceRows() {
   var html_row = "";
   html_row += '<div class="row" id="al_row_' + iAllowance + '"><div class="col-md-6 mt-4">';
   html_row += '<input class="form-control" name="allowance[' + iAllowance + '][name]" placeholder="<?php echo get_phrase('Name Of Allowance');?>" type="text">';
   html_row += '</div>';
   html_row += '<div class="col-md-5 mt-4"> <input type="number" class="allowance form-control" name="allowance[' + iAllowance + '][amount]" placeholder="<?php echo get_phrase('Amount');?>"></div>';
   html_row += '<div class="col-md-1 mt-4 text-right"><button type="button" class="btn btn-danger" onclick="deleteAllowancRow(' + iAllowance + ')"><i class="fa fa-times"></i> </button></div></div>';
   $("#add_new_allowance").append(html_row);
   iAllowance++;
}

function deleteAllowancRow(id) {
   $("#al_row_" + id).remove();
   totalCalculate();
}

var iDeduction = <?php echo !empty($deductions) ? count($deductions) + 2 : 2;?>;
function addDeductionRows() {
   var html_row = "";
   html_row += '<div class="row" id="de_row_' + iDeduction + '"><div class="col-md-6 mt-4">';
   html_row += '<input class="form-control" name="deduction[' + iDeduction + '][name]" placeholder="<?php echo get_phrase('Name Of Deductions');?>" type="text">';
   html_row += '</div><div class="col-md-5 mt-4"> <input type="number" class="deduction form-control" name="deduction[' + iDeduction + '][amount]" placeholder="<?php echo get_phrase('Amount');?>"></div>';
   html_row += '<div class="col-md-1 mt-4 text-right"><button type="button" class="btn btn-danger" onclick="deleteDeductionRow(' + iDeduction + ')"><i class="fa fa-times"></i> </button></div></div>';
   $("#add_new_deduction").append(html_row);
   iDeduction++;
}

function deleteDeductionRow(id) {
   $("#de_row_" + id).remove();
   totalCalculate();
}

$(document).on("change", function () {
   totalCalculate();
   leaveCalculate();
   totalCalculate();
});

function totalCalculate() {
   var total_allowance = 0;
   var total_deduction = 0;
   $(".allowance").each(function () {
      total_allowance += Number($(this).val());
   });
   $(".deduction").each(function () {
      total_deduction += Number($(this).val());
   });
   $("#total_allowance").val(total_allowance);
   $("#total_deduction").val(total_deduction);
   var net_amount = (total_allowance - total_deduction);
   $("#net_salary").val(net_amount);
}

function leaveCalculate() {
   var number_of_leave = Number($('#number_of_leave').val());
   var totalsal = Number($('#total_allowance').val());
   var net_leave_amount = Math.round(parseFloat((totalsal / 30) * number_of_leave));
   $("#leave_amount").val(net_leave_amount);
   $("#total_leave").val("Leave (" + number_of_leave + ") ");
}

$(document).ready(function(){
   totalCalculate();
});
</script>
<?php endif;?>
