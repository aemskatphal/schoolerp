<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>ID Card - <?php echo html_escape($student['name']); ?></title>
<style>
    @page { size: A4 portrait; margin: 0; }
    * { box-sizing: border-box; }
    body { font-family: Arial, sans-serif; margin: 0; padding: 0; background: #e9ecef; }
    .no-print { text-align: right; padding: 10px 14px; background: #fff; box-shadow: 0 1px 4px rgba(0,0,0,.25); }
    .no-print button { padding: 8px 20px; border: none; border-radius: 4px; cursor: pointer; font-size: 14px; margin-left: 6px; }
    .card-wrap { width: 210mm; margin: 15mm auto; text-align: center; }
    .idcard { width: 85.6mm; height: 54mm; background: #fff; border-radius: 2.5mm; overflow: hidden; border: 1.2px solid #1a5276; box-shadow: 0 3px 12px rgba(0,0,0,.25); display: inline-block; vertical-align: top; text-align: left; color: #222; position: relative; }
    .idcard .brand { background: linear-gradient(90deg, #1a5276, #2980b9); color: #fff; padding: 2mm 2.5mm; display: flex; align-items: center; gap: 2mm; }
    .idcard .brand .logo { width: 7mm; height: 7mm; object-fit: contain; background: #fff; border-radius: 1mm; padding: .4mm; }
    .idcard .brand .b-school { font-size: 6.2pt; font-weight: bold; line-height: 1.15; }
    .idcard .brand .b-sub { font-size: 5pt; opacity: .95; }
    .idcard .body { display: flex; padding: 2mm 2.5mm; gap: 2mm; }
    .idcard .photo-box { width: 17mm; height: 21mm; border: 1px solid #1a5276; border-radius: 1.5mm; overflow: hidden; background: #ecf0f1; flex-shrink: 0; }
    .idcard .photo-box img { width: 100%; height: 100%; object-fit: cover; }
    .idcard .details { flex: 1; font-size: 6.4pt; line-height: 1.35; overflow: hidden; }
    .idcard .details .sname { font-size: 7.6pt; font-weight: bold; color: #1a5276; text-transform: uppercase; line-height: 1.1; margin-bottom: 1mm; }
    .idcard .details .drow { display: flex; }
    .idcard .details .dlabel { width: 20mm; color: #555; font-weight: bold; }
    .idcard .details .dvalue { flex: 1; font-weight: bold; }
    .idcard .foot { position: absolute; left: 0; right: 0; bottom: 0; display: flex; align-items: center; justify-content: space-between; gap: 1mm; padding: 1.2mm 2.5mm; background: #f4f6f7; border-top: 1px solid #d5dbdb; font-size: 4.8pt; color: #555; }
    .idcard .foot .qr { width: 9mm; height: 9mm; object-fit: contain; flex-shrink: 0; }
    @media print {
        body { background: #fff; }
        .no-print { display: none; }
        .card-wrap { margin: 10mm auto; }
        .idcard { box-shadow: none; }
    }
</style>
</head>
<body>

<div class="no-print">
    <button onclick="window.print();" style="background:#3498db;color:#fff;"><i class="fa fa-print"></i> Print</button>
    <button onclick="window.close();" style="background:#e74c3c;color:#fff;">Close</button>
</div>

<div class="card-wrap">
    <?php $this->load->view('backend/admin/print_student_id_card_body', array('student' => $student)); ?>
</div>

<script>
    window.onload = function() {
        setTimeout(function(){ window.print(); }, 600);
    };
</script>
</body>
</html>
