<?php
include "../include/conexao.php";

$result_atendimento = pg_query($con, "SELECT * FROM tipo_atendimento");

$file_atendimentos = fopen('atendimentos.csv', 'w');
while ($row = pg_fetch_assoc($result_atendimento)) {
    fputcsv($file_atendimentos, $row);
}
fclose($file_atendimentos);
header('Location:../atendimento.php?msg=download');


?>