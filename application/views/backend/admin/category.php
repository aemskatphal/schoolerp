<div class="row">
    <?php if (has_action('masters', 'category', 'create')): ?>
    <div class="col-sm-5">
        <div class="panel panel-info">
            <div class="panel-heading"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Category</div>
            <div class="panel-body table-responsive">
                <?php echo form_open(base_url() . 'admin/category/insert', array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                <div class="form-group">
                    <label class="col-md-12" for="example-text">Religion<span style="color:red">*</span></label>
                    <div class="col-sm-12">
                        <select name="re_id" class="form-control select2" required>
                            <option value="">Select Religion</option>
                            <?php
                            $religions = $this->db->get('religion')->result_array();
                            foreach($religions as $row):?>
                            <option value="<?php echo $row['religion_id'];?>"><?php echo $row['religion_name'];?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12" for="example-text">Category Name<span style="color:red">*</span></label>
                    <div class="col-sm-12">
                        <input name="cat_name" type="text" class="form-control" required>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-info btn-sm btn-block btn-rounded"><i class="fa fa-plus"></i>&nbsp;&nbsp;Save Category</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <div class="col-sm-7">
        <div class="panel panel-info">
            <div class="panel-heading"><i class="fa fa-list"></i>&nbsp;&nbsp;List Category</div>
            <div class="panel-wrapper collapse in" aria-expanded="true">
                <div class="panel-body table-responsive">
                    <table id="example23" class="display nowrap" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th><div>#</div></th>
                                <th><div>Religion</div></th>
                                <th><div>Category</div></th>
                                <th><div>Date</div></th>
                                <th><div>Options</div></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $counter = 1;
                            $categories = $this->db->get('category')->result_array();
                            foreach($categories as $row):
                                $religion_name = $this->db->get_where('religion', array('religion_id' => $row['re_id']))->row()->religion_name;
                            ?>
                            <tr>
                                <td><?php echo $counter++;?></td>
                                <td><?php echo $religion_name;?></td>
                                <td><?php echo $row['cat_name'];?></td>
                                <td><?php echo date('d-m-Y', strtotime($row['created_at']));?></td>
                                <td>
                                    <?php if (has_action('masters', 'category', 'edit')): ?>
                                    <a onclick="showAjaxModal('<?php echo base_url();?>modal/popup/edit_category/<?php echo $row['category_id'];?>');" class="btn btn-info btn-circle btn-xs"><i class="fa fa-edit"></i></a>
                                    <?php endif; ?>
                                    <?php if (has_action('masters', 'category', 'delete')): ?>
                                    <a href="#" onclick="confirm_modal('<?php echo base_url();?>admin/category/delete/<?php echo $row['category_id'];?>');" class="btn btn-danger btn-circle btn-xs" style="color:white"><i class="fa fa-times"></i></a>
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
