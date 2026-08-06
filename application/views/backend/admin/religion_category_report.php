<div class="col-sm-4 offset-sm-4">
    <div class="panel panel-info">
        <div class="panel-heading"><i class="fa fa-list"></i>&nbsp;&nbsp;Religion Category Report</div>
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
                <div class="form-group">
                    <label class="col-md-12" for="class_id">Standard<span class="bg-require">*</span></label>
                    <div class="col-sm-12">
                        <select id="class_id" class="form-control select2" style="width:100%" onchange="return get_class_sections(this.value)">
                            <option value="">Select Standard</option>
                            <?php foreach($classes as $class): ?>
                                <option value="<?php echo $class['class_id']; ?>"><?php echo $class['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12" for="section_id">Division<span class="bg-require">*</span></label>
                    <div class="col-sm-12">
                        <select id="section_id" class="form-control select2" style="width:100%" required>
                            <option value="">Select Standard First</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12" for="re_id">Religion</label>
                    <div class="col-sm-12">
                        <select id="re_id" class="form-control select2">
                            <option value="0">Select All</option>
                            <?php foreach($religions as $rel): ?>
                                <option value="<?php echo $rel['religion_id']; ?>"><?php echo $rel['religion_name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12" for="cat_id">Category</label>
                    <div class="col-sm-12">
                        <select id="cat_id" class="form-control select2" onchange="return get_category_cast(this.value)">
                            <option value="0">Select All</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12" for="cast_id">Caste</label>
                    <div class="col-sm-12">
                        <select name="cast_id" class="form-control select2" id="cast_id">
                            <option value="0">Select All</option>
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
    function get_category_cast(cat_id) {
        $.ajax({
            url: '<?php echo base_url();?>admin/get_category_cast/' + cat_id,
            success: function(response) {
                jQuery('#cast_id').html(response);
            }
        });
    }
    $(document).ready(function() {
        $('#re_id').on('change', function() {
            var re_id = $(this).val();
            if (re_id > 0) {
                $.ajax({
                    url: '<?php echo base_url();?>admin/get_religion_category/' + re_id,
                    success: function(response) {
                        jQuery('#cat_id').html('<option value="0">Select All</option>' + response);
                        jQuery('#cast_id').html('<option value="0">Select All</option>');
                    }
                });
            } else {
                $('#cat_id').html('<option value="0">Select All</option>');
                $('#cast_id').html('<option value="0">Select All</option>');
            }
        });
        $('#findpnt').on('click', function() {
            var ad_year = $('#ad_year').val();
            var class_id = $('#class_id').val();
            var section_id = $('#section_id').val();
            var re_id = $('#re_id').val();
            var cat_id = $('#cat_id').val();
            var cast_id = $('#cast_id').val();
            if (ad_year == "" || class_id == "" || section_id == "") {
                showWarningToast('Please select academic year, standard and division');
                return false;
            }
            var uri = '<?php echo base_url();?>report/view/StudentEduClassDivrelcatcast/' + ad_year + '/' + class_id + '/' + section_id + '?re_id=' + re_id + '&cat_id=' + cat_id + '&cast_id=' + cast_id;
            $(".preport").prop("href", uri);
        });
    });
</script>