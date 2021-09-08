<html xml:lang="pt" lang="pt">
  <head>
    <title>Contacto</title>
  </head>
  <body>
  <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet"> <!-- Import de Fonte para escrita -->
  <?php
    header("Content-Type: text/html; charset=ISO-8859-1", true);
    session_start();
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
        if (empty($_SESSION['UtilizadorLogado'])) {
 
          // não existe sessão iniciada
          // neste caso, levamos o utilizador para a página de login
          header('Location: login.php');
          exit("Utilizador não logado!");
        } else {

          echo "Em caso de dúvidas ou auxílio, poderá contactar-nos através do telefone: +351 999 888 777";
          echo "<br><br> Caso prefira, poderá enviar-nos um email, basta <a href='mailto:gescon@condominiumsolutions.pt?subject=Suporte[CondominiumSolutions]'>clicar aqui</a>
                <br> Ou enviar um email diretamente para <em>gescon@condominiumsolutions.pt<em>";

        }
        ?>

        </div>

    </div>
    
  </body>
</html>
