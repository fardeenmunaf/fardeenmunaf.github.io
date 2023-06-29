<?php
//ligação ao servidor de mysql 
// definição de dados de acesso atraves de constantes 

// 192.168.1.1 -> servidor da escola
// localhost -> se estiverem a usar o xampp

define("DBSERVER" , "localhost");
define("DBUSER" , "root");
define("DBPWD","");
define("DBNAME" ,"psb202201_biscatesporto");

$conexao = mysqli_connect(DBSERVER, DBUSER, DBPWD, DBNAME);

// verificar ligação
if($conexao == false){
    die("ERRO : " .mysqli_connect_error());
} else {
    //echo"Ligação estabelecida com sucesso<br>";
    //echo mysqli_get_host_info($conexao);
}

?>