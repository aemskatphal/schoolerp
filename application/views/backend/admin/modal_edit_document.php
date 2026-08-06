<?php
$doc_id = $param2;
$doc = $this->db->get_where('student_documents', array('id' => $doc_id))->row_array();
?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title"><strong style="color:#FFFFFF">Edit Student Document</strong></h4>
</div>
<div class="modal-body">
    <form action="<?php echo base_url();?>admin/view_student_update_document" method="post" enctype="multipart/form-data" accept-charset="utf-8">
        <input type="hidden" name="doc_id" value="<?php echo $doc['id']; ?>">
        <input type="hidden" name="student_id" value="<?php echo $doc['student_id']; ?>">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label>Document Type <span style="color:red">*</span></label>
                    <input type="text" name="document_type" class="form-control" value="<?php echo html_escape($doc['document_type']); ?>" required>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <label>Remarks</label>
                    <textarea name="remarks" class="form-control" rows="3"><?php echo html_escape($doc['remarks']); ?></textarea>
                </div>
            </div>
            <?php if(!empty($doc['document_file'])): ?>
            <div class="col-sm-12">
                <div class="form-group">
                    <label>Current File</label>
                    <div>
                        <a href="<?php echo base_url();?>uploads/std_document/<?php echo $doc['document_file']; ?>" target="_blank" class="btn btn-default btn-sm btn-rounded"><i class="fa fa-eye"></i> View Current File</a>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <div class="col-sm-12">
                <div class="form-group">
                    <label>Replace File (leave empty to keep current)</label>
                    <input type="file" name="document_file" class="form-control">
                </div>
            </div>
            <div class="col-sm-12 text-center">
                <button type="submit" class="btn btn-success btn-rounded"><i class="fa fa-save"></i> Update Document</button>
            </div>
        </div>
    </form>
</div>