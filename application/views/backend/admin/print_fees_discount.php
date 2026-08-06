<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Fees Discount Report</title>
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
        <h3>Fees Discount Report</h3>
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
                <th>Sr.No.</th>
                <th>Date</th>
                <th>Standard</th>
                <th>Student Full Name</th>
                <th>Gen.reg.no</th>
                <th>Discount</th>
                <th>Total</th>
                <th>Paid</th>
                <th>Due</th>
            </tr>
        </thead>
        <tbody>
            <?php if(!empty($invoices)): ?>
                <?php $i = 1; $g_discount = 0; $g_total = 0; $g_paid = 0; $g_due = 0; foreach($invoices as $inv): ?>
                    <?php $g_discount += intval($inv['discount']); $g_total += intval($inv['amount']); $g_paid += intval($inv['amount_paid']); $g_due += intval($inv['due']); ?>
                    <tr>
                        <td><?php echo $i++;?></td>
                        <td><?php echo date('d-m-Y', strtotime($inv['creation_timestamp']));?></td>
                        <td><?php echo $inv['class_name'];?></td>
                        <td style="text-align:left;"><?php echo $inv['student_name'];?></td>
                        <td><?php echo !empty($inv['gen_reg_no']) ? $inv['gen_reg_no'] : '-';?></td>
                        <td class="amount"><?php echo number_format($inv['discount']);?></td>
                        <td class="amount"><?php echo number_format($inv['amount']);?></td>
                        <td class="amount"><?php echo number_format($inv['amount_paid']);?></td>
                        <td class="amount"><?php echo number_format($inv['due']);?></td>
                    </tr>
                <?php endforeach; ?>
                <tr class="total-row">
                    <td colspan="5" style="text-align:right;"><strong>Total</strong></td>
                    <td class="amount"><strong><?php echo number_format($g_discount);?></strong></td>
                    <td class="amount"><strong><?php echo number_format($g_total);?></strong></td>
                    <td class="amount"><strong><?php echo number_format($g_paid);?></strong></td>
                    <td class="amount"><strong><?php echo number_format($g_due);?></strong></td>
                </tr>
            <?php else: ?>
                <tr><td colspan="9" style="text-align:center;padding:15px;">No discount records found for the selected academic year.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>