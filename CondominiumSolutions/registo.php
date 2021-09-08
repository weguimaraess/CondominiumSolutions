<html xml:lang="pt" lang="pt">
  <head>
    <title>Registo</title>  
  </head>
  <body>
  <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet"> <!-- Import de Fonte para escrita -->
  <?php
    session_start();
    include "basedadosges.php";
    $idutilizador = $_SESSION['UtilizadorLogado'];
    $nomeutilizador = $_SESSION['NomeUtilizador'];
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

    tr#linhafracaotitulo{       
      background-color: #4CAF50;
      color: white;
      text-align: center;
    }

    tr#linhafracao{
                
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

    #btnnovafracao{
      font-family: 'Poppins', sans-serif;
      background-color:#2E8B57;
      width: 20%;
      height: 50px;
      margin: auto;
      color: white;
      cursor: pointer;
    }

    #caixanovafracao{
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

    #btncriarnovafracao{
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

    h4{
      font-family: 'Poppins', sans-serif;
      background-color:#4CAF50;
      margin: auto;
      color: white;
      width: 40%;
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

            //Verificar se ja foi declarada alguma alteração ou alguma exclusão
            if(isset($_POST["novocodfracao"]) && isset($_POST["novocodcondomino"]) && isset($_POST["novoprecofracao"]) && isset($_POST["novonomefracao"]) && isset($_POST["novocontactofracao"]) && isset($_POST["novologinfracao"]) && isset($_POST["novapassefracao"])){ //Checar se os valores foram passados pelo formulario
              $novocodcondomino = $_POST['novocodcondomino'];
              $novoprecofracao = $_POST['novoprecofracao'];
              $novonomefracao = $_POST['novonomefracao'];
              $novocontactofracao = $_POST['novocontactofracao'];
              $novologinfracao = $_POST['novologinfracao'];
              $novapassefracao = $_POST['novapassefracao'];
              $novocodfracao = $_POST['novocodfracao'];
                  //echo "jhfjhgjgkg";
              if($novocodcondomino > 0){ // Se existe condómino associado a uma fração
                $sqlupdate = "Update fracao set preco_f=$novoprecofracao Where cod_fracao=$novocodfracao";
                $resultadoupdate = $ligacao->query($sqlupdate);

                $sqlupdate2 = "Update utilizador set nome='$novonomefracao', contacto='$novocontactofracao', login='$novologinfracao', passe='$novapassefracao' Where cod_utilizador=$novocodcondomino";
                $resultadoupdate2 = $ligacao->query($sqlupdate2);
              } else { // Se não existe
                $sqlupdate = "Update fracao set preco_f=$novoprecofracao Where cod_fracao=$novocodfracao";
                $resultadoupdate = $ligacao->query($sqlupdate);

                $sqlinsert = "Insert into utilizador (nome, contacto, login, passe) values ('$novonomefracao', '$novocontactofracao', '$novologinfracao','$novapassefracao')";
                $resultadoinsert = $ligacao->query($sqlinsert);

                $sqlbusca = "select max(cod_utilizador) as MaxUtilizador from utilizador";
                $resultadobusca = $ligacao->query($sqlbusca);

                if($resultadobusca->num_rows > 0){
                  $linha = $resultadobusca->fetch_assoc();
                  $MaxUtilizador = $linha['MaxUtilizador'];
                }

                $sqlinsert = "Insert into condomino (cod_condomino) values ($MaxUtilizador)";
                $resultadoinsert = $ligacao->query($sqlinsert);

                $sqlupdate3 = "Update fracao set cod_condomino='$MaxUtilizador' where cod_fracao = $novocodfracao";
                $resultadoupdate3 = $ligacao->query($sqlupdate3);
              }
            }

          /*if((isset($_POST["codfracaodeletar"])) && $btn_submit='Deletar'){ //Checar se os valores foram passados pelo formulario
              $codfracaodeletar = $_POST['codfracaodeletar'];
                  //echo "jhfjhgjgkg";
              $sqldelete = "Delete from pagamento Where pagamento.cod_fracao=$codfracaodeletar";
              $resultadodelete = $ligacao->query($sqldelete);

              $sqldelete2 = "Delete from fracao Where cod_fracao=$codfracaodeletar";
              $resultadodelete2 = $ligacao->query($sqldelete2);
          }*/

          // Verificar se foi acionado o botão para registar nova fracao e com isso declaradas novas variaveis
          if(isset($_POST["codedificionovafracao"]) && isset($_POST["andarnovafracao"]) && isset($_POST["designacaonovafracao"]) && isset($_POST["preconovafracao"]) && isset($_POST["tipologianovafracao"])){
            $andarnovafracao = $_POST["andarnovafracao"];
            $designacaonovafracao = $_POST["designacaonovafracao"];
            $preconovafracao = $_POST["preconovafracao"];
            $codedificionovafracao = $_POST["codedificionovafracao"];
            $tipologianovafracao = $_POST["tipologianovafracao"];

            
            $sqlnovafracao = "Insert into fracao (preco_f, andar, designacao, tipologia, cod_edificio) values ($preconovafracao, $andarnovafracao, '$designacaonovafracao', $tipologianovafracao, $codedificionovafracao)";
            $resultado = $ligacao->query($sqlnovafracao);

          } 

            $sql = "select * from edificio where cod_gestor = $idutilizador";
            $resultado = $ligacao->query($sql);

            if($resultado->num_rows > 0){
                while($linha = $resultado->fetch_assoc()){
                  $cod_edificio = $linha['cod_edificio'];
                  $numero = $linha['numero'];
                  $morada = $linha['morada'];
                }
            }

            echo "<div><h4><em>GESTOR: $nomeutilizador".
            "<br>EDIFÍCIO: $cod_edificio".
            "<br>$morada - $numero</em></h4></div><br><br>";

            // Tabela de todas as frações daquele prédio
            echo "<h2>Frações do Edifício</h2>";
            $sqlfracoes = "SELECT * FROM fracao LEFT JOIN condomino ON fracao.cod_condomino = condomino.cod_condomino LEFT JOIN utilizador ON condomino.cod_condomino = utilizador.cod_utilizador WHERE cod_edificio = $cod_edificio ORDER BY andar, designacao";
            $resultadofracoes = $ligacao->query($sqlfracoes);

            if($resultadofracoes->num_rows > 0){
                ?> <!-- Fecha o PHP para fazer o table -->
                <table style='width:100%' id='tabela1'>
                <tr id='linhafracaotitulo'>
                    <th>Andar</th>
                    <th>Designação</th>
                    <th>Valor do Condomínio p/Fração</th>
                    <th>Tipologia</th>
                    <th>Condómino</th>
                    <th>Contacto</th>
                    <th>Login</th>
                    <th>Passe</th>
                    <th>Ações</th>
                </tr>
                <?php // Volta-se a abrir para fazer o while em PHP
                while($linha = $resultadofracoes->fetch_assoc()){
                    ?>  <!-- Fecha o PHP para fazer o conte?do das colunas pares -->
                    <tr id='linhafracao'>
                        <?php $cod_fracao = $linha['cod_fracao']; ?>
                        <td id='coluna1tab'> <?php echo $linha['andar'];?> </td>
                        <td id='coluna2tab'> <?php echo $linha['designacao'];?> </td>
                        <?php $cod_condomino = $linha['cod_condomino']; ?>
                        <td id='coluna3tab'> <?php echo $linha['preco_f'];?> </td>
                        <td id='coluna3tab'> T<?php echo $linha['tipologia'];?> </td>
                        <td id='coluna4tab'> <?php echo $linha['nome'];?> </td>
                        <td id='coluna5tab'> <?php echo $linha['contacto'];?> </td>
                        <td id='coluna6tab'> <?php echo $linha['login'];?> </td>
                        <td id='coluna7tab'> <?php echo $linha['passe'];?> </td>
                        <td id='coluna8icon'> <a href='registofuncoes.php?cod_fracao=<?php echo $linha['cod_fracao']?>&acao=edit'><img src='imgs/edit.png' width=28px height=28px /></a> <!--<a href='registofuncoes.php?cod_fracao=<//?php echo $linha['cod_fracao']?>&acao="trash"'><img src='imgs/trash.png' width=28px height=28px /></a> --> </td>
                    </tr>
                    <?php //Volta a abrir o PHP ap?s a cria??o do conte?do para finalizar o que n?o for par e criar as colunas.
                }
                ?> <!-- Fecha-se novamente para finalizar a tag HTML table -->
                </table> 
                <?php // Novamente abre-se para continuar o c?digo PHP
            }

          // Criaï¿½ï¿½o da janela para marcar nova reuniï¿½o na pï¿½gina
          ?>
          <form action="registo.php#ancoranovafracao" method="POST">
          <br><br><input type="submit" name="btnNovaF" value="Registar Nova Fração" id="btnnovafracao"/>
          </form>

          <?php
              if(isset($_POST['btnNovaF'])){
          ?>
                <form action="registo.php" method="POST">
                        <br>
                        <div id='caixanovafracao'>
                        <a name="ancoranovafracao"></a>
                        <h3>NOVA FRAÇÃO</h3>
                        <br>
                        <input type="hidden" value="<?php echo $cod_edificio ?>" required name="codedificionovafracao">
                        <em>Andar: </em><input type="number" min="0"  required name="andarnovafracao">
                        <br>
                        <br>
                        <em>Designacao: </em><input type="text" required name="designacaonovafracao">
                        <br>
                        <br>
                        <em>Preço do Condomínio p/Fração: </em><input type="number" step="any" min="0" required name="preconovafracao">
                        <br>
                        <br>
                        <em>Tipologia: </em><input type="number" required name="tipologianovafracao" min="0"> 
                        <br>
                        <br>
                        </div>
                        <input type="submit" name="btnNovaFracao" value="Criar" id="btncriarnovafracao"/>
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
