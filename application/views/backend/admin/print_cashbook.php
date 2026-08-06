<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Cashbook - <?php echo $system_name;?></title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; font-size: 11px; color: #333; padding: 5mm; }
        .letterhead { text-align: center; margin-bottom: 10px; position: relative; border-bottom: 2px solid #000; padding-bottom: 8px; }
        .letterhead .school-logo { position: absolute; left: 0; top: 0; height: 70px; }
        .letterhead .tagline { font-size: 9px; font-style: italic; color: #555; margin-bottom: 2px; }
        .letterhead .trust-line { font-size: 10px; font-weight: bold; margin: 2px 0; }
        .letterhead .school-name { font-size: 16px; font-weight: bold; color: #000; margin: 3px 0; letter-spacing: 0.5px; }
        .letterhead .address { font-size: 10px; margin-bottom: 3px; }
        .report-title { text-align: center; font-size: 14px; font-weight: bold; margin: 8px 0; padding: 5px; background: #f0f0f0; border: 1px solid #ccc; }
        .info-row { font-size: 11px; margin: 4px 0; padding: 2px 5px; }
        table.cashbook-table { width: 100%; border-collapse: collapse; font-size: 10px; margin-top: 6px; }
        table.cashbook-table th { background-color: #333; color: #fff; padding: 4px 5px; text-align: center; border: 1px solid #333; font-size: 9px; }
        table.cashbook-table td { padding: 3px 5px; border: 1px solid #ccc; text-align: left; }
        table.cashbook-table td.sr { text-align: center; width: 30px; }
        table.cashbook-table td.date { text-align: center; width: 70px; }
        table.cashbook-table td.voucher { text-align: center; width: 80px; }
        table.cashbook-table td.amount { text-align: right; width: 80px; }
        table.cashbook-table tr:nth-child(even) { background-color: #f9f9f9; }
        .opening-row { background-color: #e8e8e8; font-weight: bold; }
        .total-row { background-color: #d9d9d9; font-weight: bold; }
        .no-print { text-align: center; margin-bottom: 10px; }
        .no-print button { padding: 8px 20px; background: #333; color: #fff; border: none; cursor: pointer; font-size: 13px; border-radius: 4px; }
        @media print { .no-print { display: none; } body { padding: 5mm; } }
    </style>
</head>
<body>
    <div class="no-print">
        <button onclick="window.print();"><i class="fa fa-print"></i> Print Cashbook</button>
    </div>

    <div class="letterhead">
        <?php include 'report_letterhead.php'; ?>
    </div>

    <div class="report-title">CASHBOOK</div>

    <div class="info-row">
        <strong>From Date: <?php echo date('d/m/Y', strtotime($from_date));?> &nbsp;&nbsp; To Date: <?php echo date('d/m/Y', strtotime($to_date));?></strong>
    </div>

    <table class="cashbook-table">
        <thead>
            <tr>
                <th>Sr.No.</th>
                <th>Date</th>
                <th>Particulars</th>
                <th>Voucher No.</th>
                <th>Debit (Dr)</th>
                <th>Credit (Cr)</th>
                <th>Balance</th>
            </tr>
        </thead>
        <tbody>
            <tr class="opening-row">
                <td colspan="4" style="text-align:right;">Opening Balance</td>
                <td class="amount"><?php if($opening_balance < 0) echo number_format(abs($opening_balance), 2); else echo '-';?></td>
                <td class="amount"><?php if($opening_balance >= 0) echo number_format($opening_balance, 2); else echo '-';?></td>
                <td class="amount"><?php echo number_format($opening_balance, 2);?></td>
            </tr>
            <?php if(!empty($transactions)): ?>
                <?php $i = 1; foreach($transactions as $t): ?>
                    <?php
                        $particulars = '';
                        $voucher_no = '';
                        if($t['payment_type'] == 'income'){
                            $particulars = !empty($t['student_name']) ? 'Fee Receipt - ' . $t['student_name'] : 'Fee Receipt';
                            $voucher_no = 'RCP-' . $t['payment_id'] . '-' . date('Y', $t['timestamp']);
                        } else {
                            $cat_name = !empty($t['expense_category_name']) ? $t['expense_category_name'] : '';
                            $particulars = !empty($t['title']) ? $t['title'] : ($cat_name ? $cat_name . ' Expense' : 'Expense');
                            $voucher_no = 'EXP-' . $t['payment_id'];
                        }
                        $method_labels = array('1' => 'Online', '2' => 'Cash', '3' => 'Cheque');
                        $method = isset($method_labels[$t['method']]) ? $method_labels[$t['method']] : $t['method'];
                    ?>
                    <tr>
                        <td class="sr"><?php echo $i++;?></td>
                        <td class="date"><?php echo date('d-m-Y', $t['timestamp']);?></td>
                        <td><?php echo $particulars . ' (' . $method . ')';?></td>
                        <td class="voucher"><?php echo $voucher_no;?></td>
                        <td class="amount"><?php echo $t['debit'] > 0 ? number_format($t['debit'], 2) : '-';?></td>
                        <td class="amount"><?php echo $t['credit'] > 0 ? number_format($t['credit'], 2) : '-';?></td>
                        <td class="amount"><?php echo number_format($t['balance'], 2);?></td>
                    </tr>
                <?php endforeach; ?>
                <tr class="total-row">
                    <td colspan="4" style="text-align:right;">Total</td>
                    <td class="amount"><?php echo number_format($total_debit, 2);?></td>
                    <td class="amount"><?php echo number_format($total_credit, 2);?></td>
                    <td class="amount"><?php echo number_format($closing_balance, 2);?></td>
                </tr>
            <?php else: ?>
                <tr><td colspan="7" style="text-align:center;padding:15px;">No transactions found for the selected date range.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
