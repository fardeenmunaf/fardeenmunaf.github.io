<?php
// ficheiro para efetuar logout
// iniciamos a sessao 
session_start();
// efetuamos um isset de todas as variaveis de sessao existentes
$_SESSION = array();
// destruimos a sessao 
session_destroy();

// encaminhamos para a pagina de login - index.php
header("location: login.php");
exit;
?>