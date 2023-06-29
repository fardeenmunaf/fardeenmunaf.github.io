<?php

    //efetuamos o carregamento do ficheiro header.inc.php
    include_once("header.inc.php");
    
    //chamar funçao texto home
    include_once("functions.php");

?>

<div class="container">

        <div class="row">
            <div class="col">
                <h2>Home</h2>  
            </div>
            <div class="col text-right">
                <a href="home.php"><button type="button" class="btn btn-light">Atualizar</button></a>
            </div>
        </div>
    
        <div class="row">
            <div class="col">
                <p>
                    <?php
                        if(isset($_SESSION["username"])) {echo "<h5>Olá, " . $_SESSION["username"] . "</h5>";}
                        echo textoHome();
                    ?>
                </p>
            </div>
        </div>
    
</div>

<?php

    //efetuamos o carregamento do ficheiro footer.inc.php
    include_once("footer.inc.php");

?>