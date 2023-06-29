<?php

// Check if it's a GET request
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Check if the "id" parameter is set and is numeric
    if (isset($_GET["id"]) && is_numeric($_GET["id"])) {
        // Include the db.php file for database connection
        include_once("db.php");

        // Define the idTarefa variable
        $idTarefa = $_GET["id"];

        // Perform a SELECT query for the specific task using the id
        $query = "SELECT * FROM servicos WHERE id_serv = $idTarefa";

        // Execute the query
        $resultado = mysqli_query($conexao, $query);

        // Check the number of rows returned from the query
        $registos = mysqli_num_rows($resultado);

        // Retrieve the task details into variables
        if ($registos > 0) {
            $tarefa = mysqli_fetch_assoc($resultado);
            $designacaoTarefa = $tarefa['titulo'];
            $descricaoTarefa = $tarefa['descricao'];
            $fotoTarefa = $tarefa['foto'];
            $localizacaoTarefa = $tarefa['localizacao'];
            $periodoTarefa = $tarefa['periodo'];
            $precoTarefa = $tarefa['preco'];
        }
    }
}

// Check if it's a POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include the db.php file for database connection
    include_once("db.php");

    // Check if the required fields are not empty
    if (!empty($_POST["titulo"]) && !empty($_POST["descricao"]) && !empty($_POST["localizacao"]) && !empty($_POST["preco"]) && !empty($_POST["periodo"])) {
        // Retrieve the form data into variables
        $idTarefa = $_POST["id_serv"];
        $designacaoTarefa = $_POST["titulo"];
        $descricaoTarefa = $_POST["descricao"];
        $fotoTarefa = $_POST['foto'];
        $localizacaoTarefa = $_POST["localizacao"];
        $precoTarefa = $_POST["preco"];
        $periodoTarefa = $_POST["periodo"];

        // Update existing task if idTarefa is present, otherwise add a new task
        if (!empty($idTarefa)) {
            // Update query for an existing task
            $query = "UPDATE servicos SET titulo = '$designacaoTarefa', descricao = '$descricaoTarefa', localizacao = '$localizacaoTarefa', preco = '$precoTarefa', periodo = '$periodoTarefa' WHERE id_serv = $idTarefa";

            // Execute the query
            $resultado = mysqli_query($conexao, $query);

            // Check if the update was successful and redirect with a success message
            if ($resultado) {
                header("location: tarefas.php?msg=2");
                exit;
            }
        } else {
            // Insert query for a new task
            $query = "INSERT INTO servicos (titulo, descricao, localizacao, preco, periodo) VALUES ('$designacaoTarefa', '$descricaoTarefa', '$localizacaoTarefa', '$precoTarefa', '$periodoTarefa')";

            // Execute the query
            $resultado = mysqli_query($conexao, $query);

            // Check if the insert was successful and redirect with a success message
            if ($resultado) {
                header("location: tarefas.php?msg=2");
                exit;
            }
        }
    }
}

// Include the header.inc.php file for the HTML structure
include_once("header.inc.php");
?>

<style>
    .container {
        max-width: 500px;
        margin: 0 auto;
    }

    .form-group {
        margin-bottom: 20px;
    }

    label {
        display: block;
        font-weight: bold;
    }

    input[type="text"],
    textarea,
    select {
        width: 100%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    button {
        padding: 8px 16px;
        border: none;
        border-radius: 4px;
        background-color: #007bff;
        color: #fff;
        cursor: pointer;
    }

    button:hover {
        background-color: #0069d9;
    }

    .btn-light {
        background-color: #f8f9fa;
        color: #212529;
    }

    .btn-light:hover {
        background-color: #e2e6ea;
    }
</style>

<div class="container">
    <h2>Biscate</h2>
    <hr>
    <form method="POST" action="" enctype="multipart/form-data">
    
    <input type="hidden" name="id_serv" value="<?= $idTarefa ?>">

        <div class="form-group">
            <label for="titulo">Título:</label>
            <input type="text" name="titulo" id="titulo" class="form-control" placeholder="Título" value="<?=$designacaoTarefa?>" required>
        </div>

        <div class="form-group">
            <label for="descricao">Descrição:</label>
            <textarea name="descricao" id="descricao" class="form-control" placeholder="Descrição da tarefa" required><?=$descricaoTarefa?></textarea>
        </div>



        <div class="form-group">
            <label for="localizacao">Localização:</label>
        <select name="localizacao" id="localizacao">
            <option value="Amarante" <?php if ($localizacaoTarefa == "Amarante") echo "selected"; ?>>Amarante</option>
            <option value="Baião" <?php if ($localizacaoTarefa == "Baião") echo "selected"; ?>>Baião</option>
            <option value="Felgueiras" <?php if ($localizacaoTarefa == "Felgueiras") echo "selected"; ?>>Felgueiras</option>
            <option value="Gondomar" <?php if ($localizacaoTarefa == "Gondomar") echo "selected"; ?>>Gondomar</option>
            <option value="Lousada" <?php if ($localizacaoTarefa == "Lousada") echo "selected"; ?>>Lousada</option>
            <option value="Maia" <?php if ($localizacaoTarefa == "Maia") echo "selected"; ?>>Maia</option>
            <option value="Matosinhos" <?php if ($localizacaoTarefa == "Matosinhos") echo "selected"; ?>>Matosinhos</option>
            <option value="Marco de Canaveses" <?php if ($localizacaoTarefa == "Marco de Canaveses") echo "selected"; ?>>Marco de Canaveses</option>
            <option value="Paços de Ferreira" <?php if ($localizacaoTarefa == "Paços de Ferreira") echo "selected"; ?>>Paços de Ferreira</option>
            <option value="Paredes" <?php if ($localizacaoTarefa == "Paredes") echo "selected"; ?>>Paredes</option>
            <option value="Penafiel" <?php if ($localizacaoTarefa == "Penafiel") echo "selected"; ?>>Penafiel</option>
            <option value="Porto" <?php if ($localizacaoTarefa == "Porto") echo "selected"; ?>>Porto</option>
            <option value="Póvoa de Varzim" <?php if ($localizacaoTarefa == "Póvoa de Varzim") echo "selected"; ?>>Póvoa de Varzim</option>
            <option value="Santo Tirso" <?php if ($localizacaoTarefa == "Santo Tirso") echo "selected"; ?>>Santo Tirso</option>
            <option value="Trofa" <?php if ($localizacaoTarefa == "Trofa") echo "selected"; ?>>Trofa</option>
            <option value="Valongo" <?php if ($localizacaoTarefa == "Valongo") echo "selected"; ?>>Valongo</option>
            <option value="Vila do Conde" <?php if ($localizacaoTarefa == "Vila do Conde") echo "selected"; ?>>Vila do Conde</option>
            <option value="Vila Nova de Gaia" <?php if ($localizacaoTarefa == "Vila Nova de Gaia") echo "selected"; ?>>Vila Nova de Gaia</option>
    </select>
        </div>

        <div class="form-group">
            <label for="periodo">Período:</label>
            <select name="periodo" id="periodo" class="form-control" required>
                <option value="1" <?= ($periodoTarefa == '1') ? 'selected' : '' ?>>Durante a Semana</option>
                <option value="2" <?= ($periodoTarefa == '2') ? 'selected' : '' ?>>Durante o Fim de Semana</option>
                <option value="3" <?= ($periodoTarefa == '3') ? 'selected' : '' ?>>Durante a Semana + Fim de Semana</option>
            </select>
        </div>

        <div class="form-group">
            <label for="preco">Preço:</label>
            <textarea name="preco" id="preco" class="form-control" placeholder="Preço da tarefa" required><?=$precoTarefa?></textarea>
        </div>

        <!-- Add more form fields here -->

        <div class="form-group">
            <button type="submit" name="enviar" class="btn btn-info">Guardar</button>
            <a href="tarefas.php"><button type="button" class="btn btn-light">Voltar</button></a>
        </div>
    </form>
</div>

<?php
// Include the footer.inc.php file for the HTML structure
include_once("footer.inc.php");
?>









