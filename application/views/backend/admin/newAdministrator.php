<?php

$selecting_id_from_admin_table = array('admin_id' => $this->session->userdata('login_user_id'), 
'dashboard' => '1', 
'manage_academics' => '1', 'manage_employee' => '1', 
'manage_student' => '1', 'manage_attendance' => '1', 
'download_page' => '1', 'manage_parent' => '1', 
'manage_alumni' => '1');
$query_admin_role_table = $this->db->get_where('admin_role', $selecting_id_from_admin_table);

if($query_admin_role_table->num_rows() < 1)

    $this->db->insert('admin_role', $selecting_id_from_admin_table);
?>



<div class="row">
    <div class="col-sm-12">
		<div class="panel panel-info">
            <div class="panel-heading">
                <i class="fa fa-user-plus"></i>&nbsp;&nbsp;<?php echo get_phrase('New User'); ?>
                <div class="pull-right"><a href="#" data-perform="panel-collapse"><i class="fa fa-plus"></i>&nbsp;&nbsp;ADD NEW USER HERE<i class="btn btn-info btn-xs"></i></a> <a href="#" data-perform="panel-dismiss"></a> </div>
            </div>
            <div class="panel-wrapper collapse out" aria-expanded="true">
                <div class="panel-body">
                <?php echo form_open_multipart(base_url() . 'admin/newAdministrator/create', array('class' => 'form-horizontal form-goups-bordered validate'));?>
					<div class="panel-body table-responsive">

					    <div class="form-group">
                 	        <label class="col-md-12" for="example-text"><?php echo get_phrase('Name');?><span class="bg-require">*</span></label>
                                <div class="col-sm-12">
				                    <input name="name" type="text" class="form-control"/ required>
                                </div>
                        </div>

                        <div class="form-group">
                 	        <label class="col-md-12" for="example-text"><?php echo get_phrase('Email');?><span class="bg-require">*</span></label>
                                <div class="col-sm-12">
				                    <input name="email" type="text" class="form-control"/ required>
                                </div>
                        </div>

                        <div class="form-group">
                 	        <label class="col-md-12" for="example-text"><?php echo get_phrase('Phone');?><span class="bg-require">*</span></label>
                                <div class="col-sm-12">
				                    <input name="phone" type="text" class="form-control"/ required>
                                </div>
                        </div>

                    <div class="form-group">
                 	        <label class="col-md-12" for="example-text"><?php echo get_phrase('Select Role');?><span class="bg-require">*</span></label>
                        <div class="col-sm-12">
                            <select name="level" class="form-control" required>
                                <option value="1"><?php echo get_phrase('Super Admin');?>
                                <option value="2" selected=""><?php echo get_phrase('Normal User');?>
                             </select>
                        </div>
                    </div>

                        <div class="form-group">
                 	        <label class="col-md-12" for="example-text"><?php echo get_phrase('Password');?><span class="bg-require">*</span></label>
                                <div class="col-sm-12">
				                    <input name="password" type="password" autocomplete="new-password" class="form-control"/ required>
                                </div>
                        </div>

                        <div class="form-group">
                 	        <label class="col-md-12" for="example-text"><?php echo get_phrase('Select Image');?></label>
                                <div class="col-sm-12">
                                <input type='file' class="form-control" name="admin_image" onChange="readURL(this);">
                                <img id="blah" src="<?php echo base_url();?>uploads/user.jpg" alt="default image" height="150" width="150" style="border:1px solid #ccc; margin-top:10px;">
                                </div>
                        </div>

                        <div class="form-group">
                 	        <label class="col-md-12" for="example-text"><?php echo get_phrase('Send Email ?');?></label>
                                <div class="col-sm-12">
                                    <input class="js-switch" name="sendemail" type="checkbox" value="1">
                                </div>
                        </div>

                           <div class="form-group">
                                  <button type="submit" class="btn btn-block btn-info btn-rounded btn-sm "><i class="fa fa-plus"></i>&nbsp;<?php echo get_phrase('Save User');?></button>
							</div>
                <?php echo form_close();?>
                </div>
                </div>
            </div>
		</div>
	</div>

    <!----CREATION FORM ENDS-->

    <div class="col-sm-12">
		<div class="panel panel-info">
            <div class="panel-heading"> <i class="fa fa-list"></i>&nbsp;&nbsp;<?php echo get_phrase('List'); ?></div>
                <div class="panel-body table-responsive">
 					<table id="example23" class="display nowrap" cellspacing="0" width="100%">
				        <thead>
                		<tr>
                    		<th><div>#</div></th>
                    		<th><div><?php echo get_phrase('Status');?></div></th>
                    		<th><div><?php echo get_phrase('Options');?></div></th>
                    		<th><div><?php echo get_phrase('Role');?></div></th>
                    		<th><div><?php echo get_phrase('Name');?></div></th>
                    		<th><div><?php echo get_phrase('Email');?></div></th>
                    		<th><div><?php echo get_phrase('Phone');?></div></th>
						</tr>
					</thead>
                    <tbody>

                <?php $counter = 1;  $get_all_admin_from_model = $this->admin_model->select_all_the_administrator_from_admin_table();
                        foreach ($get_all_admin_from_model as $key => $all_selected_administrator):?>
                        <tr>
                            <td><?php echo $counter++;?></td>
                            <td>
                            <?php if($all_selected_administrator['admin_id'] != '1'):?>
                                <?php if($all_selected_administrator['status'] == '1'):?>
                                    <span class="btn btn-success btn-sm btn-rounded" title="Click here to Inactive" onclick="status_modal('<?php echo base_url();?>admin/newAdministrator/status/<?php echo $all_selected_administrator['admin_id'];?>');">Active</span>
                                <?php else:?>
                                    <span class="btn btn-danger btn-sm btn-rounded" title="Click here to Active" onclick="status_modal('<?php echo base_url();?>admin/newAdministrator/status/<?php echo $all_selected_administrator['admin_id'];?>');">Inactive</span>
                                <?php endif;?>
                            <?php endif;?>
                            </td>
                            <td>
                            <?php if($all_selected_administrator['admin_id'] != '1'):?>
                                <?php if (has_action('users', 'new_user', 'assign_role')): ?>
                                <a onclick="showAjaxModal('<?php echo base_url();?>modal/popup/assign_role_for_admin/<?php echo $all_selected_administrator['admin_id'];?>')" class="btn btn-primary btn-rounded btn-xs">Assign Role <i class="fa fa-edit"></i></a>
                                <?php endif; ?>
                                <?php if (has_action('users', 'new_user', 'edit')): ?>
                                <a onclick="showAjaxModal('<?php echo base_url();?>modal/popup/editAdministrator/<?php echo $all_selected_administrator['admin_id'];?>')" class="btn btn-info btn-rounded btn-xs">Edit <i class="fa fa-edit"></i></a>
                                <?php endif; ?>
                                <?php if (has_action('users', 'new_user', 'delete')): ?>
                                <a onclick="confirm_modal('<?php echo base_url();?>admin/newAdministrator/delete/<?php echo $all_selected_administrator['admin_id'];?>')" class="btn btn-danger btn-circle btn-xs" style="color:white"><i class="fa fa-times"></i></a>
                                <?php endif; ?>
                            <?php endif;?>
                            </td>
                            <td><?php echo ($all_selected_administrator['level'] == '1') ? get_phrase('Super Admin') : get_phrase('Normal User');?></td>
                            <td><?php echo $all_selected_administrator['name'];?></td>
							<td><?php echo $all_selected_administrator['email'];?></td>
							<td><?php echo $all_selected_administrator['phone'];?></td>
                        </tr>
                <?php endforeach;?>

                    </tbody>
                </table>
			</div>
		</div>
	</div>
</div>
<!----TABLE LISTING ENDS--->
