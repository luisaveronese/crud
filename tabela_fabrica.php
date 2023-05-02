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
  <h1>Selecione a Fábrica:</h1>
  <?php
    $sql = "SELECT * FROM fabrica";
    $res = pg_query($con, $sql);
    if (pg_num_rows($res) > 0){
    ?>
    <table id= "resultado_tipo_solicitacao" class="table table-striped table-bordered table-hover table-large table-fixed">
      <th>
        <tr class="titulo_coluna">
          <th>Nome</th>
        </tr>
      </th>
      <tbody>
        <?php 
          for ($i = 0; $i < pg_num_rows($res); $i ++){
            $fabrica = pg_fetch_result($res, $i, 'fabrica');
            $nome_fabrica = pg_fetch_result($res, $i, 'nome');
        ?>
        <tr>
            <td class="tac"><a href="#" onclick="window.parent.retornaFabrica(<?=$fabrica?>, '<?=$nome_fabrica?>'); window.parent.Shadowbox.close()"><?= $nome_fabrica;?></a></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
    <?php } ?>
</body>
</html>