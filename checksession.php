<?php
// verificar se exite um login , senao encaminhar para a página de login(index.php)
session_start();

if($_SESSION["login"] !== true ){
    header("location: login.php");
    exit;
}

?>