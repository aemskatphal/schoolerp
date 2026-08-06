<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Daily Cashbook - <?php echo $system_name;?></title>
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
        .day-head { margin: 10px 0 4px; font-size: 13px; font-weight: bold; }
        .day-head .opening { float: right; font-weight: normal; font-size: 12px; }
        .day-block { page-break-inside: avoid; }
        .day-block + .day-block { page-break-before: always; }
        table.cashbook-table { width: 100%; border-collapse: collapse; font-size: 11px; margin-top: 2px; }
        table.cashbook-table th { background-color: #ddd; color: #000; padding: 3px 3px; text-align: center; border: 2.25px solid #999; font-size: 10px; }
        table.cashbook-table td { padding: 2px 3px; border: 2.25px solid #bbb; text-align: left; }
        table.cashbook-table td.amount { text-align: right; white-space: nowrap; }
        .side-head td { font-weight: bold; text-align: center; background: #f0f0f0; font-size: 12px; }
        .final-head td { font-weight: bold; text-align: center; background: #e8e8e8; font-size: 12px; }
        .total-row td { background-color: #e8e8e8; font-weight: bold; }
        .closing-row td { font-weight: bold; }
        .deposit-row td { background-color: #DAA520; font-weight: bold; }
        .spacer-row td { border: none; height: 9px; padding: 0; }
        .no-print { text-align: center; margin-bottom: 10px; }
        .no-print button { padding: 8px 20px; background: #333; color: #fff; border: none; cursor: pointer; font-size: 15px; border-radius: 4px; }
        @media print { .no-print { display: none; } body { padding: 0; } }
        .clearfix:after { content: ""; display: table; clear: both; }
    </style>
</head>
<body>
    <div class="no-print">
        <button onclick="window.print();"><i class="fa fa-print"></i> Print Daily Cashbook</button>
    </div>

    <div class="letterhead">
        <?php include 'report_letterhead.php'; ?>
    </div>

    <?php if(empty($daily)): ?>
        <div class="report-title">DAILY CASHBOOK REPORT</div>
        <div class="day-head">
            From: <?php echo date('d/m/Y', strtotime($from_date));?> &nbsp;&nbsp; To: <?php echo date('d/m/Y', strtotime($to_date));?>
        </div>
        <table class="cashbook-table">
            <tr><td style="text-align:center;padding:15px;">No transactions found for the selected date range.</td></tr>
        </table>
    <?php else: ?>
        <?php $day_no = 1; foreach($daily as $day => $d): ?>
            <div class="day-block">
                <div class="report-title">DAILY CASHBOOK REPORT</div>
                <div class="day-head clearfix">
                    Date: <?php echo $d['date'];?>
                    <span class="opening">
                        Opening Balance: &nbsp;Cash Rs <?php echo number_format($d['opening_cash'], 0);?>
                        &nbsp;|&nbsp; Bank Rs <?php echo number_format($d['opening_bank'], 0);?>
                        &nbsp;|&nbsp; Total Rs <?php echo number_format($d['opening_total'], 0);?>
                    </span>
                </div>

                <table class="cashbook-table">
                    <tr class="side-head">
                        <td colspan="6">****&nbsp; Credit &nbsp;****</td>
                        <td colspan="6">****&nbsp; Debit &nbsp;****</td>
                    </tr>
                    <tr>
                        <th>Date</th>
                        <th>Particular</th>
                        <th>Receipt No.</th>
                        <th>Bank Amt.</th>
                        <th>Cash Amt.</th>
                        <th>Total Amt.</th>
                        <th>Date</th>
                        <th>Particular</th>
                        <th>Voucher No.</th>
                        <th>Bank Amt.</th>
                        <th>Cash Amt.</th>
                        <th>Total Amt.</th>
                    </tr>
                    <?php
                        $credit_count = count($d['credit_rows']);
                        $debit_count = count($d['debit_rows']);
                        $max_rows = max($credit_count, $debit_count);
                        for($i = 0; $i < $max_rows; $i++){
                            $c = isset($d['credit_rows'][$i]) ? $d['credit_rows'][$i] : null;
                            $b = isset($d['debit_rows'][$i]) ? $d['debit_rows'][$i] : null;
                            echo '<tr>';
                            if($c){
                                echo '<td>' . $c['date'] . '</td>';
                                echo '<td>' . $c['particular'] . '</td>';
                                echo '<td>' . $c['ref'] . '</td>';
                                echo '<td class="amount">' . ($c['bank'] > 0 ? number_format($c['bank'], 0) : '-') . '</td>';
                                echo '<td class="amount">' . ($c['cash'] > 0 ? number_format($c['cash'], 0) : '-') . '</td>';
                                echo '<td class="amount">' . number_format($c['total'], 0) . '</td>';
                            } else {
                                echo '<td colspan="6">&nbsp;</td>';
                            }
                            if($b){
                                echo '<td>' . $b['date'] . '</td>';
                                echo '<td>' . $b['particular'] . '</td>';
                                echo '<td>' . $b['ref'] . '</td>';
                                echo '<td class="amount">' . ($b['bank'] > 0 ? number_format($b['bank'], 0) : '-') . '</td>';
                                echo '<td class="amount">' . ($b['cash'] > 0 ? number_format($b['cash'], 0) : '-') . '</td>';
                                echo '<td class="amount">' . number_format($b['total'], 0) . '</td>';
                            } else {
                                echo '<td colspan="6">&nbsp;</td>';
                            }
                            echo '</tr>';
                        }
                    ?>
                    <tr class="final-head">
                        <td colspan="12">****&nbsp; Final Balance &nbsp;****</td>
                    </tr>
                    <tr class="total-row">
                        <td colspan="3">Total Credited</td>
                        <td class="amount"><?php echo number_format($d['credit_bank'], 0);?></td>
                        <td class="amount"><?php echo number_format($d['credit_cash'], 0);?></td>
                        <td class="amount"><?php echo number_format($d['credit_total'], 0);?></td>
                        <td colspan="3">Total Debited</td>
                        <td class="amount"><?php echo number_format($d['debit_bank'], 0);?></td>
                        <td class="amount"><?php echo number_format($d['debit_cash'], 0);?></td>
                        <td class="amount"><?php echo number_format($d['debit_total'], 0);?></td>
                    </tr>
                    <tr class="spacer-row"><td colspan="12">&nbsp;</td></tr>
                    <tr class="spacer-row"><td colspan="12">&nbsp;</td></tr>
                    <?php if(!empty($d['deposit_cash']) && $d['deposit_cash'] > 0): ?>
                    <tr class="deposit-row">
                        <td colspan="6">&nbsp;</td>
                        <td colspan="3">Cash Deposite Amt (in bank)</td>
                        <td class="amount"></td>
                        <td class="amount"><?php echo number_format($d['deposit_cash'], 0);?></td>
                        <td class="amount"></td>
                    </tr>
                    <?php endif; ?>
                    <tr class="closing-row">
                        <td colspan="6">&nbsp;</td>
                        <td colspan="3">Closing Cash Balance</td>
                        <td class="amount"></td>
                        <td class="amount"><?php echo number_format($d['closing_cash'], 0);?></td>
                        <td class="amount"></td>
                    </tr>
                    <tr class="closing-row">
                        <td colspan="6">&nbsp;</td>
                        <td colspan="3">Closing Bank Balance</td>
                        <td class="amount"></td>
                        <td class="amount"><?php echo number_format($d['closing_bank'], 0);?></td>
                        <td class="amount"></td>
                    </tr>
                    <tr class="closing-row">
                        <td colspan="6">&nbsp;</td>
                        <td colspan="3">Total Closing Balance (Cash + Bank)</td>
                        <td class="amount"></td>
                        <td class="amount"><?php echo number_format($d['closing_total'], 0);?></td>
                        <td class="amount"></td>
                    </tr>
                </table>
            </div>
        <?php $day_no++; endforeach; ?>
    <?php endif; ?>
</body>
</html>
