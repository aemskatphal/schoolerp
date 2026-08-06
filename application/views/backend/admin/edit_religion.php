<?php
$religion = $this->db->get_where('religion', array('religion_id' => $param2))->result_array();
foreach($religion as $row):?>
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-info">
            <div class="panel-heading"><i class="fa fa-edit"></i>&nbsp;&nbsp;Edit Religion</div>
            <div class="panel-body table-responsive">
                <?php echo form_open(base_url() . 'admin/religion/update/'. $param2 , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                <div class="form-group">
                    <label class="col-md-12" for="example-text">Religion Name<span style="color:red">*</span></label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" value="<?php echo $row['religion_name'];?>" name="re_name" required>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-info btn-sm btn-block btn-rounded"><i class="fa fa-edit"></i>&nbsp;&nbsp;Update Religion</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php endforeach;?>
