<?php
    $entry = $this->db->get_where('payment', array('payment_id' => $param2))->row_array();
    if(!$entry) return;
    $banks = $this->db->get('bank')->result_array();
    $expense_categories = $this->db->get('expense_category')->result_array();
    $is_credit = ($entry['payment_type'] == 'income');
?>
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-info">
            <div class="panel-heading"><i class="fa fa-list"></i>&nbsp;&nbsp;Edit Cashbook Entry</div>
            <div class="panel-wrapper collapse in" aria-expanded="true">
                <div class="panel-body table-responsive">
                    <?php echo form_open(base_url('expense/cashbook/update/'.$entry['payment_id']), array('class' => 'form-horizontal form-groups-bordered validate', 'target' => '_top'));?>
                    <div class="form-group">
                        <label class="col-md-12">Academic Year<span class="bg-require">*</span></label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" name="financial_year" value="<?php echo $entry['year'];?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Income Type<span class="bg-require">*</span></label>
                        <div class="col-md-12">
                            <div class="form-control">
                                <input type="radio" class="dsize" name="payment_type" value="credit" <?php if($is_credit) echo 'checked';?> required>&nbsp;<span class="crview">Credit</span>&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="radio" class="dsize" name="payment_type" value="debit" <?php if(!$is_credit) echo 'checked';?> required>&nbsp;<span class="drview">Debit</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Date<span class="bg-require">*</span></label>
                        <div class="col-sm-12">
                            <input class="form-control m-r-10" name="timestamp" type="date" value="<?php echo date('Y-m-d', $entry['timestamp']);?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Category<span class="bg-require">*</span></label>
                        <div class="col-sm-12">
                            <select name="expense_category_id" class="form-control" required>
                                <option value="">Select Category</option>
                                <?php foreach($expense_categories as $row): ?>
                                <option value="<?php echo $row['expense_category_id'];?>" <?php if($entry['expense_category_id']==$row['expense_category_id']) echo 'selected';?>><?php echo $row['name'];?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Total Amount<span class="bg-require">*</span></label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" name="total_amount" value="<?php echo $entry['amount'];?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Receipt No</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" name="receipt_no" value="<?php echo $entry['receipt_no'];?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Bank Name</label>
                        <div class="col-sm-12">
                            <select name="bank_id" class="form-control">
                                <option value="">Select</option>
                                <?php foreach($banks as $bank): ?>
                                <option value="<?php echo $bank['bank_id'];?>" <?php if($entry['bank_id']==$bank['bank_id']) echo 'selected';?>><?php echo $bank['bank_name'];?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Type Of Transaction<span class="bg-require">*</span></label>
                        <div class="col-sm-12">
                            <select name="transaction_type" class="form-control" required>
                                <option value="">Select Type</option>
                                <option value="1" <?php if($entry['method']=='1') echo 'selected';?>>By Bank</option>
                                <option value="2" <?php if($entry['method']=='2') echo 'selected';?>>By Cash</option>
                                <option value="3" <?php if($entry['method']=='3') echo 'selected';?>>By Cheque</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Person/Org.Name</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" name="person_org_name" value="<?php echo $entry['person_org_name'];?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Contra Entry</label>
                        <div class="col-md-12">
                            <div class="form-control">
                                <input type="radio" class="dsize" name="contra_entry" value="1" <?php if($entry['contra_entry']=='1') echo 'checked';?>>&nbsp;<span class="crview">Yes</span>&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="radio" class="dsize" name="contra_entry" value="0" <?php if($entry['contra_entry']!='1') echo 'checked';?>>&nbsp;<span class="drview">No</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Narration</label>
                        <div class="col-sm-12">
                            <textarea class="form-control" rows="3" name="description"><?php echo $entry['description'];?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-info btn-block btn-rounded btn-sm"><i class="fa fa-save"></i>&nbsp;Update Entry</button>
                    </div>
                    <?php echo form_close();?>
                </div>
            </div>
        </div>
    </div>
</div>
