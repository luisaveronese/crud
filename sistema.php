<?php 
include "include/conexao.php";
include "include/navbar.php";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema</title>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <link rel="stylesheet" href="assets/sistema.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
    <script>
        $('.carousel').carousel({
            interval: 2000
        })
    </script>
</head>
<body> 
        <h2>Principais marcas parceiras</h2>
        
        
    <div class="col-md-6">
    <div id="carousel-example-generic" class="carousel slide carousel" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <div class="item active">
      <img src="assets/2e3d90f2125c1793e1ab1c5aaf5914f7.jpg" alt="logotipo da marca makita">
      <div class="carousel-caption">
        
      </div>
    </div>
    <div class="item">
      <img src="assets/midea_logo.png" alt="logotipo da marca midea">
      <div class="carousel-caption">
      </div>
    </div>
    <div class="item">
      <img src="assets/black+decker_logo.png" alt="logotipo da marca black + decker">
      <div class="carousel-caption">
      </div>
    </div>
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
    </div>
    </div>
    <div class="col-md-6">
        <h2>Quem somos?</h2>
        <p>
            Somos especialistas em Gestão de Pós-Vendas e pioneiros no desenvolvimento de sistemas de Pós-Venda para internet.
            Ao longo de 25 anos de experiência melhoramos nosso Know How e desenvolvemos um software capaz de atender às necessidades de Assistentes Técnicos, Indústrias e Importadores.
            Atráves de um atendimento personalizado gerenciamos soluções que vão desde a abertura de Ordens de Serviço até a relatórios precisos dos processos de Pós-Venda.
            Desenvolvemos trabalhos de consultoria em processos, armazenamento e distribuição de peças, Serviços de Atendimento ao Consumidor (SAC), formação e gestão da rede de serviços autorizados, e terceirização de atividades.
            Buscamos, portanto, com a melhoria contínua de nosso software oferecer o crescimento exponencial de nossos clientes.
        </p>
    </div>


    
   
</body>
</html>







 <!-- <div class="container-blog">
                <div class="blog">
                    <img src="assets/midea_logo.png"/>
                    <h3>Midea</h3>
                    <p>Lorem ipsum dolor ammet</p>
                </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="container-blog">
                <div class="blog">
                    <img src="assets/black+decker_logo.png"/>
                    <h3>Black + Decker</h3>
                    <p>Lorem ipsum dolor ammet</p>
                </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="container-blog">
                <div class="blog">
                    <img src="assets/2e3d90f2125c1793e1ab1c5aaf5914f7.jpg"/>
                    <h3>Makita</h3>
                    <p>Lorem ipsum dolor ammet</p>
                </div>
        </div>
    </div> -->
