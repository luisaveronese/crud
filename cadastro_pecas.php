<?php
include "include/conexao.php";
include "include/navbar.php";
if(isset($_GET['peca'])){
    $peca = (int)$_GET['peca'];
    $sql = "SELECT * FROM peca WHERE peca = $peca";
    $res = pg_query($con, $sql);
    if(pg_num_rows($res) > 0){
        $referencia = pg_fetch_result($res, 0, "referencia");
        $descricao = pg_fetch_result($res, 0, "descricao");
    }
}




if(isset($_POST["btncriar"]))
{   
    $mensagem = "";
    $erro = "";
    $pecaValidada = True;
    $pecaVerificada = True;
    $novaReferencia = $_POST['referencia'];
    $novaDesc = $_POST['desc'];
    $peca = (int)$_GET['peca'];

        $pecaVerificada = filter_var($novaReferencia, FILTER_SANITIZE_SPECIAL_CHARS) && filter_var($novaDesc, FILTER_SANITIZE_SPECIAL_CHARS);
        if ($pecaVerificada = True) {

            if(empty($novaReferencia)){
                $mensagem = "O campo Referência não pode ficar vazio!";
                $erro = true;
                $pecaValidada = False;
            }
            if(empty($novaDesc)){
                $erro = true;
                $mensagem = "O campo Descrição não pode ficar vazio!";
                $pecaValidada = False;
            }
            if(strlen($novaReferencia) > 10){
                $erro = true;
                $pecaValidada = false;
                $mensagem = "O campo Referência excedeu o número máximo de caracteres, por favor, tente novamente.";
            }
            if(strlen($novaDesc) > 50){
                $erro = true;
                $pecaValidada = false;
                $mensagem = "O campo Descrição excedeu o número máximo de caracteres, por favor, tente novamente.";
            }
            
            if($erro == false && $pecaValidada == true){
                if($peca == 0){
                    $sql_insert = "INSERT INTO peca(referencia, descricao) VALUES('$novaReferencia', '$novaDesc')";
                }else{
                    $sql_insert = "UPDATE peca SET referencia = '$novaReferencia', descricao = '$novaDesc' WHERE peca = $peca";
                }
                $res_insert = pg_query($con, $sql_insert);
                if(strlen(pg_last_error($con)) == 0){
                    $mensagem = "Peça cadastrada com sucesso!";
                    $referencia = "";
                    $descricao = "";
                    $peca = "";
                }else{
                    $mensagem = "Falha ao solicitar atendimento.";
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
    <title>Cadastro de peças</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="assets/sistema.css">
    <link rel="stylesheet" href="assets/table.css">
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
    <script src="bootstrap/js/shadowbox.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<style>
    .error {
    border: 1.2px solid red;
    }       
    </style>
<script>
    function validateForm() {
        var msg1 = "";
        var msg2 = "";
        var referencia = document.getElementById("referencia");
        var desc = document.getElementById("desc");


        if (referencia.value == "") {
            referencia.classList.add("error");
            msg1 = "O campo código não pode ficar vazio!\n";  
        }else {
            referencia.classList.remove("error");
        }
        if (desc.value == "") {
            desc.classList.add("error");
            msg2 = "O campo descrição não pode ficar vazio!\n";
        }else {
            desc.classList.remove("error");
        }
        if (msg1 == "" && msg2 == "") {
            $("#msg-erro1").text(msg1);
            $("#msg-erro2").text(msg2);
        }else {
            $("#msg-erro1").text(msg1).show();
            $("#msg-erro2").text(msg2).show();
            document.querySelector('form').addEventListener('submit', function(event) {
            event.preventDefault();
            });
        }
    };
;

</script>
<body>
    <div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <div class="panel panel-default panel-login">
            <div class="panel-heading text-center">Cadastrar Peça</div>
                <div class="panel-body">
                    <form action="<?php echo $_SERVER['PHP-SELF'];?>" onsubmit="validateForm()" method="POST" class="form">
                    <label for="referencia">Referência:</label><label class="required">*</label> 
                    <div class="input-group">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-option-vertical"></i>
                            </span>
                        <input type="text" name="referencia" placeholder="Número de referência" class="form-control" maxlength=10 id="referencia" value="<?=$referencia?>">
                        </div>
                        <div class="msg_erro alert alert-danger" id="msg-erro1" style="display:none" <?= !empty($mensagem) ? "" : 'style="display:none"'?>></div>
                        <br>
                        <label for="desc">Descrição:</label><label class="required">*</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-list-alt"></i>
                            </span>
                        <input type="text" name="desc" placeholder="Ex.: defletor ar-condicionado" class="form-control" maxlength=50 id="desc" value="<?=$descricao?>">
                        </div>
                        <div class="msg_erro alert alert-danger" id="msg-erro2" style="display:none" <?= !empty($mensagem) ? "" : 'style="display:none"'?>></div>
                        <br>
                        <input type="hidden" name="peca" id="peca" value="<?=$peca;?>">
                             
                        <div class="text-center">
                            <button name = "btncriar"type="submit" onclick="validateForm()" class="btn btn-primary">Cadastrar</button>
                        </div>
                        <br>
                    </form>
                </div>
                <div class="panel-footer text-center"><?= $mensagem . $suc ?></div>
            </div>
        </div>
</div>
  <?php
    $sql = "SELECT 
    peca,
    referencia,
    descricao
      FROM peca";
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
    <div class="container" id="tabela_table">
    <div class="container">
    <table id= "peca" class="table table-striped table-bordered table-hover table-large table-fixed">
      <th>
        <tr class="titulo_coluna">
          <th>Referência</th>
          <th>Descrição</th>
          <th>Ação</th>
        </tr>
      </th>
      <tbody>
        <?php 
          for ($i = 0; $i < pg_num_rows($res); $i ++){
            $peca = pg_fetch_result($res, $i, 'peca');
            $referencia = pg_fetch_result($res, $i, 'referencia');
            $descricao = pg_fetch_result($res, $i, 'descricao');
          
        ?>
        <tr>
            <td class="tac"><?= $referencia;?></td>
            <td class="tac"><?= $descricao;?></td>
            <td class="tac"><a href="cadastro_pecas.php?peca=<?=$peca;?>"><button class="btn btn-primary">Editar</a></button></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
    <?php } ?>
    </div>
    </div>
        <div class="col-md-4"></div>
    </div>
    </div>
</body>
</html>