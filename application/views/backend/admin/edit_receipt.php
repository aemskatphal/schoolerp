<?php
    $receipt = $this->db->get_where('payment', array('payment_id' => $param2))->row_array();
    if(!$receipt) return;
    $student = $this->db->get_where('student', array('student_id' => $receipt['student_id']))->row_array();
    $invoice = $this->db->get_where('invoice', array('invoice_id' => $receipt['invoice_id']))->row_array();
    $banks = $this->db->get('bank')->result_array();
    $old_paid = $invoice ? intval($invoice['amount_paid']) : 0;
    $due = $invoice ? intval($invoice['due']) : 0;
    $total_amt = $old_paid + $due;
    $method_labels = array('1' => 'Online', '2' => 'Cash', '3' => 'Cheque');
?>
<script>
    function checkReceiptAmt(){
        var amt = parseFloat($('#edit_receipt_amount').val()) || 0;
        var due = parseFloat($('#edit_receipt_due').val()) || 0;
        var old_paid = parseFloat($('#edit_receipt_old_paid').val()) || 0;
        var checktot = old_paid + due;
        if(amt > checktot){
            $('#edit_receipt_amt_msg').text('Amount is greater than total');
            return false;
        }
        $('#edit_receipt_amt_msg').text('');
        return true;
    }
</script>
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-info">
            <div class="panel-heading"><i class="fa fa-list"></i>&nbsp;&nbsp;Edit Receipt</div>
            <div class="panel-wrapper collapse in" aria-expanded="true">
                <div class="panel-body table-responsive">
                    <?php echo form_open(base_url('admin/edit_receipt/'.$receipt['payment_id']), array('class' => 'form-horizontal form-groups-bordered validate', 'target' => '_top', 'onsubmit' => 'return checkReceiptAmt();'));?>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-sm-12">Receipt No</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" value="<?php echo $receipt['invoice_id'].'-'.date('Y', $receipt['timestamp']);?>" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-12">Date<span class="bg-require">*</span></label>
                                <div class="col-sm-12">
                                    <input class="form-control m-r-10" name="timestamp" type="date" value="<?php echo date('Y-m-d', $receipt['timestamp']);?>" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-12">Payment Method<span class="bg-require">*</span></label>
                                <div class="col-sm-12">
                                    <select name="method" class="form-control" style="width:100%" required>
                                        <option value="">Payment Method</option>
                                        <option value="1" <?php if($receipt['method']=='1') echo 'selected';?>>Online</option>
                                        <option value="2" <?php if($receipt['method']=='2') echo 'selected';?>>Cash</option>
                                        <option value="3" <?php if($receipt['method']=='3') echo 'selected';?>>Cheque</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Description<span class="bg-require">*</span></label>
                                <div class="col-sm-12">
                                    <textarea class="form-control" name="description" required><?php echo $receipt['description'];?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-sm-12">Due Amount</label>
                                <div class="col-sm-12">
                                    <input type="text" id="edit_receipt_due" class="form-control" value="<?php echo $due;?>" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-12">Amount<span class="bg-require">*</span></label>
                                <div class="col-sm-12">
                                    <input type="number" id="edit_receipt_amount" class="form-control" value="<?php echo intval($receipt['amount']);?>" readonly>
                                    <input type="hidden" name="old_paid" id="edit_receipt_old_paid" value="<?php echo $old_paid;?>">
                                    <input type="hidden" name="total_amt" value="<?php echo $total_amt;?>">
                                    <div id="edit_receipt_amt_msg" class="text-danger"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Bank Name<span class="bg-require">*</span></label>
                                <div class="col-sm-12">
                                    <select name="bank_id" class="form-control" required>
                                        <option value="">Select</option>
                                        <?php foreach($banks as $bank): ?>
                                        <option value="<?php echo $bank['bank_id'];?>" <?php if(isset($receipt['bank_id']) && $receipt['bank_id']==$bank['bank_id']) echo 'selected';?>><?php echo $bank['bank_name'];?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Contra Entry<span class="bg-require">*</span></label>
                                <div class="col-md-12">
                                    <div class="form-control">
                                        <input type="radio" class="dsize" name="contra_entry" value="1" <?php if(isset($receipt['contra_entry']) && $receipt['contra_entry']=='1') echo 'checked';?> required>&nbsp;<span class="crview">Yes</span>&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="radio" class="dsize" name="contra_entry" value="0" <?php if(isset($receipt['contra_entry']) && $receipt['contra_entry']=='0') echo 'checked';?> required>&nbsp;<span class="drview">No</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="student_id" value="<?php echo $receipt['student_id'];?>">
                    <input type="hidden" name="invoice_id" value="<?php echo $receipt['invoice_id'];?>">
                    <div class="form-group">
                        <button type="submit" class="btn btn-info btn-block btn-rounded btn-sm"><i class="fa fa-save"></i>&nbsp;Update Receipt</button>
                    </div>
                    <?php echo form_close();?>
                </div>
            </div>
        </div>
    </div>
</div>
