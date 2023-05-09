<?php 
include "../include/conexao.php";


$query_defeitos = "SELECT * FROM defeito";

$result_defeitos = $con->query($query_defeitos);

$file_defeitos = fopen('defeitos.csv', 'w');
while ($row = $result_defeitos->fetch(PDO::FETCH_ASSOC)) {
    fputcsv($file_defeitos, $row);
}
fclose($file_defeitos);






?>