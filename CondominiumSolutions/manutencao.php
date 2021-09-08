<html xml:lang="pt" lang="pt">
  <head>
    <title>Manutenção</title>
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

    tr#linhamanutencaotitulo{       
      background-color: #4CAF50;
      color: white;
      text-align: center;
    }

    tr#linhamanutencao{
                
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

    #btnnovamanutencao{
      font-family: 'Poppins', sans-serif;
      background-color:#2E8B57;
      width: 20%;
      height: 50px;
      margin: auto;
      color: white;
      cursor: pointer;
    }

    #caixanovamanutencao{
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

    #btncriarnovamanutencao{
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
        header("Content-Type: text/html; charset=ISO-8859-1", true);
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

            $idutilizador = $_SESSION['UtilizadorLogado'];
            //Verificar se ja foi declarada alguma alteração ou alguma exclusão
            if(isset($_POST["novadatamanutencao"]) && isset($_POST["novadescricaomanutencao"]) && isset($_POST["novofuncionariomanutencao"]) && isset($_POST["novahoramanutencao"]) && isset($_POST["novocodmanutencao"])){ //Checar se os valores foram passados pelo formulario
              $novadatamanutencao = $_POST['novadatamanutencao'];
              $novahoramanutencao = $_POST['novahoramanutencao'];
              $novadescricaomanutencao = $_POST['novadescricaomanutencao'];
              $novofuncionariomanutencao = $_POST['novofuncionariomanutencao'];
              $novocodmanutencao = $_POST['novocodmanutencao'];
              if(isset($_POST["novaconclusaomanutencao"])){
                $novaconclusaomanutencao = $_POST["novaconclusaomanutencao"];
              } else {
                $novaconclusaomanutencao = 0;
              }
                  //echo "jhfjhgjgkg";
              $sqlupdate = "Update manutencao set data_m='$novadatamanutencao', hora_m='$novahoramanutencao', descricao='$novadescricaomanutencao', estado_manutencao=$novaconclusaomanutencao Where cod_manutencao=$novocodmanutencao";
              $resultadoupdate = $ligacao->query($sqlupdate);

              $sqlupdate2 = "Update funcionario_manutencao set cod_funcionario='$novofuncionariomanutencao' Where cod_manutencao=$novocodmanutencao";
              $resultadoupdate2 = $ligacao->query($sqlupdate2);
            }

          if((isset($_POST["codmanutencaodeletar"])) && $btn_submit='Deletar'){ //Checar se os valores foram passados pelo formulario
              $codmanutencaodeletar = $_POST['codmanutencaodeletar'];
                  //echo "jhfjhgjgkg";
              $sqldelete = "Delete from funcionario_manutencao Where cod_manutencao=$codmanutencaodeletar";
              $resultadodelete = $ligacao->query($sqldelete);

              $sqldelete2 = "Delete from manutencao Where cod_manutencao=$codmanutencaodeletar";
              $resultadodelete2 = $ligacao->query($sqldelete2);
          }

          // Verificar se foi acionado o botão para marcar nova manutençao e com isso declaradas novas variaveis
          if(isset($_POST["datamarcarmanutencao"]) && isset($_POST["horamarcarmanutencao"]) && isset($_POST["descricaomarcarmanutencao"]) && isset($_POST["funcionariomarcarmanutencao"])){
            $datamarcarmanutencao = $_POST["datamarcarmanutencao"];
            $horamarcarmanutencao = $_POST["horamarcarmanutencao"];
            $descricaomarcarmanutencao = $_POST["descricaomarcarmanutencao"];
            $funcionariomarcarmanutencao = $_POST["funcionariomarcarmanutencao"];


            $sqlmarcarmanutencao = "Insert into manutencao (data_m, hora_m, descricao, cod_edificio) values ('$datamarcarmanutencao', '$horamarcarmanutencao', '$descricaomarcarmanutencao', (SELECT cod_edificio from edificio where cod_gestor = $idutilizador))";
            $resultado = $ligacao->query($sqlmarcarmanutencao);

            $sqlmaxmanutencao = "SELECT max(cod_manutencao) as MaxManutencao from manutencao";
            $resultado = $ligacao->query($sqlmaxmanutencao);
            if($resultado->num_rows > 0){
              $linha = $resultado->fetch_assoc();
              $MaxManutencao = $linha['MaxManutencao'];
            }
            // Insere em Funcionario_Manutenção
            $sqlinsertfuncionariomanutencao = "Insert into funcionario_manutencao (cod_funcionario, cod_manutencao) values ($funcionariomarcarmanutencao, $MaxManutencao)";
            $resultado = $ligacao->query($sqlinsertfuncionariomanutencao);

          }


            // TABELA DE MANUTENÇÕES REALIZADAS
            echo "<h2>Manutenções Realizadas</h2>";
            $sqlmanutencao = "Select distinct data_m, hora_m, descricao, edificio.numero, edificio.morada, funcionario.nome as func, utilizador.nome, manutencao.cod_manutencao from manutencao, administrador, utilizador, edificio, condomino, fracao, funcionario, funcionario_manutencao
            where (funcionario.cod_gestor = administrador.cod_gestor) and (utilizador.cod_utilizador = administrador.cod_gestor) and (manutencao.cod_edificio = edificio.cod_edificio) and (fracao.cod_edificio = edificio.cod_edificio) and (funcionario.cod_funcionario = funcionario_manutencao.cod_funcionario) and (manutencao.cod_manutencao = funcionario_manutencao.cod_manutencao) and (administrador.cod_gestor = $idutilizador) and (manutencao.estado_manutencao = 1) order by data_m";
            $resultadomanutencao = $ligacao->query($sqlmanutencao);

            if($resultadomanutencao->num_rows > 0){
                ?> <!-- Fecha o PHP para fazer o table -->
                <table style='width:100%' id='tabela1'>
                <tr id='linhamanutencaotitulo'>
                    <th>Data da Manutenção</th>
                    <th>Hora</th>
                    <th>Descrição</th>
                    <th>Morada</th>
                    <th>Nº do Edifício</th>
                    <th>Funcionario</th>
                    <th>Gestor Responsável</th>
                    <th>Ações</th>
                </tr>
                <?php // Volta-se a abrir para fazer o while em PHP
                while($linha = $resultadomanutencao->fetch_assoc()){
                    ?>  <!-- Fecha o PHP para fazer o conte?do das colunas pares -->
                    <tr id='linhamanutencao'>
                        <td id='coluna1tab'> <?php echo $linha['data_m'];?> </td>
                        <td id='coluna2tab'> <?php echo $linha['hora_m'];?> </td>
                        <td id='coluna3tab'> <?php echo $linha['descricao'];?> </td>
                        <td id='coluna3tab'> <?php echo $linha['morada'];?> </td>
                        <td id='coluna5tab'> <?php echo $linha['numero'];?> </td>
                        <td id='coluna5tab'> <?php echo $linha['func'];?> </td>
                        <td id='coluna5tab'> <?php echo $linha['nome'];?> </td>
                        <td id='coluna6icon'> <a href='manutencaofuncoes.php?cod_manutencao=<?php echo $linha['cod_manutencao']?>&acao="trash"'><img src='imgs/trash.png' width=28px height=28px /></a> </td>
                    </tr>
                    <?php //Volta a abrir o PHP ap?s a cria??o do conte?do para finalizar o que n?o for par e criar as colunas.
                }
                ?> <!-- Fecha-se novamente para finalizar a tag HTML table -->
                </table> 
            <?php
              }

                // TABELA DE MANUTENÇÕES FUTURAS
            echo "<br><br><h2>Manutenções Futuras</h2>";
            $sqlmanutencao = "Select distinct data_m, hora_m, descricao, edificio.numero, edificio.morada, funcionario.nome as func, utilizador.nome, manutencao.cod_manutencao from manutencao, administrador, utilizador, edificio, condomino, fracao, funcionario, funcionario_manutencao
            where (funcionario.cod_gestor = administrador.cod_gestor) and (utilizador.cod_utilizador = administrador.cod_gestor) and (manutencao.cod_edificio = edificio.cod_edificio) and (fracao.cod_edificio = edificio.cod_edificio) and (funcionario.cod_funcionario = funcionario_manutencao.cod_funcionario) and (manutencao.cod_manutencao = funcionario_manutencao.cod_manutencao) and (administrador.cod_gestor = $idutilizador) and (manutencao.estado_manutencao = 0) order by data_m";
            $resultadomanutencao = $ligacao->query($sqlmanutencao);

            if($resultadomanutencao->num_rows > 0){
                ?> <!-- Fecha o PHP para fazer o table -->
                <table style='width:100%' id='tabela1'>
                <tr id='linhamanutencaotitulo'>
                    <th>Data da Manutenção</th>
                    <th>Hora</th>
                    <th>Descrição</th>
                    <th>Morada</th>
                    <th>Nº do Edifício</th>
                    <th>Funcionario</th>
                    <th>Gestor Responsável</th>
                    <th>Ações</th>
                </tr>
                <?php // Volta-se a abrir para fazer o while em PHP
                while($linha = $resultadomanutencao->fetch_assoc()){
                    ?>  <!-- Fecha o PHP para fazer o conte?do das colunas pares -->
                    <tr id='linhamanutencao'>
                        <td id='coluna1tab'> <?php echo $linha['data_m'];?> </td>
                        <td id='coluna2tab'> <?php echo $linha['hora_m'];?> </td>
                        <td id='coluna3tab'> <?php echo $linha['descricao'];?> </td>
                        <td id='coluna3tab'> <?php echo $linha['morada'];?> </td>
                        <td id='coluna5tab'> <?php echo $linha['numero'];?> </td>
                        <td id='coluna5tab'> <?php echo $linha['func'];?> </td>
                        <td id='coluna5tab'> <?php echo $linha['nome'];?> </td>
                        <td id='coluna6icon'> <a href='manutencaofuncoes.php?cod_manutencao=<?php echo $linha['cod_manutencao']?>&acao=edit'><img src='imgs/edit.png' width=28px height=28px /></a> <a href='manutencaofuncoes.php?cod_manutencao=<?php echo $linha['cod_manutencao']?>&acao="trash"'><img src='imgs/trash.png' width=28px height=28px /></a> </td>
                    </tr>
                    <?php //Volta a abrir o PHP ap?s a cria??o do conte?do para finalizar o que n?o for par e criar as colunas.
                }
                ?> <!-- Fecha-se novamente para finalizar a tag HTML table -->
                </table>
                <?php // Novamente abre-se para continuar o c?digo PHP
            }
          

          // Criaï¿½ï¿½o da janela para marcar nova reuniï¿½o na pï¿½gina
          ?>
          <form action="manutencao.php#ancoranovamanutencao" method="POST">
          <br><br><input type="submit" name="btnNovaM" value="Marcar Manutenção" id='btnnovamanutencao' title="Ao clicar aqui poderá marcar uma nova manutenção no edifício!"/>
          </form>

          <?php
              if(isset($_POST['btnNovaM'])){
          ?>
                <form action="manutencao.php" method="POST">
                        <br>
                        <div id='caixanovamanutencao'>
                        <a name="ancoranovamanutencao"></a>
                        <h3>NOVA MANUTENÇÃO</h3>
                        <br>
                        <em>Data da Manutenção: </em><input type="date" required name="datamarcarmanutencao">
                        <br>
                        <br>
                        <em>Hora: </em><input type="time" required name="horamarcarmanutencao">
                        <br>
                        <br>
                        <em>Descrição: </em><input type="text" required name="descricaomarcarmanutencao">
                        <br>
                        <br>
                        <em>Funcionário: </em>
                        <select name="funcionariomarcarmanutencao">
                          <?php $sqlbuscafunc = "select cod_funcionario, nome, funcao from funcionario where cod_gestor = $idutilizador";
                            $resultadobuscafunc = $ligacao->query($sqlbuscafunc); 
                            if($resultadobuscafunc->num_rows > 0){
                              while($linha = $resultadobuscafunc->fetch_assoc()){
                                $cod_funcionario = $linha['cod_funcionario'];
                                $nome = $linha['nome'];
                                $funcao = $linha['funcao'];
                                ?>
                                <option value="<?php echo $cod_funcionario ?>"><?php echo $nome ?> - <?php echo $funcao ?></option>
                                <?php
                              }
                            }
                          ?>
                        </select>
                        <br>
                        <br>
                        </div>
                        <input type="submit" name="btnNovaManutencao" value="Criar" id='btncriarnovamanutencao'/>
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
