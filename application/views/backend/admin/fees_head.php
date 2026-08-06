<div class="row">
    <?php if (has_action('fees', 'fees_head', 'create')): ?>
    <div class="col-sm-5">
        <div class="panel panel-info">
            <div class="panel-heading"><i class="fa fa-plus"></i>&nbsp;&nbsp;Fees Head</div>
            <div class="panel-body table-responsive">
                <?php echo form_open(base_url() . 'admin/fees_head/create', array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                <div class="form-group">
                    <label class="col-md-12" for="example-text">Title<span style="color:red">*</span></label>
                    <div class="col-sm-12">
                        <input name="fh_title" type="text" class="form-control" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12" for="example-text">Amount<span style="color:red">*</span></label>
                    <div class="col-sm-12">
                        <input name="fh_amt" type="number" class="form-control" required>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-info btn-sm btn-block btn-rounded"><i class="fa fa-plus"></i>&nbsp;&nbsp;Save Head</button>
                </div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <div class="col-sm-7">
        <div class="panel panel-info">
            <div class="panel-heading"><i class="fa fa-list"></i>&nbsp;&nbsp;List Feeshead</div>
            <div class="panel-wrapper collapse in" aria-expanded="true">
                <div class="panel-body table-responsive">
                    <table id="example23" class="display nowrap" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th><div>#</div></th>
                                <th><div>Title</div></th>
                                <th><div>Amount</div></th>
                                <th><div>Date</div></th>
                                <th><div>Options</div></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $counter = 1;
                            $fee_heads = $this->db->order_by('fees_head_id', 'ASC')->get('fees_head')->result_array();
                            foreach($fee_heads as $row):?>
                            <tr>
                                <td><?php echo $counter++;?></td>
                                <td><?php echo $row['title'];?></td>
                                <td><?php echo number_format($row['amount'], 0);?></td>
                                <td><?php echo date('d-m-Y', strtotime($row['created_at']));?></td>
                                <td>
                                    <?php if (has_action('fees', 'fees_head', 'edit')): ?>
                                    <a onclick="showAjaxModal('<?php echo base_url();?>modal/popup/edit_feehead/<?php echo $row['fees_head_id'];?>');" class="btn btn-info btn-circle btn-xs"><i class="fa fa-edit"></i></a>
                                    <?php endif; ?>
                                    <?php if (has_action('fees', 'fees_head', 'delete')): ?>
                                    <a href="#" onclick="confirm_modal('<?php echo base_url();?>admin/fees_head/delete/<?php echo $row['fees_head_id'];?>');" class="btn btn-danger btn-circle btn-xs" style="color:white"><i class="fa fa-times"></i></a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
