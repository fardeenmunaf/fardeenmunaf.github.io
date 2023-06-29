<?php
// carrega o cabeçalho do projeto
include_once("header.php");
?>

        <!-- Header End -->
        <div class="container-xxl py-5 bg-dark page-header mb-5">
            <div class="container my-5 pt-5 pb-4">
                <h1 class="display-3 text-white mb-3 animated slideInDown">Anúncio</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb text-uppercase">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">Anúncio</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- Header End -->

        <!-- Job Detail Start -->

        <?php
        //carregar o ficheiro db.php responsável pelo acesso à bd
        include_once("db.php");

        // Get the ID from the link
        $id = $_GET['id'];

        // consulta com JOIN que retorna também os dados do utilizador de determinado anúncio
        $sql = "SELECT s.*, u.* FROM servicos s JOIN utilizadores u ON s.id_utilizador = u.id_utilizador
        WHERE s.id_serv = $id;";

        $result = mysqli_query($conexao, $sql);
        $row = mysqli_fetch_assoc($result);
        
        /* foreach ($row as $column => $value) {
            echo "$column: $value<br>";
        } */
?>

<div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container">
        <div class="row gy-5 gx-4">
            <div class="col-lg-8">
                <div class="d-flex align-items-center mb-5">
                    <img class="flex-shrink-0 img-fluid border rounded" src="uploads/<?php echo $row["foto"];?>" alt="" style="width: 80px; height: 80px;">
                    <div class="text-start ps-4">
                        <h3 class="mb-3"><?php echo $row["titulo"]; ?></h3>
                        <span class="text-truncate me-3"><i class="fa fa-map-marker-alt text-primary me-2"></i><?php echo $row["localizacao"]; ?></span>
                        <span class="text-truncate me-3"><i class="far fa-clock text-primary me-2"></i>
                        <?php
                        $periodoValue = $row["periodo"];
                        if ($periodoValue == 1) {echo "Durante a semana";
                        } elseif ($periodoValue == 2) {echo "Durante o fim de semana";}
                        elseif ($periodoValue == 3) {echo "Durante a semana + fim de semana";}
                    ?></span>
                        <span class="text-truncate me-0"><i class="far fa-money-bill-alt text-primary me-2"></i><?php echo $row["preco"]; ?>€</span>
                    </div>
                </div>
                <div class="mb-5">
                    <h4 class="mb-3">Descrição do Biscate</h4>
                    <p><?php echo $row["descricao"]; ?></p>

                </div>

                <div class="">
                    <h4 class="mb-4">Enviar mensagem ao Biscateiro</h4>
                    <form action="email-send/email.php" method="POST">
                        <div class="row g-3">
                            <div class="col-12 col-sm-6">
                                <input type="text" class="form-control" placeholder="O seu Nome" name="name" required>
                            </div>
                            <div class="col-12 col-sm-6">
                                <input type="email" class="form-control" placeholder="O seu Email" name="email" required>
                            </div>
                            <div class="col-12">
                                <input type="text" class="form-control" placeholder="A sua Mensagem" name="msg" required>
                            </div>
                            <div class="col-12">
                                <input type="hidden" class="form-control" name="emailbiscateiro" value="<?php echo $row["email"];?>">
                                <button class="btn btn-primary w-100" type="submit">Entrar em contacto</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="bg-light rounded p-5 mb-4 wow slideInUp" data-wow-delay="0.1s">
                    <h4 class="mb-4">Detalhes do Biscate</h4>
                    <p><i class="fa fa-angle-right text-primary me-2"></i>Período:
                    <?php
                        $periodoValue = $row["periodo"];
                        if ($periodoValue == 1) {echo "Durante a semana";
                        } elseif ($periodoValue == 2) {echo "Durante o fim de semana";}
                        elseif ($periodoValue == 3) {echo "Durante a semana + fim de semana";}
                    ?>
                    </p>
                    <p><i class="fa fa-angle-right text-primary me-2"></i>Custo: <?php echo $row["preco"]; ?>€</p>
                    <p><i class="fa fa-angle-right text-primary me-2"></i>Localização: <?php echo $row["localizacao"]; ?></p>
                </div>
                <div class="bg-light rounded p-5 wow slideInUp" data-wow-delay="0.1s">
                    <h4 class="mb-4">Detalhes do Biscateiro</h4>
                    <p class="m-0">                    
                    <p><i class="fa fa-angle-right text-primary me-2"></i>Email: <?php echo $row["email"];?></p>
                    <p><i class="fa fa-angle-right text-primary me-2"></i>Telefone: <?php echo $row["telefone"];?></p>
                    <p><i class="fa fa-angle-right text-primary me-2"></i>Nome: <?php echo $row["nome"];?></p></p>
                </div>
            </div>
        </div>
    </div>
    </div>
        <!-- Job Detail End -->


        <!-- Footer Start -->
        <?php
        include_once("footer.php");
        ?>
        <!-- Footer End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>