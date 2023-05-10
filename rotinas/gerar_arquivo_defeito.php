<?php
include "../include/conexao.php";

$result_defeito = pg_query($con, "SELECT * FROM defeito");

$file_defeito = fopen('defeito.csv', 'w');
while ($row = pg_fetch_assoc($result_defeito)) {
    fputcsv($file_defeito, $row);
}
fclose($file_defeito);

$file_path = 'defeito.csv';
$file_name = basename($file_path);
$file_size = filesize($file_path);

header('Content-Type: application/csv');
header('Content-Disposition: attachment; filename="' . $file_name . '"');
header('Content-Length: ' . $file_size);
header('Pragma: no-cache');
header('Expires: 0');
readfile($file_path);

exit(header('Location: ../defeito.php?msg=download'));
?>
