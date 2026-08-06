<?php if (has_action('masters', 'previous_school', 'create')): ?>
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                New Previous School
                <div class="pull-right"><a href="#" data-perform="panel-collapse"><i class="fa fa-plus"></i>&nbsp;&nbsp;ADD NEW PREVIOUS SCHOOL</a></div>
            </div>
            <div class="panel-wrapper collapse out" aria-expanded="true">
                <div class="panel-body">
                    <?php echo form_open(base_url() . 'admin/previous_school/insert', array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-md-12">Name Of Previous School<span style="color:red">*</span></label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" name="name" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Name Of Contact</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" name="contactname">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Email ID</label>
                                <div class="col-sm-12">
                                    <input type="email" class="form-control" name="email">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-md-12">UDISE Number</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" name="udiseno">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Contact Number</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" name="phone">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Website</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" name="website">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="col-md-12">Address</label>
                                <div class="col-sm-12">
                                    <textarea class="form-control" name="address" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-rounded btn-block btn-sm"><i class="fa fa-plus"></i>&nbsp;Save Previous School</button>
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
            <div class="panel-heading"><i class="fa fa-list"></i>&nbsp;&nbsp;List Previous School</div>
            <div class="panel-wrapper collapse in" aria-expanded="true">
                <div class="panel-body table-responsive">
                    <table id="example23" class="display nowrap" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th><div>#</div></th>
                                <th><div>Options</div></th>
                                <th><div>Name Of School</div></th>
                                <th><div>UDISE No</div></th>
                                <th><div>Address</div></th>
                                <th><div>Contact Name</div></th>
                                <th><div>Email</div></th>
                                <th><div>Website</div></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $counter = 1;
                            $previous_schools = $this->db->get('previous_school')->result_array();
                            foreach($previous_schools as $row):?>
                            <tr>
                                <td><?php echo $counter++;?></td>
                                <td>
                                    <?php if (has_action('masters', 'previous_school', 'edit')): ?>
                                    <a onclick="showAjaxModal('<?php echo base_url();?>modal/popup/edit_previous_school/<?php echo $row['previous_school_id'];?>')" class="btn btn-info btn-circle btn-xs"><i class="fa fa-edit"></i></a>
                                    <?php endif; ?>
                                    <?php if (has_action('masters', 'previous_school', 'delete')): ?>
                                    <a href="#" onclick="confirm_modal('<?php echo base_url();?>admin/previous_school/delete/<?php echo $row['previous_school_id']; ?>');"><button type="button" class="btn btn-danger btn-circle btn-xs"><i class="fa fa-times"></i></button></a>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo $row['name'];?></td>
                                <td><?php echo $row['udiseno'];?></td>
                                <td><?php echo $row['address'];?></td>
                                <td><?php echo $row['contactname'];?></td>
                                <td><?php echo $row['email'];?></td>
                                <td><?php echo $row['website'];?></td>
                            </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>