<?php
$religions = $this->db->get('religion')->result_array();
?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title"><strong style="color:#FFFFFF">Add New Caste</strong></h4>
</div>
<div class="modal-body">
    <div id="cast_msg"></div>
    <form id="cast_form" method="post" accept-charset="utf-8">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label>Religion <span style="color:red">*</span></label>
                    <select name="re_id" id="cast_re_id" class="form-control" required onchange="load_categories_for_cast(this.value)">
                        <option value="">Select Religion</option>
                        <?php foreach($religions as $rel): ?>
                            <option value="<?php echo $rel['religion_id']; ?>"><?php echo html_escape($rel['religion_name']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <label>Category <span style="color:red">*</span></label>
                    <select name="cat_id" id="cast_cat_id" class="form-control" required>
                        <option value="">Select Religion First</option>
                    </select>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <label>Caste Name <span style="color:red">*</span></label>
                    <input type="text" class="form-control" name="cast_name" placeholder="Enter caste name" required>
                </div>
            </div>
            <div class="col-sm-12 text-center">
                <button type="submit" class="btn btn-success btn-rounded"><i class="fa fa-plus"></i> Save Caste</button>
            </div>
        </div>
    </form>
</div>
<script>
function load_categories_for_cast(re_id){
    var $cat = $('#cast_cat_id');
    $cat.html('<option value="">Loading...</option>');
    if(re_id == ''){ $cat.html('<option value="">Select Religion First</option>'); return; }
    $.ajax({
        url: baseUrl + 'admin/get_religion_category/' + re_id,
        success: function(response){ $cat.html(response); }
    });
}
$('#cast_form').on('submit', function(e){
    e.preventDefault();
    var $btn = $(this).find('button[type=submit]');
    $btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Saving...');
    $.ajax({
        url: baseUrl + 'admin/modal_add_cast/insert',
        type: 'POST',
        data: $(this).serialize(),
        dataType: 'json',
        success: function(res){
            if(res.status === 'ok'){
                $('#modal_ajax').modal('hide');
                var $sel = $('select[name="cast_id"]');
                $sel.append('<option value="'+res.id+'" selected>'+res.name+'</option>');
                $sel.trigger('change');
                showToast('Caste added successfully');
            } else {
                $('#cast_msg').html('<div class="alert alert-danger">Error occurred</div>');
                $btn.prop('disabled', false).html('<i class="fa fa-plus"></i> Save Caste');
            }
        },
        error: function(){
            $btn.prop('disabled', false).html('<i class="fa fa-plus"></i> Save Caste');
        }
    });
});
</script>
