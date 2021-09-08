<!DOCTYPE html>
<html>
    <head>
        <meta charset="ISO-8859-1">
        <title>
            Funções de Manutenção
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
            $idutilizador = $_SESSION['UtilizadorLogado'];
            $cod_manutencao = $_GET["cod_manutencao"];
            $funcao = $_GET["acao"];

            $sql = "Select * from manutencao where cod_manutencao=$cod_manutencao";
            $resultado = $ligacao->query($sql);

            if($resultado->num_rows > 0){
                $linha = $resultado->fetch_assoc();
                $data_m = $linha['data_m'];
                $hora_m = $linha['hora_m'];
                $descricao = $linha['descricao'];
                $cod_edificio = $linha['cod_edificio'];
            }

            if($funcao == "edit"){
        ?>
                    <form action="manutencao.php" method="POST">
                        <div id="caixaeditar"> <!-- Separa tudo que realizado dentro da sua tag envolto de um ret?ngulo. --> 
                            <h3>FORMULARIO PARA ALTERAÇÃO</h3> <!-- h3a para o ret?ngulo dado -->
                            <input type="hidden" value=<?php echo $cod_manutencao ?> readonly=?true? name="novocodmanutencao">
                            <em>Data da Manutenção: </em><input type="date" required value=<?php echo $data_m ?> name="novadatamanutencao">
                            <br>
                            <br>
                            <em>Hora da Manutenção: </em><input type="time" required value=<?php echo $hora_m ?> name="novahoramanutencao">
                            <br>
                            <br>
                            <em>Descrição: </em><input type="text" value="<?php echo $descricao ?>" required name="novadescricaomanutencao">
                            <br>
                            <br>
                            <em>Funcionário: </em>
                            <select name="novofuncionariomanutencao">
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
                            <em>Concluida: </em><input type="checkbox" name="novaconclusaomanutencao" value="1">
                            <br>
                            <br>
                            <input type="submit" value="Submeter" name="btn_submit" id="btneditar" title="Ao clicar os dados serão alterados para os valores inseridos!">
                        </div>
                        <br>
                        <a href="manutencao.php"><em>Voltar atrás<em></a>
                    </form>
                <?php
                } else {
                ?>
                    <form action="manutencao.php" method="POST">
                        <div id="caixadeletar"> <!-- Separa tudo que realizado dentro da sua tag envolto de um ret?ngulo. --> 
                            <h3>CONFIRMAÇÃO PARA APAGAR A MANUTENÇÃO</h3> <!-- h3a para o ret?ngulo dado -->
                            <input type="hidden" value=<?php echo $cod_manutencao ?> readonly=?true? name="codmanutencaodeletar">
                            <em>Data da Manutenção: <?php echo $data_m; ?>
                            <br>
                            <br>
                            <em>Descrição: <?php echo $descricao; ?>
                            <br>
                            <br>
                            <input type="submit" value="Deletar" name="btn_submit" id="btndeletar" title="Tenha certeza da exclusão antes de clicar!" onclick="return confirm('Tem certeza que deseja deletar esse registro?')">
                        </div>
                        <br>
                        <a href="manutencao.php"><em>Voltar atrás<em></a>
                <?php
                }
                ?>

        
    </body>
</html>