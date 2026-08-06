<div class="col-sm-4 offset-sm-4">
    <div class="panel panel-info">
        <div class="panel-heading"><i class="fa fa-list"></i>&nbsp;&nbsp;Cast Category Total Students</div>
        <div class="panel-wrapper collapse in" aria-expanded="true">
            <div class="panel-body table-responsive">
                <div class="form-group">
                    <label class="col-md-12" for="ad_year">Academic Year<span class="bg-require">*</span></label>
                    <div class="col-sm-12">
                        <select id="ad_year" name="running_session" class="form-control select2">
                            <?php $current_year = $this->db->get_where('settings', array('type' => 'running_session'))->row()->description; ?>
                            <?php for($y = date('Y') - 1; $y <= date('Y') + 1; $y++): ?>
                                <option value="<?php echo $y.'-'.($y+1); ?>" <?php if(($y.'-'.($y+1)) == $current_year) echo 'selected'; ?>><?php echo $y.'-'.($y+1); ?></option>
                            <?php endfor; ?>
                        </select>
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
            var ad_year = $('#ad_year').val();

            if (ad_year == "") {
                showWarningToast('Please select academic year');
                return false;
            }

            var uri = '<?php echo base_url();?>report/view/studentcatcntreport/' + ad_year;
            $(".preport").prop("href", uri);
        });
    });
</script>