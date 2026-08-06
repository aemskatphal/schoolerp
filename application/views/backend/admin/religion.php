<div class="row">
    <?php if (has_action('masters', 'religion', 'create')): ?>
    <div class="col-sm-5">
        <div class="panel panel-info">
            <div class="panel-heading"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Religion</div>
            <div class="panel-body table-responsive">
                <?php echo form_open(base_url() . 'admin/religion/insert', array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                <div class="form-group">
                    <label class="col-md-12" for="example-text">Religion Name<span style="color:red">*</span></label>
                    <div class="col-sm-12">
                        <input name="re_name" type="text" class="form-control" required>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-info btn-sm btn-block btn-rounded"><i class="fa fa-plus"></i>&nbsp;&nbsp;Save Religion</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <div class="col-sm-7">
        <div class="panel panel-info">
            <div class="panel-heading"><i class="fa fa-list"></i>&nbsp;&nbsp;List Religion</div>
            <div class="panel-wrapper collapse in" aria-expanded="true">
                <div class="panel-body table-responsive">
                    <table id="example23" class="display nowrap" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th><div>#</div></th>
                                <th><div>Name</div></th>
                                <th><div>Date</div></th>
                                <th><div>Options</div></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $counter = 1;
                            $religions = $this->db->get('religion')->result_array();
                            foreach($religions as $row):?>
                            <tr>
                                <td><?php echo $counter++;?></td>
                                <td><?php echo $row['religion_name'];?></td>
                                <td><?php echo date('d-m-Y', strtotime($row['created_at']));?></td>
                                <td>
                                    <?php if (has_action('masters', 'religion', 'edit')): ?>
                                    <a onclick="showAjaxModal('<?php echo base_url();?>modal/popup/edit_religion/<?php echo $row['religion_id'];?>');" class="btn btn-info btn-circle btn-xs"><i class="fa fa-edit"></i></a>
                                    <?php endif; ?>
                                    <?php if (has_action('masters', 'religion', 'delete')): ?>
                                    <a href="#" onclick="confirm_modal('<?php echo base_url();?>admin/religion/delete/<?php echo $row['religion_id'];?>');" class="btn btn-danger btn-circle btn-xs" style="color:white"><i class="fa fa-times"></i></a>
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
