<?php if($this->session->flashdata('flash_message')): ?>
    <div class="alert alert-success"><?php echo $this->session->flashdata('flash_message');?></div>
<?php endif; ?>
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                NEW
                <div class="pull-right"><a href="#" data-perform="panel-collapse"><i class="fa fa-plus ti-minus"></i>&nbsp;&nbsp;ADD NEW HERE<i class="btn btn-info btn-xs ti-minus"></i></a> <a href="#" data-perform="panel-dismiss"></a> </div>
            </div>
            <div class="panel-wrapper out collapse in" aria-expanded="true">
                <div class="panel-body">
                    <form action="<?php echo base_url('admin/journal_voucher/create');?>" class="form-horizontal form-groups-bordered validate" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                        <div class="row">
                            <div class="col-sm-6">
                    <div class="form-group">
                        <label class="col-md-12" for="example-text">Voucher No<span class="bg-require">*</span></label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" name="voucher_no" id="voucher_no" value="<?php echo $next_voucher_no;?>" readonly required>
                        </div>
                    </div>
                                <div class="form-group">
                                    <label class="col-md-12" for="example-text">Category<span class="bg-require">*</span></label>
                                    <div class="col-sm-12">
                                        <select name="expense_category_id" class="form-control select2" required>
                                            <option value="">Select Category</option>
                                            <?php foreach($expense_categories as $cat): ?>
                                                <option value="<?php echo $cat['expense_category_id'];?>"><?php echo $cat['name'];?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12" for="example-text">Date<span class="bg-require">*</span></label>
                                    <div class="col-sm-12">
                                        <input class="form-control m-r-10" name="timestamp" type="date" value="<?php echo date('Y-m-d');?>" id="example-date-input" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12" for="example-text">Total Amount<span class="bg-require">*</span></label>
                                    <div class="col-sm-12">
                                        <input type="number" class="form-control" name="total_amount" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12" for="example-text">Narration<span class="bg-require">*</span></label>
                                    <div class="col-sm-12">
                                        <textarea class="form-control" rows="5" name="description" required></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-md-12" for="example-text">Financial Year<span class="bg-require">*</span></label>
                                    <div class="col-sm-12">
                                        <select name="financial_year" id="financial_year" class="form-control select2" required>
                                            <?php foreach($years as $yr): ?>
                                                <option value="<?php echo $yr;?>" <?php if($yr == $running_year) echo 'selected';?>><?php echo $yr;?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12" for="example-text">Bank Name<span class="bg-require">*</span></label>
                                    <div class="col-sm-12">
                                        <select name="bank_id" class="form-control select2" required>
                                            <option value="">Select</option>
                                            <?php foreach($banks as $bank): ?>
                                                <option value="<?php echo $bank['bank_id'];?>"><?php echo $bank['bank_name'];?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12" for="example-text">Type Of Transaction<span class="bg-require">*</span></label>
                                    <div class="col-sm-12">
                                        <select name="transaction_type" class="form-control" required>
                                            <option value="">Select</option>
                                            <option value="2">By Cash</option>
                                            <option value="3">By Cheque</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12" for="example-text">Party Name<span class="bg-require">*</span></label>
                                    <div class="row col-md-12">
                                        <div class="col-sm-10">
                                            <select name="client_id" id="client_id" class="form-control select2" required>
                                                <option value="">Select</option>
                                                <?php foreach($clients as $client): ?>
                                                    <option value="<?php echo $client['client_id'];?>"><?php echo $client['name'];?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-2">
                                            <a onclick="showAjaxModal('<?php echo base_url('modal/popup/modal_add_client');?>');"><button type="button" class="btn btn-info btn-circle btn-xs"><i class="fa fa-plus"></i></button></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-12">Bill Attachment</label>
                                    <div class="col-sm-12">
                                        <input type="file" name="billfile" class="dropify" onchange="readURL(this);">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-info btn-rounded btn-block btn-sm"> <i class="fa fa-plus"></i>&nbsp;Save</button>
                        </div>
                        <br>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-info">
            <div class="panel-heading"> <i class="fa fa-list"></i>&nbsp;&nbsp;List Journal Voucher</div>
            <div class="panel-wrapper collapse in" aria-expanded="true">
                <div class="panel-body table-responsive">
                    <table id="example25" class="display nowrap table table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th><div>#</div></th>
                                <th><div>Date</div></th>
                                <th><div>Voucher No</div></th>
                                <th><div>Action</div></th>
                                <th><div>Payment Type</div></th>
                                <th><div>Transaction</div></th>
                                <th><div>Amount</div></th>
                                <th><div>Client Bill</div></th>
                                <th><div>Bank</div></th>
                                <th><div>Party Name</div></th>
                                <th><div>Address</div></th>
                                <th><div>Entry User</div></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($vouchers)): $i = 1; $srNo = count($vouchers); foreach($vouchers as $v): 
                                $cat_name = '';
                                $cat = $this->db->get_where('expense_category', array('expense_category_id' => $v['expense_category_id']))->row_array();
                                $cat_name = !empty($cat) ? $cat['name'] : '';
                                $bank_name = '';
                                $bnk = $this->db->get_where('bank', array('bank_id' => $v['bank_id']))->row_array();
                                $bank_name = !empty($bnk) ? $bnk['bank_name'] : '';
                                $client_name = '';
                                if(!empty($v['client_id'])){
                                    $cl = $this->db->get_where('client', array('client_id' => $v['client_id']))->row_array();
                                    $client_name = !empty($cl) ? $cl['name'] : '';
                                }
                                $client_address = '';
                                if(!empty($v['client_id'])){
                                    $cl = $this->db->get_where('client', array('client_id' => $v['client_id']))->row_array();
                                    $client_address = !empty($cl['address']) ? $cl['address'] : '';
                                }
                                $trans_labels = array('2' => 'By Cash', '3' => 'By Cheque');
                                $trans_label = isset($trans_labels[$v['transaction_type']]) ? $trans_labels[$v['transaction_type']] : $v['transaction_type'];
                            ?>
                                <tr>
                                    <td><?php echo $srNo--;?></td>
                                    <td><?php echo date('d-m-Y', strtotime($v['date']));?></td>
                                    <td><?php echo $v['voucher_no'];?></td>
                                    <td>
                                        <a target="_blank" href="<?php echo base_url('admin/journal_voucher_print/'.$v['journal_voucher_id']);?>" class="btn btn-success btn-circle btn-xs"><i class="fa fa-print"></i></a>
                                        <?php if (has_action('accounts', 'journal_voucher', 'edit')): ?>
                                        <a onclick="showAjaxModal('<?php echo base_url('modal/popup/edit_journal_voucher/'.$v['journal_voucher_id']);?>');" class="btn btn-info btn-circle btn-xs"><i class="fa fa-edit"></i></a>
                                        <?php endif; ?>
                                        <?php if (has_action('accounts', 'journal_voucher', 'delete')): ?>
                                        <a onclick="confirm_modal('<?php echo base_url('admin/journal_voucher/delete/'.$v['journal_voucher_id']);?>')" class="btn btn-danger btn-circle btn-xs"><i class="fa fa-trash-o"></i></a>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo $cat_name;?></td>
                                    <td><?php echo $trans_label;?></td>
                                    <td><?php echo number_format($v['total_amount'], 2);?></td>
                                    <td>
                                        <?php if(!empty($v['bill_file'])): ?>
                                            <a href="<?php echo base_url('uploads/journal_voucher/'.$v['bill_file']);?>" target="_blank" class="btn btn-success btn-xs btn-rounded" style="color:#fff"><i class="fa fa-eye"></i>&nbsp;View</a>
                                        <?php else: ?>
                                            -
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo $bank_name;?></td>
                                    <td><?php echo $client_name;?></td>
                                    <td><?php echo $client_address;?></td>
                                    <td><?php echo !empty($v['entry_user']) ? $v['entry_user'] : '-';?></td>
                                </tr>
                            <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="12" style="text-align:center;">No journal vouchers found.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function(){
    if($('#example25').length > 0 && !$.fn.DataTable.isDataTable('#example25')){
        $('#example25').DataTable({
            'lengthMenu': [[10, 25, 50, -1], [10, 25, 50, 'All']],
            'searching': true,
            dom: 'Blfirtip',
            paging: true,
            pageLength: 25,
            buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
            order: [[0, 'desc']],
            "columnDefs": [{
                "orderable": false,
                "targets": [3, 7]
            }]
        });
    }

    $('#financial_year').on('change', function(){
        var current = $('#voucher_no').val();
        var prefix = current.split('/')[0];
        $('#voucher_no').val(prefix + '/' + $(this).val());
    });
});
</script>