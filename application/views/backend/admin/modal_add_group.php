<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title"><strong style="color:#FFFFFF">Add New Group</strong></h4>
</div>
<div class="modal-body">
    <div id="group_msg"></div>
    <form id="group_form" method="post" accept-charset="utf-8">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label>Group Name <span style="color:red">*</span></label>
                    <input type="text" name="group_name" class="form-control" placeholder="Enter group name" required>
                </div>
            </div>
            <div class="col-sm-12 text-center">
                <button type="submit" class="btn btn-success btn-rounded"><i class="fa fa-plus"></i> Save Group</button>
            </div>
        </div>
    </form>
</div>
<script>
$('#group_form').on('submit', function(e){
    e.preventDefault();
    var $btn = $(this).find('button[type=submit]');
    $btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Saving...');
    $.ajax({
        url: baseUrl + 'admin/modal_add_group/insert',
        type: 'POST',
        data: $(this).serialize(),
        dataType: 'json',
        success: function(res){
            if(res.status === 'ok'){
                $('#modal_ajax').modal('hide');
                var $sel = $('select[name="group_id"]');
                $sel.append('<option value="'+res.id+'" selected>'+res.name+'</option>');
                $sel.trigger('change');
                showToast('Group added successfully');
            } else {
                $('#group_msg').html('<div class="alert alert-danger">Error occurred</div>');
                $btn.prop('disabled', false).html('<i class="fa fa-plus"></i> Save Group');
            }
        },
        error: function(){
            $btn.prop('disabled', false).html('<i class="fa fa-plus"></i> Save Group');
        }
    });
});
</script>
