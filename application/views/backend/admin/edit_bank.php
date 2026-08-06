<form action="<?php echo base_url('admin/bank/update/'.$param2);?>" class="form-horizontal form-groups-bordered validate" method="post" accept-charset="utf-8">
    <?php $bank = $this->db->get_where('bank', array('bank_id' => $param2))->row_array();?>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label class="col-md-12" for="example-text">Bank Name<span class="bg-require">*</span></label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" name="name" value="<?php echo $bank['bank_name'];?>" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-12" for="example-text">Branch<span class="bg-require">*</span></label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" name="branch" value="<?php echo $bank['branch'];?>" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-12" for="example-text">IFSC Code<span class="bg-require">*</span></label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" name="ifsc" value="<?php echo $bank['ifsc_code'];?>" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-12" for="example-text">Address<span class="bg-require">*</span></label>
                <div class="col-sm-12">
                    <textarea class="form-control" name="address" rows="3" required><?php echo $bank['address'];?></textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary btn-rounded btn-block btn-sm"><i class="fa fa-check"></i>&nbsp;Update Bank</button>
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