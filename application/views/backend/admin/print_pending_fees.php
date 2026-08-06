<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Pending Fees Report</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; font-size: 12px; padding: 5mm; }
        .report-header { text-align: center; margin-bottom: 8px; border-bottom: 2px solid #000; padding-bottom: 5px; }
        .report-header h2 { font-size: 16px; margin-bottom: 2px; }
        .report-header p { font-size: 11px; color: #333; }
        .report-info { display: flex; justify-content: space-between; margin-bottom: 8px; font-size: 11px; }
        .report-info span { margin-right: 15px; }
        table.report-table { width: 100%; border-collapse: collapse; font-size: 11px; }
        table.report-table th { background-color: #333; color: #fff; padding: 4px 5px; text-align: center; border: 1px solid #333; font-size: 10px; }
        table.report-table td { padding: 3px 5px; border: 1px solid #ccc; text-align: center; }
        table.report-table tr:nth-child(even) { background-color: #f5f5f5; }
        table.report-table .total-row { background-color: #e8e8e8; font-weight: bold; }
        table.report-table .amount { text-align: right; }
        .status-active { color: green; font-weight: bold; }
        .status-inactive { color: red; font-weight: bold; }
        .status-outofschool { color: #d4a017; font-weight: bold; }
        @media print {
            body { padding: 5mm; }
            .no-print { display: none; }
        }
    </style>
</head>
<body>
    <div class="no-print" style="text-align:center;margin-bottom:10px;">
        <button onclick="window.print();" style="padding:8px 20px;background:#333;color:#fff;border:none;cursor:pointer;font-size:13px;border-radius:4px;">Print Report</button>
    </div>

    <div class="report-header">
        <?php include 'report_letterhead.php'; ?>
        <h3 style="margin:5px 0 2px 0;">Students Pending Fees Report</h3>
    </div>

    <div class="report-info">
        <div>
            <span><strong>Academic Year:</strong> <?php echo $ad_year;?></span>
            <span><strong>Standard:</strong> <?php echo $class_name;?></span>
            <?php if(!empty($section_name)): ?>
                <span><strong>Division:</strong> <?php echo $section_name;?></span>
            <?php endif; ?>
            <?php if(!empty($academy_name)): ?>
                <span><strong>Academy:</strong> <?php echo $academy_name;?></span>
            <?php endif; ?>
            <?php if($status != 'all'): ?>
                <span><strong>Status:</strong> <?php echo $status_label;?></span>
            <?php endif; ?>
        </div>
        <div>
            <span><strong>Date:</strong> <?php echo date('d-m-Y');?></span>
        </div>
    </div>

    <table class="report-table">
        <thead>
            <tr>
                <th>Sr.No.</th>
                <th>Regi. No.</th>
                <th>Student Full Name</th>
                <th>Mobile No</th>
                <th>Status</th>
                <th>Last Paid</th>
                <th>Pending</th>
                <th>Current Fee</th>
                <th>Total Fees</th>
                <th>Paid Fees</th>
                <th>Total Due</th>
            </tr>
        </thead>
        <tbody>
            <?php if(!empty($students)): ?>
                <?php $i = 1; $g_pending = 0; $g_current = 0; $g_total = 0; $g_paid = 0; $g_due = 0; foreach($students as $std): ?>
                    <?php $pending = intval($std['pending_fees']); $current = intval($std['current_fees']); $total = intval($std['total_fees']); $paid = intval($std['paid_fees']); $due = intval($std['total_due']); $g_pending += $pending; $g_current += $current; $g_total += $total; $g_paid += $paid; $g_due += $due; ?>
                    <tr>
                        <td><?php echo $i++;?></td>
                        <td><?php echo !empty($std['gen_reg_no']) ? $std['gen_reg_no'] : '-';?></td>
                        <td><?php echo $std['name'];?></td>
                        <td><?php echo !empty($std['phone']) ? $std['phone'] : '-';?></td>
                        <td>
                            <?php if($std['status'] == 0): ?>
                                <span class="status-active">Active</span>
                            <?php elseif($std['status'] == 1): ?>
                                <span class="status-inactive">Inactive</span>
                            <?php else: ?>
                                <span class="status-outofschool">Out Of School</span>
                            <?php endif; ?>
                        </td>
                        <td><?php echo $std['last_paid'];?></td>
                        <td class="amount"><?php echo number_format($pending, 0, '.', ',');?></td>
                        <td class="amount"><?php echo number_format($current, 0, '.', ',');?></td>
                        <td class="amount"><?php echo number_format($total, 0, '.', ',');?></td>
                        <td class="amount"><?php echo number_format($paid, 0, '.', ',');?></td>
                        <td class="amount"><?php echo number_format($due, 0, '.', ',');?></td>
                    </tr>
                <?php endforeach; ?>
                <tr class="total-row">
                    <td colspan="6" style="text-align:right;"><strong>Grand Total</strong></td>
                    <td class="amount"><strong><?php echo number_format($g_pending, 0, '.', ',');?></strong></td>
                    <td class="amount"><strong><?php echo number_format($g_current, 0, '.', ',');?></strong></td>
                    <td class="amount"><strong><?php echo number_format($g_total, 0, '.', ',');?></strong></td>
                    <td class="amount"><strong><?php echo number_format($g_paid, 0, '.', ',');?></strong></td>
                    <td class="amount"><strong><?php echo number_format($g_due, 0, '.', ',');?></strong></td>
                </tr>
            <?php else: ?>
                <tr><td colspan="11" style="text-align:center;padding:15px;">No pending fees found for the selected criteria.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
