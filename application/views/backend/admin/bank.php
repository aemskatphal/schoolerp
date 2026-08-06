<?php if($this->session->flashdata('flash_message')): ?>
    <div class="alert alert-success"><?php echo $this->session->flashdata('flash_message');?></div>
<?php endif; ?>
<?php if (has_action('accounts', 'bank', 'create')): ?>
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                New Bank
                <div class="pull-right"><a href="#" data-perform="panel-collapse"><i class="fa fa-plus ti-minus"></i>&nbsp;&nbsp;ADD NEW BANK HERE<i class="btn btn-info btn-xs ti-minus"></i></a> <a href="#" data-perform="panel-dismiss"></a> </div>
            </div>
            <div class="panel-wrapper out collapse in" aria-expanded="true">
                <div class="panel-body">
                    <form action="<?php echo base_url('admin/bank/create');?>" class="form-horizontal form-groups-bordered validate" method="post" accept-charset="utf-8">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-md-12" for="example-text">Bank Name<span class="bg-require">*</span></label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" name="name" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12" for="example-text">Branch<span class="bg-require">*</span></label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" name="branch" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-md-12" for="example-text">IFSC Code<span class="bg-require">*</span></label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" name="ifsc" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12" for="example-text">Address<span class="bg-require">*</span></label>
                                    <div class="col-sm-12">
                                        <textarea class="form-control" name="address" rows="3" required></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-rounded btn-block btn-sm"> <i class="fa fa-plus"></i>&nbsp;Save Bank</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-info">
            <div class="panel-heading"> <i class="fa fa-list"></i>&nbsp;&nbsp;List Banks</div>
            <div class="panel-wrapper collapse in" aria-expanded="true">
                <div class="panel-body table-responsive">
                    <table id="bankTable" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Bank Name</th>
                                <th>Branch</th>
                                <th>IFSC Code</th>
                                <th>Address</th>
                                <th>Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($banks)): $i = 1; foreach($banks as $bank): ?>
                                <tr>
                                    <td><?php echo $i++;?></td>
                                    <td><?php echo $bank['bank_name'];?></td>
                                    <td><?php echo $bank['branch'];?></td>
                                    <td><?php echo !empty($bank['ifsc_code']) ? $bank['ifsc_code'] : '-';?></td>
                                    <td><?php echo !empty($bank['address']) ? $bank['address'] : '-';?></td>
                                    <td>
                                        <?php if (has_action('accounts', 'bank', 'edit')): ?>
                                        <a onclick="showAjaxModal('<?php echo base_url('modal/popup/edit_bank/'.$bank['bank_id']);?>')" class="btn btn-info btn-circle btn-xs"><i class="fa fa-edit"></i></a>
                                        <?php endif; ?>
                                        <?php if (has_action('accounts', 'bank', 'delete')): ?>
                                        <a href="#" onclick="confirm_modal('<?php echo base_url('admin/bank/delete/'.$bank['bank_id']);?>');"><button type="button" class="btn btn-danger btn-circle btn-xs"><i class="fa fa-times"></i></button></a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="6" style="text-align:center;">No banks found.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
(function() {
    var table = document.getElementById('bankTable');
    if (!table) return;
    function tryInit() {
        if (typeof $ !== 'undefined' && $.fn && $.fn.DataTable) {
            if (!$.fn.DataTable.isDataTable('#bankTable')) {
                $('#bankTable').DataTable({
                    dom: 'Blfrtip',
                    buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
                    lengthMenu: [[10, 25, 50, -1], [10, 25, 50, 'All']],
                    order: [[0, 'asc']],
                    pageLength: 25
                });
            }
        } else {
            setTimeout(tryInit, 300);
        }
    }
    tryInit();
})();
</script>