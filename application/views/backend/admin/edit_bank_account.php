<form action="<?php echo base_url('admin/bank_account/update/'.$param2);?>" class="form-horizontal form-groups-bordered validate" method="post" accept-charset="utf-8">
    <?php $bac = $this->db->get_where('bank_account', array('bank_account_id' => $param2))->row_array();?>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label class="col-md-12" for="example-text">Bank Name<span class="bg-require">*</span></label>
                <div class="col-sm-12">
                    <select name="bank_id" class="form-control" required>
                        <option value="">Select Bank</option>
                        <?php $banks = $this->db->order_by('bank_name', 'ASC')->get('bank')->result_array(); foreach($banks as $bank): ?>
                            <option value="<?php echo $bank['bank_id'];?>" <?php if($bank['bank_id'] == $bac['bank_id']) echo 'selected';?>><?php echo $bank['bank_name'];?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-12" for="example-text">Branch<span class="bg-require">*</span></label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" name="branch" value="<?php echo $bac['branch'];?>" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-12" for="example-text">Account Number<span class="bg-require">*</span></label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" name="acc_no" value="<?php echo $bac['account_no'];?>" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-12" for="example-text">IFSC Code<span class="bg-require">*</span></label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" name="ifsc" value="<?php echo $bac['ifsc_code'];?>" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-12" for="example-text">Address<span class="bg-require">*</span></label>
                <div class="col-sm-12">
                    <textarea class="form-control" name="address" rows="3" required><?php echo $bac['address'];?></textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary btn-rounded btn-block btn-sm"><i class="fa fa-check"></i>&nbsp;Update Bank Account</button>
    </div>
</form>
<script type="text/javascript">
    $(document).ready(function() {
        $('form').on('submit', function(e) {
            e.preventDefault();
            var form = $(this);
            $.ajax({
                url: form.attr('action'),
                method: 'post',
                data: form.serialize(),
                success: function(response) {
                    if(response === 'success') {
                        window.location.reload();
                    }
                }
            });
        });
    });
</script>