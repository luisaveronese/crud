<?php
include "include/conexao.php";
include "include/navbar.php";
if(isset($_GET['tipo_atendimento'])){
    $tipo_atendimento = (int)$_GET["tipo_atendimento"];

    $sql = "SELECT tipo_atendimento.*, fabrica.* FROM tipo_atendimento JOIN fabrica ON tipo_atendimento.fabrica = fabrica.fabrica WHERE tipo_atendimento = $tipo_atendimento";
    $res = pg_query($con, $sql);
    if(pg_num_rows($res) > 0){
        $codigo = pg_fetch_result($res, 0, 'codido');
        $descricao = pg_fetch_result($res, 0, 'descricao');
        $ativo = pg_fetch_result($res, 0, 'ativo');
        $ativo = ($ativo == "t") ? "ativo": "inativo";
        $fabrica = pg_fetch_result($res, 0, 'fabrica');
        $nomeFabrica = pg_fetch_result($res, 0, 'nome');
    }
}

if(isset($_POST["btncriar"]))
{   
    $ativo = ($_POST['check']== 't') ? 'true' : 'false';
    $erro = "";
    $mensagem = "";
    $atendimentoValidado = True;
    $atendimentoVerificado = True;
    $novoCodigo = $_POST['codigo'];
    $novaDesc = $_POST['desc'];
    $fabrica = $_POST['fabrica'];
    $atendimento = (int)$_POST['tipo_atendimento'];

    $atendimentoVerificado = filter_var($novoCodigo, FILTER_SANITIZE_SPECIAL_CHARS) && filter_var($novaDesc, FILTER_SANITIZE_SPECIAL_CHARS);
    if ($atendimentoVerificado == True) {
        if(empty($novoCodigo)){
            $erro = true;
            $mensagem = "O campo Código não pode ficar vazio!";
            $atendimentoValidado = False;
        }
        if(empty($novaDesc)){
            $erro = true;
            $mensagem = "O campo Descrição não pode ficar vazio!";
            $atendimentoValidado = False;
        }
        if(strlen($novoCodigo) > 10){
            $erro = true;
            $atendimentoValidado = false;
            $mensagem = "O campo Código excedeu o número máximo de caracteres, solicite novamente o atendimento.";
        }
        if(strlen($novaDesc) > 50){
            $erro = true;
            $atendimentoValidado = false;
            $mensagem = "O campo Descrição excedeu o número máximo de caracteres, solicite novamente o atendimento.";
        }
        if($erro == false && $atendimentoValidado == true){
            if($atendimento == 0){
                $sql_insert = "INSERT INTO tipo_atendimento(codido, descricao, ativo, fabrica) VALUES('$novoCodigo', '$novaDesc', '$ativo', '$fabrica')";
            }else{
                $sql_insert = "UPDATE tipo_atendimento SET codido = '$novoCodigo', descricao = '$novaDesc', ativo = '$ativo', fabrica = '$fabrica' WHERE tipo_atendimento = $atendimento";
            }
            $res_insert = pg_query($con, $sql_insert);
            if(strlen(pg_last_error($con)) == 0){
                $mensagem = "Atendimento solicitado com sucesso!";
                $codigo = "";
                $descricao = "";
                $tipo_atendimento = "";
                $ativo = "";
            }else{
                $mensagem = "Falha ao solicitar atendimento.";
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
    <title>Tipo de Atendimento</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="assets/sistema.css">
    <link rel="stylesheet" href="assets/table.css">
    <link rel="stylesheet" href="bootstrap/css/shadowbox.css" >
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin=retornaProduto
retornaProduto="anonymous"></script>
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
        var msg3 = "";
        var codigo = document.getElementById("codigo");
        var desc = document.getElementById("desc");
        var fabrica = document.getElementById("fabrica");


        if (codigo.value == "") {
            codigo.classList.add("error");
            msg1 = "O campo código não pode ficar vazio!\n";  
        }else {
            codigo.classList.remove("error");
        }
        if (desc.value == "") {
            desc.classList.add("error");
            msg2 = "O campo descrição não pode ficar vazio!\n";
        }else {
            desc.classList.remove("error");
        }
        if (fabrica.value == ""){
            fabrica.classList.add("error");
            msg3 = "O campo fábrica não pode ficar vazio!\n";
        }
        if (msg1 == "" || msg2 == "" || msg3 == "") {
            $("#msg-erro1").text(msg1);
            $("#msg-erro2").text(msg2);
            $("#msg-erro3").text(msg3);
        }else {
            $("#msg-erro1").text(msg1).show();
            $("#msg-erro2").text(msg2).show();
            $("#msg-erro3").text(msg3).show();
            document.querySelector('form').addEventListener('submit', function(event) {
            event.preventDefault();
            });
        }
    };
;
$(function () { 
            Shadowbox.init();
            $(".pesquisar").click(function(){
                var nome = $(".nome").val(); 
                console.log("nome ", nome);
                Shadowbox.open({
                    content:    "tabela_fabrica.php?fabrica="+nome,
                    player: "iframe",
                    title:  "",
                    width:  1300,
                    height: 600
                });
            });
        });
    function retornaFabrica(fabrica, nome_fabrica){
        console.log("chegou aqui"+nome_fabrica)
        $(".fabrica").val(fabrica);
        $(".nome_fabrica").val(nome_fabrica);
    };
</script>
<body>
    <div class="row">
        <div class="col-md-4">
        </div>
        <div class="col-md-4">
            <div class="panel panel-default panel-login">
                <div class="panel-heading text-center">
                    Tipo de atendimento
                </div>
                <div class="panel-body">
                <form action="<?php echo $_SERVER['PHP-SELF'];?>" onsubmit="validateForm()" method="POST" class="form">
                    <label for="codigo">Código:</label><label class="required">*</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-option-vertical"></i>
                            </span>
                        <input type="text" name="codigo" placeholder="Código do atendimento" class="form-control codigo" maxlength=10 id="codigo" value="<?= $codigo; ?>">
                        </div>
                        <div class="msg_erro alert alert-danger" id="msg-erro1" style="display:none" <?= !empty($mensagem) ? "" : 'style="display:none"'?>></div>
                        <br>
                        <label for="desc">Descrição:</label><label class="required">*</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-list-alt"></i>
                            </span>
                        <input type="text" name="desc" placeholder="Ex.: manutenção de sistema" class="form-control descricao" maxlength=50 id="desc"value="<?= $descricao; ?>">
                        </div>
                        <div class="msg_erro alert alert-danger" id="msg-erro2" style="display:none" <?= !empty($mensagem) ? "" : 'style="display:none"'?>></div>
                        <br>
                        <label for="nome_fabrica">Fábrica:</label><label class="required">*</label> 
                    <div class="input-group">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-compressed"></i>
                            </span>
                        <input type="text" name="nome_fabrica" placeholder="Clique no botão pesquisar para selecionar" class="nome_fabrica form-control" maxlength=50 id="nome_fabrica" value="<?=$nomeFabrica?>"><span class="pesquisar input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
                        </div>
                        <div class="msg_erro alert alert-danger" id="msg-erro3" style="display:none" <?= !empty($mensagem) ? "" : 'style="display:none"'?>></div>
                        <br>
                        <input type="hidden" class="fabrica" name="fabrica" value="<?=$fabrica;?>">
                        <div class="active-product text-center">
                            <input type="checkbox" name="check" <?= ($ativo =='ativo') ? "   checked":"";?> value="t"> O atendimento está ativo
                        </div>
                        <br>
                        <input type="hidden" name="tipo_atendimento" placeholder="tipo_atendimento" class="tipo_atendimento" value="<?= $tipo_atendimento ?>">              
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
    $sql = "SELECT tipo_atendimento.*, fabrica.* FROM tipo_atendimento JOIN fabrica ON tipo_atendimento.fabrica = fabrica.fabrica";
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
          <th>Fábrica</th>
          <th>Status</th>
          <th>Ação</th>
        </tr>
      </th>
      <tbody>
        <?php 
          for ($i = 0; $i < pg_num_rows($res); $i ++){
            $tipo_atendimento = pg_fetch_result($res, $i, 'tipo_atendimento');
            $codigo = pg_fetch_result($res, $i, 'codido');
            $descricao = pg_fetch_result($res, $i, 'descricao');
            $ativo = pg_fetch_result($res, $i, 'ativo');
            $ativo = ($ativo == "t") ? "Ativo": "Inativo";
            $fabrica = pg_fetch_result($res, $i, 'fabrica');
            $nomeFabrica = pg_fetch_result($res, $i, 'nome');
          
        ?>
        <tr>
            <td class="tac"><?= $codigo;?></td>
            <td class="tac"><?= $descricao;?></td>
            <td class="tac"><?= $nomeFabrica; ?></td>
            <td class="tac"><?= $ativo;?></td>
            <td class="tac"><a href="atendimento.php?tipo_atendimento=<?= $tipo_atendimento;?>"><button class="btn btn-primary">Editar </a></button></td>
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