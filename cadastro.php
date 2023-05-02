<?php
include "include/conexao.php";
if(isset($_POST["btncriar"]))
{   
    $mensagem = '';
    $erro = False;
    $contaValidada = True;
    $senhaValidada = True;
    $novoEmail = $_POST['email'];
    $novaSenha = $_POST['senha'];
    $confirmaSenha = $_POST['confirmaSenha'];
    $novoNome = $_POST['nome'];
    $nomeFabrica = $_POST['nome_fabrica'];
    $fabrica = (int)$_GET['fabrica'];
    if(empty($novoNome)){
            $erro = "O campo Nome não pode ficar vazio!";
            $contaValidada = False;
        }
    elseif(empty($novoEmail)){
        $erro = "O campo Email não pode ficar vazio!";
    }else{
        $emailVerificado = filter_var($novoEmail, FILTER_SANITIZE_EMAIL);
        if (filter_var($emailVerificado, FILTER_VALIDATE_EMAIL)) {   
            if(strlen(trim($novaSenha)) < 8)
            {
                $mensagem = "A senha deve ter, no mínimo, 8 caracteres.";
                $erro = True;
                $senhaValidada = False;
                $contaValidada = False;
            }
            elseif($novaSenha != $confirmaSenha){
                $erro = True;
                $mensagem = "Senhas não coincidem.";
                $senhaValidada = False;
                $contaValidada = False;
            }
            if(empty($novaSenha))
            {
                $mensagem = "O campo Senha não pode ficar vazio!";
                $erro = True;
                $senhaValidada = False;
                $contaValidada = False;
            }
            if(strlen($novoNome) > 50){
                $erro = True;
                $senhaValidada = False;
                $contaValidada = False;
                $mensagem = "O campo Nome excedeu o número máximo de caracteres, por favor, tente novamente.";
            }
            if(strlen($novaSenha) > 50){
                $erro = True;
                $senhaValidada = False;
                $contaValidada = False;
                $mensagem = "O campo Senha excedeu o número máximo de caracteres, por favor, tente novamente.";
            }
            if(strlen($novoEmail) > 50){
                $erro = True;
                $senhaValidada = False;
                $contaValidada = False;
                $mensagem = "O campo Email excedeu o número máximo de caracteres, por favor, tente novamente.";
            }
            if($senhaValidada == True && $contaValidada == True){
                $sql_insert = "INSERT INTO usuario (nome, email, senha, fabrica) VALUES ('$novoNome', '$novoEmail', '$novaSenha', '$fabrica')";
                $res_insert = pg_query($con, $sql_insert);
                if(strlen(pg_last_error($con)) == 0){
                    $mensagem = "Cadastro realizado com sucesso!";
                }else{
                    $mensagem = "Falha ao realizar cadastro.";
                }
            }
        }
        else{
            $mensagem = "$novoEmail não é um email válido.";
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
    <title>Cadastro OS</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/style.css">
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
    console.log("cheguei");
        var msg1 = "";
        var msg2 = "";
        var msg3 = "";
        var msg4 = "";
        var msg5 = "";
        var msg6 = "";
        var nome = document.getElementById("nome");
        var email = document.getElementById("email");
        var nome_fabrica = document.getElementById("nome_fabrica");
        var senha = document.getElementById("senha");
        var confirma_senha = document.getElementById("confirma_senha");

        if (nome.value == "") {
            nome.classList.add("error");
            msg1 = "O campo código não pode ficar vazio!\n";  
        }else {
            nome.classList.remove("error");
        }
        if (email.value == "") {
            email.classList.add("error");
            msg2 = "O campo e-mail não pode ficar vazio!\n";
        }else {
            email.classList.remove("error");
        }
        if (nome_fabrica.value == ""){
            nome_fabrica.classList.add("error");
            msg3 = "O campo fábrica não pode ficar vazio!\n";
        }else{
            nome_fabrica.classList.remove("error");
        }
        if (senha.value == ""){
            senha.classList.add("error");
            msg4 = "O campo senha não pode ficar vazio!\n";
        }else{
            senha.classList.remove("error");
        }
        if (confirma_senha.value == ""){
            confirma_senha.classList.add("error");
            msg5 = "O campo confirmar senha não pode ficar vazio!\n";
        }else{
            confirma_senha.classList.remove("error");
        }
        if (senha.value != confirma_senha){
            confirma_senha.classList.add("error");
            msg6 = "As senhas não coincidem. \n";
        }else{
            confirma_senha.classList.remove("error");
        }
        if (msg1 == "" && msg2 == "" && msg3 == "" && msg4 == "" && msg5 == "" && msg6 == "") {
            $("#msg-erro1").text(msg1);
            $("#msg-erro2").text(msg2);
            $("#msg-erro3").text(msg3);
            $("#msg-erro4").text(msg4);
            $("#msg-erro5").text(msg5);
            $("#msg-erro6").text(msg6);
        }else {
            $("#msg-erro1").text(msg1).show();
            $("#msg-erro2").text(msg2).show();
            $("#msg-erro3").text(msg3).show();
            $("#msg-erro4").text(msg4).show();
            $("#msg-erro5").text(msg5).show();
            $("#msg-erro6").text(msg6).show();
            document.querySelector('form').addEventListener('submit', function(event) {
            event.preventDefault()});
        }
    };

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
    <div class="navbar">
        <a><img alt="Brand" src="assets/logo.png" width= "100px"></a> 
    </div>
        <div class="col-md-4">
        </div>
        <div class="col-md-4">
            <div class="panel panel-default panel-login">
                <div class="panel-heading text-center">
                    Cadastro
                </div>
                <div class="panel-body">
                    <form method="POST" action="<?php echo $_SERVER['PHP-SELF'];?>" onsubmit="validateForm()" class="form">
                    <label for="nome">Nome completo:</label><label class="required">*</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-user"></i>
                            </span>
                        <input type="text" name="nome" id="nome" placeholder="ex.: José da Silva" class="form-control" maxlenght=50>
                        </div>
                        <div class="msg_erro alert alert-danger" id="msg-erro1" style="display:none" <?= !empty($mensagem) ? "" : 'style="display:none"'?>></div>
                        <br>
                        <label for="email">Email:</label><label class="required">*</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-envelope"></i>
                            </span>
                        <input type="text" name="email" id="email" placeholder="exemplo@gmail.com" class="form-control" maxlength=50>
                        </div>
                        <div class="msg_erro alert alert-danger" id="msg-erro2" style="display:none" <?= !empty($mensagem) ? "" : 'style="display:none"'?>></div>
                        <br>
                        <label for="nome_fabrica">Fábrica:</label><label class="required">*</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-compressed"></i>
                            </span>
                        <input type="text" name="nome_fabrica" placeholder="Ex.: Makita" class="form-control nome_fabrica" id="nome_fabrica" value="<?= $nome_fabrica; ?>"><span class="pesquisar input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
                        </div>
                        <div class="msg_erro alert alert-danger" id="msg-erro3" style="display:none" <?= !empty($mensagem) ? "" : 'style="display:none"'?>></div>
                        <input type="hidden" class="fabrica" name="fabrica" value="<?= $fabrica ?>">
                        <br>
                        <label for="senha">Senha:</label><label class="required">*</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-lock"></i>
                            </span>                    
                        <input type="password" name="senha" id="senha" placeholder="Senha" class="form-control" maxlength=50>
                        </div>
                        <div class="msg_erro alert alert-danger" id="msg-erro4" style="display:none" <?= !empty($mensagem) ? "" : 'style="display:none"'?>></div>
                        <br>
                        <label for="confirma_senha">Confirmar Senha:</label><label class="required">*</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-lock"></i>
                            </span>                    
                        <input type="password" name="confirmaSenha" id="confirma_senha" placeholder="Confirmar senha" class="form-control" maxlenght=50>
                        </div>
                        <div class="msg_erro alert alert-danger" id="msg-erro5" style="display:none" <?= !empty($mensagem) ? "" : 'style="display:none"'?>></div>
                        <div class="msg_erro alert alert-danger" id="msg-erro6" style="display:none" <?= !empty($mensagem) ? "" : 'style="display:none"'?>></div>
                        <br>                    
                        <div class="text-center">
                            <button type="submit" name= "btncriar" onclick="validateForm()" class="btn btncriar btn-primary">Cadastrar</button>
                        </div>
                        <br>
                        <p class="link">Já possui conta? <a href="index.php">Fazer login</a></p>
                        
                    </form>
                    
                </div>
                <div class="panel-footer text-center"><?= $mensagem ?></div>
        </div>
        <div class="col-md-4"></div>
    </div>
    
</body>
</html>