<?php
    $student = $this->db->get_where('student', array('student_id' => $student_id))->row_array();
    if(!$student){ echo 'Student not found'; return; }

    $student_invoices = $this->db->where('student_id', $student_id)->order_by('creation_timestamp', 'desc')->get('invoice')->result_array();
    $payments = $this->db->where('student_id', $student_id)->where('payment_type', 'income')->order_by('payment_id', 'desc')->get('payment')->result_array();
    $class_info = $this->db->get_where('class', array('class_id' => $student['class_id']))->row_array();

    $total_fees = 0;
    $total_discount = 0;
    $total_paid = 0;
    $total_due = 0;
    foreach($student_invoices as $inv){
        if($inv['status'] == '3') continue;
        $total_fees += $inv['amount'];
        $total_discount += $inv['discount'];
        $total_paid += $inv['amount_paid'];
        $total_due += $inv['due'];
    }

    $receipt_count = $this->db->where('student_id', $student_id)->where('payment_type', 'income')->count_all_results('payment');
    $receipt_no = ($receipt_count + 1) . '-' . date('Y');

    $session_year = $this->db->get_where('settings', array('type' => 'session'))->row()->description;

    $unpaid_invoice = null;
    foreach($student_invoices as $inv){
        if($inv['year'] == $session_year && $inv['due'] > 0 && $inv['status'] != '3'){ $unpaid_invoice = $inv; break; }
    }
    if(!$unpaid_invoice){
        foreach($student_invoices as $inv){
            if($inv['due'] > 0 && $inv['status'] != '3'){ $unpaid_invoice = $inv; break; }
        }
    }
    $form_invoice_id = $unpaid_invoice ? $unpaid_invoice['invoice_id'] : (isset($student_invoices[0]) ? $student_invoices[0]['invoice_id'] : '');

    $carry_target_invoice = null;
    foreach($student_invoices as $inv){
        if($inv['year'] == $student['ad_year']){ $carry_target_invoice = $inv; break; }
    }
    $can_carry = false;
    if(!empty($carry_target_invoice) && intval($carry_target_invoice['previous_due']) == 0){
        $carry_item_count = $this->db->where('invoice_id', $carry_target_invoice['invoice_id'])->where('fees_head_id', 0)->count_all_results('invoice_item');
        $old_due_count = $this->db->where('student_id', $student_id)->where('year !=', $student['ad_year'])->where('status', '2')->where('due >', 0)->count_all_results('invoice');
        $can_carry = ($carry_item_count == 0 && $old_due_count > 0);
    }

    $academic_history = $this->db->where('student_id', $student_id)->order_by('academic_year', 'DESC')->get('student_academic_history')->result_array();

    $banks = $this->db->get('bank')->result_array();
?>

<div class="row">
   <div class="col-sm-12">
      <div class="panel panel-info">
          <div class="panel-heading">
             <i class="fa fa-list"></i>&nbsp;&nbsp;Invoice Details
             <?php if($can_carry && !empty($carry_target_invoice)): ?>
             <a href="<?php echo base_url('admin/student_payment/carry_forward/'.$carry_target_invoice['invoice_id']);?>" class="btn btn-warning btn-sm btn-rounded pull-right" style="color:#000;"><i class="fa fa-arrow-circle-right"></i>&nbsp;&nbsp;Carry Forward Previous Due</a>
             <?php endif; ?>
          </div>
         <div class="panel-wrapper collapse in" aria-expanded="true">
            <div class="panel-body table-responsive">
               <table class="table table-bordered">
                  <thead>
                     <tr>
                        <th>#</th>
                        <th>Date</th>
                        <th>Title</th>
                        <th>Amount</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php $count = 1; foreach($student_invoices as $inv):
                         $items = $this->db->get_where('invoice_item', array('invoice_id' => $inv['invoice_id']))->result_array();
                         if(!empty($items)):
                             foreach($items as $item):
                                  $title = 'Fee';
                                  if($item['fees_head_id'] == 0){
                                      $title = 'Previous Due';
                                  } else {
                                      $fh = $this->db->get_where('fees_head', array('fees_head_id' => $item['fees_head_id']))->row_array();
                                      $title = $fh ? $fh['title'] : 'Fee';
                                  }
                     ?>
                     <tr>
                        <td><?php echo $count++;?></td>
                        <td><?php echo date('d-m-Y', strtotime($inv['creation_timestamp']));?></td>
                        <td><?php echo $title;?></td>
                        <td><?php echo intval($item['amount']);?></td>
                     </tr>
                     <?php
                             endforeach;
                         else:
                     ?>
                     <tr>
                        <td><?php echo $count++;?></td>
                        <td><?php echo date('d-m-Y', strtotime($inv['creation_timestamp']));?></td>
                        <td><?php echo $inv['title'];?></td>
                        <td><?php echo intval($inv['amount']);?></td>
                     </tr>
                     <?php endif; endforeach; ?>
                     <tr>
                        <td colspan="3" class="text-right"><b>Total Fees(RS)</b></td>
                        <td><b><?php echo intval($total_fees);?></b></td>
                     </tr>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="row">
   <div class="col-sm-12">
      <div class="panel panel-info">
         <div class="panel-heading"><i class="fa fa-list"></i>&nbsp;&nbsp;Payment History</div>
         <div class="panel-wrapper collapse in" aria-expanded="true">
            <div class="panel-body table-responsive">
               <table class="table table-bordered">
                  <thead>
                     <tr>
                        <th>#</th>
                        <th>Receipt No</th>
                        <th>Date</th>
                        <th>Method</th>
                        <th>Description</th>
                        <th>Paid Amount</th>
                        <th>Entry User</th>
                        <th>
                           <div>Actions</div>
                        </th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php $count = 1; foreach($payments as $pmt):
                         $admin_name = '';
                         $admin_q = $this->db->get_where('admin', array('name' => $pmt['entry_user']));
                         if($admin_q->num_rows() > 0) $admin_name = $pmt['entry_user'];
                     ?>
                     <tr>
                        <td><?php echo $count++;?></td>
                        <td><?php echo $pmt['payment_id'];?>-<?php echo date('Y', $pmt['timestamp']);?></td>
                        <td><?php echo date('d-m-Y', $pmt['timestamp']);?></td>
                        <td><?php $method_labels = array('1' => 'Online', '2' => 'Cash', '3' => 'Cheque'); echo isset($method_labels[$pmt['method']]) ? $method_labels[$pmt['method']] : $pmt['method'];?></td>
                        <td><?php echo $pmt['description'];?></td>
                        <td><?php echo intval($pmt['amount']);?></td>
                        <td><?php echo !empty($pmt['entry_user']) ? $pmt['entry_user'] : $student['entry_user'];?></td>
                        <td>
                           <a href="<?php echo base_url('report/view/StudentpaymentReceipt/'.$pmt['invoice_id'].'/'.$pmt['payment_id']);?>" target="_blank"> <button type="button" class="btn btn-info btn-circle btn-xs"><i class="fa fa-print"></i></button></a>
                        </td>
                      </tr>
                      <?php endforeach; ?>
                      <tr>
                         <td colspan="5" class="text-right"><b>Total Paid Fees(RS)</b></td>
                         <td><b><?php echo intval($total_paid);?></b></td>
                      </tr>
                   </tbody>
                </table>
             </div>
          </div>
       </div>
    </div>
 </div>
<div class="row">
   <div class="col-sm-12">
      <div class="panel panel-info">
         <div class="panel-heading"><i class="fa fa-book"></i>&nbsp;&nbsp;Student Fee Ledger (Academic History)</div>
         <div class="panel-wrapper collapse in" aria-expanded="true">
            <div class="panel-body table-responsive">
               <table class="table table-bordered">
                  <thead>
                     <tr>
                        <th>Academic Year</th>
                        <th>Class</th>
                        <th>Current Fee</th>
                        <th>Previous Due</th>
                        <th>Total Payable</th>
                        <th>Paid</th>
                        <th>Balance</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php if(!empty($academic_history)): ?>
                     <?php foreach($academic_history as $ah):
                         $ah_class = $this->db->get_where('class', array('class_id' => $ah['class_id']))->row_array();
                     ?>
                     <tr>
                        <td><?php echo $ah['academic_year'];?></td>
                        <td><?php echo $ah_class ? $ah_class['name'] : '-';?></td>
                        <td><?php echo number_format($ah['current_fee']);?></td>
                        <td><?php echo number_format($ah['previous_due']);?></td>
                        <td><?php echo number_format($ah['total_payable']);?></td>
                        <td><?php echo number_format($ah['paid']);?></td>
                        <td><?php echo number_format($ah['balance']);?></td>
                     </tr>
                     <?php endforeach; ?>
                     <?php else: ?>
                     <tr><td colspan="7" class="text-center">No academic history records found.</td></tr>
                     <?php endif; ?>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="row">
   <div class="col-sm-6">
      <div class="panel panel-info">
         <div class="panel-heading"><i class="fa fa-list"></i>&nbsp;&nbsp;Student Details</div>
         <div class="panel-wrapper collapse in" aria-expanded="true">
            <div class="panel-body table-responsive">
               <table class="table table-bordered">
                  <tbody>
                     <tr>
                        <th>Photo</th>
                        <td>
                           <?php if(!empty($student['photo'])): ?>
                           <img src="<?php echo base_url('uploads/student_image/'.$student['photo']);?>" width="100">
                           <?php else: ?>
                           <img src="<?php echo base_url('uploads/default.png');?>" width="100">
                           <?php endif; ?>
                        </td>
                     </tr>
                     <tr>
                        <th>Student Id</th>
                        <td><?php echo $student['student_id'];?></td>
                     </tr>
                     <tr>
                        <th>Name</th>
                        <td><?php echo $student['name'];?></td>
                     </tr>
                     <tr>
                        <th>Admission Year</th>
                        <td><?php echo $student['ad_year'];?></td>
                     </tr>
                     <tr>
                        <th>Standard</th>
                        <td><?php echo $class_info['name'];?></td>
                     </tr>
                     <tr>
                        <th>Gender</th>
                        <td><?php echo $student['sex'];?></td>
                     </tr>
                     <tr>
                        <th>Address</th>
                        <td><?php echo !empty($student['address']) ? $student['address'] : '-';?></td>
                     </tr>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
   <div class="col-sm-6">
      <div class="panel panel-info">
         <div class="panel-heading"><i class="fa fa-list"></i>&nbsp;&nbsp;Accept Payment</div>
         <div class="panel-wrapper collapse in" aria-expanded="true">
            <div class="panel-body table-responsive">
               <?php echo form_open(base_url('admin/student_payment/take_payment/'.$form_invoice_id), array('class' => 'form-horizontal form-groups-bordered validate', 'target' => '_top'));?>
               <div class="row">
                  <div class="col-sm-4">
                     <div class="form-group">
                        <label class="col-sm-12">Total Amount</label>
                        <div class="col-sm-12">
                           <input type="text" class="form-control" value="<?php echo intval($total_fees);?>" readonly>
                           <input type="hidden" name="academic_year" value="<?php echo $student['ad_year'];?>">
                        </div>
                     </div>
                  </div>
                  <div class="col-sm-4">
                     <div class="form-group">
                        <label class="col-sm-12">Paid Amount</label>
                        <div class="col-sm-12">
                           <input type="text" class="form-control" name="amount_paid" value="<?php echo intval($total_paid);?>" readonly>
                        </div>
                     </div>
                  </div>
                  <div class="col-sm-4">
                     <div class="form-group">
                        <label class="col-sm-12">Remaining Balance</label>
                        <div class="col-sm-12">
                           <input type="text" class="form-control" value="<?php echo intval($total_due);?>" readonly>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-6">
                     <div class="form-group">
                        <label class="col-sm-12">Receipt No<span class="bg-require">*</span></label>
                        <div class="col-sm-12">
                           <input class="form-control m-r-10" name="receipt_no" type="text" value="<?php echo $receipt_no;?>" readonly required>
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-sm-12">Receipt Date<span class="bg-require">*</span></label>
                        <div class="col-sm-12">
                           <input class="form-control m-r-10" name="timestamp" type="date" value="<?php echo date('Y-m-d');?>" required>
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-sm-12">Amount You Want To Pay Now<span class="bg-require">*</span></label>
                        <div class="col-sm-12">
                           <input type="number" class="form-control" name="amount" value="" placeholder="Enter Payment Amount" required>
                        </div>
                     </div>
                  </div>
                  <div class="col-sm-6">
                     <div class="form-group">
                        <label class="col-sm-12">Method<span class="bg-require">*</span></label>
                        <div class="col-sm-12">
                           <select name="method" class="form-control" style="width:100%" required autofocus>
                              <option value="">Payment Method</option>
                              <option value="1">Online</option>
                              <option value="2">Cash</option>
                              <option value="3">Cheque</option>
                           </select>
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-md-12">Bank Name<span class="bg-require">*</span></label>
                        <div class="col-sm-12">
                           <select name="bank_id" class="form-control select2" required>
                              <option value="">Select</option>
                              <?php foreach($banks as $bank): ?>
                              <option value="<?php echo $bank['bank_id'];?>"><?php echo $bank['bank_name'];?></option>
                              <?php endforeach; ?>
                           </select>
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-md-12">Contra Entry<span class="bg-require">*</span></label>
                        <div class="col-md-12">
                           <div class="form-control">
                              <input type="radio" class="dsize" name="contra_entry" value="1" required>&nbsp;<span class="crview">Yes</span>&nbsp;&nbsp;&nbsp;&nbsp;
                              <input type="radio" class="dsize" name="contra_entry" value="0" required>&nbsp;<span class="drview">No</span>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <input type="hidden" name="invoice_id" value="<?php echo $form_invoice_id;?>">
               <input type="hidden" name="student_id" value="<?php echo $student_id;?>">
               <div class="form-group">
                  <label class="col-md-12">Description<span class="bg-require">*</span></label>
                  <div class="col-sm-12">
                     <textarea class="form-control" name="description" required></textarea>
                  </div>
               </div>
               <div class="form-group">
                  <button type="submit" class="btn btn-info btn-block btn-rounded btn-sm"><i class="fa fa-plus"></i>&nbsp;Accept Payment</button>
               </div>
               <?php echo form_close();?>
            </div>
         </div>
      </div>
   </div>
</div>
