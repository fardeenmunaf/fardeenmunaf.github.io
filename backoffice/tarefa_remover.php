<?php
// ficheiro para remover os registos da tabela tarefas
// vamos verificar se existe um GET
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // vamos verificar se é passado um valor numerico no id
    if (isset($_GET["id"]) && is_numeric($_GET["id"])) {
        // definir uma variavel
        $idTarefa = $_GET["id"];

        // incluímos o ficheiro db.php
        include_once("db.php");

        // preparamos a consulta para verificar se o ID existe na base de dados
        $query = "SELECT * FROM servicos WHERE id_serv = ?";
        $stmt = mysqli_prepare($conexao, $query);
        mysqli_stmt_bind_param($stmt, "i", $idTarefa);
        mysqli_stmt_execute($stmt);

        // obtemos o resultado da consulta
        $resultado = mysqli_stmt_get_result($stmt);

        // verificamos se o ID existe
        if (mysqli_num_rows($resultado) > 0) {
            // preparamos a consulta para remover o registro
            $query = "DELETE FROM servicos WHERE id_serv = ?";
            $stmt = mysqli_prepare($conexao, $query);
            mysqli_stmt_bind_param($stmt, "i", $idTarefa);
            mysqli_stmt_execute($stmt);

            // verificamos se a remoção foi bem-sucedida
            if (mysqli_stmt_affected_rows($stmt) > 0) {
                header("location: tarefas.php?msg=3");
                exit(); // terminate the script after redirecting
            } else {
                header("location: tarefas.php?msg=4");
                exit(); // terminate the script after redirecting
            }
        } else {
            header("location: tarefas.php?msg=4");
            exit(); // terminate the script after redirecting
        }

        // fechamos a ligação ao MySQL
        mysqli_stmt_close($stmt);
        mysqli_close($conexao);
    }
}
?>
