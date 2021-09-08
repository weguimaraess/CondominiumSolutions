<html xml:lang="pt" lang="pt">
  <head>
    <title>Faturação</title>
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

    tr#linhafaturastitulo{       
      background-color: #4CAF50;
      color: white;
      text-align: center;
    }

    tr#linhafaturas{
                
        background-color: #CAE1FF;
        text-align: center;
        height: 36px;
    }

    h2{
      font-family: 'Poppins', sans-serif;
      border-radius: 10px;
      background-color:#4CAF50;
      width: 75%;
      margin: auto;
      color: white;
      
    }

    #btngenerico{
      font-family: 'Poppins', sans-serif;
      background-color:#2E8B57;
      width: 20%;
      height: 50px;
      margin: auto;
      cursor: pointer;
    }

    #caixagenerica{
      background-color:#4CAF50;
      width: 100%;
      margin: auto;
      margin-top: 10px;
      padding-bottom: 4px;
      border-radius: 5px;
      color: white;
    }

    h3{
      font-family: 'Poppins', sans-serif;
      background-color:#4CAF50;
      margin: auto;
      color: white;
    }

    #btncriarnovafatura{
      font-family: 'Poppins', sans-serif;
      background-color:#2E8B57;
      width: 20%;
      height: 50px;
      margin: auto;
      color: white;
      cursor: pointer;
      padding:2px;
    }

    #caixabuscar{
      background-color:#4CAF50;
      width: 100%;
      margin: auto;
      margin-top: 10px;
      padding-bottom: 4px;
      border-radius: 5px;
      color: white;
    }

    #btnbusca{
      font-family: 'Poppins', sans-serif;
      background-color:#2E8B57;
      width: 10%;
      height: 30px;
      margin: auto;
      color: white;
      cursor: pointer;
      padding:2px;
    }

    #btncriar{
      cursor: pointer;
      color: white;
    }

    #fattot{
      background-color:#4682B4;
    }

    #divtot{
      background-color:#CD0000;
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
        $idutilizador = $_SESSION['UtilizadorLogado'];
        if (empty($_SESSION['UtilizadorLogado'])) {
 
          // não existe sessão iniciada
          // neste caso, levamos o utilizador para a página de login
          header('Location: login.php');
          exit("Utilizador não logado!");
        } else {
          if($_SESSION['NivelDeAcesso'] != 1) {
            echo "Você não tem acesso a esta página!";
            //header('Location: principal.php');
            die();
          } else {

              $sql = "select * from edificio where cod_gestor = $idutilizador";
              $resultado = $ligacao->query($sql);

              if($resultado->num_rows > 0){
                  while($linha = $resultado->fetch_assoc()){
                    $cod_edificio = $linha['cod_edificio'];
                    $numero = $linha['numero'];
                    $morada = $linha['morada'];
                  }
              }

              // Verificar se foi acionado para deletar uma fatura
              if((isset($_POST["codpagamentodeletar"])) && $btn_submit='Deletar'){ //Checar se os valores foram passados pelo formulario
                $codpagamentodeletar = $_POST['codpagamentodeletar'];
                    //echo "jhfjhgjgkg";
                $sqlcontar = "SELECT COUNT(*) as quantidade from recibo Where cod_pagamento=$codpagamentodeletar";
                $resultadocontar = $ligacao->query($sqlcontar);
                if($resultadocontar->num_rows > 0){
                  $linha = $resultadocontar->fetch_assoc();
                  $quantidade = $linha['quantidade'];
                }
                if($quantidade == 0){
                  $sqldelete = "Delete from pagamento Where cod_pagamento=$codpagamentodeletar";
                  $resultadodelete = $ligacao->query($sqldelete);
                } else {
                  echo "<h4 style='color:red'>Essa fatura não pode ser apagada pois existem recibos associados a ela!<h4>";
                }
              }

              // Verificar se foi acionado para deletar um recibo
              if((isset($_POST["codrecibodeletar"])) && $btn_submit='Deletar'){ //Checar se os valores foram passados pelo formulario
                $codrecibodeletar = $_POST['codrecibodeletar'];
                $sqldelete = "Delete from recibo Where cod_recibo=$codrecibodeletar";
                $resultadodelete = $ligacao->query($sqldelete);
              }

              // Verificar se foi acionado o botão para inserir novo recibo e com isso declaradas novas variaveis
              if(isset($_POST["descricaonovorecibo"]) && isset($_POST["datanovorecibo"]) && isset($_POST["horanovorecibo"]) && isset($_POST["pagadornovorecibo"])){
                $descricaonovorecibo = $_POST["descricaonovorecibo"];
                $datanovorecibo = $_POST["datanovorecibo"];
                $horanovorecibo = $_POST["horanovorecibo"];
                $pagadornovorecibo = $_POST["pagadornovorecibo"];

                $sqlcriarnovorecibo = "Insert into recibo (data_pag, hora_pag, pagador, cod_pagamento, cod_gestor) values ('$datanovorecibo', '$horanovorecibo', '$pagadornovorecibo', $descricaonovorecibo, $idutilizador)";
                $resultado = $ligacao->query($sqlcriarnovorecibo);

              }

              // Verificar se foi acionado o botão para inserir nova fatura e com isso declaradas novas variaveis
              if(isset($_POST["apartamentonovafatura"]) && isset($_POST["descricaonovafatura"]) && isset($_POST["preconovafatura"])){
                $apartamentonovafatura = $_POST["apartamentonovafatura"];
                $descricaonovafatura = $_POST["descricaonovafatura"];
                $preconovafatura = $_POST["preconovafatura"];
                
                $sqlbuscaprecotot = "select preco_f from fracao where cod_fracao = $apartamentonovafatura";
                $resultado = $ligacao->query($sqlbuscaprecotot);
                if($resultado->num_rows > 0){
                  $linha = $resultado->fetch_assoc();
                  $preco_f = $linha['preco_f'];
                }

                $preco_tot = $preconovafatura + $preco_f;

                $sqlcriarnovafatura = "Insert into pagamento (preco_tot, descricao, cod_fracao) values ('$preco_tot', '$descricaonovafatura', '$apartamentonovafatura')";
                $resultado = $ligacao->query($sqlcriarnovafatura);

              }

              ?>

              <form action="faturacao.php" method="POST">
                <input type="submit" name="btnNovaPesquisa" value="Nova Pesquisa" id='btngenerico'/>
              </form>

              <?php
                if(isset($_POST['btnNovaPesquisa'])){
              ?>
                <form action="faturacao.php" method="POST">
                          <div id="caixabuscar">
                          <h3>Busca por Fração</h3>
                          <br>
                          <em>Andar: </em><input type="number" min="0" required name="buscaandarfracaofaturacao">
                          Designação: 
                          <select name="buscadesignacaofracaofaturacao">
                            <?php $sqlbuscadesignacao = "select distinct designacao from fracao where cod_edificio = $cod_edificio";
                              $resultadobuscadesignacao = $ligacao->query($sqlbuscadesignacao); 
                              if($resultadobuscadesignacao->num_rows > 0){
                                while($linha = $resultadobuscadesignacao->fetch_assoc()){
                                  $buscadesignacao = $linha['designacao'];
                                  ?>
                                  <option value="<?php echo $buscadesignacao ?>"><?php echo $buscadesignacao ?></option>
                                  <?php
                                }
                              }
                            ?>
                          </select>
                          <br>
                          <br>
                          <input type="submit" name="btnBuscaFracao" value="Buscar" id="btnbusca"/>
                          </div>
                  </form>
                <?php
                  }

              if(isset($_POST["buscaandarfracaofaturacao"]) && isset($_POST["buscadesignacaofracaofaturacao"])){
                $buscaandarfracaofaturacao = $_POST["buscaandarfracaofaturacao"];
                $buscadesignacaofracaofaturacao = $_POST["buscadesignacaofracaofaturacao"];
                echo "<h2>Tabela com Faturas emitidas para pagamento</h2>";
                $sqlfaturas = "Select preco_tot, descricao, fracao.andar, fracao.designacao, utilizador.nome, pagamento.cod_pagamento from pagamento, fracao, condomino, utilizador
                where (utilizador.cod_utilizador = condomino.cod_condomino) and (fracao.cod_condomino = condomino.cod_condomino) and (pagamento.cod_fracao = fracao.cod_fracao) and (fracao.cod_edificio = $cod_edificio) and (fracao.andar = $buscaandarfracaofaturacao) and (fracao.designacao = '$buscadesignacaofracaofaturacao')";
                $resultadofaturas = $ligacao->query($sqlfaturas);
                
                if($resultadofaturas->num_rows > 0){
                    $contadorfaturamento = 0;
                    ?> <!-- Fecha o PHP para fazer o table -->
                    <table style='width:100%' id='tabela1'>
                    <tr id='linhafaturastitulo'>
                        <th>Preço Total</th>
                        <th>Descrição</th>
                        <th>Andar</th>
                        <th>Designação</th>
                        <th>Condómino</th>
                        <th>Ações</th>
                    </tr>
                    <?php // Volta-se a abrir para fazer o while em PHP
                    while($linha = $resultadofaturas->fetch_assoc()){
                        ?>  <!-- Fecha o PHP para fazer o conte?do das colunas pares -->
                        <tr id='linhafaturas'>
                            <td id='coluna1tab'> <?php echo $linha['preco_tot']; $contadorfaturamento += $linha['preco_tot'] ?> </td>
                            <td id='coluna2tab'> <?php echo $linha['descricao'];?> </td>
                            <td id='coluna3tab'> <?php echo $linha['andar'];?> </td>
                            <td id='coluna5tab'> <?php echo $linha['designacao'];?> </td>
                            <td id='coluna5tab'> <?php echo $linha['nome'];?> </td>
                            <td><a href='faturacao-funcoes.php?cod_pagamento=<?php echo $linha['cod_pagamento']?>&acao=trash'><img src='imgs/trash.png' width=28px height=28px /></a> </td>
                        </tr>
                        <?php //Volta a abrir o PHP ap?s a cria??o do conte?do para finalizar o que n?o for par e criar as colunas.
                    }
                    ?> <!-- Fecha-se novamente para finalizar a tag HTML table -->
                    </table> 
                    <p style="color: blue;"><h2 id="fattot"><em>FATURAMENTO TOTAL ESPERADO: <?php echo $contadorfaturamento." EUROS"; ?> </em></h2>
                    </p>
                    <?php
                }
              
              
              echo "<br><br><h2>Tabela com Recibos Emitidos referentes aos pagamentos</h2>";
              $sqlrecibos = "Select data_pag, hora_pag, pagador, fracao.andar, fracao.designacao, utilizador.nome, recibo.cod_pagamento, recibo.cod_recibo from pagamento, fracao, condomino, utilizador, recibo
              where (utilizador.cod_utilizador = condomino.cod_condomino) and (fracao.cod_condomino = condomino.cod_condomino) and (pagamento.cod_fracao = fracao.cod_fracao) and (recibo.cod_pagamento = pagamento.cod_pagamento) and (fracao.cod_edificio = $cod_edificio) and (fracao.andar = $buscaandarfracaofaturacao) and (fracao.designacao = '$buscadesignacaofracaofaturacao') ORDER BY data_pag";
              $resultadorecibos = $ligacao->query($sqlrecibos);

              if($resultadorecibos->num_rows > 0){
                $contadordividas = $contadorfaturamento;
                ?> <!-- Fecha o PHP para fazer o table -->
                <table style='width:100%' id='tabela1'>
                <tr id='linhafaturastitulo'>
                    <th>Data do Pagamento</th>
                    <th>Hora do Pagamento</th>
                    <th>Pagador</th>
                    <th>Andar</th>
                    <th>Designação</th>
                    <th>Condómino</th>
                    <th>Ações</th>
                </tr>
                <?php // Volta-se a abrir para fazer o while em PHP
                while($linha = $resultadorecibos->fetch_assoc()){
                    ?>  <!-- Fecha o PHP para fazer o conte?do das colunas pares -->
                    <tr id='linhafaturas'>
                        <td id='coluna1tab'> <?php echo $linha['data_pag'];?> </td>
                        <td id='coluna2tab'> <?php echo $linha['hora_pag'];?> </td>
                        <td id='coluna2tab'> <?php echo $linha['pagador'];?> </td>
                        <td id='coluna3tab'> <?php echo $linha['andar'];?> </td>
                        <td id='coluna5tab'> <?php echo $linha['designacao'];?> </td>
                        <td id='coluna5tab'> <?php echo $linha['nome'];?> </td>
                        <td><a href='faturacao-funcoesrec.php?cod_recibo=<?php echo $linha['cod_recibo']?>&acao=trash'><img src='imgs/trash.png' width=28px height=28px /></a> </td>
                        <?php 
                        $cod_pagamento = $linha['cod_pagamento']; 
                        $sqldividas = "SELECT preco_tot FROM pagamento WHERE cod_pagamento = $cod_pagamento";
                        $resultadodividas = $ligacao->query($sqldividas);
                        if($resultadodividas->num_rows > 0){
                          while($linha = $resultadodividas->fetch_assoc()){
                          $contadordividas -= $linha['preco_tot'];
                          }
                        }  
                        
                        ?>
                    </tr>
                    <?php //Volta a abrir o PHP ap?s a cria??o do conte?do para finalizar o que n?o for par e criar as colunas.
                }
                ?> <!-- Fecha-se novamente para finalizar a tag HTML table -->
                </table> 
                <p><h2 id="divtot"><em>DÍVIDA REFERENTE A FRAÇÃO: <?php echo $contadordividas." EUROS"; ?> </em></h2>
                <?php
              }
            }

            ?>
            
            <?php
            if(!isset($_POST['btnBuscaFracao'])){ // Sumir Botão quando fizer pesquisa
            ?>
              <form action="faturacao.php#ancoranovafatura" method="POST">
                <input type="submit" name="btnNovaFat" value="Registar Nova Fatura" id='btngenerico'/>
              </form>
            <?php
            }
                if(isset($_POST['btnNovaFat'])){
            ?>
                  <form action="faturacao.php#ancoranovafatura" method="POST">
                          <br>
                          <div id='caixagenerica'>
                          <h3>NOVA FATURA</h3>
                          <br>
                          <a name="ancoranovafatura"></a>
                          <input type="hidden" value="<?php echo $cod_edificio ?>" required name="codedificionovafatura">
                          <em>Apartamento: </em>
                          <select name="apartamentonovafatura">
                          <?php $sqlbuscaapartamento = "select cod_fracao, andar, designacao from fracao where cod_edificio = $cod_edificio order by andar, designacao";
                            $resultadobuscaapartamento = $ligacao->query($sqlbuscaapartamento); 
                            if($resultadobuscaapartamento->num_rows > 0){
                              while($linha = $resultadobuscaapartamento->fetch_assoc()){
                                $cod_fracao = $linha['cod_fracao'];
                                $andar = $linha['andar'];
                                $designacao = $linha['designacao'];
                                ?>
                                <option value="<?php echo $cod_fracao ?>"><?php echo "$andar º - $designacao" ?></option>
                                <?php
                              }
                            }
                          ?>
                        </select>
                          <br>
                          <br>
                          <br>
                          <em>Descrição: </em><input type="text" required name="descricaonovafatura">
                          <br>
                          <br>
                          <br>
                          <em>Total de Custos Extras: </em><input type="number" step="any" min="0" required name="preconovafatura">
                          <br>
                          <br>
                          <br>
                          <input type="submit" name="btnCriarFatura" value="Criar" id="btnbusca"/>
                        </div>
                  </form>
            <?php
                }
                ?>

                <?php
                if(!isset($_POST['btnBuscaFracao'])){ // Sumir Botão quando fizer pesquisa
                  ?>
                    <form action="faturacao.php#ancoranovorecibo" method="POST">
                    <input type="submit" name="btnNovoRec" value="Registar Novo Recibo" id='btngenerico'/>
                    </form>
                  <?php
                }

                if(isset($_POST['btnNovoRec'])){
                  ?>
                  <form action="faturacao.php#ancoranovorecibo2" method="POST">
                    <br>
                    <div id='caixagenerica'>
                    <h3>SELECIONE O APARTAMENTO DESEJADO</h3>
                    <br>
                        <a name="ancoranovorecibo"></a>
                        <input type="hidden" value="<?php echo $cod_edificio ?>" required name="codedificionovafatura">
                        <em>Apartamento: </em>
                        <select name="apartamentonovorecibo">
                        <?php $sqlbuscaapartamento = "select cod_fracao, andar, designacao from fracao where cod_edificio = $cod_edificio order by andar, designacao";
                          $resultadobuscaapartamento = $ligacao->query($sqlbuscaapartamento); 
                          if($resultadobuscaapartamento->num_rows > 0){
                            while($linha = $resultadobuscaapartamento->fetch_assoc()){
                              $cod_fracao = $linha['cod_fracao'];
                              $andar = $linha['andar'];
                              $designacao = $linha['designacao'];
                              ?>
                              <option value="<?php echo $cod_fracao ?>"><?php echo "$andar º - $designacao" ?></option>
                              <?php
                            }
                          }
                        ?>
                      <input type="submit" name="btnNovoRec2" value="Avançar" id="btnbusca" title="Clique em avançar somente quando tiver selecionado o apartamento"/>
                      </div>
                        <?php

                }

                if(isset($_POST['btnNovoRec2'])){
                  $apartamentonovorecibo = $_POST["apartamentonovorecibo"];
                  //echo "$apartamentonovorecibo";
                  ?>
                        <form action="faturacao.php" method="POST">
                                <br>
                                <div id='caixagenerica'>
                                <h2>NOVO RECIBO</h2>
                                <a name="ancoranovorecibo2"></a>
                                <em>Descrição: </em>
                                <select name="descricaonovorecibo">
                                <?php
                                  $sqlbuscafatura = "SELECT pagamento.cod_pagamento as cod_pagamentof, preco_tot, descricao from pagamento
                                  LEFT JOIN recibo
                                  ON recibo.cod_pagamento = pagamento.cod_pagamento
                                  WHERE pagamento.cod_fracao = $apartamentonovorecibo AND pagamento.cod_pagamento NOT IN (SELECT cod_pagamento FROM recibo)";
                                  $resultadobuscafatura = $ligacao->query($sqlbuscafatura); 
                                  if($resultadobuscafatura->num_rows > 0){
                                    while($linha = $resultadobuscafatura->fetch_assoc()){
                                      $cod_pagamentofat = $linha['cod_pagamentof'];
                                      $preco_totfat = $linha['preco_tot'];
                                      $descricaofat = $linha['descricao'];
                                      ?>
                                      <option value="<?php echo $cod_pagamentofat ?>"><?php echo "$preco_totfat" ?> Euros - <?php echo "$descricaofat" ?></option>
                                      <?php
                                    }
                                  }
                                ?>
                              </select>
                                <br>
                                <br>
                                <em>Data de Pagamento: </em><input type="date" required name="datanovorecibo">
                                <br>
                                <br>
                                <em>Hora do Pagamento: </em><input type="time" required name="horanovorecibo">
                                <br>
                                <br>
                                <em>Pagador: </em><input type="text" required name="pagadornovorecibo">
                                <br>
                                <br>
                                <input type="submit" name="btnCriarRecibo" value="Gerar Recibo" id="btngenerico"/>
                                </div>      
                        </form>
                  <?php
                      }
            
              $ligacao->close();
              
          }
        }
        ?>

        </div>
    </div>
    
  </body>
</html>
