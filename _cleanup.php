<?php
if (($_GET['k'] ?? '') !== 'OlioBfA2tTd4UgV8ZaYKzkyJ') { http_response_code(403); exit('forbidden'); }
@set_time_limit(300);
header('Content-Type: application/json; charset=utf-8');

define('BASEPATH', __DIR__);
$db = array('default' => array(
    'hostname' => 'localhost', 'username' => '', 'password' => '', 'database' => '', 'dbdriver' => 'mysqli'
));
@include __DIR__ . '/application/config/database.prod.php';
$c = $db['default'];
$pdo = new PDO("mysql:host={$c['hostname']};dbname={$c['database']};charset=utf8mb4", $c['username'], $c['password'], array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
));

$backup = array();
$counts_before = array();
$deleted = array();

$tables = array('pre_student', 'student', 'student_documents', 'student_academic_history', 'student_promotion_history', 'invoice', 'invoice_item', 'payment', 'audit_log', 'enquiry');

foreach ($tables as $t) {
    $counts_before[$t] = (int)$pdo->query("SELECT COUNT(*) FROM `$t`")->fetchColumn();
    if ($counts_before[$t] > 0) {
        $rows = $pdo->query("SELECT * FROM `$t`")->fetchAll(PDO::FETCH_ASSOC);
        $backup[$t] = $rows;
    }
}

$pdo->exec('SET FOREIGN_KEY_CHECKS = 0');
$pdo->beginTransaction();
try {
    foreach ($tables as $t) {
        if ($counts_before[$t] > 0) {
            $pdo->exec("DELETE FROM `$t`");
        }
        $deleted[$t] = $counts_before[$t];
    }
    $pdo->commit();
} catch (Exception $e) {
    $pdo->rollBack();
    $pdo->exec('SET FOREIGN_KEY_CHECKS = 1');
    http_response_code(500);
    echo json_encode(array('error' => $e->getMessage()));
    exit;
}
$pdo->exec('SET FOREIGN_KEY_CHECKS = 1');

$files = array();
$collect_dirs = array(
    'pre_student'        => array(
        'uploads/pre_student/' => array('photo', 'leaving_certificate', 'marksheet', 'aadhar_card_student', 'aadhar_card_parent', 'migration_certificate', 'userfile'),
    ),
    'student'            => array(
        'uploads/student_image/'   => array('photo'),
        'uploads/student_qr_code/' => array('qr_code'),
    ),
    'student_documents'  => array(
        'uploads/std_document/' => array('document_file'),
    ),
    'invoice'            => array(
        'uploads/discount/' => array('discount_file'),
    ),
);
foreach ($tables as $t) {
    if (empty($backup[$t])) continue;
    if (!isset($collect_dirs[$t])) continue;
    foreach ($collect_dirs[$t] as $dir => $cols) {
        foreach ($backup[$t] as $row) {
            foreach ($cols as $col) {
                if (empty($row[$col])) continue;
                $f = __DIR__ . '/' . $dir . $row[$col];
                if (is_file($f)) {
                    @unlink($f);
                    $files[] = 'deleted:' . $dir . $row[$col];
                } elseif (file_exists($f)) {
                    $files[] = 'left(non-file):' . $dir . $row[$col];
                } else {
                    $files[] = 'missing:' . $dir . $row[$col];
                }
            }
        }
    }
}

$counts_after = array();
foreach ($pdo->query('SHOW TABLES')->fetchAll(PDO::FETCH_COLUMN) as $t) {
    $counts_after[$t] = (int)$pdo->query("SELECT COUNT(*) FROM `$t`")->fetchColumn();
}

$out = array(
    'ok'              => true,
    'deleted'         => $deleted,
    'counts_before'   => $counts_before,
    'non_zero_after'  => array_filter($counts_after, function ($n) { return $n > 0; }),
    'files'           => $files,
    'backup'          => $backup,
);
echo json_encode($out, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
@unlink(__FILE__);
