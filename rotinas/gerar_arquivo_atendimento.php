<?php
include "../include/conexao.php";

$query_atendimentos = "SELECT * FROM atendimento";

$result_atendimentos = $con->query($query_atendimentos);

$file_atendimentos = fopen('atendimentos.csv', 'w');
while ($row = $result_atendimentos->fetch(PDO::FETCH_ASSOC)) {
    fputcsv($file_atendimentos, $row);
}
fclose($file_atendimentos);


?>