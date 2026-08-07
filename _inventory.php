<?php
if (($_GET['k'] ?? '') !== 'OlioBfA2tTd4UgV8ZaYKzkyJ') { http_response_code(403); exit('forbidden'); }
@set_time_limit(120);
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

$out = array('counts' => array(), 'details' => array());

foreach ($pdo->query('SHOW TABLES')->fetchAll(PDO::FETCH_COLUMN) as $t) {
    $out['counts'][$t] = (int)$pdo->query("SELECT COUNT(*) FROM `$t`")->fetchColumn();
}

$detailTables = array('pre_student', 'student', 'parent', 'invoice', 'invoice_item', 'payment', 'expense_category', 'audit_log', 'admin', 'admin_permissions', 'admin_role', 'student_documents', 'enquiry', 'bank', 'bank_account', 'cashbook', 'journal_voucher', 'salary_payment', 'advance_salary', 'sys_documents', 'assignment', 'attendance', 'circular', 'noticeboard', 'book', 'transport', 'vehicle', 'dormitory', 'hostel_room', 'house', 'club', 'exam', 'subject', 'fees_template', 'fees_template_item', 'fees_head', 'client', 'section', 'class');

foreach ($detailTables as $t) {
    if (!isset($out['counts'][$t])) continue;
    $n = $out['counts'][$t];
    if ($n == 0) { $out['details'][$t] = array(); continue; }
    if ($n <= 200) {
        $rows = $pdo->query("SELECT * FROM `$t`")->fetchAll(PDO::FETCH_ASSOC);
        $out['details'][$t] = $rows;
    } else {
        $out['details'][$t] = array('__too_many_rows__' => $n);
    }
}

echo json_encode($out, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
@unlink(__FILE__);
