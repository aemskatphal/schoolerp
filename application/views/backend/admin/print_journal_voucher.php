<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Journal Voucher - <?php echo $system_name;?></title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; font-size: 13px; color: #000; }
        .letterhead { text-align: center; position: relative; border-bottom: 2px solid #000; padding-bottom: 8px; margin-bottom: 12px; }
        .letterhead .school-logo { position: absolute; left: 0; top: 0; height: 70px; }
        .letterhead .tagline { font-size: 9px; font-style: italic; color: #555; margin-bottom: 2px; }
        .letterhead .trust-line { font-size: 10px; font-weight: bold; margin: 2px 0; }
        .letterhead .school-name { font-size: 16px; font-weight: bold; color: #000; margin: 3px 0; letter-spacing: 0.5px; }
        .letterhead .address { font-size: 10px; margin-bottom: 3px; }
        .no-print { text-align: center; margin-bottom: 10px; }
        .no-print button { padding: 8px 24px; background: #003366; color: #fff; border: none; cursor: pointer; font-size: 13px; border-radius: 4px; }
        .voucher-box { border: 2px solid #000; padding: 12px 15px; }
        .voucher-top { text-align: center; margin-bottom: 10px; }
        .voucher-top .no { font-size: 12px; margin-bottom: 3px; }
        .voucher-top .title { font-size: 20px; font-weight: bold; text-decoration: underline; letter-spacing: 1px; }
        .info-line { margin: 4px 0; }
        .info-line .lbl { font-weight: bold; }
        .voucher-table { width: 100%; border-collapse: collapse; margin: 10px 0; }
        .voucher-table th { border: 1px solid #000; padding: 5px 8px; text-align: left; font-size: 12px; background: #f0f0f0; }
        .voucher-table td { border: 1px solid #000; padding: 5px 8px; font-size: 12px; vertical-align: top; }
        .voucher-table td.amt { text-align: right; width: 120px; font-weight: bold; }
        .amount-words { margin: 8px 0; font-weight: bold; }
        .signatures { width: 100%; margin-top: 35px; }
        .signatures table { width: 100%; }
        .signatures td { text-align: center; font-size: 11px; padding-top: 12px; width: 33%; border-top: 1px solid #000; }
        @media print {
            @page { size: A4; margin: 10mm; }
            .no-print { display: none; }
            body { padding: 0; }
        }
    </style>
</head>
<body>
<?php
function convert_number_to_words($number){
    $ones = array('','One','Two','Three','Four','Five','Six','Seven','Eight','Nine','Ten','Eleven','Twelve','Thirteen','Fourteen','Fifteen','Sixteen','Seventeen','Eighteen','Nineteen');
    $tens = array('','','Twenty','Thirty','Forty','Fifty','Sixty','Seventy','Eighty','Ninety');
    $number = intval($number);
    if($number == 0) return 'Zero';
    $str = '';
    if($number >= 100000){ $str .= convert_number_to_words(floor($number/100000)) . ' Lakh '; $number = $number % 100000; }
    if($number >= 1000){ $str .= convert_number_to_words(floor($number/1000)) . ' Thousand '; $number = $number % 1000; }
    if($number >= 100){ $str .= $ones[floor($number/100)] . ' Hundred '; $number = $number % 100; }
    if($number >= 20){ $str .= $tens[floor($number/10)] . ' '; $number = $number % 10; }
    if($number > 0){ $str .= $ones[$number] . ' '; }
    return trim($str);
}

$client_name = !empty($client['name']) ? $client['name'] : (!empty($row['client_name']) ? $row['client_name'] : '');
$bank_name = !empty($bank['bank_name']) ? $bank['bank_name'] : 'Cash';
$bank_ac = !empty($bank['account_number']) ? $bank['account_number'] : '';
$voucher_title = ($row['transaction_type'] == '3') ? 'BANK PAYMENT VOUCHER' : 'CASH PAYMENT VOUCHER';
?>

    <div class="no-print">
        <button onclick="window.print();">Print Voucher</button>
    </div>

    <div class="letterhead">
        <img src="<?php echo base_url('uploads/logo.png');?>" class="school-logo" alt="Logo">
        <div class="tagline">YOU ARE THE SCULPTOR OF YOUR LIFE</div>
        <div class="trust-line">Sadguru Shree Wamanrao Pai Shikshan Sanstha</div>
        <div class="school-name"><?php echo $system_name;?></div>
        <div class="address">Tal. Baramati, Dist. Pune</div>
    </div>

    <div class="voucher-box">
        <div class="voucher-top">
            <div class="no"><strong>No. <?php echo $row['voucher_no'].'/'.$row['financial_year'];?></strong></div>
            <div class="title"><?php echo $voucher_title;?></div>
        </div>

        <div class="info-line"><span class="lbl">Date:</span> <?php echo date('d/m/Y', strtotime($row['date']));?></div>
        <div class="info-line"><span class="lbl">On Account Of:</span> <?php echo $bank_name;?> <?php if(!empty($bank_ac)) echo '(' . $bank_ac . ')';?></div>
        <div class="info-line"><span class="lbl">Paid To:</span> <?php echo $client_name;?></div>

        <table class="voucher-table">
            <tr>
                <th>Description</th>
                <th>Amount</th>
            </tr>
            <tr>
                <td>
                    <?php echo nl2br(html_escape($row['narration']));?>
                    <?php if(!empty($category['name'])): ?>
                        <br><small style="color:#555;">Category: <?php echo html_escape($category['name']);?></small>
                    <?php endif; ?>
                </td>
                <td class="amt"><?php echo number_format($row['total_amount'], 2);?></td>
            </tr>
        </table>

        <div class="amount-words">In Words:- <?php echo convert_number_to_words($row['total_amount']);?> Rupees Only</div>

        <div class="signatures">
            <table>
                <tr>
                    <td>Approved By</td>
                    <td>Prepared By</td>
                    <td>Received By</td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>
