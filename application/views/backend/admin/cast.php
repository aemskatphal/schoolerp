<div class="row">
    <?php if (has_action('masters', 'cast', 'create')): ?>
    <div class="col-sm-5">
        <div class="panel panel-info">
            <div class="panel-heading"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Cast</div>
            <div class="panel-body table-responsive">
                <?php echo form_open(base_url() . 'admin/caste/insert', array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                <div class="form-group">
                    <label class="col-md-12" for="example-text">Religion<span style="color:red">*</span></label>
                    <div class="col-sm-12">
                        <select name="re_id" id="re_id" class="form-control select2" required>
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
                    <label class="col-md-12" for="example-text">Category<span style="color:red">*</span></label>
                    <div class="col-sm-12">
                        <select name="cat_id" id="cat_id" class="form-control select2" required>
                            <option value="">Select Category</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12" for="example-text">Cast Name<span style="color:red">*</span></label>
                    <div class="col-sm-12">
                        <input name="cast_name" type="text" class="form-control" required>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-info btn-sm btn-block btn-rounded"><i class="fa fa-plus"></i>&nbsp;&nbsp;Save Cast</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <div class="col-sm-7">
        <div class="panel panel-info">
            <div class="panel-heading"><i class="fa fa-list"></i>&nbsp;&nbsp;List Cast</div>
            <div class="panel-wrapper collapse in" aria-expanded="true">
                <div class="panel-body table-responsive">
                    <table id="example23" class="display nowrap" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th><div>#</div></th>
                                <th><div>Religion</div></th>
                                <th><div>Category</div></th>
                                <th><div>Cast</div></th>
                                <th><div>Date</div></th>
                                <th><div>Options</div></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $counter = 1;
                            $casts = $this->db->get('cast')->result_array();
                            foreach($casts as $row):
                                $religion = $this->db->get_where('religion', array('religion_id' => $row['re_id']))->row();
                                $category = $this->db->get_where('category', array('category_id' => $row['cat_id']))->row();
                                $religion_name = $religion ? $religion->religion_name : '';
                                $category_name = $category ? $category->cat_name : '';
                            ?>
                            <tr>
                                <td><?php echo $counter++;?></td>
                                <td><?php echo $religion_name;?></td>
                                <td><?php echo $category_name;?></td>
                                <td><?php echo $row['cast_name'];?></td>
                                <td><?php echo date('d-m-Y', strtotime($row['created_at']));?></td>
                                <td>
                                    <?php if (has_action('masters', 'cast', 'edit')): ?>
                                    <a onclick="showAjaxModal('<?php echo base_url();?>modal/popup/edit_cast/<?php echo $row['cast_id'];?>');" class="btn btn-info btn-circle btn-xs"><i class="fa fa-edit"></i></a>
                                    <?php endif; ?>
                                    <?php if (has_action('masters', 'cast', 'delete')): ?>
                                    <a href="#" onclick="confirm_modal('<?php echo base_url();?>admin/caste/delete/<?php echo $row['cast_id'];?>');" class="btn btn-danger btn-circle btn-xs" style="color:white"><i class="fa fa-times"></i></a>
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

<script>
$(document).ready(function(){
    $(document).on('change', '#re_id', function(){
        var re_id = $(this).val();
        if(re_id != ''){
            $.ajax({
                url: '<?php echo base_url();?>admin/get_religion_category',
                type: 'POST',
                data: {re_id: re_id},
                success: function(response){
                    $('#cat_id').html(response);
                }
            });
        } else {
            $('#cat_id').html('<option value="">Select Category</option>');
        }
    });
});
</script>
