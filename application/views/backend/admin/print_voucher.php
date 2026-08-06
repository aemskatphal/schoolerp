<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Advance Salary Voucher - <?php echo $system_name;?></title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; font-size: 13px; color: #333; padding: 20px; }
        .header { text-align: center; border-bottom: 2px solid #333; padding-bottom: 10px; margin-bottom: 20px; }
        .header h2 { font-size: 18px; color: #003366; }
        .voucher-title { text-align: center; font-size: 16px; font-weight: bold; margin: 15px 0; padding: 8px; background: #f0f0f0; border: 1px solid #ccc; }
        .info-table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        .info-table td { padding: 6px 10px; border: 1px solid #ddd; }
        .info-table td.label { width: 30%; font-weight: bold; background: #f9f9f9; }
        .amount-box { text-align: center; margin: 20px 0; padding: 15px; border: 2px solid #003366; background: #f0f8ff; }
        .amount-box .amount { font-size: 24px; font-weight: bold; color: #003366; }
        .amount-box .label { font-size: 12px; color: #666; }
        .signatures { margin-top: 40px; display: flex; justify-content: space-between; }
        .signatures .sig-box { width: 30%; text-align: center; border-top: 1px solid #333; padding-top: 5px; }
        .print-btn { text-align: center; margin: 20px 0; }
        .print-btn button { padding: 8px 30px; background: #003366; color: #fff; border: none; border-radius: 4px; cursor: pointer; font-size: 14px; }
        @media print { .print-btn { display: none; } body { padding: 5mm; } }
    </style>
</head>
<body>
    <div class="header">
        <h2><?php echo $system_name;?></h2>
        <p>Advance Salary Voucher</p>
    </div>

    <div class="voucher-title">ADVANCE SALARY VOUCHER</div>

    <table class="info-table">
        <tr>
            <td class="label">Voucher No.</td>
            <td>ADV-<?php echo str_pad($row->advance_salary_id, 4, '0', STR_PAD_LEFT);?></td>
            <td class="label">Date</td>
            <td><?php echo date('d-m-Y', strtotime($row->advance_date));?></td>
        </tr>
        <tr>
            <td class="label">Staff Name</td>
            <td><?php echo isset($staff->name) ? $staff->name : 'N/A';?></td>
            <td class="label">Financial Year</td>
            <td><?php echo $row->financial_year;?></td>
        </tr>
        <tr>
            <td class="label">Deduct Month</td>
            <td><?php echo date('F Y', strtotime($row->month_year.'-01'));?></td>
            <td class="label">Category</td>
            <td><?php echo isset($category->name) ? $category->name : 'N/A';?></td>
        </tr>
        <tr>
            <td class="label">Bank Name</td>
            <td><?php echo isset($bank->bank_name) ? $bank->bank_name : 'N/A';?></td>
            <td class="label">Transaction Type</td>
            <td><?php echo ($row->transaction_type == 2) ? 'By Cash' : 'By Cheque';?></td>
        </tr>
        <tr>
            <td class="label">Reason</td>
            <td colspan="3"><?php echo nl2br(html_escape($row->reason));?></td>
        </tr>
    </table>

    <div class="amount-box">
        <div class="label">Advance Amount</div>
        <div class="amount">Rs. <?php echo number_format($row->amount, 2);?></div>
    </div>

    <table class="info-table">
        <tr>
            <td class="label">Entry By</td>
            <td><?php echo isset($row->entry_user) ? $row->entry_user : 'Administrator';?></td>
            <td class="label">Status</td>
            <td><?php echo ($row->review_status == 1) ? 'Reviewed' : 'Pending';?></td>
        </tr>
    </table>

    <div class="signatures">
        <div class="sig-box">
            <p>Staff Signature</p>
        </div>
        <div class="sig-box">
            <p>Accounts Officer</p>
        </div>
        <div class="sig-box">
            <p>Principal</p>
        </div>
    </div>

    <div class="print-btn">
        <button onclick="window.print();"><i class="fa fa-print"></i> Print Voucher</button>
    </div>
</body>
</html>
