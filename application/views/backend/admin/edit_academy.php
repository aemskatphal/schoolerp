<?php
$academy = $this->db->get_where('academy', array('academy_id' => $param2))->result_array();
foreach($academy as $row):
?>
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-info">
            <div class="panel-heading"><i class="fa fa-edit"></i>&nbsp;&nbsp;Edit Academy</div>
            <div class="panel-body table-responsive">
                <?php echo form_open(base_url().'admin/academy/update/'.$param2, array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top')); ?>
                <div class="form-group">
                    <label class="col-md-12" for="example-text">Academy Name<span class="bg-require">*</span></label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" value="<?php echo $row['academy_name']; ?>" name="academy_name" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12" for="example-text">Email<span class="bg-require">*</span></label>
                    <div class="col-sm-12">
                        <input type="email" class="form-control" value="<?php echo $row['email']; ?>" name="email" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12" for="example-text">Password (leave blank to keep current)</label>
                    <div class="col-sm-12">
                        <input type="password" class="form-control" name="password" value="" autocomplete="new-password">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-info btn-sm btn-block btn-rounded"><i class="fa fa-edit"></i>&nbsp;&nbsp;Update Academy</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>
