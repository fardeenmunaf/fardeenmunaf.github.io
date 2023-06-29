<?php
// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Include the database connection script
    require_once 'db.php';

  // Retrieve the form data
  $nome = isset($_POST['nome']) ? $_POST['nome'] : '';
  $morada = isset($_POST['morada']) ? $_POST['morada'] : '';
  $email = isset($_POST['email']) ? $_POST['email'] : '';
  $telefone = isset($_POST['telefone']) ? $_POST['telefone'] : '';
  $password = isset($_POST['pwd']) ? $_POST['pwd'] : '';

  // Sanitize the data
  $nome = mysqli_real_escape_string($conexao, $nome);
  $morada = mysqli_real_escape_string($conexao, $morada);
  $email = mysqli_real_escape_string($conexao, $email);
  $telefone = mysqli_real_escape_string($conexao, $telefone);
  $password = mysqli_real_escape_string($conexao, $password);
  $opts03 = [ "cost" => 15 ];
  $password = password_hash($password, PASSWORD_BCRYPT, $opts03);

  // Insert the data into the database
  $sql = "INSERT INTO utilizadores (nome, morada, email, telefone, pwd) VALUES ('$nome', '$morada', '$email', '$telefone', '$password')";
  
   $resultado = mysqli_query($conexao, $sql);

  if($resultado) {
    // If the query was successful, redirect the user to a success page or display a success message
    header('Location: login.php');
  } else {
    // If there was an error, display an error message
    echo "Error: " . mysqli_error($conexao);
  }

  // Close the database connection
  mysqli_close($conexao);

} else {
  // If the form was not submitted, display an error message or redirect the user back to the form page
  // echo "Error: Form not submitted.";
}


?>



<!DOCTYPE html>
<html lang="en">
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registo</title>
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
            
    <form action="registo.php" method="post" style="width: 23rem;">
        <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Registo</h3>

        <div class="form-group">
        <label>Nome:</label>
        <input type="text" name="nome" class="form-control" required>
        </div>

        <div class="form-group">
        <label>Morada:</label>
        <input type="text" name="morada" class="form-control" required>
        </div>

        <div class="form-group">
        <label>Email:</label>
        <input type="email" name="email" class="form-control" required>
        </div>

        <div class="form-group">
        <label>Telefone:</label>
        <input type="telefone" name="telefone" class="form-control" required>
        </div>

        <div class="form-group">
        <label>Password:</label>
        <input type="password" name="pwd" class="form-control" required>
        </div>

        <div class="form-group">
        <input type="submit" class="btn btn-success" value="Registar">
        </div>
  </form>

        </div>

      </div>
      <div class="col-sm-6 px-0 d-none d-sm-block">
        <img src="img/engenheiro-feliz-1024x683.jpg" alt="Login image" class="w-100 vh-100" style="object-fit: cover; object-position: left;">
      </div>
    </body>
    </div>
  </div>
</section>