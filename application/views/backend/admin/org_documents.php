<?php if($this->session->flashdata('flash_message')): ?>
    <div class="alert alert-success"><?php echo $this->session->flashdata('flash_message');?></div>
<?php endif; ?>
<?php if($this->session->flashdata('error_message')): ?>
    <div class="alert alert-danger"><?php echo $this->session->flashdata('error_message');?></div>
<?php endif; ?>
<div class="row">
    <div class="col-sm-4">
        <div class="panel panel-info">
            <div class="panel-heading"><i class="fa fa-plus"></i>&nbsp;&nbsp;NEW DOCUMENT</div>
            <div class="panel-wrapper collapse in" aria-expanded="true">
                <div class="panel-body table-responsive">
                    <?php echo form_open_multipart(base_url('admin/org_documents/insert'), array('class' => 'form-horizontal form-groups-bordered validate'));?>
                        <div class="form-group">
                            <label class="col-md-12" for="example-text">Title</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" name="title" autofocus required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12" for="document_file">Document File</label>
                            <div class="col-sm-12">
                                <input type="file" name="document_file" class="form-control" id="document_file" required />
                            </div>
                        </div>
                        <button type="submit" class="btn btn-info btn-rounded btn-block btn-sm"><i class="fa fa-book"></i>&nbsp;Save Document</button>
                    <?php echo form_close();?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="panel panel-info">
            <div class="panel-heading"><i class="fa fa-file"></i>&nbsp;&nbsp;List Documents</div>
            <div class="panel-wrapper collapse in" aria-expanded="true">
                <div class="panel-body table-responsive">
                    <div class="row">
                        <div class="col-sm-6">
                            <button class="btn btn-danger btn-sm btn-rounded" id="bulkdelete"><i class="fa fa-trash"></i> Delete Selected</button>
                        </div>
                        <div class="col-sm-6">
                            <input type="text" id="searchInput" class="form-control" placeholder="Search documents..." style="float:right;max-width:250px;">
                        </div>
                    </div>
                    <br>
                    <table id="document" class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width:30px;"><input type="checkbox" id="bulkSelect"></th>
                                <th>Created At</th>
                                <th>Document Title</th>
                                <th>Download</th>
                                <th>Entry User</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($documents)): ?>
                                <?php foreach($documents as $doc): ?>
                                    <tr>
                                        <td><input type="checkbox" class="selectRow" value="<?php echo $doc['doc_id'];?>"></td>
                                        <td><?php echo date('d-m-Y', strtotime($doc['created_at']));?></td>
                                        <td><?php echo $doc['title'];?></td>
                                        <td>
                                            <a href="<?php echo base_url('uploads/sys_documents/'.$doc['file_name']);?>" target="_blank">
                                                <button type="button" class="btn btn-success btn-rounded btn-sm"><i class="fa fa-download"></i> View</button>
                                            </a>
                                        </td>
                                        <td><?php echo $doc['entry_user'];?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="5" style="text-align:center;">No documents uploaded yet.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Confirm Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete selected document(s)?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-rounded btn-sm" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger btn-rounded btn-sm" id="delete_link">Delete</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-6" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Warning</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Please select at least one record.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-rounded btn-sm" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#searchInput').on('keyup', function() {
            var value = $(this).val().toLowerCase();
            $('#document tbody tr').filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
            });
        });

        $('#bulkSelect').on('click', function() {
            $('.selectRow').prop('checked', this.checked);
        });

        $("#bulkdelete").click(function() {
            if ($('.selectRow:checked').length > 0) {
                $('#modal-4').modal('show');
            } else {
                $('#modal-6').modal('show');
            }
        });

        $('#delete_link').on("click", function(event) {
            var ids = [];
            $('.selectRow').each(function() {
                if ($(this).is(':checked')) {
                    ids.push($(this).val());
                }
            });
            var doc_ids = ids.toString();
            if (doc_ids != '') {
                $.ajax({
                    url: '<?php echo base_url('admin/org_documents/delete');?>',
                    method: 'post',
                    data: { doc_ids: doc_ids },
                    success: function(response) {
                        $("#modal-4").modal("hide");
                        window.location.reload();
                    }
                });
            }
        });
    });
</script>