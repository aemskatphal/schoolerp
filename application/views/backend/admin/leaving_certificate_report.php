<div class="col-sm-4 offset-sm-4">
    <div class="panel panel-info">
        <div class="panel-heading"><i class="fa fa-list"></i>&nbsp;&nbsp;Leaving Certificate Report</div>
        <div class="panel-wrapper collapse in" aria-expanded="true">
            <div class="panel-body table-responsive">
                <div class="form-group">
                    <label class="col-md-12">From Date<span class="bg-require">*</span></label>
                    <div class="col-sm-12">
                        <input class="form-control m-r-10" name="from" type="date" value="<?php echo date('Y-m-d');?>" id="from" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-9">To Date<span class="bg-require">*</span></label>
                    <div class="col-sm-12">
                        <input class="form-control m-r-10" name="to" type="date" value="<?php echo date('Y-m-d');?>" id="to" required>
                    </div>
                </div>
                <a target="_blank" class="btn btn-success btn-sm btn-rounded btn-block preport" style="color:white" id="findpnt"> <i class="fa fa-print"></i> Print</a>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#findpnt').on('click', function() {
            var from = $('#from').val();
            var to = $('#to').val();

            if (from == "" || to == "") {
                showWarningToast('Please select dates');
                return false;
            }

            var uri = '<?php echo base_url();?>report/view/lcReport/' + from + '/' + to;
            $(".preport").prop("href", uri);
        });
    });
</script>