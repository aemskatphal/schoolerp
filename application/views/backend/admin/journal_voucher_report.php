<div class="row">
    <div class="col-sm-6">
        <div class="panel panel-info">
            <div class="panel-heading"><i class="fa fa-list"></i>&nbsp;&nbsp;Journal Voucher Report</div>
            <div class="panel-wrapper collapse in" aria-expanded="true">
                <div class="panel-body table-responsive">
                    <div class="form-group">
                        <label class="col-md-12" for="example-text">From Date<span style="color:red">*</span></label>
                        <div class="col-sm-12">
                            <input type="date" class="form-control" id="from_date" value="<?php echo date('Y-m-01');?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12" for="example-text">To Date<span style="color:red">*</span></label>
                        <div class="col-sm-12">
                            <input type="date" class="form-control" id="to_date" value="<?php echo date('Y-m-d');?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12" for="example-text">Party Name</label>
                        <div class="col-sm-12">
                            <select id="client_id" class="form-control select2" style="width:100%">
                                <option value="">All Parties</option>
                                <?php foreach($clients as $client): ?>
                                    <option value="<?php echo $client['client_id'];?>"><?php echo $client['name'];?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <a target="_blank" class="btn btn-success btn-sm btn-rounded btn-block preport" style="color:white" id="findpnt"> <i class="fa fa-print"></i> Generate Report</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#findpnt').on('click', function() {
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();
            var client_id = $('#client_id').val();

            if (from_date == "" || to_date == "") {
                showWarningToast('Please select from and to dates');
                return false;
            }

            var uri = '<?php echo base_url();?>report/view/journalvoucherreport/' + from_date + '/' + to_date + '?client_id=' + client_id;
            $(".preport").attr("href", uri);
        });
    });
</script>
