<?php if($this->session->flashdata('flash_message')): ?>
    <div class="alert alert-success"><?php echo $this->session->flashdata('flash_message');?></div>
<?php endif; ?>
<?php if (has_action('accounts', 'bank_account', 'create')): ?>
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                New Bank Account
                <div class="pull-right"><a href="#" data-perform="panel-collapse"><i class="fa fa-plus ti-minus"></i>&nbsp;&nbsp;ADD NEW BANK ACCOUNT HERE<i class="btn btn-info btn-xs ti-minus"></i></a> <a href="#" data-perform="panel-dismiss"></a> </div>
            </div>
            <div class="panel-wrapper out collapse in" aria-expanded="true">
                <div class="panel-body">
                    <form action="<?php echo base_url('admin/bank_account/create');?>" class="form-horizontal form-groups-bordered validate" method="post" accept-charset="utf-8">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-md-12" for="example-text">Bank Name<span class="bg-require">*</span></label>
                                    <div class="col-sm-12">
                                        <select name="bank_id" class="form-control select2" required>
                                            <option value="">Select Bank</option>
                                            <?php foreach($banks as $bank): ?>
                                                <option value="<?php echo $bank['bank_id'];?>"><?php echo $bank['bank_name'];?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12" for="example-text">Branch<span class="bg-require">*</span></label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" name="branch" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12" for="example-text">Account Number<span class="bg-require">*</span></label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" name="acc_no" required>
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
                            <button type="submit" class="btn btn-primary btn-rounded btn-block btn-sm"> <i class="fa fa-plus"></i>&nbsp;Save Bank Account</button>
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
            <div class="panel-heading"> <i class="fa fa-list"></i>&nbsp;&nbsp;List Bank Accounts</div>
            <div class="panel-wrapper collapse in" aria-expanded="true">
                <div class="panel-body table-responsive">
                    <table id="example23" class="display nowrap table table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th width="80"><div>#</div></th>
                                <th><div>Bank Name</div></th>
                                <th><div>Account No</div></th>
                                <th><div>Branch</div></th>
                                <th><div>IFSC Code</div></th>
                                <th><div>Address</div></th>
                                <th><div>Options</div></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($bank_accounts)): $i = 1; foreach($bank_accounts as $bac): ?>
                                <tr>
                                    <td><?php echo $i++;?></td>
                                    <td><?php echo $bac['bank_name'];?></td>
                                    <td><?php echo $bac['account_no'];?></td>
                                    <td><?php echo $bac['branch'];?></td>
                                    <td><?php echo $bac['ifsc_code'];?></td>
                                    <td><?php echo !empty($bac['address']) ? $bac['address'] : '-';?></td>
                                    <td>
                                        <?php if (has_action('accounts', 'bank_account', 'edit')): ?>
                                        <a onclick="showAjaxModal('<?php echo base_url('modal/popup/edit_bank_account/'.$bac['bank_account_id']);?>')" class="btn btn-info btn-circle btn-xs"><i class="fa fa-edit"></i></a>
                                        <?php endif; ?>
                                        <?php if (has_action('accounts', 'bank_account', 'delete')): ?>
                                        <a href="#" onclick="confirm_modal('<?php echo base_url('admin/bank_account/delete/'.$bac['bank_account_id']);?>');"><button type="button" class="btn btn-danger btn-circle btn-xs"><i class="fa fa-times"></i></button></a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="7" style="text-align:center;">No bank accounts found.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>