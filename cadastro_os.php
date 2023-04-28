<?php
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
if(isset($_GET['os'])){
    $os = (int)$_GET['os'];
    $produto = (int)$_GET['produto'];
    $sql = "SELECT * FROM os WHERE os = $os";
    $res = pg_query($con, $sql);
    if(pg_num_rows($res) > 0){
        $os = pg_fetch_result($res, $i, 'os');
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
        $defeito = pg_fetch_result($res, $i, 'defeito');
        $referencia = pg_fetch_result($res, $i, 'referencia');
        $descricao = pg_fetch_result($res, $i, 'descricao');
        $tipo_atendimento = pg_fetch_result($res, $i, 'tipo_atendimento');
        $complemento = pg_fetch_result($res, $i, 'complemento');
    }
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


if(isset($_POST["btngravar"])) {
    $msg = '';
    $cadastroOsValidado = true;
    $erro = false;

    $novaData1 = trim($_POST['data']);
    $dataAberturaConvertida = converterData($novaData1);
    
    $novaData2 = trim($_POST['date']);
    $dataCompraConvertida = converterData($novaData2);

    $novaNf = $_POST['NF'];
    if(strlen($novaNf) > 10) {
        $erro = true;
        $msg = "O campo Nota Fiscal excedeu o número máximo de caracteres, por favor, tente novamente.";
    }
    
    $novaAparencia = $_POST['aparencia'];
    if(strlen($novaAparencia) > 50) {
        $erro = true;
        $msg = "O campo Aparência excedeu o número máximo de caracteres, por favor, tente novamente.";
    }
    
    $novoAcessorio = $_POST['acessorios'];
    if(strlen($novoAcessorio) > 50) {
        $erro = true;
        $msg = "O campo Acessórios excedeu o número máximo de caracteres, por favor, tente novamente.";
    }

    $novoNome = $_POST['nome'];
    if(strlen($novoNome) > 50) {
        $erro = true;
        $msg = "O campo Nome excedeu o número máximo de caracteres, por favor, tente novamente.";
    }
    $novoCpf = $_POST['cpf_cnpj'];
    if(strlen($novoCpf) > 14){
        $erro = true;
        $msg = "O campo CPF ou CNPJ excedeu o número máximo de caracteres, por favor, tente novamente.";
    }
    $novoCep = $_POST['cep'];
    if(strlen($novoCep) > 10){
        $erro = true;
        $msg = "O campo CEP excedeu o número máximo de caracteres, por favor, tente novamente.";
    }
    $novoEstado = $_POST['estado'];
    if(strlen($novoEstado) > 2){
        $erro = true;
        $msg = "O campo Estado excedeu o número máximo de caracteres, por favor, tente novamente.";
    }
    $novaCidade = $_POST['cidade'];
    if(strlen($novaCidade) > 50){
        $erro = true;
        $msg = "O campo Cidade excedeu o número máximo de caracteres, por favor, tente novamente.";
    }
    $novoEndereco = $_POST['endereco'];
    if(strlen($novoEndereco) > 50){
        $erro = true;
        $msg = "O campo Endereço excedeu o número máximo de caracteres, por favor, tente novamente.";
    }
    $novoNumero = $_POST['numero'];
    if(strlen($novoNumero) > 10){
        $erro = true;
        $msg = "O campo Número excedeu o número máximo de caracteres, por favor, tente novamente.";
    }
    $novoTelefone = $_POST['telefone'];
    if(strlen($novoTelefone) > 10){
        $erro = true;
        $msg = "O campo Telefone excedeu o número máximo de caracteres, por favor, tente novamente.";
    }
    $novoCelular = $_POST['celular'];
    if(strlen($novoCelular) > 11){
        $erro = true;
        $msg = "O campo Celular excedeu o número máximo de caracteres, por favor, tente novamente.";
    }
    $novoEmail = $_POST['email'];
    if(strlen($novoEmail) > 50){
        $erro = true;
        $msg = "O campo Email excedeu o número máximo de caracteres, por favor, tente novamente.";
    }
    $novaReferencia = $_POST['referencia'];
    if(strlen($novaReferencia) > 10){
        $erro = true;
        $msg = "O campo Referência excedeu o número máximo de caracteres, por favor, tente novamente.";
    }
    $novaDesc = $_POST['desc'];
    if(strlen($novaDesc) > 50){
        $erro = true;
        $msg = "O campo Descrição excedeu o número máximo de caracteres, por favor, tente novamente.";
    }
    $novoDefeito = $_POST['defeito'];
    $novoNumSerie = $_POST['numero_serie'];
    if(strlen($novoNumSerie) > 50){
        $erro = true;
        $msg = "O campo Número de Série excedeu o número máximo de caracteres, por favor, tente novamente,";
    }
    $novoBairro = $_POST['bairro'];
    if(strlen($novoBairro) > 50){
        $erro = true;
        $msg = "O campo Bairro excedeu o número máximo de caracteres, por favor, tente novamente.";
    }
    $novoComplemento = $_POST['complemento'];
    if(strlen($novoComplemento) > 40){
        $erro = true;
        $msg = "O campo Complemento excedeu o número máximo de caracteres, por favor, tente novamente.";
    }
    $novoAtendimento = $_POST['tipo_atendimento'];
    $os = (int)$_GET['os'];

    if($erro == false){
        if(empty($novoEmail)){
            $erro = true;
            $cadastroOsValidado = false;
            $msg = "O campo E-mail não pode ficar vazio!";
        }else{
    
            $emailVerificado = filter_var($novoEmail, FILTER_VALIDATE_EMAIL);
            $nfSanitizada = filter_var($novaNf, FILTER_SANITIZE_SPECIAL_CHARS);
            $aparenciaSanitizada = filter_var($novaAparencia, FILTER_SANITIZE_SPECIAL_CHARS);
            $acessorioSanitizado = filter_var($novoAcessorio, FILTER_SANITIZE_SPECIAL_CHARS);
            $nomeSanitizado = filter_var($novoNome, FILTER_SANITIZE_SPECIAL_CHARS);
            $cpfSanitizado = filter_var($novoCpf, FILTER_SANITIZE_SPECIAL_CHARS);
            $cepSanitizado = filter_var($novoCep, FILTER_SANITIZE_SPECIAL_CHARS);
            $estadoSanitizado = filter_var($novoEstado, FILTER_SANITIZE_SPECIAL_CHARS);
            $cidadeSanitizada = filter_var($novaCidade, FILTER_SANITIZE_SPECIAL_CHARS);
            $enderecoSanitizado = filter_var($novoEndereco, FILTER_SANITIZE_SPECIAL_CHARS);
            $numeroSanitizado = filter_var($novoNumero, FILTER_SANITIZE_SPECIAL_CHARS);
            $telefoneSanitizado = filter_var($novoTelefone, FILTER_SANITIZE_SPECIAL_CHARS);
            $celularSanitizado = filter_var($novoCelular, FILTER_SANITIZE_SPECIAL_CHARS);
            $emailSanitizado = filter_var($novoEmail, FILTER_SANITIZE_SPECIAL_CHARS);
            $numSerieSanitizado = filter_var($novoNumSerie, FILTER_SANITIZE_SPECIAL_CHARS);
            $referenciaSanitizada = filter_var($novaReferencia, FILTER_SANITIZE_SPECIAL_CHARS);
            $descricaoSanitizada = filter_var($novaDesc, FILTER_SANITIZE_SPECIAL_CHARS);
            $defeitoSanitizado = filter_var($novoDefeito, FILTER_SANITIZE_SPECIAL_CHARS);
            $bairroSanitizado = filter_var($novoBairro, FILTER_SANITIZE_SPECIAL_CHARS);
            $complementoSanitizado = filter_var($novoComplemento, FILTER_SANITIZE_SPECIAL_CHARS);
        }
    if(empty($novaNf)){
        $erro = True;
        $cadastroOsValidado = False;
        $msg = "O campo Nota Fiscal não pode ficar vazio!";
    }
    if(empty($novaAparencia)){
        $erro = True;
        $cadastroOsValidado = False;
        $msg = "O campo Aparência não pode ficar vazio!";
    }
    if(empty($novoAcessorio)){
        $erro = True;
        $cadastroOsValidado = False;
        $msg = "O campo Acessório não pode ficar vazio!";
    }
    if(empty($novoNome)){
        $erro = True;
        $cadastroOsValidado = False;
        $msg = "O campo Nome não pode ficar vazio!";
    }
    if(empty($novoCpf)){
        $erro = True;
        $cadastroOsValidado = False;
        $msg = "O campo CPF/CNPJ não pode ficar vazio!";
    }
    if(empty($novoCep)){
        $erro = True;
        $cadastroOsValidado = False;
        $msg = "O campo CEP não pode ficar vazio!";
    }
    if(empty($novoEstado)){
        $erro = True;
        $cadastroOsValidado = False;
        $msg = "O campo Estado não pode ficar vazio!";
    }
    if(empty($novaCidade)){
        $erro = True;
        $cadastroOsValidado = False;
        $msg = "O campo Cidade não pode ficar vazio!";
    }
    if(empty($novoEndereco)){
        $erro = True;
        $cadastroOsValidado = False;
        $msg = "O campo Endereço não pode ficar vazio!";
    }
    if(empty($novoNumero)){
        $erro = True;
        $cadastroOsValidado = False;
        $msg = "O campo Número não pode ficar vazio!";
    }
    if(empty($novoTelefone)){
        $erro = True;
        $cadastroOsValidado = False;
        $msg = "O campo Telefone não pode ficar vazio!";
    }
    if(empty($novoCelular)){
        $erro = True;
        $cadastroOsValidado = False;
        $msg = "O campo Celular não pode ficar vazio!";
    }
    if(empty($novaReferencia)){
        $erro = True;
        $cadastroOsValidado = False;
        $msg = "O campo Referência não pode ficar vazio!";
    }
    if(empty($novaDesc)){
        $erro = True;
        $cadastroOsValidado = False;
        $msg = "O campo Descrição não pode ficar vazio!";
    }
    if(empty($novoNumSerie)){
        $erro = True;
        $cadastroOsValidado = False;
        $msg = "O campo Número de Série não pode ficar vazio!";
    }
    if(empty($novoBairro)){
        $erro = True;
        $cadastroOsValidado = False;
        $msg = "O campo Bairro não pode ficar vazio!";
    }
    if(empty($novoAtendimento)){
        $erro = True;
        $cadastroOsValidado = False;
        $msg = "O campo Atendimento não pode ficar vazio!";
    }
    if($erro == false && $cadastroOsValidado = True){
        if($os == 0){
           $sql_insert = "INSERT INTO os(data_abertura,
            nota_fiscal,
            data_compra,
            aparencia,
            acessorio,
            nome_consumidor,
            cpf_cnpj,
            cep_consumidor,
            estado_consumidor,
            cidade_consumidor ,
            bairro_consumidor,
            endereco_consumidor,
            numero_consumidor,
            telefone_consumidor,
            celular_consumidor,
            email_consumidor,
            numero_serie,
            defeito,
            referencia,
            descricao,
            complemento,
            tipo_atendimento) VALUES 
            ('$dataAberturaConvertida', 
            '$novaNf',
            '$dataCompraConvertida',
            '$novaAparencia',
            '$novoAcessorio',
            '$novoNome',
            '$novoCpf',
            '$novoCep',
            '$novoEstado',
            '$novaCidade',
            '$novoBairro',
            '$novoEndereco',
            '$novoNumero',
            '$novoTelefone',
            '$novoCelular',
            '$novoEmail',
            '$novoNumSerie',
            '$novoDefeito',
            '$novaReferencia',
            '$novaDesc',
            '$novoComplemento',
            '$novoAtendimento')";
             
        }else{
            $sql_insert = "UPDATE os SET 
            data_abertura = '$dataAberturaConvertida', 
            nota_fiscal = '$novaNf', 
            data_compra = '$dataCompraConvertida', 
            aparencia = '$novaAparencia', 
            acessorio = '$novoAcessorio', 
            nome_consumidor = '$novoNome', 
            cpf_cnpj = '$novoCpf', 
            cep_consumidor = '$novoCep', 
            estado_consumidor = '$novoEstado', 
            cidade_consumidor = '$novaCidade', 
            bairro_consumidor = '$novoBairro', 
            endereco_consumidor = '$novoEndereco', 
            numero_consumidor = '$novoNumero', 
            telefone_consumidor = '$novoTelefone', 
            celular_consumidor = '$novoCelular', 
            email_consumidor = '$novoEmail', 
            numero_serie = '$novoNumSerie', 
            referencia = '$novaReferencia',
            descricao = '$novaDesc',
            defeito = '$novoDefeito',
            complemento = '$novoComplemento',
            tipo_atendimento = '$novoAtendimento' 
            WHERE os = $os";
        }
        // $res_insert = pg_query($con, $sql_insert);
        // echo nl2br($res_insert); echo pg_last_error($con); exit; 
        if(strlen(pg_last_error($con)) == 0){
            $msg = "Ordem de serviço solicitada com sucesso!";
            $codigo = "";
            $dataAbertura = "";
            $nf = "";
            $dataCompra = "";
            $aparencia = "";
            $acessorios = "";
            $nome = "";
            $cpf = "";
            $cep = "";
            $estado = "";
            $cidade = "";
            $bairro = "";
            $endereco = "";
            $numero = "";
            $telefone = "";
            $celular = "";
            $email = "";
            $numeroSerie = "";
            $descricao = "";
            $referencia = "";
            $defeito = "";
            $complemento = "";
            $tipo_atendimento = "";
        }else{
            $msg = "Falha ao solicitar ordem de serviço.";
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
    <title>Cadastro OS</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="assets/sistema.css">
    <link rel="stylesheet" href="bootstrap/css/shadowbox.css" >
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin=retornaProduto
retornaProduto="anonymous"></script>
    <script src="bootstrap/js/shadowbox.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>$('#data').mask('00/00/0000');</script>
    <script>$('#date').mask('00/00/0000');</script>
    <style>
        .error {
        border: 1.2px solid red;
        }       
    </style>
    <script>
        function validateForm() {
        var msg1 = ""; // data abertura
        var msg2 = ""; // data compra
        var msg3 = ""; // aparencia
        var msg4 = ""; // acessorio
        var msg5 = ""; // nome
        var msg6 = ""; // cpf
        var msg7 = ""; // cep
        var msg8= ""; // estado
        var msg9 = ""; // cidade
        var msg10 = ""; //bairro
        var msg11 = ""; //endereco
        var msg12 = ""; // numero
        var msg13 = ""; // telefone
        var msg14 = ""; // celular
        var msg15 = ""; // email
        var msg16 = ""; // numero_serie
        var msg17 = ""; // defeito
        var msg18 = ""; // referencia
        var msg19 = ""; // descricao
        var msg20 = ""; // tipo_atendimento
        var msg21 = ""; // nota_fiscal
        var dataAbertura = document.getElementById("data");
        var notaFiscal = document.getElementById("nf");
        var dataCompra = document.getElementById("date");
        var aparencia = document.getElementById("aparencia");
        var acessorios = document.getElementById("acessorios");
        var nome = document.getElementById("nome");
        var cpf = document.getElementById("cpf");
        var cep = document.getElementById("cep");
        var estado = document.getElementById("estado");
        var cidade = document.getElementById("cidade");
        var bairro = document.getElementById("bairro");
        var endereco = document.getElementById("endereco");
        var numero = document.getElementById("numero");
        var telefone = document.getElementById("tel");
        var celular = document.getElementById("cel");
        var email = document.getElementById("email");
        var numSerie = document.getElementById("numero_serie");
        var defeito = document.getElementById("defeito");
        var desc = document.getElementById("desc");
        var atendimento = document.getElementById("tipo_atendimento");
        
        if (dataAbertura.value == ""){
            dataAbertura.classList.add("error");
            msg1 = "O campo data de abertura não pode ficar vazio!\n";
        }else{
            dataAbertura.classList.remove("error");
        }
        if (notaFiscal.value == ""){
            notaFiscal.classList.add("error");
            msg21 = "O campo nota fiscal não pode ficar vazio!\n";
        }else{
            notaFiscal.classList.remove("error");
        }
        if (dataCompra.value == ""){
            dataCompra.classList.add("error");
            msg2 = "O campo data de compra não pode ficar vazio!\n";
        }else{
            dataCompra.classList.remove("error");
        }
        if (aparencia.value == ""){
            aparencia.classList.add("error");
            msg3 = "O campo aparência não pode ficar vazio!\n";
        }else{
            aparencia.classList.remove("error");
        }
        if (acessorios.value == ""){
            acessorios.classList.add("error");
            msg4 = "O campo acessório não pode ficar vazio!\n";
        }else{
            acessorios.classList.remove("error");
        }
        if(nome.value == ""){
            nome.classList.add("error");
            msg5 = "O campo nome não pode ficar vazio!\n";
        }else{
            nome.classList.remove("error");
        }
        if(cpf.value == ""){
            cpf.classList.add("error");
            msg6 = "O campo CPF ou CNPJ não pode ficar vazio!\n";
        }else{
            cpf.classList.remove("error");
        }
        if(cep.value == ""){
            cep.classList.add("error");
            msg7 = "O campo CEP não pode ficar vazio!\n";
        }else{
            cep.classList.remove("error");
        }
        if(estado.value == ""){
            estado.classList.add("error");
            msg8 = "O campo estado não pode ficar vazio!\n";
        }else{
            estado.classList.remove("error");
        }
        if(cidade.value == ""){
            cidade.classList.add("error");
            msg9 = "O campo cidade não pode ficar vazio!\n";
        }else{
            cidade.classList.remove("error");
        }
        if(bairro.value == ""){
            bairro.classList.add("error");
            msg10 = "O campo bairro não pode ficar vazio!\n";
        }else{
            bairro.classList.remove("error");
        }
        if(endereco.value == ""){
            endereco.classList.add("error");
            msg11 = "O campo endereço não pode ficar vazio!\n";
        }else{
            endereco.classList.remove("error");
        }
        if(numero.value == ""){
            numero.classList.add("error");
            msg12 = "O campo número não pode ficar vazio!\n";
        }else{
            numero.classList.remove("error");
        }
        if(telefone.value == ""){
            telefone.classList.add("error");
            msg13 = "O campo telefone não pode ficar vazio!\n";
        }else{
            telefone.classList.remove("error");
        }
        if(celular.value == ""){
            celular.classList.add("error");
            msg14 = "O campo celular não pode ficar vazio!\n";
        }else{
            celular.classList.remove("error");
        }
        if(email.value == ""){
            email.classList.add("error");
            msg15 = "O campo email não pode ficar vazio!\n";
        }else{
            email.classList.remove("error");
        }
        if(numSerie.value == ""){
            numSerie.classList.add("error");
            msg16 = "O campo número de série não pode ficar vazio!\n";
        }else{
            numSerie.classList.remove("error");
        }
        if(defeito.value == ""){
            defeito.classList.add("error");
            msg17 = "O campo defeito não pode ficar vazio!\n";
        }else{
            defeito.classList.remove("error");
        } 
        if(referencia.value == ""){
            referencia.classList.add("error");
            msg18 = "O campo referência não pode ficar vazio!\n";
        }else{
            referencia.classList.remove("error");
        }
        if(desc.value == ""){
            desc.classList.add("error");
            msg19 = "O campo descrição não pode ficar vazio!\n";
        }else{
            desc.classList.remove("error");
        }
        if(atendimento.value == ""){
            atendimento.classList.add("error");
            msg20 = "O campo tipo de atendimento não pode ficar vazio!\n";
        }

        if (msg1 == "" && msg2 == "" && msg3 == "" && msg4 == "" && msg5 == "" && msg6 == "" && msg7 == "" && msg8 == "" && msg9 == "" && msg10 == "" && msg11 == "" && msg12 == "" && msg13 == "" && msg14 == "" && msg15 == "" && msg16 == "" && msg17 == "" && msg18 == "" && msg19 == "" && msg20 == "" && msg21 == "") {
            $("#msg-erro1").text(msg1);
            $("#msg-erro2").text(msg2);
            $("#msg-erro3").text(msg3);
            $("#msg-erro4").text(msg4);
            $("#msg-erro5").text(msg5);
            $("#msg-erro6").text(msg6);
            $("#msg-erro7").text(msg7);
            $("#msg-erro8").text(msg8);
            $("#msg-erro9").text(msg9);
            $("#msg-erro10").text(msg10);
            $("#msg-erro11").text(msg11);
            $("#msg-erro12").text(msg12);
            $("#msg-erro13").text(msg13);
            $("#msg-erro14").text(msg14);
            $("#msg-erro15").text(msg15);
            $("#msg-erro16").text(msg16);
            $("#msg-erro17").text(msg17);
            $("#msg-erro18").text(msg18);
            $("#msg-erro19").text(msg19);
            $("#msg-erro20").text(msg20);
            $("#msg-erro21").text(msg21);
        }else {
            $("#msg-erro1").text(msg1).show();
            $("#msg-erro2").text(msg2).show();
            $("#msg-erro3").text(msg3).show();
            $("#msg-erro4").text(msg4).show();
            $("#msg-erro5").text(msg5).show();
            $("#msg-erro6").text(msg6).show();
            $("#msg-erro7").text(msg7).show();
            $("#msg-erro8").text(msg8).show();
            $("#msg-erro9").text(msg9).show();
            $("#msg-erro10").text(msg10).show();
            $("#msg-erro11").text(msg11).show();
            $("#msg-erro12").text(msg12).show();
            $("#msg-erro13").text(msg13).show();
            $("#msg-erro14").text(msg14).show();
            $("#msg-erro15").text(msg15).show();
            $("#msg-erro16").text(msg16).show();
            $("#msg-erro17").text(msg17).show();
            $("#msg-erro18").text(msg18).show();
            $("#msg-erro19").text(msg19).show();
            $("#msg-erro20").text(msg20).show();
            $("#msg-erro21").text(msg21).show();
            document.querySelector('form').addEventListener('submit', function(event) {
            event.preventDefault();
            });
        }
    };
;
        $(function () {
            Shadowbox.init();
            $(".abrir").click(function(){
                var nome = $(".nome").val(); 
                console.log("nome ", nome);
                Shadowbox.open({
                    content:    "teste.php?produto="+nome,
                    player: "iframe",
                    title:  "",
                    width:  1300,
                    height: 800
                });
            });
        });
        function retornaProduto(produto,referencia,descricao){
            console.log("chegou aqui"+produto)
            $(".produto").val(produto);
            $(".referencia").val(referencia);
            $(".descricao").val(descricao);
        }
        $(function () { 
            Shadowbox.init();
            $(".pesquisar").click(function(){
                var nome = $(".nome").val(); 
                console.log("nome ", nome);
                Shadowbox.open({
                    content:    "tabela_defeito.php?defeito="+nome,
                    player: "iframe",
                    title:  "",
                    width:  1300,
                    height: 600
                });
            });
        });
        function retornaDefeito(id_defeito,descricao_defeito){
            console.log("chegou aqui"+id_defeito)
            $(".codigo_defeito").val(id_defeito);
            $(".descricao_defeito").val(descricao_defeito);
        }
        $(function () { 
            Shadowbox.init();
            $(".buscar").click(function(){
                var nome = $(".nome").val(); 
                console.log("nome ", nome);
                Shadowbox.open({
                    content:    "tabela_atendimento.php?tipo_atendimento="+nome,
                    player: "iframe",
                    title:  "",
                    width:  1300,
                    height: 600
                });
            });
        });
        function retornaAtendimento(tipo_atendimento,codigo_atendimento,descricao_atendimento){
            console.log("chegou aqui"+codigo_atendimento)
            $(".codigo_atendimento").val(tipo_atendimento);
            $(".tipo_atendimento").val(tipo_atendimento);
        }
    </script>
</head>
<body>
    <div class="row">
        <div class="col-md-4">
        </div>
        <div class="col-md-4">
            <div class="panel panel-default panel-login">
                <div class="panel-heading text-center">
                    Cadastro OS
                </div>
                <div class="panel-body">
                    <form action="<?php echo $_SERVER['PHP-SELF'];?>" onsubmit="validateForm()" method="POST" class="form">
                    <input type="hidden" class="os" value="<?= $os; ?>">
                    <input type="hidden" class="produto" value="<?= $produto; ?>">
                        <h5>Dados da abertura:</h5>
                        <label for="data">Data de abertura:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-calendar"></i>
                            </span>
                            <input id="data" type="text" name="data" placeholder="Data de Abertura" class="dataAbertura form-control" value="<?= $dataAberturaBanco ?>">
                        </div>
                        <div class="msg_erro alert alert-danger" id="msg-erro1" style="display:none" <?= !empty($mensagem) ? "" : 'style="display:none"'?>></div>
                        <br>
                        <label for="nf">Nota fiscal:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-paperclip"></i>
                            </span>
                        <input type="text" name="NF" placeholder="Ex.: 1234567890" class="nf form-control" maxlength=10 id="nf" value="<?= $nf; ?>">
                        </div>
                        <div class="msg_erro alert alert-danger" id="msg-erro21" style="display:none" <?= !empty($mensagem) ? "" : 'style="display:none"'?>></div>
                        <br>
                        <label for="tipo_atendimento">Tipo de Atendimento:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-headphones"></i>
                            </span>
                        <input type="text" name="tipo_atendimento" placeholder="Selecione o tipo de atendimento" class="codigo_atendimento form-control" id="tipo_atendimento" value="<?= $tipo_atendimento; ?>"><span class="buscar input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
                        </div>
                        <div class="msg_erro alert alert-danger" id="msg-erro20" style="display:none" <?= !empty($mensagem) ? "" : 'style="display:none"'?>></div>
                        <input type="hidden" class="tipo_atendimento" value="<?= $tipo_atendimento ?>">
                        <br>
                        <h5>Dados da compra:</h5>
                        <label for="date">Data da compra:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-calendar"></i>
                            </span>
                        <input id="date" type="text" name="date" placeholder="Data da Compra" class="dataCompra form-control" value="<?= $dataCompraBanco ?>">
                        </div>
                        <div class="msg_erro alert alert-danger" id="msg-erro2" style="display:none" <?= !empty($mensagem) ? "" : 'style="display:none"'?>></div>
                        <br>
                        <label for="aparencia">Aparência:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-pushpin"></i>
                            </span>
                        <input type="text" name="aparencia" placeholder="Ex.: conservado" class="aparencia form-control"maxlength=50 id="aparencia" value="<?= $aparencia; ?>">
                        </div>
                        <div class="msg_erro alert alert-danger" id="msg-erro3" style="display:none" <?= !empty($mensagem) ? "" : 'style="display:none"'?>></div>
                        <br>
                        <label for="acessorios">Acessórios</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-pushpin"></i>
                            </span>
                        <input type="text" name="acessorios" placeholder="Ex.: cabo extensor" class="acessorios form-control" maxlength=50 id="acessorios" value="<?= $acessorios; ?>">
                        </div>
                        <div class="msg_erro alert alert-danger" id="msg-erro4" style="display:none" <?= !empty($mensagem) ? "" : 'style="display:none"'?>></div>
                        <br>
                        <h5>Dados do consumidor:</h5>
                        <label for="nome">Nome completo:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-user"></i>
                            </span>
                        <input type="text" name="nome" placeholder="Ex.: José da Silva" class="nome form-control" maxlength=50 id="nome" value="<?= $nome; ?>">
                        </div>
                        <div class="msg_erro alert alert-danger" id="msg-erro5" style="display:none" <?= !empty($mensagem) ? "" : 'style="display:none"'?>></div>
                        <br>
                        <label for="cpf">CPF ou CNPJ:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-pushpin"></i>
                            </span>
                        <input type="text" name="cpf_cnpj" placeholder="Ex.: 12345678900" class="cpf form-control" maxlength=14 id="cpf" value="<?= $cpf; ?>">
                        </div>
                        <div class="msg_erro alert alert-danger" id="msg-erro6" style="display:none" <?= !empty($mensagem) ? "" : 'style="display:none"'?>></div>
                        <br>
                        <label for="cep">CEP:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-pushpin"></i>
                            </span>
                        <input type="text" name="cep" placeholder="Ex.: 9876543211" class="cep form-control" maxlength=10 id="cep" value="<?= $cep; ?>">
                        </div>
                        <div class="msg_erro alert alert-danger" id="msg-erro7" style="display:none" <?= !empty($mensagem) ? "" : 'style="display:none"'?>></div>
                        <br>
                        <label for="estado">Estado:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-globe"></i>
                            </span>
                        <input type="text" name="estado" placeholder="Ex.: SP" class="estado form-control" maxlength=2 id="estado" value="<?= $estado; ?>">
                        </div>
                        <div class="msg_erro alert alert-danger" id="msg-erro8" style="display:none" <?= !empty($mensagem) ? "" : 'style="display:none"'?>></div>
                        <br>
                        <label for="cidade">Cidade:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-globe"></i>
                            </span>
                        <input type="text" name="cidade" placeholder="Ex.: Campinas" class="cidade form-control" maxlength=50 id="cidade" value="<?= $cidade; ?>">
                        </div>
                        <div class="msg_erro alert alert-danger" id="msg-erro9" style="display:none" <?= !empty($mensagem) ? "" : 'style="display:none"'?>></div>
                        <br>
                        <label for="bairro">Bairro:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-globe"></i>
                            </span>
                        <input type="text" name="bairro" placeholder="Ex.: centro" class="bairro form-control" maxlength=50 id="bairro" value="<?= $bairro; ?>">
                        </div>
                        <div class="msg_erro alert alert-danger" id="msg-erro10" style="display:none" <?= !empty($mensagem) ? "" : 'style="display:none"'?>></div>
                        <br>
                        <label for="endereco">Endereço:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-globe"></i>
                            </span>
                        <input type="text" name="endereco" placeholder="Ex.: Avenida Francisco Glicério" class="endereco form-control"maxlength=50 id="endereco" value="<?= $endereco; ?>">
                        </div>
                        <div class="msg_erro alert alert-danger" id="msg-erro11" style="display:none" <?= !empty($mensagem) ? "" : 'style="display:none"'?>></div>
                        <br>
                        <label for="numero">Número:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-globe"></i>
                            </span>
                        <input type="text" name="numero" placeholder="Ex.: 506" class="numero form-control" maxlength=10 id="numero" value="<?= $numero; ?>">
                        </div>
                        <div class="msg_erro alert alert-danger" id="msg-erro12" style="display:none" <?= !empty($mensagem) ? "" : 'style="display:none"'?>></div>
                        <br>
                        <label for="complemento">Complemento:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-globe"></i>
                            </span>
                        <input type="text" name="complemento" placeholder="casa, apartamento, bloco..." class="complemento form-control" maxlength=40 id="complemento" value="<?= $complemento; ?>">
                        </div>
                        <br>
                        <label for="tel">Telefone:</label> 
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-earphone"></i>
                            </span>
                        <input type="text" name="telefone" placeholder="Ex.: 1134525462" class="telefone form-control" maxlength=10 id="tel" value="<?= $telefone; ?>">
                        </div>
                        <div class="msg_erro alert alert-danger" id="msg-erro13" style="display:none" <?= !empty($mensagem) ? "" : 'style="display:none"'?>></div>
                        <br>
                        <label for="cel">Celular:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-phone"></i>
                            </span>
                        <input type="text" name="celular" placeholder="Ex.: 14953471572" class="celular form-control"maxlength=11 id="cel" value="<?= $celular; ?>">
                        </div>
                        <div class="msg_erro alert alert-danger" id="msg-erro14" style="display:none" <?= !empty($mensagem) ? "" : 'style="display:none"'?>></div>
                        <br>
                        <label for="email">E-mail:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-envelope"></i>
                            </span>
                        <input type="text" name="email" placeholder="Ex.: exemplo@gmail.com" class="email form-control"maxlength=50 id="email" value="<?= $email; ?>">
                        </div>
                        <div class="msg_erro alert alert-danger" id="msg-erro15" style="display:none" <?= !empty($mensagem) ? "" : 'style="display:none"'?>></div>
                        <br>
                        <h5>Dados do produto:</h5>
                        <label for="numero_serie">Número de série:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-list-alt"></i>
                            </span>
                        <input type="text" name="numero_serie" id="numero_serie" placeholder="Número de série" class="numeroSerie form-control" maxlength=50 value="<?= $numeroSerie; ?>">
                        </div>
                        <div class="msg_erro alert alert-danger" id="msg-erro16" style="display:none" <?= !empty($mensagem) ? "" : 'style="display:none"'?>></div>
                         <div class="input-group">
                        <input type="hidden" name="produto" placeholder="produto" class="form-control produto">
                        </div>
                        <br>
                        <label for="referencia">Referência:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-option-vertical"></i>
                            </span>
                        <input type="text" name="referencia" placeholder="Número de referência" class="form-control referencia" maxlength="10" id="referencia"  value="<?= $referencia ?>"><span class="abrir input-group-addon"><i class="glyphicon glyphicon-search"></i></span> 
                        </div>
                        <div class="msg_erro alert alert-danger" id="msg-erro17" style="display:none" <?= !empty($mensagem) ? "" : 'style="display:none"'?>></div>
                        <br>
                        <label for="desc">Descrição:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-list-alt"></i>
                            </span>
                        <input type="text" name="desc" placeholder="Ex.: ar condicionado midea 10000 btus" class="form-control descricao" maxlenght="50" id="desc" value="<?= $descricao ?>">
                        </div>
                        <div class="msg_erro alert alert-danger" id="msg-erro18" style="display:none" <?= !empty($mensagem) ? "" : 'style="display:none"'?>></div>
                        <div class="input-group">
                        <input type="hidden" name="produto" placeholder="produto" class="form-control descricao_defeito">
                        </div>
                        <br>
                        <label for="defeito">Defeito:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-option-vertical"></i>
                            </span>
                        <input type="text" name="defeito" placeholder="Ex.: problemas ao resfriar" class="form-control codigo_defeito" id="defeito" value="<?= $id_defeito; ?>"><span class="pesquisar input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
                        </div>
                        <div class="msg_erro alert alert-danger" id="msg-erro19" style="display:none" <?= !empty($mensagem) ? "" : 'style="display:none"'?>></div>
                        <br>
                        <div class="text-center">
                            <button name ="btngravar" value="t" type="submit" onclick="validateForm()" class="btn btn-primary">Cadastrar</button>
                        </div>
                    </form>
                </div>
                <div class="panel-footer panel-danger text-center"><?= $msg ?></div>
            </div>
        </div>
        <div class="col-md-4"></div>
    </div>
    </div>
</body>
<script>
        $("#cep").change(function(){
            var cep = $(this).val();
    console.log(cep);
    $.ajax({
        url: "http://viacep.com.br/ws/" + cep + "/json/",
        type: "GET", 
        dataType : "json",
        beforeSend: function() {

            //aguarde 

        },
        async: false,
        timeout: 10000,
        success: function(dados) {
            console.log(dados.logradouro);
            $("#endereco").val(dados.logradouro);
            $("#bairro").val(dados.bairro);
            $("#cidade").val(dados.localidade);
            $("#estado").val(dados.uf);
        }
        })

        }); 
</script>
</html>