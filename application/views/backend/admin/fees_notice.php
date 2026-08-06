<div class="col-sm-4 offset-sm-4">
    <div class="panel panel-info">
        <div class="panel-heading"><i class="fa fa-list"></i>&nbsp;&nbsp;Students Pending Fees Notice</div>
        <div class="panel-wrapper collapse in" aria-expanded="true">
            <div class="panel-body table-responsive">
                <div class="form-group">
                    <label class="col-md-12" for="example-text">Education Year<span style="color:red">*</span></label>
                    <div class="col-sm-12">
                        <select name="running_session" class="form-control" id="ad_year">
                            <option value="">Select Running Session</option>
                            <?php
                            $current_year = date('Y');
                            for($y = $current_year - 5; $y <= $current_year + 5; $y++){
                                $val = $y.'-'.($y+1);
                                $sel = ($val == $current_year.'-'.($current_year+1)) ? 'selected' : '';
                                echo '<option value="'.$val.'" '.$sel.'>'.$val.'</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12" for="example-text">Admission Std<span style="color:red">*</span></label>
                    <div class="col-sm-12">
                        <select id="class_id" class="form-control" style="width:100%" onchange="return get_class_sections(this.value)">
                            <option value="">Select</option>
                            <?php foreach($classes as $cls): ?>
                                <option value="<?php echo $cls['class_id'];?>"><?php echo $cls['name'];?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-9" for="example-text">Division<span style="color:red">*</span></label>
                    <div class="col-sm-12">
                        <select id="section_id" class="form-control" style="width:100%" required>
                            <option value="">Select Standard First</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12" for="example-text">Date<span style="color:red">*</span></label>
                    <div class="col-sm-12">
                        <input class="form-control m-r-10" name="date" type="date" value="<?php echo date('Y-m-d');?>" id="notice-date" required>
                    </div>
                </div>
                <a target="_blank" class="btn btn-success btn-sm btn-rounded btn-block preport" style="color:white" id="findpnt"> <i class="fa fa-print"></i> Print</a>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function get_class_sections(class_id) {
        $.ajax({
            url: '<?php echo base_url();?>admin/get_class_section/' + class_id,
            success: function(response) {
                jQuery('#section_id').html(response);
            }
        });
    }
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#findpnt').on('click', function() {
            var ad_year = $('#ad_year').val();
            var class_id = $('#class_id').val();
            var section_id = $('#section_id').val();
            var date = $('#notice-date').val();

            if (ad_year == "" || class_id == "" || section_id == "") {
                showWarningToast('Please select admission year, standard and division');
                return false;
            }

            var uri = '<?php echo base_url();?>report/view/pendingfeesnotice/' + ad_year + '/' + class_id + '/' + section_id + '?date=' + date;
            $(".preport").attr("href", uri);
        });
    });
</script>
