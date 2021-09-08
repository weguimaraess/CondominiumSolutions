<!DOCTYPE html>
<html>
    <head>
        <meta charset="ISO-8859-1">
        <title>
            Funções de Registo
        </title>
        
        <style>
            table{
                text-align: center;
            }

            tr{
                
                background-color: white;
                text-align: center;
            }

            td{
                text-align: center;
            }

            h1{
                text-align: center;
                color: red;
            }

            body {
			    padding:0px;
                margin:0px;
                background-color: #CAE1FF;
                font-weight: bold;
                font-family: 'Calibri light', sans-serif;
                text-align: center;
		    }

            table{
                text-align: center;
            }

            tr{
                
                background-color: white;
                text-align: center;
            }

            td{
                text-align: center;
            }

            h1{
                text-align: center;
                color: red;
            }

            #caixadeletar{
                background-color:#4CAF50;
                width: 100%;
                margin: auto;
                margin-top: 10px;
                padding-bottom: 4px;
                border-radius: 5px;
                color: white;
            }

            #caixaeditar{
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

            h1{
                font-family: 'Poppins', sans-serif;
                background-color:#4CAF50;
                margin: auto;
            }

            #btndeletar{
                font-family: 'Poppins', sans-serif;
                background-color:#CD0000;
                width: 20%;
                height: 50px;
                margin: auto;
                color: white;
                cursor: pointer;
                padding:2px;
            }

            #btneditar{
                font-family: 'Poppins', sans-serif;
                background-color:#27408B;
                width: 20%;
                height: 50px;
                margin: auto;
                color: white;
                cursor: pointer;
                padding:2px;
            }

            a{
                font-family: 'Poppins', sans-serif;
                font-size: 12px;
                background-color:#2E8B57;
                border: 10px solid #2E8B57;
                height: 20px;
                color: white;
                cursor: pointer;
                padding:2px;
            }
        </style>

    </head>
    <body>
        <div style="text-align: center;">
        <img src="imgs/banner.png" style="width: 50%; height: 50%; -webkit-filter: blur(2px)">
        <?xml version="1.0" encoding="iso-8859-1"?>
        </div>
        <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet"> <!-- Import de Fonte para escrita -->
        <?php
            session_start();
            header("Content-Type: text/html; charset=ISO-8859-1", true);
            include 'basedadosges.php';
            $idutilizador = $_SESSION['UtilizadorLogado'];
            $cod_fracao = $_GET["cod_fracao"];
            $funcao = $_GET["acao"];

            $sql = "SELECT * FROM fracao LEFT JOIN UTILIZADOR ON fracao.cod_condomino = utilizador.cod_utilizador WHERE cod_fracao=$cod_fracao";
            $resultado = $ligacao->query($sql);

            if($resultado->num_rows > 0){
                $linha = $resultado->fetch_assoc();
                $preco_f = $linha['preco_f'];
                $andar = $linha['andar'];
                $designacao = $linha['designacao'];
                $cod_edificio = $linha['cod_edificio'];
                $cod_condomino = $linha['cod_condomino'];
                $nome = $linha['nome'];
                $contacto = $linha['contacto'];
                $login = $linha['login'];
                $passe = $linha['passe'];

            }

            if($funcao == "edit"){
        ?>
                    <form action="registo.php" method="POST">
                        <div id="caixaeditar"> <!-- Separa tudo que realizado dentro da sua tag envolto de um ret?ngulo. --> 
                            <h3>FORMULARIO PARA ALTERAÇÃO</h3> <!-- Legenda para o ret?ngulo dado -->
                            <input type="hidden" value=<?php echo $cod_fracao ?> readonly=?true? name="novocodfracao">
                            <input type="hidden" value=<?php echo $cod_condomino ?> readonly=?true? name="novocodcondomino">
                            <em>Preço pago pela Fração: </em><input type="float" required value=<?php echo $preco_f ?> name="novoprecofracao">
                            <br>
                            <br>
                            <em>Condómino: </em><input type="text" required value="<?php echo $nome; ?>" name="novonomefracao">
                            <br>
                            <br>
                            <em>Contacto: </em><input type="text" required value="<?php echo $contacto; ?>" name="novocontactofracao">
                            <br>
                            <br>
                            <em>Login: </em><input type="text" required value="<?php echo $login; ?>" name="novologinfracao">
                            <br>
                            <br>
                            <em>Passe: </em><input type="text" required value="<?php echo $passe; ?>" name="novapassefracao">
                            <br>
                            <br>
                            <input type="submit" value="Submeter" name="btn_submit" id="btneditar" title="Ao clicar os dados serão alterados para os valores inseridos!">
                        </div>
                        <br>
                        <a href="registo.php"><em>Voltar atrás<em></a>
                    </form>
                <?php
                } else {
                ?>
                    <form action="registo.php" method="POST">
                        <div id="caixadeletar"> <!-- Separa tudo que realizado dentro da sua tag envolto de um ret?ngulo. --> 
                            <h3>CONFIRMAÇÃO PARA APAGAR A FRACÃO</h3> <!-- Legenda para o ret?ngulo dado -->
                            <input type="hidden" value=<?php echo $cod_fracao; ?> readonly=?true? name="codfracaodeletar">
                            <em>Andar: <?php echo $andar; ?>
                            <br>
                            <br>
                            <em>Designação: <?php echo $designacao; ?>
                            <br>
                            <br>
                            <input type="submit" value="Deletar" name="btn_submit" id="btndeletar" title="Tenha certeza da exclusão antes de clicar!" onclick="return confirm('Tem certeza que deseja deletar esse registro?')">
                        </div>
                        <br>
                        <a href="registo.php"><em>Voltar atrás<em></a>
                <?php
                }
                ?>

        
    </body>
</html>