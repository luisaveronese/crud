<?php 
include "../include/conexao.php";


$query_pecas = "SELECT * FROM peca";

$result_pecas = $con->query($query_pecas);

$file_pecas = fopen('pecas.csv', 'w');
while ($row = $result_pecas->fetch(PDO::FETCH_ASSOC)) {
    fputcsv($file_pecas, $row);
}
fclose($file_pecas);





?>