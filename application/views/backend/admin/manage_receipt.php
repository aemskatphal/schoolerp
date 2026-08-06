<?php
    $classes = $this->db->order_by('sort_order', 'ASC')->get('class')->result_array();
    $admins = $this->db->get('admin')->result_array();
    $sel_class = isset($class_id) ? $class_id : '';
    $sel_from  = isset($from) ? $from : '';
    $sel_to    = isset($to) ? $to : '';
    $sel_year  = isset($year) ? $year : '';
?>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading"><i class="fa fa-filter"></i>&nbsp;&nbsp;<i>Filter</i></div>
            <div class="panel-wrapper collapse in" aria-expanded="true">
                <div class="panel-body">
                    <div class="col-md-3">
                        <select id="admin_id" class="form-control">
                            <option value="">Select Admin</option>
                            <?php foreach($admins as $admin):?>
                            <option value="<?php echo $admin['admin_id'];?>"><?php echo $admin['name'];?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select id="class_id" class="form-control">
                            <option value="">Select Standard</option>
                            <?php foreach($classes as $class):?>
                            <option value="<?php echo $class['class_id'];?>" <?php if($sel_class != '' && $class['class_id'] == $sel_class) echo 'selected'; ?>><?php echo $class['name'];?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <input class="form-control m-r-10" name="from" type="date" value="<?php echo $sel_from; ?>" id="from">
                    </div>
                    <div class="col-md-3">
                        <input class="form-control m-r-10" name="to" type="date" value="<?php echo $sel_to; ?>" id="to">
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
                                <th>Action</th>
                                <th>Invoice</th>
                                <th>Receipt No</th>
                                <th>Student</th>
                                <th>Year</th>
                                <th>Std.</th>
                                <th>Amount</th>
                                <th>Method</th>
                                <th>Description</th>
                                <th>Entry User</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function(){
    $('.preloader').hide();

    $('#admin_id, #class_id').select2();

    var receiptDataTable = $('#tblinvoice').DataTable({
        'lengthMenu': [[10, 25, 50, -1], [10, 25, 50, 'All']],
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        'searching': true,
        <?php $rcpt_export = has_action('fees', 'manage_receipt', 'export'); ?>
        <?php if ($rcpt_export): ?>
        dom: 'Blfirtip',
        <?php else: ?>
        dom: 'frtip',
        <?php endif; ?>
        paging: true,
        <?php if ($rcpt_export): ?>
        buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
        <?php endif; ?>
        aaSorting: [[1, 'desc']],
        'ajax': {
            'url': '<?php echo base_url();?>admin/receiptList',
            'data': function(data){
                data.class_id = $('#class_id').val();
                data.admin_id = $('#admin_id').val();
                data.from = $('#from').val();
                data.to = $('#to').val();
                data.year = '<?php echo $sel_year; ?>';
            }
        },
        "columnDefs": [{
            "targets": [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11],
            "orderable": false
        }],
    });

    $('#class_id, #admin_id, #from, #to').change(function(){
        receiptDataTable.draw();
    });
});
</script>
