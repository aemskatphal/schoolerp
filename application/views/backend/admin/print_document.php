<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $doc_name; ?> - <?php echo html_escape($student['name']); ?></title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .header { text-align: center; border-bottom: 2px solid #333; padding-bottom: 10px; margin-bottom: 20px; }
        .header h2 { margin: 5px 0; }
        .header p { margin: 3px 0; font-size: 14px; }
        .doc-title { text-align: center; font-size: 20px; font-weight: bold; margin: 20px 0; text-decoration: underline; }
        .details { width: 100%; margin: 20px 0; }
        .details td { padding: 6px 10px; font-size: 14px; }
        .details td:first-child { font-weight: bold; width: 200px; }
        .footer { margin-top: 60px; text-align: right; font-size: 14px; }
        .footer .line { border-top: 1px solid #333; width: 200px; display: inline-block; }
        @media print {
            body { margin: 0; }
            .no-print { display: none; }
        }
    </style>
</head>
<body>
    <div class="no-print" style="text-align:right;margin-bottom:10px;">
        <button onclick="window.print();" style="padding:8px 20px;background:#3498db;color:#fff;border:none;border-radius:4px;cursor:pointer;font-size:14px;"><i class="fa fa-print"></i> Print Document</button>
        <button onclick="window.close();" style="padding:8px 20px;background:#e74c3c;color:#fff;border:none;border-radius:4px;cursor:pointer;font-size:14px;margin-left:5px;">Close</button>
    </div>

    <div class="header">
        <h2><?php echo $system_name; ?></h2>
    </div>

    <div class="doc-title"><?php echo $doc_name; ?></div>

    <table class="details">
        <tr><td>Date:</td><td><?php echo date('d/m/Y'); ?></td></tr>
        <tr><td>Student Name:</td><td><?php echo html_escape($student['name']); ?></td></tr>
        <tr><td>Father's Name:</td><td><?php echo html_escape($student['father_name']); ?></td></tr>
        <tr><td>Mother's Name:</td><td><?php echo html_escape($student['mother_name']); ?></td></tr>
        <tr><td>Class / Standard:</td><td><?php echo html_escape($student['class_name']); ?></td></tr>
        <tr><td>Division:</td><td><?php echo html_escape($student['section_name']); ?></td></tr>
        <tr><td>UID Number:</td><td><?php echo html_escape($student['uid']); ?></td></tr>
        <tr><td>Date of Birth:</td><td><?php echo html_escape($student['birthday']); ?></td></tr>
        <tr><td>Gender:</td><td><?php echo ucfirst(html_escape($student['sex'])); ?></td></tr>
        <tr><td>Address:</td><td><?php echo html_escape($student['address']); ?></td></tr>
        <tr><td>Academic Year:</td><td><?php echo html_escape($student['ad_year']); ?></td></tr>
    </table>

    <div class="footer">
        <p>Authorized Signatory</p>
        <div class="line"></div>
    </div>

    <script>
        window.onload = function() {
            setTimeout(function(){ window.print(); }, 500);
        };
    </script>
</body>
</html>