<?php
session_start();
include "../include/conexao.php";
$fabrica = $_SESSION['fabrica'];
$result_atendimento = pg_query($con, "SELECT * FROM tipo_atendimento WHERE fabrica = $fabrica");

$file_atendimentos = fopen('atendimentos.csv', 'w');
while ($row = pg_fetch_assoc($result_atendimento)) {
    fputcsv($file_atendimentos, $row);
}
fclose($file_atendimentos);
$file_path = 'atendimentos.csv';
$file_name = basename($file_path);
$file_size = filesize($file_path);

header('Content-Type: application/csv');
header('Content-Disposition: attachment; filename="' . $file_name . '"');
header('Content-Length: ' . $file_size);
header('Pragma: no-cache');
header('Expires: 0');
readfile($file_path);

exit;


?>