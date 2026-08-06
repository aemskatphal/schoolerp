<?php
$mother_tongue = $this->db->get_where('mother_tongue', array('mother_tongue_id' => $param2))->result_array();
foreach($mother_tongue as $row):?>
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-info">
            <div class="panel-heading"><i class="fa fa-edit"></i>&nbsp;&nbsp;Edit Mother Tongue</div>
            <div class="panel-body table-responsive">
                <?php echo form_open(base_url() . 'admin/mother_tongue/update/'. $param2 , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                <div class="form-group">
                    <label class="col-md-12" for="example-text">Mother Tongue Name<span style="color:red">*</span></label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" value="<?php echo $row['mother_tongue_name'];?>" name="mt_name" required>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-info btn-sm btn-block btn-rounded"><i class="fa fa-edit"></i>&nbsp;&nbsp;Update Mother Tongue</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php endforeach;?>