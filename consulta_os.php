<?php 
session_start();
include "include/conexao.php";
include "include/navbar.php";
function converterDataBanco($dataCompra) {
  $data1 = date('d/m/Y', strtotime($dataCompra));
  return $data1;
}
function converterDataBanco1($dataAbertura) {
  $data = date('d/m/Y', strtotime($dataAbertura));
  return $data;
}
function converterData($data){
  $array = explode(" ", $data);

  if(count($array) == 2){
      $dataInvertida = array_reverse(explode("/", $array[0]));
      $dataFormatada = implode("-",$dataInvertida);
    
      $horaFormatada = date('H:i:s', strtotime($array[1]));
      $dataHora = $dataFormatada . ' ' . $horaFormatada;
      return $dataHora;
  }else{
      $dataInvertida = array_reverse(explode("/", $data));
      return $dataFormatada = implode("-",$dataInvertida);
  }
}
if (isset($_POST['buscar'])) {
  $nome = $_POST['nome'];
  $notaFiscal = $_POST['nf'];
  $ns = $_POST['ns'];
  $tipo_data = $_POST['tipo_data'];
  $dataInicio = $_POST['data_inicio'];
  $dataFim = $_POST['data_fim'];
  $dataInicioConvertida = converterData($dataInicio);
  $dataFimConvertida = converterData($dataFim);
  $cond = '';
  $msg = '';
  $numResultados = '';
  if (strlen($nome) > 0) {
    $cond .= "os.nome_consumidor = '$nome' AND ";
  }
  if (strlen($notaFiscal) > 0) {
    $cond .= "os.nota_fiscal = '$notaFiscal' AND ";
  }
  if (strlen($ns) > 0) {
    $cond .= "os.numero_serie = '$ns' AND ";
  }
  if (strlen($tipo_data) > 0){
    $cond .= "os.$tipo_data BETWEEN '$dataInicioConvertida' AND '$dataFimConvertida' AND ";
  }
  $cond = rtrim($cond, 'AND ');
  $where = !empty($cond) ? "WHERE $cond and fabrica = {$_SESSION['fabrica']}" : "";
  $sql =  "SELECT os.*, produto.* FROM os
  LEFT JOIN produto ON os.produto = produto.produto
  $where";
  $res = pg_query($con, $sql);
  // echo $tipo_data; echo pg_last_error($con); exit;
  for ($i = 0; $i < pg_num_rows($res); $i ++){
    
    $os = pg_fetch_result($res, $i, 'os');
    $produto = pg_fetch_result($res, $i, 'produto');
    $dataAbertura = pg_fetch_result($res, $i, 'data_abertura');
    $nf = pg_fetch_result($res, $i, 'nota_fiscal');
    $dataCompra = pg_fetch_result($res, $i, 'data_compra');
    $aparencia = pg_fetch_result($res, $i, 'aparencia');
    $acessorios = pg_fetch_result($res, $i, 'acessorio');
    $nome = pg_fetch_result($res, $i, 'nome_consumidor');
    $cpf = pg_fetch_result($res, $i, 'cpf_cnpj');
    $cep = pg_fetch_result($res, $i, 'cep_consumidor');
    $estado = pg_fetch_result($res, $i, 'estado_consumidor');
    $cidade = pg_fetch_result($res, $i, 'cidade_consumidor');
    $bairro = pg_fetch_result($res, $i, 'bairro_consumidor');
    $endereco = pg_fetch_result($res, $i, 'endereco_consumidor');
    $numero = pg_fetch_result($res, $i, 'numero_consumidor');
    $telefone = pg_fetch_result($res, $i, 'telefone_consumidor');
    $celular = pg_fetch_result($res, $i, 'celular_consumidor');
    $email = pg_fetch_result($res, $i, 'email_consumidor');
    $numeroSerie = pg_fetch_result($res, $i, 'numero_serie');
    $referencia = pg_fetch_result($res, $i, 'referencia');
    $descricao = pg_fetch_result($res, $i, 'descricao');
    $defeito = pg_fetch_result($res, $i, 'defeito');
    $tipoAtendimento = pg_fetch_result($res, $i, 'tipo_atendimento');
    $complemento = pg_fetch_result($res, $i, 'complemento');
    $fabrica = pg_fetch_result($res, $i, 'fabrica');
    $_SESSION['fabrica'] = $fabrica;
    
}

}
?>
<!DOCTYPE html>
<html lang="en">
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta OS</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="assets/sistema.css">
    <link rel="stylesheet" href="bootstrap/css/shadowbox.css" >
    <link rel="stylesheet" href="assets/table.css">
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin=retornaProduto
retornaProduto="anonymous"></script>
    <script src="bootstrap/js/shadowbox.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>$('.data').mask('00/00/0000');</script>
</head>
<body>
  <div class="row">
        <div class="col-md-4">
        </div>
        <div class="col-md-4">
            <div class="panel panel-default panel-login">
                <div class="panel-heading text-center">
                    Procurar OS existente
                </div>
                <div class="panel-body">
                    <form action="" method="POST" class="form">
                    <label for="codigo">Nome</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-user"></i>
                            </span>
                        <input type="text" name="nome" placeholder="Digite seu nome completo" class="form-control" id="nome" value="<?= $nome ?>">
                        </div>
                        <br>
                        <label for="nf">Nota Fiscal</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-list-alt"></i>
                            </span>
                        <input type="text" name="nf" placeholder="Digite a nota fiscal" class="form-control" id="nf" value="<?= $nf?>">
                        </div>
                        <br>      
                        <label for="ns">Número de Série</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-list-alt"></i>
                            </span>
                        <input type="text" name="ns" placeholder="Digite o número de série" class="form-control" id="ns">
                        </div>
                        <br>             
                          <input type="radio" name="tipo_data" id="option1" value="<?= $dataAbertura ?>"> Data de Abertura
                          <br>
                          <input type="radio" name="tipo_data" id="option2"> Data de Digitação
                          <br>
                          <input type="radio" name="tipo_data" id="option3"> Data de Fechamento
                          <br>
                          <br>
                          <label for="date">Data de início:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-calendar"></i>
                            </span>
                        <input id="date" type="text" name="data_inicio" placeholder="Data de início" class="data form-control" value="<?= $dataInicio ?>">
                        </div>
                        <br>
                        <label for="data">Data de Finalização:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-calendar"></i>
                            </span>
                        <input id="data" type="text" name="data_fim" placeholder="Data de finalização" class="data form-control" value="<?= $dataFim ?>">
                        </div>
                        <br>
                        <div class="text-center">
                            <button name="buscar" type="submit" class="btn btn-primary">Buscar</button>
                        </div>
                        <br>
                      </div>
                      <div class="panel-footer text-center"><?= $msg ?></div>
                    </form>
                </div>
                
            </div>
        </div>
        </div>
        <?php
        
    if (isset($_POST['buscar'])){
      if(pg_num_rows($res) == 0){
        $alert = "Aviso! Não exitem registros cadastrados com essas informações."; ?>
        <div class="alert alert-warning alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong><?= $alert ?></strong>
        </div>
    <?php }
      if( pg_num_rows($res) > 0){
    ?>
    <div class="row">
    <div class="container table-responsive">
    <table id= "consulta" class="table table-striped table-bordered table-hover table-large">
      <thead>
        <tr class="titulo_coluna">
          <th>Código</th>
          <th>Data de Abertura</th>
          <th>Nota Fiscal</th>
          <th>Tipo de Atendimento</th>
          <th>Data de Compra</th>
          <th>Aparência</th>
          <th>Acessório</th>
          <th>Nome</th>
          <th>CPF/CNPJ</th>
          <th>CEP</th>
          <th>Estado</th>
          <th>Cidade</th>
          <th>Bairro</th>
          <th>Endereço</th>
          <th>Número</th>
          <th>Complemento</th>
          <th>Telefone</th>
          <th>Celular</th>
          <th>E-mail</th>
          <th>Número de Série</th>
          <th>Referência</th>
          <th>Descrição</th>
          <th>Defeito</th>
          </tr>
          </thead>
          <tbody>
          <?php 
          for ($i = 0; $i < pg_num_rows($res); $i ++) {
              $os = pg_fetch_result($res, $i, 'os');
              $produto = pg_fetch_result($res, $i, 'produto');
              $dataAbertura = pg_fetch_result($res, $i, 'data_abertura');
              $dataAberturaBanco = converterDataBanco1($dataAbertura);
              $nf = pg_fetch_result($res, $i, 'nota_fiscal');
              $dataCompra = pg_fetch_result($res, $i, 'data_compra');
              $dataCompraBanco = converterDataBanco($dataCompra);
              $aparencia = pg_fetch_result($res, $i, 'aparencia');
              $acessorios = pg_fetch_result($res, $i, 'acessorio');
              $nome = pg_fetch_result($res, $i, 'nome_consumidor');
              $cpf = pg_fetch_result($res, $i, 'cpf_cnpj');
              $cep = pg_fetch_result($res, $i, 'cep_consumidor');
              $estado = pg_fetch_result($res, $i, 'estado_consumidor');
              $cidade = pg_fetch_result($res, $i, 'cidade_consumidor');
              $bairro = pg_fetch_result($res, $i, 'bairro_consumidor');
              $endereco = pg_fetch_result($res, $i, 'endereco_consumidor');
              $numero = pg_fetch_result($res, $i, 'numero_consumidor');
              $telefone = pg_fetch_result($res, $i, 'telefone_consumidor');
              $celular = pg_fetch_result($res, $i, 'celular_consumidor');
              $email = pg_fetch_result($res, $i, 'email_consumidor');
              $numeroSerie = pg_fetch_result($res, $i, 'numero_serie');
              $referencia = pg_fetch_result($res, $i, 'referencia');
              $descricao = pg_fetch_result($res, $i, 'descricao');
              $defeito = pg_fetch_result($res, $i, 'defeito');
              $atendimento = pg_fetch_result($res, $i, 'tipo_atendimento');
              $complemento = pg_fetch_result($res, $i, 'complemento');
          ?>
          <tr>
            <td class="tac"><?= $os;?></td>
            <td class="tac"><?= $dataAbertura;?></td>
            <td class="tac"><?= $nf;?></td>
            <td class="tac"><?= $atendimento;?></td>
            <td class="tac"><?= $dataCompra;?></td>
            <td class="tac"><?= $aparencia;?></td>
            <td class="tac"><?= $acessorios;?></td>
            <td class="tac"><?= $nome;?></td>
            <td class="tac"><?= $cpf;?></td>
            <td class="tac"><?= $cep;?></td>
            <td class="tac"><?= $estado;?></td>
            <td class="tac"><?= $cidade;?></td>
            <td class="tac"><?= $bairro;?></td>
            <td class="tac"><?= $endereco;?></td>
            <td class="tac"><?= $numero;?></td>
            <td class="tac"><?= $complemento;?></td>
            <td class="tac"><?= $telefone;?></td>
            <td class="tac"><?= $celular;?></td>
            <td class="tac"><?= $email;?></td>
            <td class="tac"><?= $numeroSerie;?></td>
            <td class="tac"><?= $referencia;?></td>
            <td class="tac"><?= $descricao;?></td>
            <td class="tac"><?= $defeito;?></td>
            <td class="tac"><a href="cadastro_os.php?os=<?= $os ?>"><button class="btn btn-primary">Editar</a></button></td>
          </tr>
          <?php 
          }
          ?>
          </tbody>
          </table>
          <?php 
          } else {
              $msg = "Nenhuma OS encontrada.";
          }
        }
          ?>
          </div>
          <div class="col-md-4"></div>
          </div>  
        </div>

</body>
</html>