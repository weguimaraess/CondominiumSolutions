<!DOCTYPE html>
<html>
    <head>
        <meta charset="ISO-8859-1">
        <title>
            Funções do Calendário
        </title>
        
        <style>
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
                margin: auto;
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
            $cod_reuniao = $_GET["cod_reuniao"];
            $funcao = $_GET["acao"];

            $sql = "Select * from reuniao where cod_reuniao=$cod_reuniao";
            $resultado = $ligacao->query($sql);

            if($resultado->num_rows > 0){
                $linha = $resultado->fetch_assoc();
                $data_r = $linha['data_r'];
                $pauta = $linha['pauta'];
                $cod_gestor = $linha['cod_gestor'];
                $cod_edificio = $linha['cod_edificio'];
            }

            if($funcao == "edit"){
        ?>
                    <form action="calendario.php" method="POST">
                        <div id="caixaeditar"> <!-- Separa tudo que realizado dentro da sua tag envolto de um ret?ngulo. --> 
                            <h3>FORMULARIO PARA ALTERAÇÃO</h3> <!-- legenda para o ret?ngulo dado -->
                            <input type="hidden" value=<?php echo $cod_reuniao ?> readonly=?true? name="novocodreuniao">
                            <em>Data da Reunião: </em><input type="date" required value=<?php echo $data_r ?> name="novadatareuniao">
                            <br>
                            <br>
                            <br>
                            <em>Pauta: </em><input type="text" value="<?php echo "$pauta"; ?>" required name="novapautareuniao">
                            <br>
                            <br>
                            <br>
                            <em>Concluida: </em><input type="checkbox" name="novaconclusaoreuniao" value="1">
                            <br>
                            <br>
                            <br>
                            <input type="submit" value="Submeter" name="btn_submit" id="btneditar" title="Ao clicar os dados serão alterados para os valores inseridos!">
                        </div>
                        <br>
                        <a href="calendario.php"><em>Voltar atrás<em></a>
                    </form>
                <?php
                } else {
                ?>
                    <form action="calendario.php" method="POST">
                        <div id="caixadeletar"> <!-- Separa tudo que realizado dentro da sua tag envolto de um ret?ngulo. --> 
                            <h3>CONFIRMAÇÃO PARA APAGAR A REUNIÃO</h3> <!-- h3a para o ret?ngulo dado -->
                            <input type="hidden" value=<?php echo $cod_reuniao ?> readonly=?true? name="codreuniaodeletar">
                            <em>Data da Reunião: <?php echo $data_r; ?>
                            <br>
                            <br>
                            <em>Pauta: <?php echo $pauta; ?>
                            <br>
                            <br>
                            <input type="submit" value="Deletar" name="btn_submit" id="btndeletar" title="Tenha certeza da exclusão antes de clicar!" onclick="return confirm('Tem certeza que deseja deletar esse registro?')">
                        </div>
                        <br>
                        <a href="calendario.php"><em>Voltar atrás<em></a>
                <?php
                }
                ?>

        
    </body>
</html>