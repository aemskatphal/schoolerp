<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Expense Category Waise Report - <?php echo $system_name;?></title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; font-size: 12px; color: #333; padding: 5mm; }
        .letterhead { text-align: center; margin-bottom: 10px; position: relative; border-bottom: 2px solid #000; padding-bottom: 8px; }
        .letterhead .school-logo { position: absolute; left: 0; top: 0; height: 70px; }
        .letterhead .tagline { font-size: 9px; font-style: italic; color: #555; margin-bottom: 2px; }
        .letterhead .trust-line { font-size: 10px; font-weight: bold; margin: 2px 0; }
        .letterhead .school-name { font-size: 16px; font-weight: bold; color: #000; margin: 3px 0; letter-spacing: 0.5px; }
        .letterhead .address { font-size: 10px; margin-bottom: 3px; }
        .report-title { text-align: center; font-size: 14px; font-weight: bold; margin: 8px 0; padding: 5px; background: #f0f0f0; border: 1px solid #ccc; }
        .info-row { font-size: 12px; margin: 5px 0; padding: 3px 5px; }
        .info-row strong { display: inline-block; min-width: 200px; }
        table.report-table { width: 100%; border-collapse: collapse; font-size: 11px; margin-top: 8px; }
        table.report-table th { background-color: #333; color: #fff; padding: 5px 6px; text-align: center; border: 1px solid #333; font-size: 10px; }
        table.report-table td { padding: 4px 6px; border: 1px solid #ccc; text-align: left; }
        table.report-table td.date { text-align: center; width: 80px; }
        table.report-table td.receipt { text-align: center; width: 80px; }
        table.report-table td.amount { text-align: right; width: 100px; }
        table.report-table tr:nth-child(even) { background-color: #f9f9f9; }
        .total-row { background-color: #e8e8e8; font-weight: bold; }
        .category-row { background-color: #ddd; }
        .no-print { text-align: center; margin-bottom: 10px; }
        .no-print button { padding: 8px 20px; background: #333; color: #fff; border: none; cursor: pointer; font-size: 13px; border-radius: 4px; }
        @media print { .no-print { display: none; } body { padding: 5mm; } }
    </style>
</head>
<body>
    <div class="no-print">
        <button onclick="window.print();"><i class="fa fa-print"></i> Print Report</button>
    </div>

    <div class="letterhead">
        <?php include 'report_letterhead.php'; ?>
    </div>

    <div class="report-title">Expense Category Waise Report</div>

    <div class="info-row">
        <strong>Category: <?php echo $category_name;?></strong>
        <strong>Between Date: <?php echo date('d/m/Y', strtotime($from_date));?> - <?php echo date('d/m/Y', strtotime($to_date));?></strong>
    </div>

    <table class="report-table">
        <thead>
            <tr>
                <th>Date</th>
                <th>Name</th>
                <th>Particular</th>
                <th>Receipt No.</th>
                <th>Bank Amt.</th>
                <th>Cash Amt.</th>
            </tr>
        </thead>
        <tbody>
            <?php if(!empty($grouped)): ?>
                <?php $is_all = (count($grouped) > 1); foreach($grouped as $cat): ?>
                    <tr class="category-row">
                        <td colspan="6"><strong>Category: <?php echo $cat['name'];?></strong></td>
                    </tr>
                    <?php foreach($cat['rows'] as $e): ?>
                        <tr>
                            <td class="date"><?php echo date('d/m/Y', strtotime($e['date']));?></td>
                            <td><?php echo !empty($e['name']) ? $e['name'] : '-';?></td>
                            <td><?php echo $e['particular'];?></td>
                            <td class="receipt"><?php echo $e['receipt_no'];?></td>
                            <td class="amount"><?php echo number_format($e['bank'], 2);?></td>
                            <td class="amount"><?php echo number_format($e['cash'], 2);?></td>
                        </tr>
                    <?php endforeach; ?>
                    <tr class="total-row">
                        <td colspan="4" style="text-align:right;"><?php echo $is_all ? 'Sub Total (' . $cat['name'] . ')' : 'Total Amount';?></td>
                        <td class="amount"><?php echo number_format($cat['bank'], 2);?></td>
                        <td class="amount"><?php echo number_format($cat['cash'], 2);?></td>
                    </tr>
                <?php endforeach; ?>
                <?php if($is_all): ?>
                    <tr class="total-row">
                        <td colspan="4" style="text-align:right;">Grand Total</td>
                        <td class="amount"><?php echo number_format($total_bank, 2);?></td>
                        <td class="amount"><?php echo number_format($total_cash, 2);?></td>
                    </tr>
                <?php endif; ?>
            <?php else: ?>
                <tr><td colspan="6" style="text-align:center;padding:15px;">No expenses found for the selected criteria.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
