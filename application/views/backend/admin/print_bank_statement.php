<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Bank Statement - <?php echo $system_name;?></title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; font-size: 12px; color: #333; padding: 5mm; }
        @page { size: A4 landscape; margin: 8mm; }
        .letterhead { text-align: center; margin-bottom: 8px; position: relative; border-bottom: 3.25px solid #000; padding-bottom: 6px; }
        .letterhead .school-logo { position: absolute; left: 0; top: 0; height: 65px; }
        .letterhead .tagline { font-size: 10px; font-style: italic; color: #555; margin-bottom: 1px; }
        .letterhead .trust-line { font-size: 11px; font-weight: bold; margin: 1px 0; }
        .letterhead .school-name { font-size: 17px; font-weight: bold; color: #000; margin: 2px 0; letter-spacing: 0.5px; }
        .letterhead .address { font-size: 11px; margin-bottom: 2px; }
        .report-title { text-align: center; font-size: 15px; font-weight: bold; margin: 8px 0 4px; padding: 4px; background: #f0f0f0; border: 2.25px solid #ccc; }
        .bank-info { margin: 6px 0; padding: 5px 8px; border: 2.25px solid #999; background: #fafafa; font-size: 12px; }
        .bank-info div { padding: 1px 0; }
        .bank-info b { display: inline-block; min-width: 160px; }
        table.bank-table { width: 100%; border-collapse: collapse; font-size: 11px; margin-top: 6px; }
        table.bank-table th { background-color: #ddd; color: #000; padding: 3px 4px; text-align: center; border: 2.25px solid #999; font-size: 10px; }
        table.bank-table td { padding: 2px 4px; border: 2.25px solid #bbb; text-align: left; }
        table.bank-table td.amount { text-align: right; white-space: nowrap; }
        table.bank-table td.date { text-align: center; white-space: nowrap; width: 90px; }
        .total-row td { background-color: #e8e8e8; font-weight: bold; }
        .deposit-row td { background-color: #fff3cd; }
        .no-print { text-align: center; margin-bottom: 10px; }
        .no-print button { padding: 8px 20px; background: #333; color: #fff; border: none; cursor: pointer; font-size: 15px; border-radius: 4px; }
        @media print { .no-print { display: none; } body { padding: 0; } }
    </style>
</head>
<body>
    <div class="no-print">
        <button onclick="window.print();"><i class="fa fa-print"></i> Print Bank Statement</button>
    </div>

    <div class="letterhead">
        <?php include 'report_letterhead.php'; ?>
    </div>

    <div class="report-title">BANK STATEMENT</div>

    <div class="bank-info">
        <div><b>Name of Bank:</b> <?php echo $bank['bank_name'];?></div>
        <div><b>Account Number:</b> <?php echo !empty($bank['account_number']) ? $bank['account_number'] : '-';?></div>
        <?php if(!empty($bank['branch'])): ?><div><b>Branch:</b> <?php echo $bank['branch'];?></div><?php endif; ?>
        <?php if(!empty($bank['ifsc_code'])): ?><div><b>IFSC Code:</b> <?php echo $bank['ifsc_code'];?></div><?php endif; ?>
        <div><b>Statement Period:</b> <?php echo date('d/m/Y', strtotime($from_date));?> - <?php echo date('d/m/Y', strtotime($to_date));?></div>
        <div><b>Forwarded Opening Balance:</b> <?php echo $opening_balance == 0 ? '0.00' : number_format($opening_balance, 0);?></div>
    </div>

    <table class="bank-table">
        <thead>
            <tr>
                <th>Date</th>
                <th>Particular</th>
                <th>Credit (Rs.)</th>
                <th>Debit (Rs.)</th>
                <th>Avail. Bal (Rs.)</th>
            </tr>
        </thead>
        <tbody>
            <?php if(!empty($transactions)): ?>
                <?php foreach($transactions as $t): ?>
                    <?php
                        $particular = '';
                        $desc = (!empty($t['description']) && trim($t['description']) !== '' && trim($t['description']) !== '-') ? ' ' . trim($t['description']) : '';
                        if($t['payment_type'] == 'income'){
                            if(!empty($t['student_name'])){
                                $particular = $t['student_name'];
                            } elseif(!empty($t['person_org_name']) && trim($t['person_org_name']) !== '' && trim($t['person_org_name']) !== '-'){
                                $particular = $t['person_org_name'];
                            } elseif(!empty($t['title'])){
                                $particular = $t['title'];
                            } else {
                                $particular = 'Fee Receipt';
                            }
                        } else {
                            if(!empty($t['person_org_name']) && trim($t['person_org_name']) !== '' && trim($t['person_org_name']) !== '-'){
                                $particular = $t['person_org_name'];
                            } elseif(!empty($t['title']) && trim($t['title']) !== '-'){
                                $particular = $t['title'];
                            } elseif(!empty($t['expense_category_name'])){
                                $particular = $t['expense_category_name'];
                            } else {
                                $particular = 'Expense';
                            }
                        }
                        $particular .= $desc;
                    ?>
                    <?php if(!empty($t['is_deposit'])): ?>
                    <tr class="deposit-row">
                        <td class="date"><?php echo date('d/m/Y', $t['timestamp']);?></td>
                        <td><?php echo $particular;?> <span style="color:#b8860b;font-weight:bold;">(Deposit - <?php echo number_format($t['debit'], 0);?>)</span></td>
                        <td class="amount">-</td>
                        <td class="amount">-</td>
                        <td class="amount">-</td>
                    </tr>
                    <?php else: ?>
                    <tr>
                        <td class="date"><?php echo date('d/m/Y', $t['timestamp']);?></td>
                        <td><?php echo $particular;?></td>
                        <td class="amount"><?php echo $t['credit'] > 0 ? number_format($t['credit'], 0) : '0.00';?></td>
                        <td class="amount"><?php echo $t['debit'] > 0 ? number_format($t['debit'], 0) : '0.00';?></td>
                        <td class="amount"><?php echo $t['balance'] == 0 ? '0.00' : number_format($t['balance'], 0);?></td>
                    </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
                <tr class="total-row">
                    <td colspan="2" style="text-align:right;">Total Amount</td>
                    <td class="amount"><?php echo $total_credit == 0 ? '0.00' : number_format($total_credit, 0);?></td>
                    <td class="amount"><?php echo $total_debit == 0 ? '0.00' : number_format($total_debit, 0);?></td>
                    <td class="amount"><?php echo $closing_balance == 0 ? '0.00' : number_format($closing_balance, 0);?></td>
                </tr>
            <?php else: ?>
                <tr><td colspan="5" style="text-align:center;padding:15px;">No transactions found for the selected bank and date range.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div style="margin-top:6px;font-size:10px;color:#555;">
        Note: Rows highlighted in yellow are "Bank Account Deposite" entries. They are shown for reference only and are <b>not calculated</b> in the running balance, totals, or closing balance.
    </div>
</body>
</html>
