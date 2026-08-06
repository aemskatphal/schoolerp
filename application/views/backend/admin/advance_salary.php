<style>.preloader{display:none!important;}</style>
<script type="text/javascript">
$(document).ready(function(){
   $('.preloader').hide();
});
</script>

<div class="row">
   <div class="col-sm-12">
      <div class="panel panel-info">
         <div class="panel-heading">
            NEW Advance
            <div class="pull-right"><a href="#" data-perform="panel-collapse"><i class="fa fa-plus"></i>&nbsp;&nbsp;ADD NEW HERE<i class="btn btn-info btn-xs"></i></a> <a href="#" data-perform="panel-dismiss"></a> </div>
         </div>
         <div class="panel-wrapper collapse out" aria-expanded="true">
            <div class="panel-body">
               <?php echo form_open(base_url() . 'admin/advance_salary/insert/', array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
               <div class="row">
                  <div class="col-sm-6">
                     <div class="form-group">
                        <label class="col-md-3 control-label">Financial Year <span class="bg-require">*</span></label>
                        <div class="col-md-9">
                           <select name="financial_year" class="form-control select2" required>
                              <option value="">Select Running Session</option>
                              <?php
                              $current_year = date('Y');
                              for($y = $current_year - 5; $y <= $current_year + 3; $y++){
                                 $val = $y.'-'.($y+1);
                                 $sel = ($val == date('Y').'-'.(date('Y')+1)) ? 'selected' : '';
                                 echo '<option value="'.$val.'" '.$sel.'>'.$val.'</option>';
                              }
                              ?>
                           </select>
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-md-3 control-label">Staff<span class="bg-require">*</span></label>
                        <div class="col-md-9">
                           <select name="staff_id" id="staff_id" class="form-control select2" required>
                              <option value="">Select Staff</option>
                              <?php
                              $staff_list = $this->db->get_where('teacher', array('status' => 1))->result_array();
                              foreach($staff_list as $s){ ?>
                                 <option value="<?php echo $s['teacher_id'];?>"><?php echo $s['name'];?></option>
                              <?php } ?>
                           </select>
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-md-3 control-label">Deduct Month <span class="bg-require">*</span></label>
                        <div class="col-md-9">
                           <input class="form-control date-month-picker" name="month_year" value="<?php echo date('Y-m');?>" required>
                        </div>
                     </div>
                     <div class="form-group mb-md">
                        <label class="col-md-3 control-label">Category<span class="bg-require">*</span></label>
                        <div class="col-md-9">
                           <select name="expense_category_id" class="form-control select2" required>
                              <option value="">Select Category</option>
                              <?php
                              $categories = $this->db->get('expense_category')->result_array();
                              foreach($categories as $cat){ ?>
                                 <option value="<?php echo $cat['expense_category_id'];?>"><?php echo $cat['name'];?></option>
                              <?php } ?>
                           </select>
                        </div>
                     </div>
                     <div class="form-group mb-md">
                        <label class="col-md-3 control-label">Reason<span class="bg-require">*</span></label>
                        <div class="col-md-9">
                           <textarea class="form-control" rows="4" name="reason" placeholder="Enter your Reason" required></textarea>
                        </div>
                     </div>
                  </div>
                  <div class="col-sm-6">
                     <div class="form-group mb-md">
                        <label class="col-md-3 control-label">Date<span class="bg-require">*</span></label>
                        <div class="col-md-9">
                           <input class="form-control m-r-10" name="advance_date" type="date" value="<?php echo date('Y-m-d');?>" required>
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-md-3 control-label">Total Amount <span class="bg-require">*</span></label>
                        <div class="col-md-9">
                           <input type="number" class="form-control" name="amount" required />
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-md-3 control-label">Bank Name <span class="bg-require">*</span></label>
                        <div class="col-md-9">
                           <select name="bank_id" class="form-control select2" required>
                              <option value="">Select</option>
                              <?php
                              $banks = $this->db->get('bank')->result_array();
                              foreach($banks as $bnk){ ?>
                                 <option value="<?php echo $bnk['bank_id'];?>"><?php echo $bnk['bank_name'];?></option>
                              <?php } ?>
                           </select>
                        </div>
                     </div>
                     <div class="form-group mb-md">
                        <label class="col-md-3 control-label">Transaction Type<span class="bg-require">*</span></label>
                        <div class="col-md-9">
                           <select name="transaction_type" class="form-control" required>
                              <option value="">Select</option>
                              <option value="2">By Cash</option>
                              <option value="3">By Cheque</option>
                           </select>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="form-group">
                  <button type="submit" class="btn btn-info btn-rounded btn-block btn-sm"> <i class="fa fa-plus"></i>&nbsp;Save</button>
               </div>
               <br>
               <?php echo form_close();?>
            </div>
         </div>
      </div>
   </div>
</div>

<div class="row">
   <div class="col-sm-12">
      <div class="panel panel-info">
         <div class="panel-heading"> <i class="fa fa-list"></i>&nbsp;&nbsp;Advance Salary List</div>
         <div class="panel-wrapper collapse in" aria-expanded="true">
            <div class="panel-body table-responsive">
               <table id="tbladsalaryinfo" class="display nowrap" cellspacing="0" width="100%">
                  <thead>
                     <tr>
                        <th>#</th>
                        <th>Action</th>
                        <th>Create At</th>
                        <th>Review By</th>
                        <th>Status</th>
                        <th>Photo</th>
                        <th>Staff Name</th>
                        <th>Advance Amount</th>
                        <th>Balance Amount</th>
                        <th>Deduct Month</th>
                        <th>Entry User</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php $i = 1; foreach($advance_salaries as $row){
                        $staff = $this->db->get_where('teacher', array('teacher_id' => $row['staff_id']))->row();
                        $created = date('d-m-Y', strtotime($row['created_at']));
                        $status_label = ($row['status'] == 1) ? '<span class="label label-success">paid</span>' : '<span class="label label-danger">unpaid</span>';
                        $review_text = ($row['review_status'] == 1) ? (isset($row['entry_user']) ? $row['entry_user'] : 'Administrator') : '';
                        $review_class = ($row['review_status'] == 1) ? '' : 'label label-danger';
                        $review_click = ($row['review_status'] == 1) ? '' : 'onclick="status_modal(\''.base_url().'admin/advance_salary/status/'.$row['advance_salary_id'].'\');" style="cursor: pointer;"';
                        $review_label = ($row['review_status'] == 1) ? $row['entry_user'] : 'Mark as Review';
                        $balance = number_format($row['balance_amount']);
                        $amount = number_format($row['amount']);
                        $photo = 'uploads/default.jpg';
                        if(isset($staff->teacher_id)){
                           $photo_file = 'uploads/teacher_image/'.$staff->teacher_id.'.jpg';
                           if(file_exists($photo_file)) $photo = $photo_file;
                           else $photo = 'uploads/default.jpg';
                        }
                        $month_name = date('F Y', strtotime($row['month_year'].'-01'));
                     ?>
                     <tr>
                        <td><?php echo $i++;?></td>
                        <td>
                           <a onclick="confirm_print('<?php echo base_url().'report/jvoucherprint/'.$row['advance_salary_id']; ?>');" class="btn btn-info btn-circle btn-xs"><i class="fa fa-print"></i></a>
                           <?php if (has_action('hr', 'advance_salary', 'edit')): ?>
                           <a onclick="showAjaxModal('<?php echo base_url().'modal/popup/edit_advance_salary/'.$row['advance_salary_id']; ?>');" class="btn btn-info btn-circle btn-xs"><i class="fa fa-edit"></i></a>
                           <?php endif; ?>
                           <?php if (has_action('hr', 'advance_salary', 'delete')): ?>
                           <a onclick="confirm_modal('<?php echo base_url().'admin/advance_salary/delete/'.$row['advance_salary_id']; ?>')"><button type="button" class="btn btn-danger btn-circle btn-xs"><i class="fa fa-trash"></i></button></a>
                           <?php endif; ?>
                        </td>
                        <td><?php echo $created;?></td>
                        <td>
                           <span class="<?php echo $review_class;?>" <?php echo $review_click;?>>
                              <?php echo $review_label;?>
                           </span>
                        </td>
                        <td><?php echo $status_label;?></td>
                        <td><img src="<?php echo base_url().$photo;?>" width="30px"></td>
                        <td><?php echo isset($staff->name) ? $staff->name : '';?></td>
                        <td><?php echo $amount;?></td>
                        <td><?php echo $balance;?></td>
                        <td><?php echo $month_name;?></td>
                        <td><?php echo isset($row['entry_user']) ? $row['entry_user'] : 'Administrator';?></td>
                     </tr>
                     <?php } ?>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
</div>

<script src="<?php echo base_url(); ?>optimum/plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
   $('.preloader').hide();
   if(typeof $.fn.metisMenu !== 'undefined'){
      $('#side-menu').metisMenu();
   }
   $('#staff_id').select2();
   $('#tbladsalaryinfo').DataTable({
      dom: 'Blfirtip',
      paging: true,
      buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
      aaSorting: [[0, 'asc']],
      "columnDefs": [{
         "orderable": false,
         "targets": [0,1,2,3,4,5,6,7,8,9,10],
         "searchable": true
      }]
   });

   $('.date-month-picker').datepicker({
      format: 'yyyy-mm',
      startView: "months",
      minViewMode: "months",
      autoclose: true,
      todayHighlight: true,
      orientation: "bottom left"
   });
});
</script>
