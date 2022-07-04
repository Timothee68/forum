<?php
 $title = "Accueuil";
if(isset($user)){
    $user = $result ["data"]["user"];
}

?>

    <h1 class="text-center mt-3 ">Bonjour <?= isset($_SESSION['user']) ? $_SESSION['user']->getPseudo()." bienvenue sur " : "!" ?></a></h3>
    <h2 class="text-center mt-3 mb-2">Best Forum pour jeux vidéo</h2>
    <div id="home" class="container-fluid">
        <img src="public\img\img2.avif" alt="" srcset="">

    </div>
