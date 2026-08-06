<?php $select_admin_informtion_from_admin_table = $this->db->get_where('admin', array('admin_id' => $param2))->result_array();
        foreach ($select_admin_informtion_from_admin_table as $key => $selected_admin):?>
<div class="col-sm-12">
	<div class="panel panel-info">
        <div class="panel-heading"> <i class="fa fa-edit"></i>&nbsp;&nbsp;<?php echo get_phrase('Edit User');?> : <?php echo $selected_admin['name'];?></div>
            <div class="panel-body table-responsive">
            <?php echo form_open_multipart(base_url() . 'admin/newAdministrator/update/'. $param2, array('class' => 'form-horizontal form-goups-bordered validate'));?>

                <div class="form-group">
                    <label class="col-md-12" for="example-text"><?php echo get_phrase('Name');?><span class="bg-require">*</span></label>
                    <div class="col-sm-12">
                        <input name="name" type="text" class="form-control" value="<?php echo $selected_admin['name'];?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-12" for="example-text"><?php echo get_phrase('Email');?><span class="bg-require">*</span></label>
                    <div class="col-sm-12">
                        <input name="email" type="text" class="form-control" value="<?php echo $selected_admin['email'];?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-12" for="example-text"><?php echo get_phrase('Phone');?><span class="bg-require">*</span></label>
                    <div class="col-sm-12">
                        <input name="phone" type="text" class="form-control" value="<?php echo $selected_admin['phone'];?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-12" for="example-text"><?php echo get_phrase('Select Role');?><span class="bg-require">*</span></label>
                    <div class="col-sm-12">
                        <select name="level" class="form-control" required>
                            <option value="1" <?php if($selected_admin['level'] == '1') echo 'selected';?>><?php echo get_phrase('Super Admin');?></option>
                            <option value="2" <?php if($selected_admin['level'] == '2') echo 'selected';?>><?php echo get_phrase('Normal User');?></option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-12" for="example-text"><?php echo get_phrase('Password');?><span class="bg-require">*</span></label>
                    <div class="col-sm-12">
                        <input name="password" type="password" autocomplete="new-password" class="form-control" placeholder="<?php echo get_phrase('Leave blank to keep unchanged');?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-12" for="example-text"><?php echo get_phrase('Select Image');?></label>
                    <div class="col-sm-12">
                        <input type='file' class="form-control" name="admin_image" onChange="readURL(this);">
                        <img id="blah" src="<?php echo $this->crud_model->get_image_url('admin', $selected_admin['admin_id']); ?>" alt="image" height="150" width="150" style="border:1px solid #ccc; margin-top:10px;">
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-block btn-info btn-rounded btn-sm "><i class="fa fa-check"></i>&nbsp;<?php echo get_phrase('Update User');?></button>
                </div>
            <?php echo form_close();?>
            </div>
	</div>
</div>
        <?php endforeach;?>
