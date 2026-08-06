<?php
$classes = $this->db->order_by('sort_order', 'asc')->get('class')->result_array();
$student_ids = isset($param2) ? $param2 : '';
?>
<div class="modal-header" style="background:#00897b;">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color:#fff;">&times;</button>
    <h4 class="modal-title" style="color:#fff; text-align:left;"><strong><i class="fa fa-share"></i>&nbsp;&nbsp;Student Promotion</strong></h4>
</div>
<div class="modal-body">
    <form id="frm_student_transfer" method="post">
        <input type="hidden" name="student_ids" id="transfer_student_ids" value="<?php echo htmlspecialchars($student_ids); ?>" />

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label><strong>Promote To Standard *</strong></label>
                    <select name="new_class_id" id="new_class_id" class="form-control" required>
                        <option value="">-- Select Standard --</option>
                        <?php foreach($classes as $cls): ?>
                            <option value="<?php echo $cls['class_id']; ?>"><?php echo $cls['name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label><strong>Promote To Division *</strong></label>
                    <select name="new_section_id" id="new_section_id" class="form-control" required disabled>
                        <option value="">-- Select Standard First --</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label><strong>Session / Academic Year</strong></label>
                    <select name="session" class="form-control">
                        <option value="">-- Select Session --</option>
                        <?php
                        $current_year = date('Y');
                        for($y = $current_year - 2; $y <= $current_year + 3; $y++):
                            $year_val = $y.'-'.($y+1);
                        ?>
                            <option value="<?php echo $year_val; ?>"><?php echo $year_val; ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <p class="text-muted"><i class="fa fa-info-circle"></i> Selected students will be promoted to the new Standard and Division. This action cannot be undone.</p>
            </div>
        </div>
    </form>
</div>
<div class="modal-footer" style="background:#f5f5f5;">
    <button type="button" class="btn btn-success btn-rounded btn-sm" id="btn_promote_student" style="color:#fff;"><i class="fa fa-check"></i>&nbsp;&nbsp;Promote</button>
    <button type="button" class="btn btn-default btn-rounded btn-sm" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;&nbsp;Cancel</button>
</div>

<script>
$(document).ready(function(){
    $('#new_class_id').on('change', function(){
        var class_id = $(this).val();
        var secSelect = $('#new_section_id');
        secSelect.html('<option value="">Loading...</option>').prop('disabled', true);
        if(!class_id){
            secSelect.html('<option value="">-- Select Standard First --</option>').prop('disabled', true);
            return;
        }
        $.ajax({
            url: baseUrl + 'admin/get_class_section/' + class_id,
            type: 'GET',
            success: function(html){
                secSelect.html(html).prop('disabled', false);
            }
        });
    });

    $('#btn_promote_student').click(function(){
        var student_ids = $('#transfer_student_ids').val();
        var new_class_id = $('#new_class_id').val();
        var new_section_id = $('#new_section_id').val();
        var session = $('select[name="session"]').val();

        if(!new_class_id){
            showWarningToast('Please select a Standard to promote to.');
            return;
        }
        if(!new_section_id){
            showWarningToast('Please select a Division to promote to.');
            return;
        }

        $(this).prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>&nbsp;&nbsp;Processing...');

        $.ajax({
            url: baseUrl + 'admin/student_transfer',
            type: 'POST',
            data: {
                student_ids: student_ids,
                new_class_id: new_class_id,
                new_section_id: new_section_id,
                session: session
            },
            dataType: 'json',
            success: function(response){
                if(response.status === 'ok'){
                    $('#modal_ajax').modal('hide');
                    showToast(response.message);
                    setTimeout(function(){ window.location.reload(); }, 1500);
                } else {
                    showWarningToast(response.message);
                    $('#btn_promote_student').prop('disabled', false).html('<i class="fa fa-check"></i>&nbsp;&nbsp;Promote');
                }
            },
            error: function(){
                showWarningToast('An error occurred. Please try again.');
                $('#btn_promote_student').prop('disabled', false).html('<i class="fa fa-check"></i>&nbsp;&nbsp;Promote');
            }
        });
    });
});
</script>
