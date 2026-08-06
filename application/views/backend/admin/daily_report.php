<style type="text/css">
    .white-box .daily {
        max-height: 515px;
        overflow: auto;
    }

    .white-box {
        padding: 10px;
    }

    .white-box .box-title {
        font-size: 14px;
        text-align: center;
    }

    .section-title {
        font-style: italic;
    }

    .p-head {
        padding: 5px 0px;
    }

    .p-head p {
        width: 100%;
        text-align: justify;
        padding: 5px;
        color: #000;
        font-size: 17px;
        text-transform: capitalize;
        margin: 0;
    }

    #dailyreportPrint .table>tbody>tr>td,
    .table>tbody>tr>th,
    .table>tfoot>tr>td,
    .table>tfoot>tr>th,
    .table>thead>tr>td,
    .table>thead>tr>th {
        padding: 7px 8px;
        color: #00357d;
    }

    .white-box.b-info {
        border-left: 4px solid #46b8da;
    }

    .white-box.b-danger {
        border-left: 4px solid #d9534f;
    }

    .white-box.b-success {
        border-left: 4px solid #5cb85c;
    }
</style>

<div id="dailyreportPrint" class="daily_report_print">
    <div class="p-head">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <p class="text-center"><?php echo $selected_admin; ?>&nbsp;-&nbsp;<b><?php echo date('d-m-Y', strtotime($from)); ?></b>&nbsp;&nbsp;To&nbsp;&nbsp;<b><?php echo date('d-m-Y', strtotime($to)); ?></b></p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="white-box b-info">
                <h3 class="box-title m-b-0">Income&nbsp;-&nbsp;<strong>Rs&nbsp;<?php echo number_format($income_total); ?></strong></h3>
                <div class="table-responsive table-bordered daily">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Standard</th>
                                <th>Amount</th>
                                <th>Entry User</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(empty($income_rows)): ?>
                                <tr><td colspan="4" class="text-center">No records</td></tr>
                            <?php else: ?>
                                <?php foreach($income_rows as $row): ?>
                                    <tr>
                                        <td><?php echo $row['person_name']; ?></td>
                                        <td><?php echo $row['class_name']; ?></td>
                                        <td><?php echo number_format($row['amount']); ?></td>
                                        <td><?php echo $row['entry_user']; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="white-box b-danger">
                <h3 class="box-title m-b-0">Expence&nbsp;-&nbsp;<strong>Rs&nbsp;<?php echo number_format($expense_total); ?></strong></h3>
                <div class="table-responsive table-bordered daily">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Amount</th>
                                <th>Category</th>
                                <th>Entry User</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(empty($expense_rows)): ?>
                                <tr><td colspan="4" class="text-center">No records</td></tr>
                            <?php else: ?>
                                <?php foreach($expense_rows as $row): ?>
                                    <tr>
                                        <td><?php echo $row['person_name']; ?></td>
                                        <td><?php echo number_format($row['amount']); ?></td>
                                        <td><?php echo $row['category_name']; ?></td>
                                        <td><?php echo $row['entry_user']; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="white-box b-success">
                <h3 class="box-title m-b-0">Student Admission&nbsp;-&nbsp;<strong><?php echo count($admissions); ?></strong></h3>
                <div class="table-responsive table-bordered daily">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Ad Year</th>
                                <th>Name</th>
                                <th>Standard</th>
                                <th>Entry User</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(empty($admissions)): ?>
                                <tr><td colspan="5" class="text-center">No records</td></tr>
                            <?php else: ?>
                                <?php $i = 0; foreach($admissions as $row): $i++; ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $row['ad_year']; ?></td>
                                        <td><?php echo $row['name']; ?></td>
                                        <td><?php echo $row['class_name']; ?></td>
                                        <td><?php echo $row['entry_user']; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="white-box">
                <h3 class="box-title m-b-0 text-dark">Leaving Certificate&nbsp;-<strong>&nbsp;<?php echo count($lc_docs); ?></strong></h3>
                <div class="table-responsive table-bordered daily">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Standard</th>
                                <th>Entry User</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(empty($lc_docs)): ?>
                                <tr><td colspan="4" class="text-center">No records</td></tr>
                            <?php else: ?>
                                <?php $i = 0; foreach($lc_docs as $row): $i++; ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $row['student_name']; ?></td>
                                        <td><?php echo $row['class_name']; ?></td>
                                        <td><?php echo $row['entry_user']; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="white-box">
                <h3 class="box-title m-b-0 text-dark">Bonafide Certificate&nbsp;-<strong>&nbsp;<?php echo count($bonafide_docs); ?></strong></h3>
                <div class="table-responsive table-bordered daily">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Standard</th>
                                <th>Entry User</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(empty($bonafide_docs)): ?>
                                <tr><td colspan="4" class="text-center">No records</td></tr>
                            <?php else: ?>
                                <?php $i = 0; foreach($bonafide_docs as $row): $i++; ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $row['student_name']; ?></td>
                                        <td><?php echo $row['class_name']; ?></td>
                                        <td><?php echo $row['entry_user']; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="white-box">
                <h3 class="box-title m-b-0 text-dark">Form 15-A&nbsp;-<strong>&nbsp;<?php echo count($form15_docs); ?></strong></h3>
                <div class="table-responsive table-bordered daily">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Standard</th>
                                <th>Entry User</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(empty($form15_docs)): ?>
                                <tr><td colspan="4" class="text-center">No records</td></tr>
                            <?php else: ?>
                                <?php $i = 0; foreach($form15_docs as $row): $i++; ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $row['student_name']; ?></td>
                                        <td><?php echo $row['class_name']; ?></td>
                                        <td><?php echo $row['entry_user']; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="white-box">
                <h3 class="box-title m-b-0 text-dark">Covering Letter&nbsp;-<strong>&nbsp;<?php echo count($covering_docs); ?></strong></h3>
                <div class="table-responsive table-bordered daily">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Standard</th>
                                <th>Entry User</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(empty($covering_docs)): ?>
                                <tr><td colspan="4" class="text-center">No records</td></tr>
                            <?php else: ?>
                                <?php $i = 0; foreach($covering_docs as $row): $i++; ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $row['student_name']; ?></td>
                                        <td><?php echo $row['class_name']; ?></td>
                                        <td><?php echo $row['entry_user']; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="white-box">
                <h3 class="box-title m-b-0 text-dark">Character Certificate&nbsp;-<strong>&nbsp;<?php echo count($character_docs); ?></strong></h3>
                <div class="table-responsive table-bordered daily">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Standard</th>
                                <th>Entry User</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(empty($character_docs)): ?>
                                <tr><td colspan="4" class="text-center">No records</td></tr>
                            <?php else: ?>
                                <?php $i = 0; foreach($character_docs as $row): $i++; ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $row['student_name']; ?></td>
                                        <td><?php echo $row['class_name']; ?></td>
                                        <td><?php echo $row['entry_user']; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="white-box">
                <h3 class="box-title m-b-0 text-dark">ID Card&nbsp;-<strong>&nbsp;<?php echo count($idcard_docs); ?></strong></h3>
                <div class="table-responsive table-bordered daily">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Standard</th>
                                <th>Entry User</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(empty($idcard_docs)): ?>
                                <tr><td colspan="4" class="text-center">No records</td></tr>
                            <?php else: ?>
                                <?php $i = 0; foreach($idcard_docs as $row): $i++; ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $row['student_name']; ?></td>
                                        <td><?php echo $row['class_name']; ?></td>
                                        <td><?php echo $row['entry_user']; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="white-box">
                <h3 class="box-title m-b-0 text-dark">75% Attendance&nbsp;-<strong>&nbsp;<?php echo count($attendance_docs); ?></strong></h3>
                <div class="table-responsive table-bordered daily">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Standard</th>
                                <th>Entry User</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(empty($attendance_docs)): ?>
                                <tr><td colspan="4" class="text-center">No records</td></tr>
                            <?php else: ?>
                                <?php $i = 0; foreach($attendance_docs as $row): $i++; ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $row['student_name']; ?></td>
                                        <td><?php echo $row['class_name']; ?></td>
                                        <td><?php echo $row['entry_user']; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<footer class="panel-footer">
    <div class="text-right mr-lg">
        <a href="javascript:void(0);" id="print_button" class="btn btn-default">
            <i class="fa fa-print"></i> Print
        </a>
    </div>
</footer>

<script>
    $("#print_button").click(function() {
        $("#dailyreportPrint").printArea();
    });
</script>
