<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Students Pending Fees Notice</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; font-size: 13px; padding: 5mm; }
        .notice-block { padding: 15px 0; border-bottom: 2px dashed #333; margin-bottom: 5px; page-break-inside: avoid; }
        .notice-block:last-child { border-bottom: none; }
        .notice-header { text-align: center; margin-bottom: 10px; }
        .notice-header h2 { font-size: 16px; }
        .notice-header p { font-size: 11px; color: #333; }
        .notice-text { font-size: 13px; line-height: 1.8; margin: 10px 0; }
        .notice-footer { display: flex; justify-content: space-between; margin-top: 15px; font-size: 12px; }
        .divider { text-align: center; font-weight: bold; font-size: 12px; padding: 8px 0; color: #333; }
        .seal-area { margin-top: 20px; display: flex; justify-content: space-between; align-items: flex-end; }
        .seal-box { text-align: center; font-size: 11px; }
        .seal-line { border-top: 1px solid #333; width: 150px; margin-top: 40px; padding-top: 5px; }
        @media print {
            body { padding: 5mm; }
            .no-print { display: none; }
            .notice-block { page-break-inside: avoid; }
        }
    </style>
</head>
<body>
    <div class="no-print" style="text-align:center;margin-bottom:10px;">
        <button onclick="window.print();" style="padding:8px 20px;background:#333;color:#fff;border:none;cursor:pointer;font-size:13px;border-radius:4px;">Print Notice</button>
    </div>

    <div class="notice-header">
        <?php include 'report_letterhead.php'; ?>
    </div>

    <?php if(!empty($students)): ?>
        <?php foreach($students as $idx => $std): ?>
            <?php if($idx > 0): ?>
                <div class="divider">*** Students Pending Fees Notice ***</div>
            <?php endif; ?>

            <div class="notice-block">
                <div class="notice-text">
                    <p>Parents of Miss/ Mast: <strong><?php echo $std['name'];?></strong>, Standard: <strong><?php echo $std['class_name'];?></strong>, Section/Division: <strong><?php echo $std['section_name'];?></strong>,</p>
                    <p>Education Year: <strong><?php echo $ad_year;?></strong>, You are being informed by this notice that you have to pay remaining fees Rs. <strong><?php echo number_format($std['total_due'], 0, '.', ',');?></strong> till dated: <strong><?php echo date('d/m/Y', strtotime($notice_date));?></strong> in the office.</p>
                    <p>Please ignore if already paid.</p>
                </div>

                <div class="seal-area">
                    <div class="seal-box">
                        <div class="seal-line">Date &amp; Time: <?php echo date('d/m/Y h:i:s a', strtotime($notice_date));?></div>
                    </div>
                    <div class="seal-box">
                        <div class="seal-line">School Seal &amp; Sign</div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p style="text-align:center;padding:30px;">No students with pending fees found for the selected criteria.</p>
    <?php endif; ?>
</body>
</html>
