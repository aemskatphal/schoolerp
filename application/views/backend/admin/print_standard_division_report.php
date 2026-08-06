<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Standard & Division Report</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; font-size: 12px; padding: 5mm; }
        .report-header { text-align: center; margin-bottom: 8px; border-bottom: 2px solid #000; padding-bottom: 5px; }
        .report-header h2 { font-size: 16px; margin-bottom: 2px; }
        .report-header p { font-size: 11px; color: #333; }
        .report-info { text-align: center; margin-bottom: 10px; font-size: 13px; font-weight: bold; }
        table.report-table { width: 100%; border-collapse: collapse; font-size: 11px; }
        table.report-table th { background-color: #333; color: #fff; padding: 4px 5px; text-align: center; border: 1px solid #333; font-size: 10px; }
        table.report-table td { padding: 3px 5px; border: 1px solid #ccc; text-align: center; }
        table.report-table tr:nth-child(even) { background-color: #f5f5f5; }
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
        <h3>Standard And Division Wise Student List</h3>
    </div>

    <div class="report-info">
        Standard: <?php echo $class_name;?> | Division: <?php echo $section_name;?><?php if(!empty($ad_year)): ?> | Education Year: <?php echo $ad_year;?><?php endif; ?><?php if(!empty($academy_name)): ?> | Academy: <?php echo $academy_name;?><?php endif; ?><?php if(!empty($status_label)): ?> | Status: <?php echo $status_label;?><?php endif; ?>
    </div>

    <table class="report-table">
        <thead>
            <tr>
                <th>Sr. No.</th>
                <th>Gen. Reg. No.</th>
                <th>Status</th>
                <th>Full Name</th>
            </tr>
        </thead>
        <tbody>
            <?php if(!empty($students)): ?>
                <?php $i = 1; foreach($students as $std): ?>
                    <tr>
                        <td><?php echo $i++;?></td>
                        <td><?php echo !empty($std['gen_reg_no']) ? $std['gen_reg_no'] : '-';?></td>
                        <td>
                            <?php if($std['status'] == 0): ?>
                                <span class="status-active">Active</span>
                            <?php elseif($std['status'] == 1): ?>
                                <span class="status-inactive">Inactive</span>
                            <?php else: ?>
                                <span class="status-outofschool">Out Of School</span>
                            <?php endif; ?>
                        </td>
                        <td style="text-align:left;padding-left:8px;"><?php echo $std['name'];?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="4" style="text-align:center;padding:15px;">No students found for the selected criteria.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>