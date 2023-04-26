<?php 
function data ($data) {
    $invertedData = array_reverse (explode("/", $data));
    return implode ("-", $invertedData);
}


include "include/conexao.php";





session_start();
    if (isset($_POST['btncriar'])) {
        $email= $_POST['email'];
        $senha = $_POST['senha'];
        $mensagem;

        if (empty($email)){
            $erro = true;
            $mensagem .= " Campo email é obrigatório ";
        }
        
        if (empty($senha) or strlen($senha) < 9){
            $erro = true;
            $mensagem .= " Campo senha inválido ";
        }
        if(strlen(trim($mensagem))==0){
            $sql = "SELECT * FROM usuario WHERE email = '$email' and senha= '$senha'";
            $res = pg_query($con, $sql);

            if(pg_num_rows($res)==1){
                $_SESSION['logado'] = true;
                header("location:sistema.php");
            }else{
                $erro = true;
                $mensagem = "Verifique os campos corretamente";
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
    <title>Formulário de Login</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/style.css">
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
                    Login
                </div>
                <div class="panel-body">
                    <form action="<?php echo $_SERVER['PHP-SELF'];?>" method="POST" class="form">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-envelope"></i>
                            </span>
                        <input type="text" name="email" placeholder="E-mail" class="form-control">
                        </div>
                        <br>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-lock"></i>
                            </span>                    
                        <input type="password" name="senha" placeholder="Senha" class="form-control">
                        </div>
                        <br>                    
                        <div class="text-center">
                            <button name="btncriar" type="submit" class="btn btn-primary">Entrar</button>
                        </div>
                        <br>
                        <p class="link">Ainda não tem conta? <a href="cadastro.php">Cadastre-se</a></p>
                    </form>
                </div>  
                    <div class="panel-footer text-center" > <?= $mensagem ?> </div>
            </div>
        </div>
        <div class="col-md-4"></div>
</body>
</html>