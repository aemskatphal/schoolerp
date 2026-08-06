<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>Fee Receipt - <?php echo $system_name;?></title>
<style>
  * { box-sizing: border-box; margin: 0; padding: 0; }
  body {
    font-family: Arial, Helvetica, sans-serif;
    background: #f3f3f3;
    padding: 20px 15px;
    color: #000;
    font-size: 12px;
    line-height: 1.25;
  }
  .page {
    max-width: 820px;
    margin: 0 auto;
    background: #fff;
    padding: 12px;
    box-shadow: 0 1px 4px rgba(0,0,0,.1);
  }
  .receipt { border: 1px solid #000; margin-bottom: 2cm; }
  .receipt:last-child { margin-bottom: 0; }

  .row { display: flex; border-bottom: 1px solid #000; }
  .row:last-child { border-bottom: none; }
  .cell { padding: 3px 6px; border-left: 1px solid #000; }
  .cell:first-child { border-left: none; }
  .center { text-align: center; }
  .right  { text-align: right; }
  .bold   { font-weight: bold; }
  .grow   { flex: 1; }

  /* Header */
  .header { align-items: stretch; }
  .logo-box {
    width: 110px;
    display: flex; align-items: center; justify-content: center;
    padding: 4px; border-right: 1px solid #000;
  }
  .logo-box img { max-width: 100%; max-height: 92px; object-fit: contain; }
  .title-box {
    flex: 1; text-align: center; padding: 4px;
    display: flex; flex-direction: column; justify-content: center; gap: 2px;
  }
  .title-box .school { font-size: 16px; font-weight: bold; }
  .title-box .addr   { font-style: italic; }

  .copy-tag { color: #16a34a; font-weight: bold; text-align: center; }

  /* Table header */
  .thead { font-weight: bold; }
  .col-sr    { width: 60px; }
  .col-part  { flex: 1; text-align: center; }
  .col-amt   { width: 90px; }

  /* Split section */
  .split { display: flex; }
  .split-left { width: 42%; border-right: 1px solid #000; }
  .split-left .row { border-bottom: 1px solid #000; }
  .split-left .row:last-child { border-bottom: none; }
  .half { width: 50%; padding: 3px 6px; }
  .half + .half { border-left: 1px solid #000; }
  .split-right {
    flex: 1; padding: 3px 6px;
    display: flex; flex-direction: column; justify-content: center;
  }

  .words { padding: 3px 6px; border-bottom: 1px solid #000; }
  .signs { display: flex; padding: 40px 6px 6px; font-weight: bold; }
  .signs > div { flex: 1; }
  .signs .s-mid { text-align: center; }
  .signs .s-end { text-align: right; }

  .no-print { text-align: center; padding: 20px; }
  .no-print button { padding: 10px 30px; font-size: 14px; cursor: pointer; }

  @media print {
    body { background: #fff; padding: 0; }
    .page { box-shadow: none; padding: 0; max-width: none; }
    .no-print { display: none; }
    @page { size: A4; margin: 4mm; }
    .receipt { page-break-inside: avoid; }
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

$method_labels = array('1' => 'Online', '2' => 'Cash', '3' => 'Cheque');
$method_label = isset($method_labels[$payment['method']]) ? $method_labels[$payment['method']] : $payment['method'];
$received_by = !empty($payment['entry_user']) ? $payment['entry_user'] : 'Administrator';

$snap = isset($snapshot) ? $snapshot : null;
$std_name = $snap ? $snap['student_name'] : $student['name'];
$std_class = $snap ? $snap['class_name'] : (isset($student['class_name']) ? $student['class_name'] : '');
$std_section = $snap ? (isset($section_name) ? $section_name : '') : (isset($student['section_name']) ? $student['section_name'] : '');
$academic_year_display = $snap ? $snap['academic_year'] : $payment['year'];
$current_fee = $snap ? $snap['current_fee'] : $total_fees;
$previous_due_display = $snap ? $snap['previous_due'] : 0;
$total_payable_display = $snap ? $snap['total_payable'] : $total_fees;
$balance_display = $snap ? $snap['balance_after'] : $total_due;
$paid_amount_display = $snap ? $snap['paid_amount'] : $payment['amount'];
?>
<div class="page">

    <?php for($copy = 1; $copy <= 2; $copy++): ?>
    <div class="receipt">
        <!-- HEADER -->
        <div class="row header">
            <div class="logo-box">
                <img src="<?php echo base_url('uploads/logo.png');?>" alt="School logo" />
            </div>
            <div class="title-box">
                <div>YOU ARE THE SCULPTOR OF YOUR LIFE</div>
                <div>Sadguru Shree Wamanrao Pai Shikshan Sanstha</div>
                <div class="school">ACHARYA ENGLISH MEDIUM SCHOOL AND JR. COLLEGE</div>
                <div class="addr">Suryanagari, Jalochi, Tal-Baramati, Dist-Pune</div>
            </div>
        </div>

        <!-- Student info -->
        <div class="row">
            <div class="cell grow">Student Name: <?php echo $std_name;?></div>
            <div class="cell" style="min-width:180px; text-align:right;">No: <?php echo $receipt_no;?></div>
        </div>

        <div class="row">
            <div class="cell" style="width:140px;">Std. <?php echo $std_class;?></div>
            <div class="cell" style="width:120px;">Div. <?php echo !empty($std_section) ? $std_section : '-';?></div>
            <div class="cell grow copy-tag"><?php echo ($copy == 1) ? 'STUDENT COPY' : 'SCHOOL COPY';?></div>
            <div class="cell" style="min-width:150px;">Acad. Year: <?php echo !empty($academic_year_display) ? $academic_year_display : '-';?></div>
            <div class="cell" style="min-width:150px;">Date: <?php echo $receipt_date;?></div>
        </div>

        <!-- Table head -->
        <div class="row thead">
            <div class="cell col-sr">Sr.No.</div>
            <div class="cell col-part">Particulars</div>
            <div class="cell col-amt">Amount</div>
        </div>

        <?php $sr = 1; if(!empty($fee_items)): foreach($fee_items as $item):
            $title = 'Fee';
            if($item['fees_head_id'] == 0){
                $title = 'Previous Due';
            } else {
                $fh = $this->db->get_where('fees_head', array('fees_head_id' => $item['fees_head_id']))->row_array();
                $title = $fh ? $fh['title'] : 'Fee';
            }
        ?>
        <div class="row">
            <div class="cell col-sr"><?php echo $sr++;?></div>
            <div class="cell col-part" style="text-align:left;"><?php echo $title;?></div>
            <div class="cell col-amt"><?php echo intval($item['amount']);?></div>
        </div>
        <?php endforeach; elseif(!empty($invoices)): foreach($invoices as $inv): ?>
        <div class="row">
            <div class="cell col-sr"><?php echo $sr++;?></div>
            <div class="cell col-part" style="text-align:left;"><?php echo $inv['title'];?></div>
            <div class="cell col-amt"><?php echo intval($inv['amount']);?></div>
        </div>
        <?php endforeach; elseif($snap): ?>
        <div class="row">
            <div class="cell col-sr">1</div>
            <div class="cell col-part" style="text-align:left;">Current Year Fee (<?php echo $academic_year_display; ?>)</div>
            <div class="cell col-amt"><?php echo intval($current_fee);?></div>
        </div>
        <?php if($previous_due_display > 0): ?>
        <div class="row">
            <div class="cell col-sr">2</div>
            <div class="cell col-part" style="text-align:left;">Previous Due</div>
            <div class="cell col-amt"><?php echo intval($previous_due_display);?></div>
        </div>
        <?php endif; endif; ?>

        <div class="row">
            <div class="cell grow right bold">TOTAL</div>
            <div class="cell col-amt"><?php echo intval($total_payable_display);?></div>
        </div>
        <div class="row">
            <div class="cell grow right bold">PAID NOW</div>
            <div class="cell col-amt bold"><?php echo intval($paid_amount_display);?></div>
        </div>

        <!-- Split: last/due  |  payment info -->
        <div class="row">
            <div class="split" style="width:100%;">
                <div class="split-left">
                    <div class="row">
                        <div class="half">Last Paid Fee</div>
                        <div class="half"><?php echo intval($last_paid_amount);?></div>
                    </div>
                    <div class="row">
                        <div class="half">Due Fee</div>
                        <div class="half bold"><?php echo intval($balance_display);?></div>
                    </div>
                </div>
                <div class="split-right">
                    <?php if(!empty($payment['description'])): ?>
                    <div><?php echo nl2br($payment['description']);?></div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="words">Amount in Rupees: <?php echo convert_number_to_words($paid_amount_display);?> Rupees Only</div>

        <div class="signs">
            <div>Principal</div>
            <div class="s-mid">Parents</div>
            <div class="s-end">Office Clerk</div>
        </div>
    </div>
    <?php endfor; ?>

</div>

<div class="no-print">
    <button onclick="window.print();">Print Receipt</button>
</div>

<script>
    window.onload = function(){ window.print(); };
</script>
</body>
</html>
