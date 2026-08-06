<?php
    $row = $this->db->get_where('journal_voucher', array('journal_voucher_id' => $param2))->row_array();
    if(!$row) return;
    $expense_categories = $this->db->get('expense_category')->result_array();
    $banks = $this->db->get('bank')->result_array();
    $clients = $this->db->get('client')->result_array();
?>
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-info">
            <div class="panel-heading"><i class="fa fa-edit"></i>&nbsp;&nbsp;Edit Journal Voucher</div>
            <div class="panel-body table-responsive">
                            <?php echo form_open(base_url('admin/journal_voucher/update/'.$row['journal_voucher_id']), array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
                            <div class="row">
                                <div class="col-sm-6">
                                    <input type="hidden" name="existing_bill" value="<?php echo $row['bill_file'];?>">
                                    <div class="form-group">
                                        <label class="col-md-12">Financial Year<span class="bg-require">*</span></label>
                                        <div class="col-sm-12">
                                            <select name="financial_year" class="form-control" id="ad_year" readonly>
                                                <option value="<?php echo $row['financial_year'];?>" selected><?php echo $row['financial_year'];?></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Category<span class="bg-require">*</span></label>
                                        <div class="col-sm-12">
                                            <select name="expense_category_id" class="form-control" required>
                                                <option value="">Select Category</option>
                                                <?php foreach($expense_categories as $cat): ?>
                                                    <option value="<?php echo $cat['expense_category_id'];?>" <?php if($row['expense_category_id']==$cat['expense_category_id']) echo 'selected';?>><?php echo $cat['name'];?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Date<span class="bg-require">*</span></label>
                                        <div class="col-sm-12">
                                            <input class="form-control m-r-10" name="timestamp" type="date" value="<?php echo $row['date'];?>" id="example-date-input" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Total Amount<span class="bg-require">*</span></label>
                                        <div class="col-sm-12">
                                            <input type="number" class="form-control" name="total_amount" value="<?php echo $row['total_amount'];?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Narration</label>
                                        <div class="col-sm-12">
                                            <textarea class="form-control" rows="5" name="description"><?php echo $row['narration'];?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-md-12">Voucher No<span class="bg-require">*</span></label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" value="<?php echo $row['voucher_no'].'/'.$row['financial_year'];?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Bank Name<span class="bg-require">*</span></label>
                                        <div class="col-sm-12">
                                            <select name="bank_id" class="form-control" required>
                                                <option value="">Select</option>
                                                <?php foreach($banks as $bank): ?>
                                                    <option value="<?php echo $bank['bank_id'];?>" <?php if($row['bank_id']==$bank['bank_id']) echo 'selected';?>><?php echo $bank['bank_name'];?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Type Of Transaction<span class="bg-require">*</span></label>
                                        <div class="col-sm-12">
                                            <select name="transaction_type" class="form-control">
                                                <option value="2" <?php if($row['transaction_type']=='2') echo 'selected';?>>By Cash</option>
                                                <option value="3" <?php if($row['transaction_type']=='3') echo 'selected';?>>By Cheque</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Person/Org.Name<span class="bg-require">*</span></label>
                                        <div class="col-sm-12">
                                            <select name="client_id" id="client_id" class="form-control" required onchange="document.getElementById('jv_client_name').value = this.options[this.selectedIndex].text;">
                                                <option value="">Select</option>
                                                <?php foreach($clients as $client): ?>
                                                    <option value="<?php echo $client['client_id'];?>" <?php if($row['client_id']==$client['client_id']) echo 'selected';?>><?php echo $client['name'];?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <input type="hidden" name="client_name" id="jv_client_name" value="<?php echo $row['client_name'];?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-12">Bill Attachment</label>
                                        <div class="col-sm-12">
                                            <?php if(!empty($row['bill_file'])): ?>
                                                <a href="<?php echo base_url('uploads/journal_voucher/'.$row['bill_file']);?>" target="_blank" class="btn btn-success btn-xs btn-rounded" style="color:#fff"><i class="fa fa-eye"></i>&nbsp;View</a>
                                                <br><br>
                                            <?php endif; ?>
                                            <input type="file" name="billfile" id="jv_billfile" class="dropify" onchange="readURL(this);">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-info btn-rounded btn-block btn-sm"><i class="fa fa-plus"></i>&nbsp;Update</button>
                            </div>
                            <br>
                            <?php echo form_close();?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('#jv_billfile').dropify();
    var jvSelect = document.getElementById('client_id');
    if(jvSelect){
        var jvOpt = jvSelect.options[jvSelect.selectedIndex];
        if(jvOpt && jvOpt.value !== ''){ document.getElementById('jv_client_name').value = jvOpt.text; }
    }
</script>
