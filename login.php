<?php

    //iniciamos uma sessao
    session_start();

    // verificar se o utilizador esta com login efetuado ,  se sim encaminhar para a pagina index.php
    if(isset($_SESSION["login"]) && $_SESSION["login"] == true){
        header("location:index.php");
        exit;
    }

    //carregar o ficheiro db.php responsável pelo acesso à bd
    include_once("db.php");

    //verificar se há um post
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        
        //verificar os campos username e password
        if(empty($_POST["email"]) || empty($_POST["pwd"])) {

            //redirecionamos para a página login.php com o código de erro = 1
            header("location: login.php?erro=1");
        } else {

            //definimos as variáveis
            $email = $_POST["email"];
            $password = $_POST["pwd"];
            //consulta à base de dados
            $query = "select * from utilizadores where email='$email'";
            
            //executar a consulta 
            $resultado = mysqli_query($conexao, $query);

            //se o resultado resultar num true...
            if($resultado) {

                $utilizador = mysqli_fetch_row($resultado);
                $idUtilizador = $utilizador[0];
                $emailUtilizador = $utilizador[3];
                $passwordUtilizador = $utilizador[5];

                //verificar a password
                if(password_verify($password, $passwordUtilizador)) {

                    //se a password estiver correta iniciamos uma sessão
                    session_start();

                    //guardar dados em variaveis de sessao
                    $_SESSION["login"] = true;
                    $_SESSION["id"] = $idUtilizador;
                    $_SESSION["email"] = $emailUtilizador;

                    //redirecionamos para a pagina index.php
                    header("location: index.php");
                }
                else {

                    //no caso da password inválida redirecionamos para o login.php com erro 2
                    header("location: login.php?erro=2");
                }
            }

            //fechar a ligação ao mysql
            mysqli_close($conexao);
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom CSS neste caso para diminuir o tamanho do container em ecrãs de menor resolução -->
    <style>
        .bg-image-vertical {
        position: relative;
        overflow: hidden;
        background-repeat: no-repeat;
        background-position: right center;
        background-size: auto 100%;
        }

        @media (min-width: 1025px) {
        .h-custom-2 {
        height: 100%;
        }
        }
    </style>

    <body>
    <section class="vh-100">
    <div class="container-fluid">
    <div class="row">
    <div class="col-sm-6 text-black">

        <div class="px-5 ms-xl-4">
          <!-- <img src="img/B-removebg-preview.png" alt="logo image" class="px-2 w-25 mb-0"> -->

        </div>

        <div class="d-flex align-items-center h-custom-2 px-5 ms-xl-4 mt-5 pt-5 pt-xl-0 mt-xl-n5">

          <form action="login.php" method="post" style="width: 23rem;">

            <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Login</h3>

            <div class="form-outline mb-4">
                <label class="form-label" for="email">Email</label>
              <input type="email" id="email" name="email" class="form-control form-control-lg" />
            </div>

            <div class="form-outline mb-4">
                    <label class="form-label" for="password">Password</label>
              <input type="password" id="password" name="pwd" class="form-control form-control-lg" />
            </div>

            <div class="pt-1 mb-4">
             <input type="submit" class="btn btn-success" value="Login">
            </div>

            <p>Não tens uma conta? <a href="registo.php">Regista-te aqui!</a></p>

          </form>

        </div>

      </div>
      <div class="col-sm-6 px-0 d-none d-sm-block">
        <img src="img/engenheiro-feliz-1024x683.jpg" alt="Login image" class="w-100 vh-100" style="object-fit: cover; object-position: left;">
      </div>


      <?php
        //tratar as mensagens de erro
        if(!empty($_GET["erro"])) {
                $erro = $_GET["erro"];
                //em função do código do erro apresentamos uma mensagem
                switch($erro) {
                    case 1:
                        $erro_descricao = "email e/ou password vazio/inválido!";
                        break;
                  
                    case 2:
                        $erro_descricao = "email e/ou password incorreto!";
                        break;
                }
        }

        //apresentar a mensagem de erro
            if(isset($erro)) {
        ?>
            <div class="alert alert-danger alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong><?=$erro_descricao?></strong>
            </div>
        <?php
            }
        ?>
    </body>
    </div>
  </div>
</section>