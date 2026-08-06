<?php
    $banks = isset($banks) ? $banks : $this->db->get('bank')->result_array();
    $expense_categories = isset($expense_categories) ? $expense_categories : $this->db->get('expense_category')->result_array();
    $admins = isset($admins) ? $admins : $this->db->order_by('name', 'ASC')->get('admin')->result_array();
    $years = isset($years) ? $years : $this->db->query("SELECT DISTINCT year FROM payment ORDER BY year DESC")->result_array();
    $session_row = $this->db->get_where('settings', array('type' => 'session'))->row();
    $session_year = $session_row ? $session_row->description : '';
    $year_options = array();
    foreach($years as $y){
        $year_options[$y['year']] = $y['year'];
    }
    if(!empty($session_year)) $year_options[$session_year] = $session_year;

    $preset_expcat = isset($expcat_id)    ? $expcat_id    : $this->input->get('expcat_id');
    $preset_income = isset($income_type)  ? $income_type  : $this->input->get('income_type');
    $preset_from   = isset($from)         ? $from         : $this->input->get('from');
    $preset_to     = isset($to)           ? $to           : $this->input->get('to');
?>

<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                <i class="fa fa-plus"></i>&nbsp;&nbsp;NEW ENTRY
                <div class="pull-right"><a href="#" data-perform="panel-collapse"><i class="fa fa-plus"></i>&nbsp;&nbsp;ADD NEW ENTRY HERE<i class="btn btn-info btn-xs"></i></a></div>
            </div>
            <div class="panel-wrapper collapse out" aria-expanded="true">
                <div class="panel-body">
                <?php echo form_open(base_url() . 'expense/cashbook/insert/' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-sm-12" for="example-text">Academic Year<span style="color:red">*</span></label>
                                <div class="col-sm-12">
                                    <select name="financial_year" class="form-control select2" required>
                                        <?php foreach($year_options as $y): ?>
                                        <option value="<?php echo $y;?>" <?php if($y == $session_year) echo 'selected';?>><?php echo $y;?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-sm-12" for="example-text">Receipt No</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" name="receipt_no">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-sm-12">Credit/Debit<span style="color:red">*</span></label>
                                <div class="col-sm-12">
                                    <div class="form-control">
                                        <input type="radio" class="dsize" name="payment_type" value="credit" checked>&nbsp;<span class="crview">Credit</span>&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="radio" class="dsize" name="payment_type" value="debit">&nbsp;<span class="drview">Debit</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-sm-12" for="example-text">Bank Name</label>
                                <div class="col-sm-12">
                                    <select name="bank_id" class="form-control select2">
                                        <option value="">Select</option>
                                        <?php foreach($banks as $bank): ?>
                                        <option value="<?php echo $bank['bank_id'];?>"><?php echo $bank['bank_name'];?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-sm-12" for="example-text">Date<span style="color:red">*</span></label>
                                <div class="col-sm-12">
                                    <input class="form-control m-r-10" name="timestamp" type="date" value="<?php echo date('Y-m-d'); ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-sm-12" for="example-text">Type of Transaction<span style="color:red">*</span></label>
                                <div class="col-sm-12">
                                    <select name="transaction_type" class="form-control select2" required>
                                        <option value="">Select Type</option>
                                        <option value="1">By Bank</option>
                                        <option value="2">By Cash</option>
                                        <option value="3">By Cheque</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-sm-12" for="example-text">Category<span style="color:red">*</span></label>
                                <div class="col-sm-12">
                                    <select name="expense_category_id" class="form-control select2" required>
                                        <option value="">Select Category</option>
                                        <?php foreach($expense_categories as $row): ?>
                                        <option value="<?php echo $row['expense_category_id'];?>"><?php echo $row['name'];?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-sm-12" for="example-text">Person/Org.Name</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" name="person_org_name">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-sm-12" for="example-text">Total Amount<span style="color:red">*</span></label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" name="total_amount" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-sm-12">Contra Entry</label>
                                <div class="col-sm-12">
                                    <div class="form-control">
                                        <input type="radio" class="dsize" name="contra_entry" value="1">&nbsp;<span class="crview">Yes</span>&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="radio" class="dsize" name="contra_entry" value="0" checked>&nbsp;<span class="drview">No</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-12" for="example-text">Narration</label>
                        <div class="col-sm-12">
                            <textarea class="form-control textarea_editor" rows="5" name="description"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-info btn-rounded btn-block btn-sm"> <i class="fa fa-plus"></i>&nbsp;Save</button>
                    </div>
                    <br>
                <?php echo form_close();?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading"><i class="fa fa-filter"></i>&nbsp;&nbsp;<i>Filter</i></div>
            <div class="panel-wrapper collapse in" aria-expanded="true">
                <div class="panel-body">
                    <div class="col-md-3">
                        <select id="expcat_id" class="form-control">
                            <option value="">Select Category</option>
                            <?php foreach($expense_categories as $row): ?>
                            <option value="<?php echo $row['expense_category_id'];?>" <?php if(!empty($preset_expcat) && $preset_expcat == $row['expense_category_id']) echo 'selected';?>><?php echo $row['name'];?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select id="income_type" class="form-control">
                            <option value="">Select Income Type</option>
                            <option value="credit" <?php if($preset_income == 'credit') echo 'selected';?>>Credit</option>
                            <option value="debit" <?php if($preset_income == 'debit') echo 'selected';?>>Debit</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select id="admin_id" class="form-control">
                            <option value="">Select Admin</option>
                            <?php foreach($admins as $admin): ?>
                            <option value="<?php echo $admin['admin_id'];?>"><?php echo $admin['name'];?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select id="year" class="form-control">
                            <option value="">Select Year</option>
                            <?php foreach($year_options as $y): ?>
                            <option value="<?php echo $y;?>"><?php echo $y;?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <input class="form-control m-r-10" name="from" type="date" id="from" value="<?php echo html_escape($preset_from); ?>">
                    </div>
                    <div class="col-md-3">
                        <input class="form-control m-r-10" name="to" type="date" id="to" value="<?php echo html_escape($preset_to); ?>">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-info">
            <div class="panel-heading"><i class="fa fa-book"></i>&nbsp;&nbsp;Cashbook</div>
            <div class="panel-wrapper collapse in" aria-expanded="true">
                <div class="panel-body table-responsive">
                    <table id="tblcashbookinfo" class="display nowrap" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Action</th>
                                <th>Date</th>
                                <th>Receipt No</th>
                                <th>Income Type</th>
                                <th>Category</th>
                                <th>Transaction</th>
                                <th>Amount</th>
                                <th>Narration</th>
                                <th>Person/Org.Name</th>
                                <th>Bank</th>
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

    $('#expcat_id, #income_type, #admin_id, #year').select2();

    var cashbookDataTable = $('#tblcashbookinfo').DataTable({
        'lengthMenu': [[10, 25, 50, -1], [10, 25, 50, 'All']],
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        'searching': true,
        <?php $cb_export = has_action('accounts', 'cashbook', 'export'); ?>
        <?php if ($cb_export): ?>
        dom: 'Blfirtip',
        <?php else: ?>
        dom: 'frtip',
        <?php endif; ?>
        paging: true,
        <?php if ($cb_export): ?>
        buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
        <?php endif; ?>
        aaSorting: [[0, 'desc']],
        'ajax': {
            'url': '<?php echo base_url();?>admin/cashbookList',
            'data': function(data){
                data.expcat_id = $('#expcat_id').val();
                data.income_type = $('#income_type').val();
                data.admin_id = $('#admin_id').val();
                data.year = $('#year').val();
                data.from = $('#from').val();
                data.to = $('#to').val();
            }
        },
        "columnDefs": [{
            "targets": [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11],
            "orderable": false
        }],
    });

    $('#expcat_id, #income_type, #admin_id, #year, #from, #to').change(function(){
        cashbookDataTable.draw();
    });
});
</script>
