<div class="row">
    <?php if (has_action('students', 'standard', 'create')): ?>
    <div class="col-sm-5">
        <div class="panel panel-info">
            <div class="panel-heading"> <i class="fa fa-plus"></i>&nbsp;&nbsp;Add Standard</div>
            <div class="panel-wrapper collapse in" aria-expanded="true">
                <div class="panel-body table-responsive">

                    <?php echo form_open(base_url() . 'admin/classes/create', array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top')); ?>
                    <div class="form-group">
                        <label class="col-md-12" for="example-text">Standard (in Words)<span class="bg-require">*</span></label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" name="name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12" for="example-text">Standard (in Numeric)<span class="bg-require">*</span></label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" name="name_numeric" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12" for="example-text">Teacher</label>
                        <div class="col-sm-12">
                            <select name="teacher_id" class="form-control select2">
                                <option value="">Select Teacher</option>
                                <?php
                                $teacher = $this->db->get('teacher')->result_array();
                                foreach($teacher as $row):
                                ?>
                                <option value="<?php echo $row['teacher_id']; ?>"><?php echo $row['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-info btn-block btn-rounded btn-sm"><i class="fa fa-book"></i>&nbsp;Add Standard</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <!----CREATION FORM ENDS---->

    <div class="col-sm-7">
        <div class="panel panel-info">
            <div class="panel-heading"> <i class="fa fa-plus"></i>&nbsp;&nbsp;List Standard</div>
            <div class="panel-wrapper collapse in" aria-expanded="true">
                <div class="panel-body table-responsive">
                    <table id="example23" class="display nowrap" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th><div>#</div></th>
                                <th><div>Standard</div></th>
                                <th><div>Standard(numeric)</div></th>
                                <th><div>Teacher</div></th>
                                <th><div>Options</div></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $counter = 1;
                            $classes = $this->db->order_by('sort_order', 'ASC')->get('class')->result_array();
                            foreach($classes as $row):
                            ?>
                            <tr>
                                <td><?php echo $counter++; ?></td>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['name_numeric']; ?></td>
                                <td><?php echo $this->crud_model->get_type_name_by_id('teacher', $row['teacher_id']); ?></td>
                                <td>
                                    <?php if (has_action('students', 'standard', 'edit')): ?>
                                    <a href="#" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/edit_class/<?php echo $row['class_id'];?>');"><button type="button" class="btn btn-info btn-rounded btn-sm"><i class="fa fa-pencil"></i></button></a>
                                    <?php endif; ?>
                                    <?php if (has_action('students', 'standard', 'delete')): ?>
                                    <a href="#" onclick="confirm_modal('<?php echo base_url();?>admin/classes/delete/<?php echo $row['class_id'];?>');"><button type="button" class="btn btn-danger btn-rounded btn-sm"><i class="fa fa-times"></i></button></a>
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
<!----TABLE LISTING ENDS--->
