<html xml:lang="pt" lang="pt">
  <head>
    <meta charset="ISO-8859-1">
    <title>Mural</title>
  </head>
  <body>
  <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet"> <!-- Import de Fonte para escrita -->
  <?php
    session_start();
    include "basedadosges.php";
  ?>
    <div style="text-align: center;">
      <img src="imgs/banner.png" style="width: 50%; height: 50%">
      <?xml version="1.0" encoding="iso-8859-1"?>
    </div>
    <style type="text/css">
		body {
			padding:0px;
      margin:0px;
      background-color: #CAE1FF;
      font-weight: bold;
      font-family: 'Calibri light', sans-serif;
		}
 
		#menu ul {
			padding:0px;
			margin:0px;
			width: 80%;
			background-color:#CD3333;
			list-style:none;
      font-family: 'Poppins', sans-serif;
      font-weight: bold;
      font-size: 20px;
      text-align: center;
      margin: 0 auto;
      border-radius: 10px;
		}
 
		#menu ul li { display: inline; }
 
		#menu ul li a {
			background-color:#EDEDED;
			color: #333;
			text-decoration: none;
			border-bottom:3px solid #EDEDED;
			padding: 2px 10px;
      text-align: center;
		}
 
		#menu ul li a:hover {
			background-color:#D6D6D6;
			color: #EDEDED;
			border-bottom:3px solid #000000;
      text-align: center;
    }

    #Caixatexto{
      background-color:#FFFFFF;
      width: 78%;
      margin: 0 auto;
      padding: 2px 10px;
      border-radius: 10px;
      margin-top: 10px;

    }

    tr#linhareuniaotitulo{       
      background-color: #4CAF50;
      color: white;
      text-align: center;
    }

    tr#linhareuniao{
                
        background-color: #CAE1FF;
        text-align: center;
        height: 36px;
    }

    tr#linhamanutencaotitulo{       
      background-color: #4CAF50;
      color: white;
      text-align: center;
    }

    tr#linhamanutencao{
                
      background-color: #D3D3D3;
      text-align: center;
      height: 36px;
    }

    h2{
      font-family: 'Poppins', sans-serif;
      border-radius: 10px;
      background-color:#4CAF50;
      width: 50%;
      margin: auto;
      color: white;
    }

	</style>

    <div id="menu">
      <ul style="height: 90px;">
      <li><br>
        </li>
        <li><a href="principal.php">Home</a></li>
        <?php
          if($_SESSION['NivelDeAcesso'] != 0) {
        ?>
        <li><a href="faturacao.php">Faturação</a></li>
        <li><a href="manutencao.php">Manutenção</a></li>
        <li><a href="registo.php">Registo</a></li>
        <li><a href="calendario.php">Calendário</a></li>
        <?php
          } else{
        ?>
        <li><a href="mural.php">Mural</a></li>
        <li><a href="pagamento.php">Pagamento</a></li>
        <?php
            }
        ?>
        <li><a href="contacto.php">Contacto</a></li>
        <li><a href="logout.php">Sair</a></li>
        
      </ul>
    </div>
    <div id="Caixatexto"> <br>
      <div style="text-align: center;">
      <?php 
        header("Content-Type: text/html; charset=ISO-8859-1", true);
        if (empty($_SESSION['UtilizadorLogado'])) {
 
          // n?o existe sess?o iniciada
          // neste caso, levamos o utilizador para a p?gina de login
          header('Location: login.php');
          exit("Utilizador não logado!");
        } else {
          if($_SESSION['NivelDeAcesso'] != 0) {
            echo "Você não tem acesso a esta página!";
            //header('Location: principal.php');
            die();
          } else { // CONTEUDO DA PAGINA VAI AQUI DENTRO PARA UTILIZADOR QUE TIVER ACESSO A ELA

          $idutilizador = $_SESSION['UtilizadorLogado'];
          
          // TABELA DE REUNI?ES
          echo "<h2>Agenda de Reuniões</h2>";
          $sqlreuniao = "Select data_r, pauta, edificio.numero, edificio.morada, utilizador.nome, estado_reuniao from reuniao, administrador, utilizador, edificio, condomino, fracao
          where (reuniao.cod_gestor = administrador.cod_gestor) and (utilizador.cod_utilizador = administrador.cod_gestor) and (reuniao.cod_edificio = edificio.cod_edificio) and (condomino.cod_condomino = $idutilizador) and (fracao.cod_condomino = $idutilizador) and (fracao.cod_edificio = edificio.cod_edificio) and (reuniao.estado_reuniao = 0) order by data_r";
          //echo $sql;
          $resultadoreuniao = $ligacao->query($sqlreuniao);

          if($resultadoreuniao->num_rows > 0){
              ?> <!-- Fecha o PHP para fazer o table -->
              <table style='width:100%' id='tabela1'>
              <tr id='linhareuniaotitulo'>
                  <th>Data da Reunião</th>
                  <th>Pauta</th>
                  <th>Edificio</th>
                  <th>Nº do Edificio</th>
                  <th>Gestor Responsável</th>
              </tr>
              <?php // Volta-se a abrir para fazer o while em PHP
              while($linha = $resultadoreuniao->fetch_assoc()){
                  ?>  <!-- Fecha o PHP para fazer o conte?do das colunas pares -->
                  <tr id='linhareuniao'>
                      <td id='coluna1tab'> <?php echo $linha['data_r'];?> </td>
                      <td id='coluna2tab'> <?php echo $linha['pauta'];?> </td>
                      <td id='coluna3tab'> <?php echo $linha['numero'];?> </td>
                      <td id='coluna3tab'> <?php echo $linha['morada'];?> </td>
                      <td id='coluna5tab'> <?php echo $linha['nome'];?> </td>
                  </tr>
                  <?php //Volta a abrir o PHP ap?s a cria??o do conte?do para finalizar o que n?o for par e criar as colunas.
              }
              ?> <!-- Fecha-se novamente para finalizar a tag HTML table -->
              </table> 
              <?php // Novamente abre-se para continuar o c?digo PHP
          }

          ?>
          <br><br><br>
          <?php

          // TABELA DE MANUTEN??ES
          echo "<h2>Agenda de Manutenções</h2>";
          $sqlmanutencao = "Select distinct data_m, descricao, hora_m, edificio.numero, funcionario.nome, estado_manutencao from manutencao, utilizador, edificio, condomino, fracao, funcionario_manutencao, funcionario
          where (manutencao.cod_manutencao = funcionario_manutencao.cod_manutencao) and (funcionario_manutencao.cod_funcionario = funcionario.cod_funcionario) and (manutencao.cod_edificio = edificio.cod_edificio) and (condomino.cod_condomino = $idutilizador) and (fracao.cod_condomino = $idutilizador) and (fracao.cod_edificio = edificio.cod_edificio) and (manutencao.estado_manutencao = 0) order by data_m";
          $resultadomanutencao = $ligacao->query($sqlmanutencao);

          if($resultadomanutencao->num_rows > 0){
              ?> <!-- Fecha o PHP para fazer o table -->
              <table style='width:100%' id='tabela1'>
              <tr id='linhamanutencaotitulo'>
                  <th>Data da Manutenção</th>
                  <th>Descrição</th>
                  <th>Hora</th>
                  <th>Nº do Edificio</th>
                  <th>Funcionário</th>
              </tr>
              <?php // Volta-se a abrir para fazer o while em PHP
              while($linham = $resultadomanutencao->fetch_assoc()){
                  ?>  <!-- Fecha o PHP para fazer o conte?do das colunas pares -->
                  <tr id='linhamanutencao'>
                      <td id='coluna1tab'> <?php echo $linham['data_m'];?> </td>
                      <td id='coluna2tab'> <?php echo $linham['descricao'];?> </td>
                      <td id='coluna3tab'> <?php echo $linham['hora_m'];?> </td>
                      <td id='coluna3tab'> <?php echo $linham['numero'];?> </td>
                      <td id='coluna5tab'> <?php echo $linham['nome'];?> </td>
                  </tr>
                  <?php //Volta a abrir o PHP ap?s a cria??o do conte?do para finalizar o que n?o for par e criar as colunas.
              }
              ?> <!-- Fecha-se novamente para finalizar a tag HTML table -->
              </table> 
              <?php // Novamente abre-se para continuar o c?digo PHP
          }

          $ligacao->close();

          }
        }
        ?>

        </div>
    </div>
    
  </body>
</html>
