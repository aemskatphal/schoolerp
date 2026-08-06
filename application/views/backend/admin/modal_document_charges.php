<?php
$student_id = $param2;
$doc_code = $param3;
$doc_type_map = array('stdlc' => 'Leaving Certificate');
$doc_name = isset($doc_type_map[$doc_code]) ? $doc_type_map[$doc_code] : 'Leaving Certificate';
?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title"><strong style="color:#FFFFFF"><?php echo $doc_name; ?> - Document Charges</strong></h4>
</div>
<div class="modal-body">
    <form id="lcChargeForm" method="post" accept-charset="utf-8">
        <input type="hidden" name="student_id" value="<?php echo $student_id; ?>">
        <input type="hidden" name="doc_code" value="<?php echo $doc_code; ?>">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label>Document Charges</label>
                    <input type="text" name="document_charges" class="form-control" value="0 Rs" placeholder="e.g. 0 Rs">
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <label>Fee Remark</label>
                    <input type="text" name="fee_remark" class="form-control" placeholder="Enter fee remark">
                </div>
            </div>
            <div class="col-sm-12 text-center">
                <button type="submit" class="btn btn-success btn-rounded"><i class="fa fa-check"></i> Confirm & Print</button>
            </div>
        </div>
    </form>
</div>

<script>
$('#lcChargeForm').on('submit', function(e){
    e.preventDefault();
    var form = $(this);
    var charges = form.find('input[name="document_charges"]').val();
    var remark = form.find('input[name="fee_remark"]').val();
    var sid = form.find('input[name="student_id"]').val();
    var doc_code = form.find('input[name="doc_code"]').val();

    window.open(baseUrl + 'admin/print_student_document/' + sid + '/' + doc_code + '?charges=' + encodeURIComponent(charges) + '&remark=' + encodeURIComponent(remark), '_blank');
    $('#modal_ajax').modal('hide');
});
</script>