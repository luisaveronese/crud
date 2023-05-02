<?php
function data ($data) {
    $invertedData = array_reverse (explode("/", $data));
    return implode ("-", $invertedData);
}
if(isset($_POST['email']) && isset($_POST['senha'])){
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    
    
    // if(strlen(trim($email)) == 0) {
    //     header("location:index.php?msg=erro_dados");  
    // }
    // if(strlen(trim($email)) == 0) {
    //     header("location:index.php?msg=erro_dados");  
    // }
    //   if($email == 'admin@gmail.com' && $senha == '123') {
    //       header("location:sistema.php");
    //   }
      if (strlen(trim($msg))==0){
        $sql = "SELECT * FROM usuario WHERE email= '$email' and senha='$senha'";
        $res = pg_query($con, $sql);

        if(pg_num_row($res)==0){
            $_SESSION['logado'] = true;
            header("location:sistema.php"); 
        }else{
            $erro = true;
            $msg = "verifique os campos corretamente.";
        }
      }
      else{
          header("location:index.php?msg=erro_login");
      }
  }else{
      header("location:index.php?msg=erro_dados");
}
?>