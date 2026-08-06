<?php
$category = $this->db->get_where('category', array('category_id' => $param2))->result_array();
foreach($category as $row):?>
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-info">
            <div class="panel-heading"><i class="fa fa-edit"></i>&nbsp;&nbsp;Edit Category</div>
            <div class="panel-body table-responsive">
                <?php echo form_open(base_url() . 'admin/category/update/'. $param2 , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                <div class="form-group">
                    <label class="col-md-12" for="example-text">Religion<span style="color:red">*</span></label>
                    <div class="col-sm-12">
                        <select name="re_id" class="form-control select2" required>
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
                    <label class="col-md-12" for="example-text">Category Name<span style="color:red">*</span></label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" value="<?php echo $row['cat_name'];?>" name="cat_name" required>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-info btn-sm btn-block btn-rounded"><i class="fa fa-edit"></i>&nbsp;&nbsp;Update Category</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php endforeach;?>
