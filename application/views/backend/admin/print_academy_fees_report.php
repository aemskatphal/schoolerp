<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Academy Wise Fees Report</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; font-size: 12px; padding: 5mm; }
        .report-header { text-align: center; margin-bottom: 8px; border-bottom: 2px solid #000; padding-bottom: 5px; }
        .report-header h2 { font-size: 16px; margin-bottom: 2px; }
        .report-header p { font-size: 11px; color: #333; }
        .report-info { display: flex; justify-content: space-between; margin-bottom: 8px; font-size: 11px; }
        table.report-table { width: 100%; border-collapse: collapse; font-size: 11px; }
        table.report-table th { background-color: #333; color: #fff; padding: 4px 5px; text-align: center; border: 1px solid #333; }
        table.report-table td { padding: 3px 5px; border: 1px solid #ccc; text-align: center; }
        table.report-table tr:nth-child(even) { background-color: #f5f5f5; }
        table.report-table .total-row { background-color: #e8e8e8; font-weight: bold; }
        table.report-table .amount { text-align: right; }
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
        <h3>Academy Wise Fees Report</h3>
    </div>

    <div class="report-info">
        <div>
            <span><strong>Academic Year:</strong> <?php echo $ad_year;?></span>
        </div>
        <div>
            <span><strong>Date:</strong> <?php echo date('d-m-Y');?></span>
        </div>
    </div>

    <table class="report-table">
        <thead>
            <tr>
                <th>Sr. No.</th>
                <th>Academy Name</th>
                <th>Total Students</th>
                <th>Total Fees</th>
                <th>Discount</th>
                <th>Online Paid</th>
                <th>Cash Paid</th>
                <th>Due Fees</th>
                <th>% Collected</th>
            </tr>
        </thead>
        <tbody>
            <?php if(!empty($academy_data)): ?>
                <?php $i = 1; $g_students = 0; $g_fees = 0; $g_discount = 0; $g_online = 0; $g_cash = 0; $g_due = 0; foreach($academy_data as $row): ?>
                    <?php
                    $g_students += $row['total_students'];
                    $g_fees += $row['total_fees'];
                    $g_discount += $row['total_discount'];
                    $g_online += $row['online_paid'];
                    $g_cash += $row['cash_paid'];
                    $g_due += $row['total_due'];
                    $total_paid = $row['online_paid'] + $row['cash_paid'];
                    $pct = $row['total_fees'] > 0 ? round(($total_paid / $row['total_fees']) * 100, 1) : 0;
                    ?>
                    <tr>
                        <td><?php echo $i++;?></td>
                        <td><?php echo $row['academy_name'];?></td>
                        <td><?php echo $row['total_students'];?></td>
                        <td class="amount"><?php echo number_format($row['total_fees'], 0, '.', ',');?></td>
                        <td class="amount"><?php echo number_format($row['total_discount'], 0, '.', ',');?></td>
                        <td class="amount"><?php echo number_format($row['online_paid'], 0, '.', ',');?></td>
                        <td class="amount"><?php echo number_format($row['cash_paid'], 0, '.', ',');?></td>
                        <td class="amount"><?php echo number_format($row['total_due'], 0, '.', ',');?></td>
                        <td><?php echo $pct;?>%</td>
                    </tr>
                <?php endforeach; ?>
                <?php $g_total_paid = $g_online + $g_cash; $g_pct = $g_fees > 0 ? round(($g_total_paid / $g_fees) * 100, 1) : 0; ?>
                <tr class="total-row">
                    <td colspan="2" style="text-align:right;"><strong>Grand Total</strong></td>
                    <td><strong><?php echo $g_students;?></strong></td>
                    <td class="amount"><strong><?php echo number_format($g_fees, 0, '.', ',');?></strong></td>
                    <td class="amount"><strong><?php echo number_format($g_discount, 0, '.', ',');?></strong></td>
                    <td class="amount"><strong><?php echo number_format($g_online, 0, '.', ',');?></strong></td>
                    <td class="amount"><strong><?php echo number_format($g_cash, 0, '.', ',');?></strong></td>
                    <td class="amount"><strong><?php echo number_format($g_due, 0, '.', ',');?></strong></td>
                    <td><strong><?php echo $g_pct;?>%</strong></td>
                </tr>
            <?php else: ?>
                <tr><td colspan="9" style="text-align:center;padding:15px;">No data found for the selected academic year.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
