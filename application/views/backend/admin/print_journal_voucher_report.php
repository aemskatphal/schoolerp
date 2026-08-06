<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Journal Voucher Report - <?php echo $system_name;?></title>
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
        table.report-table td.sr { text-align: center; width: 40px; }
        table.report-table td.date { text-align: center; width: 80px; }
        table.report-table td.amount { text-align: right; width: 100px; }
        table.report-table tr:nth-child(even) { background-color: #f9f9f9; }
        .total-row { background-color: #e8e8e8; font-weight: bold; }
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

    <div class="report-title">JOURNAL VOUCHER REPORT</div>

    <div class="info-row">
        <strong>Journal Voucher Between Date: <?php echo date('d/m/Y', strtotime($from_date));?> - <?php echo date('d/m/Y', strtotime($to_date));?></strong>
    </div>

    <div class="info-row">
        <strong>Party Name & Address: <?php echo !empty($client_name) ? $client_name : 'All';?><?php if(!empty($client_address)) echo ', ' . $client_address;?></strong>
    </div>

    <table class="report-table">
        <thead>
            <tr>
                <th>Sr.No.</th>
                <th>Date</th>
                <th>Voucher No.</th>
                <th>Party Name</th>
                <th>Description</th>
                <th>Debit Amount</th>
            </tr>
        </thead>
        <tbody>
            <?php if(!empty($vouchers)): ?>
                <?php $i = 1; foreach($vouchers as $v): ?>
                    <tr>
                        <td class="sr"><?php echo $i++;?></td>
                        <td class="date"><?php echo date('d-m-Y', strtotime($v['date']));?></td>
                        <td><?php echo $v['voucher_no'];?></td>
                        <td><?php echo !empty($v['party_name']) ? $v['party_name'] : '-';?></td>
                        <td><?php echo !empty($v['narration']) ? $v['narration'] : '-';?></td>
                        <td class="amount"><?php echo number_format($v['total_amount'], 2);?></td>
                    </tr>
                <?php endforeach; ?>
                <tr class="total-row">
                    <td colspan="5" style="text-align:right;">Grand Total</td>
                    <td class="amount"><?php echo number_format($total_amount, 2);?></td>
                </tr>
            <?php else: ?>
                <tr><td colspan="6" style="text-align:center;padding:15px;">No journal vouchers found for the selected criteria.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
