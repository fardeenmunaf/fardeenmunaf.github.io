<?php
// carrega o cabeçalho do projeto
include_once("header.php");
?>

<!-- Jobs Start -->
<div class="container-xxl py-5">
    <div class="container">
        <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">Serviços</h1>

        <!-- Search Bar -->
        <form action="" method="GET" class="mb-4">
            <div class="input-group">
                <input type="text" class="form-control" name="search" placeholder="Pesquisar título do serviço">
                <button type="submit" class="btn btn-primary">Pesquisar</button>
            </div>
        </form>

        <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.3s">
            <div class="tab-content">
                <div id="tab-1" class="tab-pane fade show p-0 active">
                    <?php
                    //carregar o ficheiro db.php responsável pelo acesso à bd
                    include_once("db.php");

                    // Check if search query is provided
                    $search = isset($_GET['search']) ? $_GET['search'] : '';

                    // Retrieve data from the table based on search query
                    $sql = "SELECT * FROM servicos WHERE titulo LIKE '%$search%'";
                    $result = mysqli_query($conexao, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        // Display table rows
                        while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                            <div class="job-item p-4 mb-4">
                                <div class="row g-4">
                                    <div class="col-sm-12 col-md-8 d-flex align-items-center">
                                        <img class="flex-shrink-0 img-fluid border rounded" src="uploads/<?php echo $row["foto"];?>" alt="" style="width: 80px; height: 80px;">
                                        <div class="text-start ps-4">
                                            <h5 class="mb-3"><?php echo $row["titulo"]; ?></h5>
                                            <span class="text-truncate me-3"><i class="fa fa-map-marker-alt text-primary me-2"></i><?php echo $row["localizacao"];?></span>
                                            <span class="text-truncate me-3">
                                                <i class="far fa-clock text-primary me-2"></i>
                                                <?php
                                                $periodoValue = $row["periodo"];
                                                if ($periodoValue == 1) {
                                                    echo "Durante a semana";
                                                } elseif ($periodoValue == 2) {
                                                    echo "Durante o fim de semana";
                                                } elseif ($periodoValue == 3) {
                                                    echo "Durante a semana + fim de semana";
                                                }
                                                ?>
                                            </span>
                                            <span class="text-truncate me-0"><i class="far fa-money-bill-alt text-primary me-2"></i><?php echo $row["preco"];?>€</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-4 d-flex flex-column align-items-start align-items-md-end justify-content-center">
                                        <div class="d-flex mb-3">
                                            <a class="btn btn-primary" href="anuncio.php?id=<?php echo $row["id_serv"];?>">Saber mais</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    } else {
                        echo "Não foram encontrados serviços correspondentes à pesquisa.";
                    }

                    // Free result
                    mysqli_free_result($result);

                    // fechar a ligacao à base de dados
                    mysqli_close($conexao);
                    ?>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- Jobs End -->

<?php
include_once("footer.php");
?>
