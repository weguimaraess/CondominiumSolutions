<html xml:lang="pt" lang="pt">
  <head>
    <title>Calendário</title>
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

    h2{
      font-family: 'Poppins', sans-serif;
      border-radius: 10px;
      background-color:#4CAF50;
      width: 50%;
      margin: auto;
      color: white;
      
    }

    #btnnovareuniao{
      font-family: 'Poppins', sans-serif;
      background-color:#2E8B57;
      width: 20%;
      height: 50px;
      margin: auto;
      color: white;
      cursor: pointer;
    }

    #caixanovareuniao{
      background-color:#4CAF50;
      width: 100%;
      margin: auto;
      margin-top: 10px;
      padding-bottom: 4px;
      border-radius: 5px;
    }

    h3{
      font-family: 'Poppins', sans-serif;
      background-color:#4CAF50;
      margin: auto;
      color: white;
    }

    #btncriarnovareuniao{
      font-family: 'Poppins', sans-serif;
      background-color:#2E8B57;
      width: 20%;
      height: 50px;
      margin: auto;
      color: white;
      cursor: pointer;
      padding:2px;
    }

    em{
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
        $idutilizador = $_SESSION['UtilizadorLogado'];
        //Verificar se ja foi declarada alguma altera??o ou alguma exclus?o
        if(isset($_POST["novadatareuniao"]) && isset($_POST["novapautareuniao"]) && isset($_POST["novocodreuniao"] )){ //Checar se os valores foram passados pelo formulario
          $novadatareuniao = $_POST['novadatareuniao'];
          $novapautareuniao = $_POST['novapautareuniao'];
          $novocodreuniao = $_POST['novocodreuniao'];
          if(isset($_POST["novaconclusaoreuniao"])){
            $novaconclusaoreuniao = $_POST["novaconclusaoreuniao"];
          } else {
            $novaconclusaoreuniao = 0;
          }
              //echo "jhfjhgjgkg";
          $sqlupdate = "Update reuniao set data_r='$novadatareuniao', pauta='$novapautareuniao', estado_reuniao=$novaconclusaoreuniao Where cod_reuniao=$novocodreuniao";
          $resultadoupdate = $ligacao->query($sqlupdate);
        }

      if((isset($_POST["codreuniaodeletar"])) && $btn_submit='Deletar'){ //Checar se os valores foram passados pelo formulario
          $codreuniaodeletar = $_POST['codreuniaodeletar'];
              //echo "jhfjhgjgkg";
          $sqldelete = "Delete from reuniao Where cod_reuniao=$codreuniaodeletar";
          $resultadodelete = $ligacao->query($sqldelete);
      }

      // Verificar se foi acionado o bot?o para marcar nova reuniao e com isso declaradas novas variaveis
      if(isset($_POST["datamarcarreuniao"]) && isset($_POST["pautamarcarreuniao"])){
        $datamarcarreuniao = $_POST["datamarcarreuniao"];
        $pautamarcarreuniao = $_POST["pautamarcarreuniao"];

        $sqlmarcarreuniao = "Insert into reuniao (data_r, pauta, cod_gestor, cod_edificio) values ('$datamarcarreuniao', '$pautamarcarreuniao', $idutilizador, (SELECT cod_edificio from edificio where cod_gestor = $idutilizador))";
        $resultado = $ligacao->query($sqlmarcarreuniao);
      }


        header("Content-Type: text/html; charset=ISO-8859-1", true);
        if (empty($_SESSION['UtilizadorLogado'])) {
 
          // n?o existe sess?o iniciada
          // neste caso, levamos o utilizador para a p?gina de login
          header('Location: login.php');
          exit("Utilizador nao logado!");
        } else {
          if($_SESSION['NivelDeAcesso'] != 1) {
            echo "Você não tem acesso a esta página!";
            //header('Location: principal.php');
            die();
          } else {
            $idutilizador = $_SESSION['UtilizadorLogado'];
            // TABELA DE REUNIÕES FINALIZADAS
            echo "<h2>Reuniões Passadas</h2>";
            $sqlreuniao = "Select distinct data_r, pauta, edificio.numero, edificio.morada, utilizador.nome, cod_reuniao, estado_reuniao from reuniao, administrador, utilizador, edificio, condomino, fracao
            where (reuniao.cod_gestor = administrador.cod_gestor) and (utilizador.cod_utilizador = administrador.cod_gestor) and (reuniao.cod_edificio = edificio.cod_edificio) and (fracao.cod_edificio = edificio.cod_edificio) and (administrador.cod_gestor = $idutilizador) and (reuniao.estado_reuniao = 1) order by data_r";
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
                    <th>Ações</th>
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
                        <td id='coluna6icon'> <a href='calendariofuncoes.php?cod_reuniao=<?php echo $linha['cod_reuniao']?>&acao="trash"'><img src='imgs/trash.png' width=28px height=28px /></a> </td>
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

             // TABELA DE REUNIÕES FUTURAS
             echo "<h2>Futuras Reuniões</h2>";
             $sqlreuniao = "Select distinct data_r, pauta, edificio.numero, edificio.morada, utilizador.nome, cod_reuniao, estado_reuniao from reuniao, administrador, utilizador, edificio, condomino, fracao
             where (reuniao.cod_gestor = administrador.cod_gestor) and (utilizador.cod_utilizador = administrador.cod_gestor) and (reuniao.cod_edificio = edificio.cod_edificio) and (fracao.cod_edificio = edificio.cod_edificio) and (administrador.cod_gestor = $idutilizador) and (reuniao.estado_reuniao = 0) order by data_r";
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
                     <th>Ações</th>
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
                         <td id='coluna6icon'> <a href='calendariofuncoes.php?cod_reuniao=<?php echo $linha['cod_reuniao']?>&acao=edit'><img src='imgs/edit.png' width=28px height=28px /></a> <a href='calendariofuncoes.php?cod_reuniao=<?php echo $linha['cod_reuniao']?>&acao="trash"'><img src='imgs/trash.png' width=28px height=28px /></a> </td>
                     </tr>
                     <?php //Volta a abrir o PHP ap?s a cria??o do conte?do para finalizar o que n?o for par e criar as colunas.
                 }
                 ?> <!-- Fecha-se novamente para finalizar a tag HTML table -->
                 </table> 
                 <?php // Novamente abre-se para continuar o c?digo PHP
             }
          

          // Cria??o da janela para marcar nova reuni?o na p?gina
          ?>
          <form action="calendario.php#ancoranovareuniao" method="POST">
          <br><br><input type="submit" name="btnNovo" value="Marcar Reunião" id='btnnovareuniao' title="Ao clicar aqui poderá marcar uma nova reunião no edifício!"/>
          </form>

          <?php
              if(isset($_POST['btnNovo'])){
          ?>
                <form action="calendario.php" method="POST">
                        <br>
                        <div id='caixanovareuniao'>
                        <a name="ancoranovareuniao"></a>
                        <h3>NOVA REUNIÃO</h3>
                        <br>
                        <em>Data da Reunião: </em><input type="date" min="2018-01-01" max="2030-12-31" required name="datamarcarreuniao">
                        <h6 style="color:red;">Para valores entre 01-01-2018 a 31-12-2030</h6>
                        <br>
                        <br>
                        <em>Pauta: </em><input type="text" required name="pautamarcarreuniao">
                        <br>
                        <br>
                        <input type="submit" name="btnNovo" value="Criar" id='btncriarnovareuniao'/>
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
