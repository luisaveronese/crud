<?php
include "include/conexao.php";
include "include/navbar.php";
if(isset($_GET['defeito'])){
    $defeito = (int)$_GET['defeito'];
    $sql = "SELECT * FROM defeito WHERE defeito = $defeito";
    $res = pg_query($con, $sql);
    if(pg_num_rows($res) > 0){
        $codigo = pg_fetch_result($res, 0, "codigo");
        $descricao = pg_fetch_result($res, 0, "descricao");
    }
}
if(isset($_POST["btncriar"]))
{   
    $defeitoValidado = True;
    $defeitoVerificado = True;
    $erro = False;
    $mensagem = "";
    $novoCodigo = $_POST['codigo'];
    $novaDesc = $_POST['desc'];
    $defeito = (int)$_GET['defeito'];
        $defeitoVerificado = filter_var($novoCodigo, FILTER_SANITIZE_SPECIAL_CHARS) && filter_var($novaDesc, FILTER_SANITIZE_SPECIAL_CHARS);
        if ($defeitoVerificado= True) {
            if(empty($novoCodigo)){
                $mensagem = "O campo Código não pode ficar vazio!";
                $defeitoValidado = False;
                $erro = True;
            }
            if(empty($novaDesc)){
                $mensagem = "O campo Descrição não pode ficar vazio!";
                $defeitoValidado = False;
                $erro = True;
            }
            if(strlen($novoCodigo) > 10){
                $mensagem = "O campo Código excedeu o número máximo de caracteres, por favor, tente novamente.";
                $defeitoValidado = False;
                $erro = True;
            }
            if(strlen($novaDesc) > 50){
                $mensagem = "O campo Descrição excedeu o número máximo de caracteres, por favor, tente novamente.";
                $defeitoValidado = False;
                $erro = True;
            }
            if($erro == false && $defeitoValidado == true){
                if($defeito == 0){
                    $sql_insert = "INSERT INTO defeito(codigo, descricao) VALUES('$novoCodigo', '$novaDesc')";
                }else{
                    $sql_insert = "UPDATE defeito SET codigo = '$novoCodigo', descricao = '$novaDesc' WHERE defeito = $defeito";
                }
                $res_insert = pg_query($con, $sql_insert);
                if(strlen(pg_last_error($con)) == 0){
                    $mensagem = "Defeito reportado com sucesso.";
                    $codigo = "";
                    $descricao = "";
                    $defeito = "";
                }else{
                    $mensagem = "Falha ao reportar defeito";
                }
            }
        }
    }
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Defeito</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="assets/sistema.css">
    <link rel="stylesheet" href="assets/table.css">
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="row">
        <div class="col-md-4">
        </div>
        <div class="col-md-4">
            <div class="panel panel-default panel-login">
                <div class="panel-heading text-center">
                    Reportar defeito
                </div>
                <div class="panel-body">
                    <form action="<?php echo $_SERVER['PHP-SELF'];?>" method="POST" class="form">
                    <label for="codigo">Código</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-option-vertical"></i>
                            </span>
                        <input type="text" name="codigo" placeholder="Código do defeito" class="form-control" maxlength=10 id="codigo" value="<?= $codigo; ?>">
                        </div>
                        <br>
                        <label for="desc">Descrição</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-list-alt"></i>
                            </span>
                        <input type="text" name="desc" placeholder="Ex.: desligamento inesperado" class="form-control"maxlength=50 id="desc" value="<?= $descricao; ?>">
                        </div>
                        <br>      
                        <input type="hidden" name="defeito" value="<?= $defeito; ?>">        
                        <div class="text-center">
                            <button name="btncriar" type="submit" class="btn btn-primary">Enviar</button>
                        </div>
                        <br>
                    </form>
                </div>
                <div class="panel-footer text-center"><?= $mensagem ?></div>
            </div>
        </div>
</div>
  <?php
    $sql = "SELECT * FROM defeito";
    $res = pg_query($con, $sql);
    if(pg_num_rows($res) == 0){
        $alert = "Aviso! Não exitem registros cadastrados."; ?>
        <div class="alert alert-warning alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong><?= $alert ?></strong>
        </div>
    <?php }
    if (pg_num_rows($res) > 0){
    ?>
    <div class="row">
    <div class="container">
    <table id= "tipo_atendimento" class="table table-striped table-bordered table-hover table-large table-fixed">
      <th>
        <tr class="titulo_coluna">
          <th>Código</th>
          <th>Descrição</th>
          <th>Ação</th>
        </tr>
      </th>
      <tbody>
        <?php 
          for ($i = 0; $i < pg_num_rows($res); $i ++){
            $defeito = pg_fetch_result($res, $i, 'defeito');
            $codigo = pg_fetch_result($res, $i, 'codigo');
            $descricao = pg_fetch_result($res, $i, 'descricao');
          
        ?>
        <tr>
            <td class="tac"><?= $codigo;?></td>
            <td class="tac"><?= $descricao;?></td>
            <td class="tac"><a href="defeito.php?defeito=<?= $defeito;?>"><button class="btn btn-primary">Editar </a></button></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
    <?php } ?>
        <div class="col-md-4"></div>
    </div>
    </div>
</body>
</html>