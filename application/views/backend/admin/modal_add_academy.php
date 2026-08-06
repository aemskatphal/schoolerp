<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title"><strong style="color:#FFFFFF">Add New Academy</strong></h4>
</div>
<div class="modal-body">
    <div id="academy_msg"></div>
    <form id="academy_form" method="post" accept-charset="utf-8">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label>Academy Name <span style="color:red">*</span></label>
                    <input type="text" name="academy_name" class="form-control" placeholder="Enter academy name" required>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <label>Email <span style="color:red">*</span></label>
                    <input type="email" name="email" class="form-control" placeholder="Enter email" required>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <label>Password <span style="color:red">*</span></label>
                    <input type="password" name="password" class="form-control" placeholder="Enter password" required>
                </div>
            </div>
            <div class="col-sm-12 text-center">
                <button type="submit" class="btn btn-success btn-rounded"><i class="fa fa-plus"></i> Save Academy</button>
            </div>
        </div>
    </form>
</div>
<script>
$('#academy_form').on('submit', function(e){
    e.preventDefault();
    var $btn = $(this).find('button[type=submit]');
    $btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Saving...');
    $.ajax({
        url: baseUrl + 'admin/modal_add_academy/insert',
        type: 'POST',
        data: $(this).serialize(),
        dataType: 'json',
        success: function(res){
            if(res.status === 'ok'){
                $('#modal_ajax').modal('hide');
                var $sel = $('select[name="academy_id"]');
                $sel.append('<option value="'+res.id+'" selected>'+res.name+'</option>');
                $sel.trigger('change');
                showToast('Academy added successfully');
            } else {
                $('#academy_msg').html('<div class="alert alert-danger">Error occurred</div>');
                $btn.prop('disabled', false).html('<i class="fa fa-plus"></i> Save Academy');
            }
        },
        error: function(){
            $btn.prop('disabled', false).html('<i class="fa fa-plus"></i> Save Academy');
        }
    });
});
</script>
