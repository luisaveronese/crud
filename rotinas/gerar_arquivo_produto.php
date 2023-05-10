<?php 
session_start();
include "../include/conexao.php";



$result_produtos = pg_query($con, "SELECT * FROM produto");
$row = pg_fetch_assoc($result_produtos);


$file_produtos = fopen('produtos.csv', 'w');
while ($row = pg_fetch_assoc($result_produtos)) {
    fputcsv($file_produtos, $row);
}
fclose($file_produtos);
$file_path = 'produtos.csv';
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