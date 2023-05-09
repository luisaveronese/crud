<?php 
include "../include/conexao.php";


$result_pecas = pg_query($con, "SELECT * FROM peca");
$row = pg_fetch_assoc($result_pecas);


$file_pecas = fopen('pecas.csv', 'w');
while ($row = pg_fetch_assoc($result_pecas)) {
    fputcsv($file_pecas, $row);
}
fclose($file_pecas);





?>