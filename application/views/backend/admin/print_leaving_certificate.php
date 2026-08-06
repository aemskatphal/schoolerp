<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Leaving Certificate - <?php echo html_escape($student['name']); ?></title>
<style>
    @page { size: A4 portrait; margin: 0; }
    * { box-sizing: border-box; }
    body { font-family: Arial, sans-serif; margin: 0; padding: 0; background: #e9ecef; }
    .no-print { text-align: right; padding: 10px 14px; background: #fff; box-shadow: 0 1px 4px rgba(0,0,0,.25); }
    .no-print button { padding: 8px 20px; border: none; border-radius: 4px; cursor: pointer; font-size: 14px; margin-left: 6px; }
    .certificate {
        width: 190mm; min-height: 277mm; margin: 10mm auto; background: #fff;
        position: relative; padding: 8mm 12mm 10mm 12mm;
        border: 3px solid #333;
        box-shadow: 0 3px 12px rgba(0,0,0,.2);
    }
    .letterhead { display: flex; align-items: center; justify-content: center; gap: 8mm; }
    .letterhead .logo { width: calc(27mm + 10px); height: calc(27mm + 10px); object-fit: contain; background: #fff; border-radius: 3mm; padding: 1.5mm; box-shadow: 0 1px 4px rgba(0,0,0,.2); }
    .letterhead .head-text { text-align: center; flex: 1; }
    .letterhead .tagline { font-size: 10pt; font-weight: bold; letter-spacing: 2px; margin: 0 0 2mm 0; }
    .letterhead .sanstha { font-size: 12.1pt; margin: 0 0 1mm 0; }
    .letterhead .school { font-size: 14pt; font-weight: bold; margin: 0 0 1.5mm 0; white-space: nowrap; }
    .letterhead .address { font-size: 10pt; font-style: italic; margin: 0; }
    .bordered-block { border-top: 0.2pt solid #333; margin: 4mm -12mm 0 -12mm; }
    .b-row { display: flex; justify-content: space-between; border-bottom: 0.2pt solid #333; padding: 1.5mm 3mm 1.5mm 2mm; font-size: 12pt; }
    .b-row-split { position: relative; align-items: center; }
    .b-row-split .v-line { position: absolute; top: 0; bottom: -0.2pt; left: calc(50% - 20mm); width: 0.2pt; background: #333; }
    .b-row-split3 { position: relative; align-items: center; }
    .b-row-split3 > span { flex: 1; text-align: center; white-space: nowrap; }
    .b-row-split3 > span:first-child { text-align: left; }
    .b-row-split3 > span:last-child { text-align: right; }
    .b-row-split3 .v-line { position: absolute; top: 0; bottom: -0.2pt; width: 0.2pt; background: #333; }
    .b-row-split3 .v-line.vl1 { left: calc(33.333% - 7mm); }
    .b-row-split3 .v-line.vl2 { left: calc(66.667% - 3mm); }
    .original-text { font-weight: bold; color: #008000; margin-left: -6mm; }
    .lc-title { font-size: 12pt; font-weight: bold; letter-spacing: 1px; margin-left: -3mm; }
    .lc-table { width: calc(100% + 24mm); table-layout: fixed; border-collapse: collapse; font-size: 11pt; margin-left: -12mm; }
    .photo { position: absolute; top: 82mm; right: 5mm; width: 30mm; height: 36mm; object-fit: cover; border: 2px solid #333; background: #fff; z-index: 1; }
    .lc-table td { padding: 1.4mm 2mm; vertical-align: top; border-bottom: 0.2pt solid #333; }
    .lc-table td.num, .lc-table td.lab, .lc-table td.val { border-right: 0.2pt solid #333; }
    .lc-table td.no-sep { border-right: none; }
    .lc-table td.nowrap { white-space: nowrap; }
    .lc-table td.right { padding-right: 17mm; }
    .lc-table td.right5 { padding-right: 67mm; }
    .lc-table td.num { width: 9mm; }
    .lc-table td.lab { width: 62mm; }
    .lc-table td.val { width: 60mm; }
    .lc-table td.right { text-align: right; white-space: nowrap; }
    .certified { font-size: 11pt; text-align: center; margin: 1mm -12mm 2mm -12mm; border-bottom: 0.2pt solid #333; padding: 0 12mm 2mm 12mm; }
    .cert-note { font-size: 9.5pt; font-style: italic; text-align: left; margin: -2mm -12mm 4mm -12mm; padding-left: 2mm; border-bottom: 0.2pt solid #333; line-height: 1.4; }
    .sign-block { display: flex; justify-content: space-between; margin-top: 6mm; font-size: 11pt; text-align: center; }
    .sign-block .col { flex: 1; }
    .sign-block .col .date-val { min-height: 10mm; }
    .footer { position: absolute; bottom: 7mm; left: -35mm; right: 12mm; display: flex; align-items: center; justify-content: space-between; }
    .footer .qr-block { display: flex; flex-direction: column; align-items: center; gap: 1mm; }
    .footer .qr-note { font-size: 9pt; max-width: 100mm; text-align: center; margin-left: 43mm; }
    .footer .qr-img { width: 26mm; height: 26mm; object-fit: contain; }
    @media print {
        body { background: #fff; }
        .no-print { display: none; }
        .certificate { margin: 10mm auto; box-shadow: none; }
    }
</style>
</head>
<body>

<div class="no-print">
    <button onclick="window.print();" style="background:#3498db;color:#fff;"><i class="fa fa-print"></i> Print</button>
    <button onclick="window.close();" style="background:#e74c3c;color:#fff;">Close</button>
</div>

<?php $this->load->view('backend/admin/print_leaving_certificate_body', array('student' => $student, 'cert_no' => $cert_no, 'dob_words' => $dob_words, 'lc_date' => $lc_date)); ?>

<script>
    window.onload = function() {
        setTimeout(function(){ window.print(); }, 600);
    };
</script>
</body>
</html>
