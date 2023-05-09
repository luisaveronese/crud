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


?>