<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-info">
            <div class="panel-heading"><i class="fa fa-graduation-cap"></i>&nbsp;&nbsp;Academy Details</div>
            <div class="panel-wrapper collapse in" aria-expanded="true">
                <div class="panel-body">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th style="width:200px;">Academy ID</th>
                            <td><?php echo $academy['academy_id']; ?></td>
                        </tr>
                        <tr>
                            <th>Academy Name</th>
                            <td><?php echo $academy['academy_name']; ?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><?php echo $academy['email']; ?></td>
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
                            <th>QR Code</th>
                            <td>
                                <?php if(!empty($academy['qr_code']) && file_exists('uploads/academy_qr_code/'.$academy['qr_code'])): ?>
                                    <a href="<?php echo base_url();?>uploads/academy_qr_code/<?php echo $academy['qr_code']; ?>" target="_blank"><img src="<?php echo base_url();?>uploads/academy_qr_code/<?php echo $academy['qr_code']; ?>" width="80"></a>
                                <?php else: ?>
                                    <span class="text-muted">No QR Code</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Created At</th>
                            <td><?php echo date('d M, Y h:i A', strtotime($academy['created_at'])); ?></td>
                        </tr>
                    </table>

                    <table class="table display nowrap table-bordered" cellspacing="0" width="100%" style="margin-top:15px;">
                        <thead>
                            <tr>
                                <th>Class</th>
                                <th class="bg-primary" style="color:#fff;">Total</th>
                                <th class="bg-success" style="color:#fff;">Male</th>
                                <th class="bg-warning" style="color:#fff;">Female</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($class_stats as $row): ?>
                            <tr>
                                <td><?php echo html_escape($row['class_name']); ?></td>
                                <td><?php echo $row['total'] > 0 ? $row['total'] : '-'; ?></td>
                                <td><?php echo $row['male'] > 0 ? $row['male'] : '-'; ?></td>
                                <td><?php echo $row['female'] > 0 ? $row['female'] : '-'; ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr style="font-weight:bold;">
                                <td><b>Total</b></td>
                                <td><b><?php echo $total_students; ?></b></td>
                                <td><b><?php echo array_sum(array_column($class_stats, 'male')); ?></b></td>
                                <td><b><?php echo array_sum(array_column($class_stats, 'female')); ?></b></td>
                            </tr>
                        </tfoot>
                    </table>

                    <div class="form-group" style="margin-top:15px;">
                        <a href="<?php echo base_url();?>admin/academy" class="btn btn-default btn-rounded"><i class="fa fa-arrow-left"></i> Back to Academy List</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>