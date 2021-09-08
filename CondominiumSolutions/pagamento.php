<html xml:lang="pt" lang="pt">
  <head>
    <title>Pagamento</title>
  </head>
  <body>
  <?php
    session_start();
    include "basedadosges.php";
  ?>
    <div style="text-align: center;"> 
        <img src="imgs/banner.png" style="width: 50%; height: 50%">
        <?xml version="1.0" encoding="iso-8859-1"?>
        <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet"> <!-- Import de Fonte para escrita -->
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

    tr#linhapagamentostitulo{       
      background-color: #4CAF50;
      color: white;
      text-align: center;
    }

    tr#linhapagamentos{      
      background-color: #D3D3D3;
      text-align: center;
      height: 36px;
    }

    tr#linharecibostitulo{       
      background-color: #4CAF50;
      color: white;
      text-align: center;
    }
        
    tr#linharecibos{             
      background-color: #CAE1FF;
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
 
          // não existe sessão iniciada
          // neste caso, levamos o utilizador para a página de login
          header('Location: login.php');
          exit("Utilizador não logado!");
        } else {
          if($_SESSION['NivelDeAcesso'] != 0) {
            echo "Você não tem acesso a esta página!";
            //header('Location: principal.php');
            die();
          } else { // CONTEUDO DA PAGINA VAI AQUI DENTRO PARA UTILIZADOR QUE TIVER ACESSO A ELA

            $idutilizador = $_SESSION['UtilizadorLogado'];

            // TABELA DE PAGAMENTOS LANÇADOS
          echo "<h2>Tabela com Faturas emitidas para pagamento</h2>";
          $sqlpagamentos = "Select preco_tot, descricao, edificio.numero, fracao.andar, fracao.designacao, utilizador.nome from pagamento, condomino, utilizador, edificio, fracao
          where (utilizador.cod_utilizador = condomino.cod_condomino) and (fracao.cod_condomino = condomino.cod_condomino) and (edificio.cod_edificio = fracao.cod_edificio) and (pagamento.cod_fracao = fracao.cod_fracao) and (condomino.cod_condomino = $idutilizador) and (fracao.cod_edificio = edificio.cod_edificio)";
          $resultadopagamento = $ligacao->query($sqlpagamentos);

          if($resultadopagamento->num_rows > 0){
              ?> <!-- Fecha o PHP para fazer o table -->
              <table style='width:100%' id='tabela1'>
              <tr id='linhapagamentostitulo'>
                  <th>Preço Total</th>
                  <th>Descrição</th>
                  <th>Nº do Edificio</th>
                  <th>Andar</th>
                  <th>Designação</th>
                  <th>Condómino</th>
              </tr>
              <?php // Volta-se a abrir para fazer o while em PHP
              while($linha = $resultadopagamento->fetch_assoc()){
                  ?>  <!-- Fecha o PHP para fazer o conte?do das colunas pares -->
                  <tr id='linhapagamentos'>
                      <td id='coluna1tab'> <?php echo $linha['preco_tot'];?> </td>
                      <td id='coluna2tab'> <?php echo $linha['descricao'];?> </td>
                      <td id='coluna3tab'> <?php echo $linha['numero'];?> </td>
                      <td id='coluna3tab'> <?php echo $linha['andar'];?> </td>
                      <td id='coluna5tab'> <?php echo $linha['designacao'];?> </td>
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

          // TABELA DE RECIBOS DE PAGAMENTOS
          echo "<h2>Recibos de Pagamentos ja realizados</h2>";
          $sqlrecibos = "Select data_pag, hora_pag, pagador, pagamento.descricao, pagamento.preco_tot from recibo, pagamento, fracao
          where (recibo.cod_pagamento = pagamento.cod_pagamento) and (pagamento.cod_fracao = fracao.cod_fracao) and (fracao.cod_condomino = $idutilizador)";
          $resultadorecibos = $ligacao->query($sqlrecibos);

          if($resultadorecibos->num_rows > 0){
              ?> <!-- Fecha o PHP para fazer o table -->
              <table style='width:100%' id='tabela1'>
              <tr id='linharecibostitulo'>
                  <th>Data do Pagamento</th>
                  <th>Hora do Pagamento</th>
                  <th>Pagador</th>
                  <th>Descrição</th>
                  <th>Valor Pago</th>
              </tr>
              <?php // Volta-se a abrir para fazer o while em PHP
              while($linham = $resultadorecibos->fetch_assoc()){
                  ?>  <!-- Fecha o PHP para fazer o conte?do das colunas pares -->
                  <tr id='linharecibos'>
                      <td id='coluna1tab'> <?php echo $linham['data_pag'];?> </td>
                      <td id='coluna2tab'> <?php echo $linham['hora_pag'];?> </td>
                      <td id='coluna3tab'> <?php echo $linham['pagador'];?> </td>
                      <td id='coluna3tab'> <?php echo $linham['descricao'];?> </td>
                      <td id='coluna5tab'> <?php echo $linham['preco_tot'];?> </td>
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
