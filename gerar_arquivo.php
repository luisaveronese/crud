<?php
include "include/conexao.php";


$query_produtos = "SELECT * FROM produto";
$query_defeitos = "SELECT * FROM defeito";
$query_pecas = "SELECT * FROM peca";
$query_atendimentos = "SELECT * FROM atendimento";

$result_produtos = $con->query($query_produtos);
$result_defeitos = $con->query($query_defeitos);
$result_pecas = $con->query($query_pecas);
$result_atendimentos = $con->query($query_atendimentos);


$file_produtos = fopen('produtos.csv', 'w');
while ($row = $result_produtos->fetch(PDO::FETCH_ASSOC)) {
    fputcsv($file_produtos, $row);
}
fclose($file_produtos);

$file_defeitos = fopen('defeitos.csv', 'w');
while ($row = $result_defeitos->fetch(PDO::FETCH_ASSOC)) {
    fputcsv($file_defeitos, $row);
}
fclose($file_defeitos);

$file_pecas = fopen('pecas.csv', 'w');
while ($row = $result_pecas->fetch(PDO::FETCH_ASSOC)) {
    fputcsv($file_pecas, $row);
}
fclose($file_pecas);

$file_atendimentos = fopen('atendimentos.csv', 'w');
while ($row = $result_atendimentos->fetch(PDO::FETCH_ASSOC)) {
    fputcsv($file_atendimentos, $row);
}
fclose($file_atendimentos);


?>