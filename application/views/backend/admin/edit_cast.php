<?php
$cast = $this->db->get_where('cast', array('cast_id' => $param2))->result_array();
foreach($cast as $row):?>
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-info">
            <div class="panel-heading"><i class="fa fa-edit"></i>&nbsp;&nbsp;Edit Cast</div>
            <div class="panel-body table-responsive">
                <?php echo form_open(base_url() . 'admin/caste/update/'. $param2 , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                <div class="form-group">
                    <label class="col-md-12" for="example-text">Religion<span style="color:red">*</span></label>
                    <div class="col-sm-12">
                        <select name="re_id" id="edit_re_id" class="form-control select2" required>
                            <option value="">Select Religion</option>
                            <?php
                            $religions = $this->db->get('religion')->result_array();
                            foreach($religions as $rel):?>
                            <option value="<?php echo $rel['religion_id'];?>"<?php if($row['re_id'] == $rel['religion_id']) echo ' selected'; ?>><?php echo $rel['religion_name'];?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12" for="example-text">Category<span style="color:red">*</span></label>
                    <div class="col-sm-12">
                        <select name="cat_id" id="edit_cat_id" class="form-control select2" required>
                            <option value="">Select Category</option>
                            <?php
                            $categories = $this->db->get_where('category', array('re_id' => $row['re_id']))->result_array();
                            foreach($categories as $cat):?>
                            <option value="<?php echo $cat['category_id'];?>"<?php if($row['cat_id'] == $cat['category_id']) echo ' selected'; ?>><?php echo $cat['cat_name'];?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12" for="example-text">Cast Name<span style="color:red">*</span></label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" value="<?php echo $row['cast_name'];?>" name="cast_name" required>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-info btn-sm btn-block btn-rounded"><i class="fa fa-edit"></i>&nbsp;&nbsp;Update Cast</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){
    $(document).on('change', '#edit_re_id', function(){
        var re_id = $(this).val();
        if(re_id != ''){
            $.ajax({
                url: '<?php echo base_url();?>admin/get_religion_category',
                type: 'POST',
                data: {re_id: re_id},
                success: function(response){
                    $('#edit_cat_id').html(response);
                }
            });
        } else {
            $('#edit_cat_id').html('<option value="">Select Category</option>');
        }
    });
});
</script>
<?php endforeach;?>