<?php
if (!isset($_GET['k']) || $_GET['k'] !== 'OlioBfA2tTd4UgV8ZaYKzkyJ') { http_response_code(404); exit; }
$out = "PHP " . PHP_VERSION . "\n";
foreach (array('dom','mbstring','gd','imagick','xml','libxml','SimpleXML','pdo','json') as $m) {
    $out .= $m . " = " . (extension_loaded($m) ? "YES" : "no") . "\n";
}
$out .= "disable_functions: " . ini_get('disable_functions') . "\n";
$out .= "memory_limit: " . ini_get('memory_limit') . "\n";
$out .= "max_execution_time: " . ini_get('max_execution_time') . "\n";
echo $out;
@unlink(__FILE__);
