<div class="row">
    <?php if (has_action('students', 'board', 'create')): ?>
    <div class="col-sm-5">
        <div class="panel panel-info">
            <div class="panel-heading"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Board</div>
            <div class="panel-wrapper collapse in" aria-expanded="true">
                <div class="panel-body table-responsive">
                    <?php echo form_open(base_url().'admin/board/create', array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top')); ?>
                    <div class="form-group">
                        <label class="col-md-12" for="example-text">Name<span class="bg-require">*</span></label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" name="board_name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-info btn-block btn-rounded btn-sm"><i class="fa fa-book"></i>&nbsp;Add Board</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <div class="col-sm-7">
        <div class="panel panel-info">
            <div class="panel-heading"><i class="fa fa-plus"></i>&nbsp;&nbsp;List Boards</div>
            <div class="panel-wrapper collapse in" aria-expanded="true">
                <div class="panel-body table-responsive">
                    <table id="example23" class="display nowrap" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th><div>#</div></th>
                                <th><div>Name</div></th>
                                <th><div>Options</div></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $boards = $this->board_model->getAllBoard();
                            $count = 1;
                            foreach($boards as $row):
                            ?>
                            <tr>
                                <td><?php echo $count++; ?></td>
                                <td><?php echo $row['board_name']; ?></td>
                                <td>
                                    <?php if (has_action('students', 'board', 'edit')): ?>
                                    <a onclick="showAjaxModal('<?php echo base_url();?>modal/popup/edit_board/<?php echo $row['board_id']; ?>');"><button type="button" class="btn btn-info btn-rounded btn-sm"><i class="fa fa-pencil"></i></button></a>
                                    <?php endif; ?>
                                    <?php if (has_action('students', 'board', 'delete')): ?>
                                    <a href="#" onclick="confirm_modal('<?php echo base_url();?>admin/board/delete/<?php echo $row['board_id']; ?>');"><button type="button" class="btn btn-danger btn-rounded btn-sm"><i class="fa fa-times"></i></button></a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
