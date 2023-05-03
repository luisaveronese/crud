<?php
include "include/conexao.php";
include "include/navbar.php";
if(isset($_GET['produto'])){
    $produto = (int)$_GET['produto'];
    $sql = "SELECT produto.*, fabrica.* FROM produto JOIN fabrica ON produto.fabrica = fabrica.fabrica";
    $res = pg_query($con, $sql);
    if(pg_num_rows($res) > 0){
        $referencia = pg_fetch_result($res, 0, "referencia");
        $descricao = pg_fetch_result($res, 0, "descricao");
        $garantia = pg_fetch_result($res, 0, "garantia");
        $ativo = pg_fetch_result($res, 0, "ativo");
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
    $produtoValidado = True;
    $produtoVerificado = True;
    $novaReferencia = $_POST['referencia'];
    $novaDesc = $_POST['desc'];
    $novaGarantia = $_POST['garantia'];
    $fabrica = $_POST['fabrica'];
    $produto = (int)$_GET['produto'];

        $produtoVerificado = filter_var($novoNomeProduto, FILTER_SANITIZE_SPECIAL_CHARS);
        $garantiaVerificada = filter_var($novaGarantia, FILTER_SANITIZE_NUMBER_INT);
        if ($produtoVerificado = True) {

            if(empty($novaReferencia)){
                $erro = true;
                $mensagem = "O campo Referência não pode ficar vazio!";
                $produtoValidado = False;
            }
            if(empty($novaDesc)){
                $erro = true;
                $mensagem = "O campo Descrição não pode ficar vazio!";
                $produtoValidado = False;
            }
            if(empty($novaGarantia)){
                $erro = true;
                $mensagem = "O campo Garantia não pode ficar vazio!";
                $produtoValidado = False;
            }
            if(!filter_var($garantiaVerificada, FILTER_VALIDATE_INT)){
                $erro = true;
                $mensagem = "O tempo de garantia precisa ser um número.";
                $produtoValidado = False;
            }
            if(strlen($novaReferencia) > 10){
                $erro = true;
                $produtoValidado = false;
                $mensagem = "O campo Referência excedeu o número máximo de caracteres, por favor, tente novamente.";
            }
            if(strlen($novaDesc) > 50){
                $erro = true;
                $produtoValidado = false;
                $mensagem = "O campo Descrição excedeu o número máximo de caracteres, por favor, tente novamente.";
            }
            
            if($erro == false && $produtoValidado == true){
                if($produto == 0){
                    $sql_insert = "INSERT INTO produto(referencia, descricao, garantia, ativo, fabrica) VALUES('$novaReferencia', '$novaDesc', '$novaGarantia', '$ativo', '$fabrica')";
                }else{
                    $sql_insert = "UPDATE produto SET referencia = '$novaReferencia', descricao = '$novaDesc', garantia = '$novaGarantia', ativo = '$ativo', fabrica = '$fabrica' WHERE produto = $produto";
                }
                $res_insert = pg_query($con, $sql_insert);
                // echo pg_last_error($con); echo nl2br($sql_insert); exit;
                if(strlen(pg_last_error($con)) == 0){
                    $mensagem = "Produto cadastrado com sucesso!";
                    $referencia = "";
                    $descricao = "";
                    $garantia = "";
                    $ativo = "";
                    $produto = "";
                }else{
                    $mensagem = "Falha ao cadastrar produto.";
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
    <title>Cadastro de produtos</title>
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
        var msg4 = "";
        var referencia = document.getElementById("referencia");
        var desc = document.getElementById("desc");
        var garantia = document.getElementById("garantia");
        var fabrica = document.getElementById("fabrica");

        if (referencia.value == "") {
            referencia.classList.add("error");
            msg1 = "O campo referência não pode ficar vazio!\n";  
        }else {
            referencia.classList.remove("error");
        }
        if (desc.value == "") {
            desc.classList.add("error");
            msg2 = "O campo descrição não pode ficar vazio!\n";
        }else {
            desc.classList.remove("error");
        }
        if (garantia.value == ""){
            garantia.classList.add("error");
            msg3 = "O campo garantia não pode ficar vazio!\n";

        }else{
            garantia.classList.remove("error");
        }
        if (fabrica.value == ""){
            fabrica.classList.add("error");
            msg4 = "O campo fábrica não pode ficar vazio!\n";
        }else{
            fabrica.classList.remove("error");
        }
        if (msg1 == "" || msg2 == "" || msg3 == "" || msg4 == "") {
            $("#msg-erro1").text(msg1);
            $("#msg-erro2").text(msg2);
            $("#msg-erro3").text(msg3);
            $("#msg-erro4").text(msg4);
        }else {
            $("#msg-erro1").text(msg1).show();
            $("#msg-erro2").text(msg2).show();
            $("#msg-erro3").text(msg3).show();
            $("#msg-erro4").text(msg4).show();
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
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="panel panel-default panel-login">
                <div class="panel-heading text-center">
                    Cadastrar Produto
                </div>
                <div class="panel-body">
                    <form action="<?php echo $_SERVER['PHP-SELF'];?>" onsubmit="validateForm()" method="POST" class="form">
                        <label for="referencia">Referência:</label><label class="required">*</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-option-vertical"></i>
                            </span>
                        <input type="text" name="referencia" placeholder="Número de referência" class="form-control" maxlength=10 id="referencia" value="<?= $referencia; ?>">
                        </div>
                        <div class="msg_erro alert alert-danger" id="msg-erro1" style="display:none" <?= !empty($mensagem) ? "" : 'style="display:none"'?>></div>
                        <br>
                        <label for="desc">Descrição:</label><label class="required">*</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-list-alt"></i>
                            </span>
                        <input type="text" name="desc" placeholder="Ex.: Midea, 12kg, 220v" class="form-control" maxlenght=50 id="desc" value="<?= $descricao; ?>">
                        </div>
                        <div class="msg_erro alert alert-danger" id="msg-erro2" style="display:none" <?= !empty($mensagem) ? "" : 'style="display:none"'?>></div>
                        <br>
                        <label for="garantia">Tempo de Garantia:</label><label class="required">*</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-calendar"></i>
                            </span>                    
                        <input type="text" name="garantia" placeholder="Tempo de garantia (em meses)" class="form-control" id="garantia" value="<?=$garantia;?>">
                        </div>
                        <div class="msg_erro alert alert-danger" id="msg-erro3" style="display:none" <?= !empty($mensagem) ? "" : 'style="display:none"'?>></div>
                        <br>
                        <label for="fabrica">Fábrica:</label><label class="required">*</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-option-vertical"></i>
                            </span>
                        <input type="text" name="nome_fabrica" placeholder="Clique no botão pesquisar para selecionar" class="nome_fabrica form-control" maxlength=50 id="fabrica" value="<?= $nomeFabrica; ?>"><span class="pesquisar input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
                        </div>
                        <div class="msg_erro alert alert-danger" id="msg-erro4" style="display:none" <?= !empty($mensagem) ? "" : 'style="display:none"'?>></div>
                        <br>
                        <div class="active-product text-center">
                            <input type="checkbox" name="check" <?= ($ativo =='ativo') ? "   checked":"";?> value="t"> O produto está ativo
                        </div>
                        <br>
                        <input type="hidden" name="fabrica" class="fabrica" value="<?= $fabrica; ?>">
                        <input type="hidden" name="produto" value="<?= $produto; ?>">      
                        <div class="text-center">
                            <button name ="btncriar" type="submit" onclick="validateForm()" class="btn btn-primary">Cadastrar</button>
                        </div>
                        <br>
                        <div class="panel-footer text-center"><?= $mensagem ?></div>
                    </form> 
            </div>  
        </div>
    

    
    
  <?php
    $sql = "SELECT produto.*, fabrica.* FROM produto JOIN fabrica ON produto.fabrica = fabrica.fabrica";
    $res = pg_query($con, $sql);
    if(pg_num_rows($res) == 0){
        $alert = "Aviso! Não exitem registros cadastrados."; ?>
        <div class="alerta alert alert-warning alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong><?= $alert ?></strong>
        </div>
    <?php }
    if (pg_num_rows($res) > 0){
    ?>
    <div class="row">
    <div class="container">
    <table id= "produto" class="table table-striped table-bordered table-hover table-responsive table-fixed">
      <th>
        <tr class="titulo_coluna">
          <th>Referência</th>
          <th>Descrição</th>
          <th>Garantia</th>
          <th>Status</th>
          <th>Fábrica</th>
          <th>Ação</th>
        </tr>
      </th>
      <tbody>
        <?php 
          for ($i = 0; $i < pg_num_rows($res); $i ++){
            $produto = pg_fetch_result($res, $i, 'produto');
            $referencia = pg_fetch_result($res, $i, 'referencia');
            $descricao = pg_fetch_result($res, $i, 'descricao');
            $garantia = pg_fetch_result($res, $i, 'garantia');
            $ativo = pg_fetch_result($res, $i, 'ativo');
            $ativo = ($ativo == "t") ? "Ativo": "Inativo";
            $fabrica = pg_fetch_result($res, $i, 'fabrica');
            $nomeFabrica = pg_fetch_result($res, $i, 'nome');
        ?>
        <tr>
            <td class="tac"><?= $referencia;?></td>
            <td class="tac"><?= $descricao;?></td>
            <td class="tac"><?= $garantia;?></td>
            <td class="tac"><?= $ativo;?></td>
            <td class="tac"><?= $nomeFabrica ?></td>
            <td class="tac"><a href="cadastro_produtos.php?produto=<?=$produto;?>"><button class="btn btn-primary">Editar</a></button></td>
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