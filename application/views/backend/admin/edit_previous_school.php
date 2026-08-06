<?php
$previous_school = $this->db->get_where('previous_school', array('previous_school_id' => $param2))->result_array();
foreach($previous_school as $row):?>
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-info">
            <div class="panel-heading"><i class="fa fa-edit"></i>&nbsp;&nbsp;Edit Previous School</div>
            <div class="panel-body table-responsive">
                <?php echo form_open(base_url() . 'admin/previous_school/update/'. $param2 , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="col-md-12">Name Of Previous School<span style="color:red">*</span></label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" value="<?php echo $row['name'];?>" name="name" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Name Of Contact</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" value="<?php echo $row['contactname'];?>" name="contactname">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Email ID</label>
                            <div class="col-sm-12">
                                <input type="email" class="form-control" value="<?php echo $row['email'];?>" name="email">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="col-md-12">UDISE Number</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" value="<?php echo $row['udiseno'];?>" name="udiseno">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Contact Number</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" value="<?php echo $row['phone'];?>" name="phone">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Website</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" value="<?php echo $row['website'];?>" name="website">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="col-md-12">Address</label>
                            <div class="col-sm-12">
                                <textarea class="form-control" name="address" rows="3"><?php echo $row['address'];?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-info btn-sm btn-block btn-rounded"><i class="fa fa-edit"></i>&nbsp;&nbsp;Update Previous School</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php endforeach;?>