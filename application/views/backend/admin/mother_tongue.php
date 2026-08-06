<div class="row">
    <?php if (has_action('masters', 'mother_tongue', 'create')): ?>
    <div class="col-sm-5">
        <div class="panel panel-info">
            <div class="panel-heading"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Mother Tongue</div>
            <div class="panel-body table-responsive">
                <?php echo form_open(base_url() . 'admin/mother_tongue/insert', array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                <div class="form-group">
                    <label class="col-md-12" for="example-text">Mother Tongue<span style="color:red">*</span></label>
                    <div class="col-sm-12">
                        <input name="mt_name" type="text" class="form-control" required>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-info btn-sm btn-block btn-rounded"><i class="fa fa-plus"></i>&nbsp;&nbsp;Save Mother Tongue</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <div class="col-sm-7">
        <div class="panel panel-info">
            <div class="panel-heading"><i class="fa fa-list"></i>&nbsp;&nbsp;List Mother Tongue</div>
            <div class="panel-wrapper collapse in" aria-expanded="true">
                <div class="panel-body table-responsive">
                    <table id="example23" class="display nowrap" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th><div>#</div></th>
                                <th><div>Mother Tongue</div></th>
                                <th><div>Date</div></th>
                                <th><div>Options</div></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $counter = 1;
                            $mother_tongues = $this->db->get('mother_tongue')->result_array();
                            foreach($mother_tongues as $row):?>
                            <tr>
                                <td><?php echo $counter++;?></td>
                                <td><?php echo $row['mother_tongue_name'];?></td>
                                <td><?php echo date('d-m-Y', strtotime($row['created_at']));?></td>
                                <td>
                                    <?php if (has_action('masters', 'mother_tongue', 'edit')): ?>
                                    <a onclick="showAjaxModal('<?php echo base_url();?>modal/popup/edit_mothertongue/<?php echo $row['mother_tongue_id'];?>');" class="btn btn-info btn-circle btn-xs"><i class="fa fa-edit"></i></a>
                                    <?php endif; ?>
                                    <?php if (has_action('masters', 'mother_tongue', 'delete')): ?>
                                    <a href="#" onclick="confirm_modal('<?php echo base_url();?>admin/mother_tongue/delete/<?php echo $row['mother_tongue_id'];?>');" class="btn btn-danger btn-circle btn-xs" style="color:white"><i class="fa fa-times"></i></a>
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