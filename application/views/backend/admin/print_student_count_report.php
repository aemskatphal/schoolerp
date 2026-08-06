<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Student Count Report</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; font-size: 11px; padding: 5mm; }
        .report-header { text-align: center; margin-bottom: 8px; border-bottom: 2px solid #000; padding-bottom: 5px; }
        .report-header h2 { font-size: 16px; margin-bottom: 2px; }
        .report-header p { font-size: 11px; color: #333; }
        .report-title { text-align: center; margin-bottom: 4px; font-size: 14px; font-weight: bold; }
        .report-info { text-align: center; margin-bottom: 10px; font-size: 12px; }
        .class-section { margin-bottom: 4px; margin-top: 8px; }
        .class-section:first-of-type { margin-top: 0; }
        .class-section h4 { font-size: 12px; font-weight: bold; padding: 3px 0; }
        table.report-table { width: 100%; border-collapse: collapse; font-size: 10px; margin-bottom: 6px; }
        table.report-table th { background-color: #333; color: #fff; padding: 3px 4px; text-align: center; border: 1px solid #333; font-size: 9px; }
        table.report-table td { padding: 2px 4px; border: 1px solid #ccc; text-align: center; }
        table.report-table td.cat-name { text-align: left; padding-left: 6px; }
        table.report-table tr.total-row { background-color: #e8e8e8; font-weight: bold; }
        table.report-table tr:nth-child(even):not(.total-row) { background-color: #f5f5f5; }
        @media print {
            body { padding: 3mm; }
            .no-print { display: none; }
            .class-section { page-break-inside: avoid; }
        }
    </style>
</head>
<body>
    <div class="no-print" style="text-align:center;margin-bottom:10px;">
        <button onclick="window.print();" style="padding:8px 20px;background:#333;color:#fff;border:none;cursor:pointer;font-size:13px;border-radius:4px;">Print Report</button>
    </div>

    <div class="report-header">
        <?php include 'report_letterhead.php'; ?>
    </div>

    <div class="report-title">Category Waise Students Total</div>

    <div class="report-info">
        Education Year: <?php echo $ad_year;?>
    </div>

    <?php
    $section_map = array();
    foreach($sections as $sec){
        $section_map[$sec['section_id']] = $sec['name'];
    }

    $cat_names = array('0' => 'N/A');
    foreach($categories as $cat){
        $cat_names[$cat['category_id']] = $cat['cat_name'];
    }

    foreach($classes as $class):
        $class_id = $class['class_id'];
        if(!isset($data[$class_id])) continue;
    ?>
    <div class="class-section">
        <?php foreach($data[$class_id] as $section_id => $cat_data): ?>
        <h4><?php echo $class['name'];?> &nbsp;<?php echo isset($section_map[$section_id]) ? $section_map[$section_id] : '';?></h4>
        <table class="report-table">
            <thead>
                <tr>
                    <th style="width:30%;">Category</th>
                    <th>Boys</th>
                    <th>Girls</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total_boys = 0;
                $total_girls = 0;
                $total_all = 0;
                ?>
                <tr class="total-row">
                    <td class="cat-name">Total</td>
                    <?php
                    foreach($cat_data as $cid => $sex_data){
                        $boys = isset($sex_data['male']) ? $sex_data['male'] : 0;
                        $girls = isset($sex_data['female']) ? $sex_data['female'] : 0;
                        $total_boys += $boys;
                        $total_girls += $girls;
                        $total_all += ($boys + $girls);
                    }
                    ?>
                    <td><?php echo $total_boys;?></td>
                    <td><?php echo $total_girls;?></td>
                    <td><?php echo $total_all;?></td>
                </tr>
                <?php foreach($cat_names as $cid => $cname):
                    $boys = isset($cat_data[$cid]['male']) ? $cat_data[$cid]['male'] : 0;
                    $girls = isset($cat_data[$cid]['female']) ? $cat_data[$cid]['female'] : 0;
                    $total = $boys + $girls;
                ?>
                <tr>
                    <td class="cat-name"><?php echo $cname;?></td>
                    <td><?php echo $boys;?></td>
                    <td><?php echo $girls;?></td>
                    <td><?php echo $total;?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php endforeach; ?>
    </div>
    <?php endforeach; ?>
</body>
</html>