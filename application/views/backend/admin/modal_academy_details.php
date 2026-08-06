<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$academy_id = $this->input->post('academy_id');
$year = $this->input->post('year');

$academy = null;
if(!empty($academy_id) && $academy_id != '0'){
    $academy = $this->db->get_where('academy', array('academy_id' => $academy_id))->row_array();
}
$student_counts = $this->academy_model->getStudentsCountByClassForAcademy($academy_id, $year);
?>
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-info">
            <div class="panel-heading">&nbsp;Academy Details</div>
            <div class="panel-body table-responsive">
                <?php if($academy): ?>
                <table class="table table-bordered" style="margin-bottom:15px;">
                    <tr>
                        <th width="30%">Academy Name</th>
                        <td><?php echo html_escape($academy['academy_name']); ?></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><?php echo html_escape($academy['email']); ?></td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            <?php if($academy['status'] == '1'): ?>
                                <span class="label label-success">Active</span>
                            <?php else: ?>
                                <span class="label label-danger">Inactive</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Academic Year</th>
                        <td><?php echo html_escape($year); ?></td>
                    </tr>
                </table>
                <?php endif; ?>
                <table class="table display nowrap table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Class</th>
                            <th class="bg-primary">Total</th>
                            <th class="bg-success">Male</th>
                            <th class="bg-warning">Female</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($student_counts['classes'] as $row): ?>
                        <tr>
                            <td><?php echo html_escape($row['class_name']); ?></td>
                            <td><?php echo $row['total']; ?></td>
                            <td><?php echo $row['male']; ?></td>
                            <td><?php echo $row['female']; ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td><b>Total</b></td>
                            <td><b><?php echo $student_counts['grand_total']; ?></b></td>
                            <td><b><?php echo $student_counts['grand_male']; ?></b></td>
                            <td><b><?php echo $student_counts['grand_female']; ?></b></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
