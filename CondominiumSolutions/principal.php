<html xml:lang="pt" lang="pt">
  <head>
    <title>Página Principal</title>
  </head>
  <body>
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
      font-family: 'Calibri', sans-serif;
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

    #avatar{
      width: 8%;
      
    }

    #texto-avatar{
      margin-top: -20px;
    }

    #avatar-texto-container{
      text-align: center;
    }

    p{
      font-size: 12px;
    }

    #logo{
      width: 2%;
    }

    
	</style>

    <?php
        include 'basedadosges.php';
        session_start(); #inicia a sessão do PHP
        $LoginErro = "Nenhum usuário com esses dados, tente novamente inserir um login! <br><a href=login.php>Login</a>";

        if((isset($_POST["login"]) && isset($_POST["passe"])) || isset($_SESSION['UtilizadorLogado'])){
          if(isset($_POST["login"]) && isset($_POST["passe"])){
          $loginutilizador = $_POST["login"];
          $passeutilizador = $_POST["passe"];
  
          $sqllogin = "SELECT COUNT(*) AS ExistenciaLogin FROM utilizador WHERE login = '$loginutilizador' AND passe = '$passeutilizador'";
          $resultado = $ligacao->query($sqllogin);
          // Resultado será um array de linhas, nesse caso com apenas uma linha
          while($linha = $resultado->fetch_assoc()){
            $loginexiste = $linha['ExistenciaLogin'];
          }
          //echo $loginexiste;
          if ($loginexiste == 1){
            $sqllogin2 = "SELECT * FROM utilizador WHERE login = '$loginutilizador' AND passe = '$passeutilizador'";
            $resultado2 = $ligacao->query($sqllogin2);
            while($linha2 = $resultado2->fetch_assoc()){
              $cod_utilizador = $linha2['cod_utilizador'];
              $nivel_acesso = $linha2['nivel_acesso'];
              $nome = $linha2['nome'];
            }
            $_SESSION['UtilizadorLogado'] = $cod_utilizador;
            $_SESSION['NivelDeAcesso'] = $nivel_acesso;
            $_SESSION['NomeUtilizador'] = $nome;

          } else { // Caso tenha erro no login
            //echo $LoginErro;
            header('Location: login.php');
          }
          } else {
            //echo "Bem vindo <b>".$_SESSION['NomeUtilizador']."</b>, tudo bem?<br>Não esqueça que você é nivel <b>".$_SESSION['NivelDeAcesso']."</b> nesse sistema!";
            //echo '<br><a href=../config/Deslogar.php>Sair</a>';
          }

        } else{ // Caso não tenha sido declarado nada, exemplo, só colocar o url
          //return false;
          header('Location: login.php');
        }
        

    ?>

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
      <div id="avatar-texto-container">
      <?php if($_SESSION['NivelDeAcesso'] == 0) {
          ?>
          <img src="imgs/avatar-condomino.png" id="avatar" >
          <div id="texto-avatar">
            <h4>Olá, <?php echo $_SESSION['NomeUtilizador'] ?>.
            <br>Você foi autenticado como Condómino!</h4>
          </div>
          <?php
        } else {
            ?>
            <img src="imgs/avatar-gestor.png" id="avatar">
            <div id="texto-avatar">
              <h4>Olá, <?php echo $_SESSION['NomeUtilizador'] ?>.
              <br>Você foi autenticado como Gestor!</h4>
            </div>
            <?php
        }
        ?>
        </div>
      <p style="text-align: center;">Seja muito bem vindo a plataforma Condominium Solutions, escolha dentre as opções do menu acima para utilizar nossos recursos.
        <br><br>
        <h5>Caso deseje sair da plataforma: <a href="logout.php">Terminar sessão</a></h5>
      </p>
    </div>

    
  </body>
</html>
