<?php 
include "../include/conexao.php";


$result_defeito = pg_query($con, "SELECT * FROM defeito");

$file_defeito = fopen('defeito.csv', 'w');
while ($row = pg_fetch_assoc($result_defeito)) {
    fputcsv($file_defeito, $row);
}
fclose($file_defeito);






?>