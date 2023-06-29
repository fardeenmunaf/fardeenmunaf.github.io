<?php
include_once("header.php");
?>

<?php
// Database connection configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "psb202201_biscatesporto";

// Create a new record in the MySQL table
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Gather form data
  $tiposervico = $_POST["tiposervico"];
  $id_utilizador = $_POST["id_utilizador"];
  $titulo = $_POST["titulo"];
  $descricao = $_POST["descricao"];
  $localizacao = $_POST["localizacao"];
  $periodo = $_POST["periodo"];
  $preco = $_POST["preco"];
  
  // Database connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Prepare and execute SQL statement

  $stmt = $conn->prepare("INSERT INTO servicos (id_tserv, id_utilizador, titulo, descricao, foto, localizacao, periodo, preco) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("ssssssss", $tiposervico, $id_utilizador, $titulo, $descricao, $fileName, $localizacao, $periodo, $preco);

  // File upload configuration
  $targetDir = "uploads/";
  $fileName = basename($_FILES["foto"]["name"]);
  $targetFilePath = $targetDir . $fileName;
  $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

  // Upload file to the server
  if (!empty($_FILES["foto"]["tmp_name"])) {
    if (move_uploaded_file($_FILES["foto"]["tmp_name"], $targetFilePath)) {
      // Execute the SQL statement
      $stmt->execute();
      echo "The file " . $fileName . " has been uploaded and the record has been added to the database.";
    } else {
      echo "Sorry, there was an error uploading your file.";
    }
  }

  // Close the database connection
  $stmt->close();
  $conn->close();
}

$conn2 = new mysqli($servername, $username, $password, $dbname);
  if ($conn2->connect_error) {
    die("Connection failed: " . $conn2->connect_error);
  }


  $sql2 = "SELECT * FROM utilizadores";
  $result2 = mysqli_query($conn2, $sql2);
  $row2 = mysqli_fetch_assoc($result2);


?>


<!-- adicionar -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                <div class="row g-0 about-bg rounded overflow-hidden">
                    <div class="col-6 text-start">
                        <img class="img-fluid w-100" src="img/about-1.jpg">
                    </div>
                    <div class="col-6 text-start">
                        <img class="img-fluid" src="img/about-2.jpg" style="width: 85%; margin-top: 15%;">
                    </div>
                    <div class="col-6 text-end">
                        <img class="img-fluid" src="img/about-3.jpg" style="width: 85%;">
                    </div>
                    <div class="col-6 text-end">
                        <img class="img-fluid w-100" src="img/about-4.jpg">
                    </div>
                </div>
            </div>
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                <h1 class="mb-4">Adicionar</h1>
                <p class="mb-4">No formulário seguinte pode adicionar um serviço que disponibilize na nossa plataforma.</p>

                <div class="container">
                    <form action="#" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="tiposervico" class="form-label">Tipo de Serviço:</label>
                            <select class="form-select" id="tiposervico" name="tiposervico" required>
                                <option value="1">Babysitting</option>
                                <option value="2">Pequenas reparações elétricas</option>
                                <option value="3">Petsitting</option>
                                <option value="4">Fabrico de Bolos</option>
                                <option value="5">Decoração para eventos</option>
                                <option value="6">Arquiteto</option>
                                <option value="7">Reparações em casa</option>
                                <option value="8">Carpinteiro</option>
                                <option value="9">Limpeza</option>
                                <option value="10">Jardinagem</option>
                                <option value="11">Lavagem de carros</option>
                                <option value="12">Explicações de várias disciplinas</option>
                                <option value="13">Montagem de Computadores</option>
                                <option value="14">Remoção de Vírus em dispositivos informáticos</option>
                                <option value="15">Instalação de Sistema Operativo em dispositivos</option>
                                <option value="16">Outro(descrever o mesmo na descrição)</option>


                                <!-- aqui terão de ter um ciclo para obter os dados da tabela tipo_serv -->
                            </select>
                        </div>
                        <!-- <input type="hidden" name="id_utilizador" value=> -->
                        <input type="hidden" name="id_utilizador" value="<?php echo $row2["id_utilizador"];?>">
                        <!-- no value devem colocar o id do utilizador que tem a sessão loggada -->
                        <div class="mb-3">
                            <label for="titulo" class="form-label">Título:</label>
                            <input type="text" class="form-control" id="titulo" name="titulo" required>
                        </div>
                        <div class="mb-3">
                            <label for="descricao" class="form-label">Descrição:</label>
                            <textarea class="form-control" id="descricao" name="descricao" rows="5" placeholder="Uma breve descrição sobre si e descreva em um texto pequeno o seu biscate" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="foto" class="form-label">Foto:</label>
                            <input class="form-control" type="file" id="foto" name="foto" required>
                        </div>
                        <!-- <div class="mb-3">
                            <label for="localizacao" class="form-label">Localização:</label>
                            <input type="text" class="form-control" id="localizacao" name="localizacao" required>
                        </div> -->

                        <div class="mb-3">
                            <label for="localizacao" class="form-label">Localidade:</label>
                            <select class="form-select" id="localizacao" name="localizacao" required>
                                <option value="Amarante">Amarante</option>
                                <option value="Baião">Baião</option>
                                <option value="Felgueiras">Felgueiras</option>
                                <option value="Gondomar">Gondomar</option>
                                <option value="Lousada">Lousada</option>
                                <option value="Maia">Maia</option>
                                <option value="Matosinhos">Matosinhos</option>
                                <option value="Marco de Canaveses">Marco de Canaveses</option>
                                <option value="Paços de Ferreira">Paços de Ferreira</option>
                                <option value="Paredes">Paredes</option>
                                <option value="Penafiel">Penafiel</option>
                                <option value="Porto">Porto</option>
                                <option value="Póvoa de Varzim">Póvoa de Varzim</option>
                                <option value="Santo Tirso">Santo Tirso</option>
                                <option value="Trofa">Trofa</option>
                                <option value="Valongo">Valongo</option>
                                <option value="Vila do Conde">Vila do Conde</option>
                                <option value="Vila Nova de Gaia">Vila Nova de Gaia</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="periodo" class="form-label">Período:</label>
                            <select class="form-select" id="periodo" name="periodo" required>
                                <option value="1">Durante a semana</option>
                                <option value="2">Durante o fim de semana</option>
                                <option value="3">Semana + Fim de semana</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="preco" class="form-label">Preço:</label>
                            <input type="text" class="form-control" id="preco" name="preco" placeholder="Por exemplo (25)" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Adicionar</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- About End -->

<?php
include_once("footer.php");
?>