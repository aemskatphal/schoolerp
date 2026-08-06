<?php
$row = $this->db->get_where('fees_head', array('fees_head_id' => $param2))->row_array();
?>
<div class="panel panel-info">
    <div class="panel-heading"><i class="fa fa-list"></i>&nbsp;&nbsp;Edit Fees Head</div>
    <div class="panel-body">
        <?php echo form_open(base_url() . 'admin/fees_head/update/'.$row['fees_head_id'], array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
        <div class="form-group">
            <label class="col-md-12">Title<span style="color:red">*</span></label>
            <div class="col-sm-12">
                <input name="fh_title" type="text" class="form-control" value="<?php echo $row['title'];?>" required>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-12">Amount<span style="color:red">*</span></label>
            <div class="col-sm-12">
                <input name="fh_amt" type="number" class="form-control" value="<?php echo $row['amount'];?>" required>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-12">
                <button type="submit" class="btn btn-info btn-block btn-rounded btn-sm"><i class="fa fa-plus"></i>&nbsp;&nbsp;Update Fees Head</button>
            </div>
        </div>
        <?php echo form_close();?>
    </div>
</div>
