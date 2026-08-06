<div class="row">
    <div class="col-sm-4 col-sm-offset-4">
        <div class="panel panel-info">
            <div class="panel-heading"><i class="fa fa-list"></i>&nbsp;&nbsp;Bank Statement Report</div>
            <div class="panel-wrapper collapse in" aria-expanded="true">
                <div class="panel-body table-responsive">
                    <div class="form-group">
                        <label class="col-md-12" for="example-text">Financial Year<span class="bg-require">*</span></label>
                        <div class="col-sm-12">
                            <select name="fin_year" id="fin_year" class="form-control select2" required>
                                <?php foreach($years as $yr): ?>
                                    <option value="<?php echo $yr;?>" <?php if($yr == $running_year) echo 'selected';?>><?php echo $yr;?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12" for="example-text">Bank Name<span class="bg-require">*</span></label>
                        <div class="col-sm-12">
                            <select name="bank_id" id="bank_id" class="form-control select2" required>
                                <option value="">Select</option>
                                <?php foreach($banks as $bank): ?>
                                    <option value="<?php echo $bank['bank_id'];?>"><?php echo $bank['bank_name'];?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12" for="example-text">From Date<span class="bg-require">*</span></label>
                        <div class="col-sm-12">
                            <input class="form-control m-r-10" name="from" type="date" value="<?php echo date('Y-m-d');?>" id="from" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12" for="example-text">To Date<span class="bg-require">*</span></label>
                        <div class="col-sm-12">
                            <input class="form-control m-r-10" name="to" type="date" value="<?php echo date('Y-m-d');?>" id="to" required>
                        </div>
                    </div>
                    <a target="_blank" class="btn btn-success btn-sm btn-rounded btn-block preport" style="color:white" id="findpnt"><i class="fa fa-print"></i> Print</a>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#findpnt').on('click', function() {
            var fin_year = $('#fin_year').val();
            var bank_id = $('#bank_id').val();
            var from = $('#from').val();
            var to = $('#to').val();

            if (fin_year == "" || bank_id == "" || from == "" || to == "") {
                $.toast({
                    text: 'Please select all required fields',
                    position: 'top-right',
                    loaderBg: '#f56954',
                    icon: 'warning',
                    hideAfter: 3500,
                    stack: 6
                });
                return false;
            }

            var uri = '<?php echo base_url();?>report/view/bank_statement_report/' + fin_year + '/' + bank_id + '/' + from + '/' + to;
            window.open(uri, '_blank');
        });
    });
</script>
