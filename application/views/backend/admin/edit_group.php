<?php
$group = $this->group_model->getGroupById($param2);
?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title">Edit Group</h4>
</div>
<?php echo form_open(base_url().'admin/group/update/'.$param2, array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top')); ?>
<div class="modal-body">
    <div class="form-group">
        <label class="col-md-12">Group Name<span class="bg-require">*</span></label>
        <div class="col-sm-12">
            <input type="text" class="form-control" name="group_name" value="<?php echo $group['group_name']; ?>" required>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-success">Update</button>
</div>
<?php echo form_close(); ?>
