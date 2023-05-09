<?php 
include "../include/conexao.php";


$query_produtos = "SELECT * FROM produto";

$result_produtos = $con->query($query_produtos);

$file_produtos = fopen('produtos.csv', 'w');
while ($row = $result_produtos->fetch(PDO::FETCH_ASSOC)) {
    fputcsv($file_produtos, $row);
}
fclose($file_produtos);


?>