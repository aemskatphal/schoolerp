<div class="row">
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading"><i class="fa fa-filter"></i>&nbsp;&nbsp;<i>Filter</i></div>
            <div class="panel-wrapper collapse in" aria-expanded="true">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-3">
                            <select class="form-control" id="year">
                                <option value="">Academic Year</option>
                                <?php
                                $current_year = date('Y');
                                for($y = $current_year - 5; $y <= $current_year + 3; $y++):
                                ?>
                                    <option value="<?php echo $y.'-'.($y+1); ?>" <?php if(isset($selected_year) && $selected_year == $y.'-'.($y+1)) echo 'selected'; ?>><?php echo $y.'-'.($y+1); ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select id="class_id" class="form-control">
                                <option value="">Select Standard</option>
                                <?php foreach($classes as $cls): ?>
                                    <option value="<?php echo $cls['class_id']; ?>" <?php if(isset($selected_class_id) && $selected_class_id == $cls['class_id']) echo 'selected'; ?>><?php echo $cls['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select id="board_id" class="form-control">
                                <option value="">Select Board</option>
                                <?php foreach($boards as $brd): ?>
                                    <option value="<?php echo $brd['board_id']; ?>"><?php echo $brd['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select id="academy_id" class="form-control">
                                <option value="">Select Academy</option>
                                <?php foreach($academies as $acd): ?>
                                    <option value="<?php echo $acd['academy_id']; ?>"><?php echo $acd['academy_name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 mt-4">
                            <select id="paystatus" class="form-control">
                                <option value="">Payment Status</option>
                                <option value="1" <?php if(isset($selected_paystatus) && $selected_paystatus == '1') echo 'selected'; ?>>Paid</option>
                                <option value="2" <?php if(isset($selected_paystatus) && $selected_paystatus == '2') echo 'selected'; ?>>Unpaid</option>
                            </select>
                        </div>
                        <div class="col-md-3 mt-4">
                            <select id="discntstatus" class="form-control">
                                <option value="">Discount Status</option>
                                <option value="1" <?php if(isset($selected_discntstatus) && $selected_discntstatus == '1') echo 'selected'; ?>>Yes</option>
                                <option value="2" <?php if(isset($selected_discntstatus) && $selected_discntstatus == '2') echo 'selected'; ?>>No</option>
                            </select>
                        </div>
                        <div class="col-md-3 mt-4">
                            <input class="form-control m-r-10" name="from" type="date" value="" id="from">
                        </div>
                        <div class="col-md-3 mt-4">
                            <input class="form-control m-r-10" name="to" type="date" value="" id="to">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-info">
            <div class="panel-wrapper collapse in" aria-expanded="true">
                <div class="panel-body table-responsive">
                    <table id="tblinvoice" class="display nowrap" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Invoice No</th>
                                <th>Actions</th>
                                <th>Status</th>
                                <th>Details</th>
                                <th>Student</th>
                                <th>Year</th>
                                <th>Std.</th>
                                <th>Total</th>
                                <th>Discount</th>
                                <th>Paid</th>
                                <th>Due</th>
                                <th>Description</th>
                                <th>Entry User</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
    var invoiceDataTable = $('#tblinvoice').DataTable({
        'lengthMenu': [[10, 25, 50, -1], [10, 25, 50, 'All']],
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        'searching': true,
        <?php $inv_export = has_action('fees', 'manage_invoice', 'export'); ?>
        <?php if ($inv_export): ?>
        dom: 'Blfirtip',
        <?php else: ?>
        dom: 'frtip',
        <?php endif; ?>
        paging: true,
        <?php if ($inv_export): ?>
        buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
        <?php endif; ?>
        aaSorting: [[1, 'desc']],
        'ajax': {
            'url': '<?php echo base_url();?>admin/invoiceList',
            'data': function(data){
                data.class_id = $('#class_id').val();
                data.paystatus = $('#paystatus').val();
                data.discntstatus = $('#discntstatus').val();
                data.from = $('#from').val();
                data.to = $('#to').val();
                data.year = $('#year').val();
                data.board_id = $('#board_id').val();
                data.academy_id = $('#academy_id').val();
            }
        },
        "columnDefs": [{
            "targets": [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14],
            "orderable": false,
            "searchable": false
        }]
    });

    $('#class_id, #paystatus, #from, #to, #year, #board_id, #academy_id, #discntstatus').change(function(){
        invoiceDataTable.draw();
    });
});
</script>
