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
    $novoSobrenome = $_POST['sobrenome'];
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
                $mensagem = "Cadastro realizado com sucesso!";
                $nome = $novoNome;
                $senha = $novaSenha;            
                $email = $novoEmail;
                $sql_insert = "INSERT INTO usuario (nome, email, senha) VALUES ('$nome', '$email', '$senha')";
                $res_insert = pg_query($con, $sql_insert);
            }
        }
        else{
            $erro = "$novoEmail não é um email válido.";
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
    <title>Cadastre-se</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="assets/sistema.css">
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
</head>
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
                    <form method="POST" action="" class="form">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-user"></i>
                            </span>
                        <input type="text" name="nome" placeholder="Nome" class="form-control" maxlenght=50>
                        </div>
                        <br>
                        <!-- <div class="input-group">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-user"></i>
                            </span>
                        <input type="text" name="sobrenome" placeholder="Sobrenome" class="form-control">
                        </div>
                        <br> -->
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-envelope"></i>
                            </span>
                        <input type="text" name="email" placeholder="E-mail" class="form-control" maxlength=50>
                        </div>
                        <br>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-lock"></i>
                            </span>                    
                        <input type="password" name="senha" placeholder="Senha" class="form-control" maxlength=50>
                        </div>
                        <br>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-lock"></i>
                            </span>                    
                        <input type="password" name="confirmaSenha" placeholder="Confirmar senha" class="form-control" maxlenght=50>
                        </div>
                        <br>                    
                        <div class="text-center">
                            <button type="submit" name= "btncriar" class="btn btncriar btn-primary">Cadastrar</button>
                        </div>
                        <br>
                        <p class="link">Já possui conta? <a href="index.php">Fazer login</a></p>
                        
                    </form>
                    
                </div>
                <div class="panel-footer text-center"><?= $erro . $suc ?></div>
        </div>
        <div class="col-md-4"></div>
    </div>
    
</body>
</html>