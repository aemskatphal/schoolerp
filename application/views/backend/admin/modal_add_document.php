<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title"><strong style="color:#FFFFFF">Add Student Document</strong></h4>
</div>
<div class="modal-body">
    <form action="<?php echo base_url();?>admin/view_student_add_document" method="post" enctype="multipart/form-data" accept-charset="utf-8">
        <input type="hidden" name="student_id" value="<?php echo $param2; ?>">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label>Document File <span style="color:red">*</span></label>
                    <input type="file" name="document_file" id="adocument_file" class="form-control" required>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <label>Document Type <span style="color:red">*</span></label>
                    <input type="text" name="document_type" class="form-control" placeholder="Enter document name" required>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <label>Remarks</label>
                    <textarea name="remarks" class="form-control" rows="3"></textarea>
                </div>
            </div>
            <div class="col-sm-12 text-center">
                <button type="submit" class="btn btn-success btn-rounded"><i class="fa fa-plus"></i> Save Document</button>
            </div>
        </div>
    </form>
</div>
