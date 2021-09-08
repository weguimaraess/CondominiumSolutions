<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>
            BasedeDados
        </title>
    </head>
    <body>

        <?php
            $servidor = "localhost";
            $utilizador = "root";
            $pass = "#Qwerty3";
            $bd = "gescondominio";

            $ligacao = new mysqli($servidor, $utilizador, $pass, $bd);

            if($ligacao->connect_error){        //Verificar Ligação
                die("Erro de conexão: " .$ligacao->connect_error);
            }
        ?>
        
    </body>
</html>