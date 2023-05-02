<?php
include "include/conexao.php";
include "include/navbar.php";
if(isset($_GET['fabrica'])){
    $fabrica = (int)$_GET["fabrica"];

    $sql = "SELECT * FROM fabrica WHERE fabrica = $fabrica";
    $res = pg_query($con, $sql);
    if(pg_num_rows($res) > 0){
        $nome = pg_fetch_result($res, 0, 'nome');
    }
}

if(isset($_POST["btncriar"]))
{   
    $erro = "";
    $mensagem = "";
    $fabricaValidada = True;
    $fabricaVerificada = True;
    $novoNome = $_POST['nome'];
    $fabrica = (int)$_POST['fabrica'];

    $fabricaVerificada = filter_var($novoNome, FILTER_SANITIZE_SPECIAL_CHARS);
    if ($fabricaVerificada == True) {
        if(empty($novoNome)){
            $erro = true;
            $mensagem = "O campo Nome não pode ficar vazio!";
            $fabricaValidada = False;
        }
        if(strlen($novoNome) > 50){
            $erro = true;
            $fabricaValidada = false;
            $mensagem = "O campo Nome excedeu o número máximo de caracteres, por favor, tente novamente.";
        }
        if($erro == false && $fabricaValidada == true){
            if($atendimento == 0){
                $sql_insert = "INSERT INTO fabrica(nome) VALUES('$novoNome')";
            }else{
                $sql_insert = "UPDATE fabrica SET nome = '$novoNome' WHERE fabrica = $fabrica";
            }
            $res_insert = pg_query($con, $sql_insert);
            if(strlen(pg_last_error($con)) == 0){
                $mensagem = "Fábrica cadastrada com sucesso!";
                $nome = "";
                $fabrica = "";
            }else{
                $mensagem = "Falha ao cadastrar fábrica.";
            }

        } 

    }
    else{
        $erro = true;
        $mensagem = "Informações inválidas";
    }

}

?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tipo de atendimento</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="assets/sistema.css">
    <link rel="stylesheet" href="assets/tabela.css">
    <link rel="stylesheet" href="assets/table.css">
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
        var msg = "";
        var nome = document.getElementById("nome");

        if (nome.value == "") {
            nome.classList.add("error");
            msg = "O campo nome não pode ficar vazio!\n";  
        }else {
            nome.classList.remove("error");
        }
        if (msg == "") {
            $("#msg-erro").text(msg);
        }else {
            $("#msg-erro").text(msg).show();
            document.querySelector('form').addEventListener('submit', function(event) {
            event.preventDefault();
            });
        }
    };
;
</script>
<body>
    <div class="row">
        <div class="col-md-4">
        </div>
        <div class="col-md-4">
            <div class="panel panel-default panel-login">
                <div class="panel-heading text-center">
                    Cadastro de fábrica
                </div>
                <div class="panel-body">
                <form action="<?php echo $_SERVER['PHP-SELF'];?>" onsubmit="validateForm()" method="POST" class="form">
                    <label for="nome">Nome:</label><label class="required">*</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-option-vertical"></i>
                            </span>
                        <input type="text" name="nome" placeholder="Nome da fábrica" class="form-control nome" id="nome" maxlength=50 value="<?= $nome ?>">
                        </div>
                        <div class="msg_erro alert alert-danger" id="msg-erro" style="display:none" <?= !empty($mensagem) ? "" : 'style="display:none"'?>></div>
                        <br>
                        <input type="hidden" name="fabrica" placeholder="fabrica" class="fabrica" value="<?= $fabrica ?>">              
                        <div class="text-center">
                            <button name="btncriar" type="submit" onclick="validateForm()" class="btn btn-primary">Enviar</button>
                        </div>
                        <br>
                    </form>
                </div>
                <div class="panel-footer text-center"><?= $mensagem ?></div>
            </div>
        </div>
</div>

  <?php
    $sql = "SELECT * FROM fabrica";
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
    <table id= "fabrica" class="table table-striped table-bordered table-hover table-large table-fixed">
      <th>
        <tr class="titulo_coluna">
          <th>Nome</th>
          <th>Ação</th>
        </tr>
      </th>
      <tbody>
        <?php 
          for ($i = 0; $i < pg_num_rows($res); $i ++){
            $fabrica = pg_fetch_result($res, $i, 'fabrica');
            $nome = pg_fetch_result($res, $i, 'nome');
        ?>
        <tr>
            <td class="tac"><?= $nome;?></td>
            <td class="tac"><a href="fabrica.php?fabrica=<?= $fabrica;?>"><button class="btn btn-primary">Editar </a></button></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
    <?php } ?>
    </div>
        <div class="col-md-4"></div>
    </div>
    </div>
</body>
</html>