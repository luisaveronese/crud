<?php 
session_start();
include "../include/conexao.php";


$result_pecas = pg_query($con, "SELECT * FROM peca WHERE fabrica = {$_SESSION['fabrica']}");
$row = pg_fetch_assoc($result_pecas);


$file_pecas = fopen('pecas.csv', 'w');
while ($row = pg_fetch_assoc($result_pecas)) {
    fputcsv($file_pecas, $row);
}
fclose($file_pecas);
$file_path = 'pecas.csv';
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