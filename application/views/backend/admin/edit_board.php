<?php
$board = $this->db->get_where('board', array('board_id' => $param2))->result_array();
foreach($board as $row):
?>
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-info">
            <div class="panel-heading"><i class="fa fa-edit"></i>&nbsp;&nbsp;Edit Board</div>
            <div class="panel-body table-responsive">
                <?php echo form_open(base_url().'admin/board/update/'.$param2, array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top')); ?>
                <div class="form-group">
                    <label class="col-md-12" for="example-text">Board Name<span class="bg-require">*</span></label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" value="<?php echo $row['board_name']; ?>" name="board_name" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-info btn-sm btn-block btn-rounded"><i class="fa fa-edit"></i>&nbsp;&nbsp;Update Board</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>
