<?php

    //incluimos o ficheiro header.inc.php
    include_once("header.inc.php");

    //incluimos o ficheiro db.php
    include_once("db.php");

    //verificar se temos um argumento pagina no GET
    if(isset($_GET["pagina"])) {

        $pagina = $_GET["pagina"];
    } else {

        $pagina = 1;
    }

    //definir o número de registos por pagina
    $nRegistosPagina = 4;
    $regInicial = ($pagina - 1) * $nRegistosPagina;

    $query = "select count(*) from servicos";
    $resultado = mysqli_query($conexao, $query);
    $totalRegistos = mysqli_fetch_array($resultado)[0];
    $totalPaginas = ceil($totalRegistos / $nRegistosPagina);

    //vamos efetuar uma consulta/query na tabela de tarefas da bd
    $query = "select * from servicos limit $regInicial, $nRegistosPagina";

    //executamos a consulta
    $resultado = mysqli_query($conexao, $query);

    //obtemos uma variavel  com o numero de registos
    $registos = mysqli_num_rows($resultado);

?>

<div class="container">

    <?php

        //mensagens de erro e de sucesso
        if(!empty($_GET["msg"])) {

            $msg = $_GET["msg"];

            //em função do codigo da msg vamos mostrar uma informação
            switch($msg) {

                case 1: 
                    $info = "Registo inserido com sucesso.";
                    $alert = "alert-success";
                    break;
                case 2:
                    $info = "Registo atualizado com sucesso.";
                    $alert = "alert-info";
                    break;
                case 3:
                    $info = "Registo removido com sucesso.";
                    $alert = "alert-danger";
                    break;
                case 4:
                    $info = "O ID não existe na base de dados!";
                    $alert = "alert-danger";
            }
        }

        //se a variavel $info tiver um valor vamos mostrar no ecra 
        if(isset($msg)) {

            ?>

                <div class="alert <?=$alert?> alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong><?=$info?></strong>
                </div>

            <?php
        }

    ?>

    <div class ="row">
        <div class="col-6">
            <h2>Biscates</h2>  
        </div>
        <div class="col-6 text-right">
                <!-- <a href="tarefa.php"><button type="button" class="btn btn-info" >+ Nova tarefa</button></a> -->
            <a href="tarefas.php"><button type="button" class="btn btn-light">Atualizar</button></a>
        </div>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Titulo</th>
                <th scope="col">Descrição</th>
                <th scope="col">Foto</th>
                <th scope="col">Localização</th>
                <th scope="col">Período</th>
                <th scope="col">Preço</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php

                //codigo para listar os registos encontrados na tabela tarefas
                if(!empty($registos)) {

                    while($tarefa = mysqli_fetch_assoc($resultado)) {

            ?>
            <tr>
                <td scope="row"><?=$tarefa["id_serv"]?></td> 
                <td scope="row"><?=$tarefa["titulo"]?></td> 
                <td scope="row">
                    <?php
                        $descricao = $tarefa["descricao"];
                        $max_length = 200; // Maximum length of the description

                        if (strlen($descricao) > $max_length) {
                            $descricao = substr($descricao, 0, $max_length) . "...";
                        }

                        echo $descricao;
                    ?>
                </td>
                <td scope="row"><?=$tarefa["foto"]?></td> 
                <td scope="row"><?=$tarefa["localizacao"]?></td> 
                <td scope="row">
                    <?php
                        if ($tarefa["periodo"] == 1) {
                            echo "Durante a semana";
                        } elseif ($tarefa["periodo"] == 2) {
                            echo "Durante o Fim de Semana";
                        } elseif ($tarefa["periodo"] == 3) {
                            echo "Durante a Semana + Fim de semana";
                        }
                    ?>
                </td>                
                <td scope="row"><?=$tarefa["preco"]?>€</td>  
                </td>

                <td scope="row">
                    <!-- <a href="tarefa_ver.php?id=<?=$tarefa["id_serv"]?>"><button type="button" class="btn btn-dark btn-sm mr-1"><i class="fa fa-print text-white"></i></a> -->
                    <a href="tarefa.php?id=<?=$tarefa["id_serv"]?>"><button type="button" class="btn btn-dark btn-sm mr-1"><i class="fa fa-pencil text-white"></i></a>
                    <a href="tarefa_remover.php?id=<?=$tarefa["id_serv"]?>" onclick="javascript:return confirm('Deseja remover o registo');"><button type="button" class="btn btn-dark btn-sm mr-1"><i class="fa fa-trash text-white"></i></a>
                </td> 
            </tr>
            <?php
                //fecho do if e do while
                    }
                }
            ?>
        </tbody>
    </table>

    <nav aria-label="paginacao">
        <ul class="pagination">
            <li class="page-item <?php if($pagina <=1) { echo "disabled"; } ?>">
                <a class="page-link" href="<?php if($pagina <= 1) { echo "#"; } else { echo "?pagina=".($pagina-1); } ?>">Anterior</a>
            </li>
            <?php
                //ciclo para efetuar a paginação 1, 2, 3...
                for($i = 1; $i <= $totalPaginas; $i++) {
            ?>
            <li class="page-item <?php if($pagina == $i) { echo "active"; } ?>">
                <a class="page-link" href="?pagina=<?=$i?>"><?=$i?></a>
            </li>
            <?php
                }
            ?>
            <li class="page-item <?php if($pagina == $totalPaginas) { echo "disabled"; } ?>">
                <a class="page-link" href="<?php if($pagina != $totalPaginas) { echo "?pagina=".($pagina+1); } ?>">Próxima</a>
            </li>
        </ul>
    </nav>

</div>

<?php

    //incluimos o ficheiro footer.inc.php
    include_once("footer.inc.php");

?>