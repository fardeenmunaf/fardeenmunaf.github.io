<?php
session_start();
?>
<head>
    <meta charset="utf-8">
    <title>Biscatesporto</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon-32x32.png" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@700;800&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head> 


<nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
            <a href="index.php" class="navbar-brand d-flex align-items-center text-center py-0 px-4 px-lg-5">
            <img src="img/5-removebg-preview.png" style="width: 180px; height: 160px; margin-top: 15px;" />
            </a>
            <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto p-4 p-lg-0">
                    <a href="index.php" class="nav-item nav-link">Home</a>
                    <a href="about.php" class="nav-item nav-link">Sobre nós</a>
                    <a href="listagem.php" class="nav-item nav-link">Listagem</a>
                    <a href="contact.php" class="nav-item nav-link">Contactos</a>

                <?php
                // verificar se login existe mostra utilizador e terminar sessao se não mostra entrar
                  //session_start();
                 if(isset($_SESSION["login"]) && ($_SESSION["login"] == true)) {
                 ?>  
                <a href="logout.php" class="btn text-primary rounded-0 py-4 px-lg-5 d-none d-lg-block">Terminar sessão<i class="fa fa-light fa-user ms-3"></i></a>
                 <?php
                 } else {
                 ?>
                 <a href="login.php" class="btn text-primary rounded-0 py-4 px-lg-5 d-none d-lg-block">Entrar<i class="fa fa-light fa-user ms-3"></i></a>
                 <?php
                 }
                 ?>
                </div>
                <a href="adicionar.php" class="btn btn-primary rounded-0 py-4 px-lg-5 d-none d-lg-block">Anunciar<i class="fa fa-arrow-right ms-3"></i></a>
            </div>
</nav>