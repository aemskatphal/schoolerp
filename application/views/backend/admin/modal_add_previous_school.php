<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title"><strong style="color:#FFFFFF">Add New Previous School</strong></h4>
</div>
<div class="modal-body">
    <div id="ps_msg"></div>
    <form id="ps_form" method="post" accept-charset="utf-8">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label>School Name <span style="color:red">*</span></label>
                    <input type="text" name="name" class="form-control" placeholder="Enter school name" required>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <label>Contact Person</label>
                    <input type="text" name="contactname" class="form-control" placeholder="Enter contact person name">
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <label>Phone</label>
                    <input type="text" name="phone" class="form-control" placeholder="Enter phone number">
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Enter email">
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <label>Address</label>
                    <textarea name="address" class="form-control" rows="2" placeholder="Enter address"></textarea>
                </div>
            </div>
            <div class="col-sm-12 text-center">
                <button type="submit" class="btn btn-success btn-rounded"><i class="fa fa-plus"></i> Save School</button>
            </div>
        </div>
    </form>
</div>
<script>
$('#ps_form').on('submit', function(e){
    e.preventDefault();
    var $btn = $(this).find('button[type=submit]');
    $btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Saving...');
    $.ajax({
        url: baseUrl + 'admin/modal_add_previous_school/insert',
        type: 'POST',
        data: $(this).serialize(),
        dataType: 'json',
        success: function(res){
            if(res.status === 'ok'){
                $('#modal_ajax').modal('hide');
                var $sel = $('select[name="ps_id"]');
                $sel.append('<option value="'+res.id+'" selected>'+res.name+'</option>');
                $sel.trigger('change');
                showToast('Previous school added successfully');
            } else {
                $('#ps_msg').html('<div class="alert alert-danger">Error occurred</div>');
                $btn.prop('disabled', false).html('<i class="fa fa-plus"></i> Save School');
            }
        },
        error: function(){
            $btn.prop('disabled', false).html('<i class="fa fa-plus"></i> Save School');
        }
    });
});
</script>
