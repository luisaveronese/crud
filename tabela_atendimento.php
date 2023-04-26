<?php 
  include "include/conexao.php";  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="assets/style.css"> -->
    <link rel="stylesheet" href="assets/tabela.css">
    <link rel="stylesheet" href="bootstrap/css/shadowbox.css" >
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
    <script src="bootstrap/js/shadowbox.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>Document</title>
</head>
<body>
  <h1>Selecione o tipo de atendimento:</h1>
  <?php
    $sql = "SELECT 
      tipo_atendimento,
      codido,
      descricao,
      ativo
      FROM tipo_atendimento where ativo = 't'";
    $res = pg_query($con, $sql);
    // echo nl2br($sql); exit;
    if (pg_num_rows($res) > 0){
    ?>
    <table id= "tipo_atendimento" class="table table-striped table-bordered table-hover table-large table-fixed">
      <th>
        <tr class="titulo_coluna">
          <th>Código</th>
          <th>Descrição</th>
        </tr>
      </th>
      <tbody>
        <?php 
          for ($i = 0; $i < pg_num_rows($res); $i ++){
            $tipo_atendimento = pg_fetch_result($res, $i, 'tipo_atendimento');
            $codigo_atendimento = pg_fetch_result($res, $i, 'codido');
            $descricao_atendimento = pg_fetch_result($res, $i, 'descricao');
            $ativo = pg_fetch_result($res, $i, 'ativo');
            $ativo = ($ativo == "t") ? 't': 'f';
          
        ?>
        <tr>
            <td class="tac"><a href="#" onclick="window.parent.retornaAtendimento(<?=$tipo_atendimento?>,'<?=$codigo_atendimento?>','<?=$descricao_atendimento?>'); window.parent.Shadowbox.close()"><?= $codigo_atendimento;?></a></td>
            <td class="tac"><a href="#" onclick="window.parent.retornaAtendimento(<?=$tipo_atendimento?>,'<?=$codigo_atendimento?>','<?=$descricao_atendimento?>'); window.parent.Shadowbox.close()"><?= $descricao_atendimento;?></a></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
    <?php } ?>
</body>
</html>