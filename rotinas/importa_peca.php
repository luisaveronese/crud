<?php
// Importa o arquivo de conexão com o banco de dados
require_once '../include/conexao.php';

// Define o caminho completo para o arquivo .csv
$caminho_csv = 'pecas_black_new.csv';

// Lê o conteúdo do arquivo .csv
$conteudo_csv = file_get_contents($caminho_csv);

// Converte o conteúdo do arquivo .csv em um array
$linhas_csv = str_getcsv($conteudo_csv, "\n");
$dados_csv = array_map('str_getcsv', $linhas_csv);

// Insere os dados do arquivo .csv no banco de dados
foreach ($dados_csv as $linha) {
  $referencia = $linha[0];
  $descricao = $linha[1];

  $query = "INSERT INTO peca (referencia, descricao, fabrica) VALUES ('$referencia', '$descricao', '2')";
  $res = pg_query($con, $query);
}
?>
