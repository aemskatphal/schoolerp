<?php
$row = $this->db->get_where('advance_salary', array('advance_salary_id' => $param2))->row();
$staff = $this->db->get_where('teacher', array('teacher_id' => $row->staff_id))->row();
?>

<div class="modal-header">
   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
   <h4 class="modal-title">Edit Advance Salary</h4>
</div>

<?php echo form_open(base_url() . 'admin/advance_salary/update/'. $row->advance_salary_id, array('class' => 'form-horizontal form-groups-bordered', 'enctype' => 'multipart/form-data'));?>

<div class="modal-body">
   <div class="form-group">
      <label class="col-md-3 control-label">Staff</label>
      <div class="col-md-9">
         <input type="text" class="form-control" value="<?php echo isset($staff->name) ? $staff->name : '';?>" readonly>
         <input type="hidden" name="staff_id" value="<?php echo $row->staff_id;?>">
      </div>
   </div>
   <div class="form-group">
      <label class="col-md-3 control-label">Financial Year</label>
      <div class="col-md-9">
         <input type="text" class="form-control" name="financial_year" value="<?php echo $row->financial_year;?>" readonly>
      </div>
   </div>
   <div class="form-group">
      <label class="col-md-3 control-label">Deduct Month</label>
      <div class="col-md-9">
         <input type="text" class="form-control" name="month_year" value="<?php echo $row->month_year;?>" readonly>
      </div>
   </div>
   <div class="form-group">
      <label class="col-md-3 control-label">Date</label>
      <div class="col-md-9">
         <input type="date" class="form-control" name="advance_date" value="<?php echo $row->advance_date;?>" required>
      </div>
   </div>
   <div class="form-group">
      <label class="col-md-3 control-label">Amount</label>
      <div class="col-md-9">
         <input type="number" class="form-control" name="amount" value="<?php echo $row->amount;?>" required>
      </div>
   </div>
   <div class="form-group">
      <label class="col-md-3 control-label">Category</label>
      <div class="col-md-9">
         <select name="expense_category_id" class="form-control select2">
            <option value="">Select Category</option>
            <?php
            $categories = $this->db->get('expense_category')->result_array();
            foreach($categories as $cat){ ?>
               <option value="<?php echo $cat['expense_category_id'];?>" <?php echo ($cat['expense_category_id'] == $row->expense_category_id) ? 'selected' : '';?>><?php echo $cat['name'];?></option>
            <?php } ?>
         </select>
      </div>
   </div>
   <div class="form-group">
      <label class="col-md-3 control-label">Bank Name</label>
      <div class="col-md-9">
         <select name="bank_id" class="form-control select2">
            <option value="">Select</option>
            <?php
            $banks = $this->db->get('bank')->result_array();
            foreach($banks as $bnk){ ?>
               <option value="<?php echo $bnk['bank_id'];?>" <?php echo ($bnk['bank_id'] == $row->bank_id) ? 'selected' : '';?>><?php echo $bnk['bank_name'];?></option>
            <?php } ?>
         </select>
      </div>
   </div>
   <div class="form-group">
      <label class="col-md-3 control-label">Transaction Type</label>
      <div class="col-md-9">
         <select name="transaction_type" class="form-control" required>
            <option value="">Select</option>
            <option value="2" <?php echo ($row->transaction_type == 2) ? 'selected' : '';?>>By Cash</option>
            <option value="3" <?php echo ($row->transaction_type == 3) ? 'selected' : '';?>>By Cheque</option>
         </select>
      </div>
   </div>
   <div class="form-group">
      <label class="col-md-3 control-label">Reason</label>
      <div class="col-md-9">
         <textarea class="form-control" rows="3" name="reason"><?php echo $row->reason;?></textarea>
      </div>
   </div>
</div>
<div class="modal-footer" align="center">
   <button type="submit" class="btn btn-info btn-rounded btn-sm"><i class="fa fa-check">&nbsp;</i>Update</button>
   <button type="button" class="btn btn-default btn-rounded btn-sm" data-dismiss="modal"><i class="fa fa-times">&nbsp;</i>Cancel</button>
</div>

<?php echo form_close();?>
