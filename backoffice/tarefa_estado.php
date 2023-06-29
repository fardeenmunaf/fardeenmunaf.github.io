<?php

    //ficheiro alternar o estado de conclusao de uma tarefa

    //vamos verificar se temos um GET
    if($_SERVER["REQUEST_METHOD"] == "GET") {

        //vamos verificar se é passado um valor no id e se o mesmo é numérico e se o estado é 0 ou 1
        if(isset($_GET["id"]) && is_numeric($_GET["id"]) && ($_GET["estado"] == 0 || $_GET["estado"] == 1)) {

            //definir variavel
            $idTarefa = $_GET["id"];

            //incluimos o ficheiro db.php
            include_once("db.php");

            //vamos verificar se existe o ID na base de dados
            $query = "select * from servicos where idTarefa=$idTarefa";

            //executamos a consulta
            $resultado = mysqli_query($conexao, $query);

            //atribuimos a variavel o numero de registos retornados pela query
            $tarefaEncontrada = mysqli_num_rows($resultado);

            //limpar a variavel resultado
            mysqli_free_result($resultado);

            //se existir o id, podemos alterar o seu estado de concluida
            if($tarefaEncontrada > 0) {

                //trocamos o valor do estado de concluido
                //se o estado for 0 passa a 1 (vice-versa)
                $estado = $_GET["estado"] == 0 ? 1 : 0;

                //efetuamos um query de update
                $query = "update servicos set concluida=$estado where idTarefa=$idTarefa";

                //executamos a consulta
                $resultado = mysqli_query($conexao, $query);

                //se o resultado retornar um true encaminhamos com a msg = 2
                if($resultado) {

                    //header("location: tarefas.php?msg=2");
                    header("location: tarefas.php");
                }

            } else {

                header("location: tarefas.php?msg=4");
            }

            //fechamos a ligação ao mysql
            mysqli_close($conexao);
        }
    }

?>