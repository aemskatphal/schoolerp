<div class="col-sm-4 offset-sm-4">
    <div class="panel panel-info">
        <div class="panel-heading"><i class="fa fa-list"></i>&nbsp;&nbsp;Standard Division Report</div>
        <div class="panel-wrapper collapse in" aria-expanded="true">
            <div class="panel-body table-responsive">
                <div class="form-group">
                    <label class="col-md-12" for="example-text">Admission Year<span style="color:red">*</span></label>
                    <div class="col-sm-12">
                        <select name="running_session" class="form-control" id="ad_year">
                            <option value="">Academic Year</option>
                            <?php
                            $current_year_session = $this->db->get_where('settings', array('type' => 'session'))->row();
                            $current_year = $current_year_session ? $current_year_session->description : date('Y').'-'.(date('Y')+1);
                            for($y = date('Y')+1; $y >= 2020; $y--){
                                $yr = ($y-1).'-'.$y;
                                echo '<option value="'.$yr.'">'.$yr.'</option>';
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
                    <label class="col-md-9" for="example-text">Select Academy</label>
                    <div class="col-sm-12">
                        <select id="academy" class="form-control">
                            <option value="all">All</option>
                            <?php foreach($this->db->get('academy')->result_array() as $acd): ?>
                                <option value="<?php echo $acd['academy_id'];?>"><?php echo $acd['academy_name'];?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-9" for="example-text">Student Status</label>
                    <div class="col-sm-12">
                        <select id="status" class="form-control">
                            <option value="all">All</option>
                            <option value="0">Active</option>
                            <option value="1">Inactive</option>
                            <option value="2">Out Of School</option>
                        </select>
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
                jQuery('#section_id').html('<option value="">Select Division</option>' + response);
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
            var academy_id = $('#academy').val();
            var status = $('#status').val();

            if (class_id == "" || section_id == "") {
                showWarningToast('Please select standard and division');
                return false;
            }

            var uri = '<?php echo base_url();?>report/view/StudentEduClassDiv/' + ad_year + '/' + class_id + '/' + section_id + '?academy_id=' + academy_id + '&status=' + status;
            $(".preport").attr("href", uri);
        });
    });
</script>