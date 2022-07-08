<?php
 $title = "Accueuil";
if(isset($user)){
    $user = $result ["data"]["user"];
}

?>
    <h3 class="message" style="color: red"><?= App\Session::getFlash("error") ?></h3>
    <h3 class="message" style="color: green"><?= App\Session::getFlash("success") ?></h3>
    <h1 class="text-center mt-3 ">Bonjour <?= isset($_SESSION['user']) ? $_SESSION['user']->getPseudo()." bienvenue sur " : "!" ?></a></h3>
    <h2 class="text-center mt-3 mb-2">Best Forum pour jeux vidéo</h2>
    <hr>
<div class="container-fluid mt-5 mb-5">
    <h2 class="mt-5 mb-5">EN CE MOMENT</h2>
    <div class="row row-col-3">
        <div class="col-4">
                <iframe width="560" height="315" src="https://www.youtube.com/embed/aER4kA08WIo" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
        <div class="col-4">
            <iframe width="560" height="315" src="https://www.youtube.com/embed/C9526T7v0nQ" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
        <div class="col-4">
        <iframe width="560" height="315" src="https://www.youtube.com/embed/5pBTV2XLGh4" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
        <h2 class="mt-5 mb-5">DERNIÈRES VIDÉOS GAMEPLAY</h2>
        <div class="row row-col-3">
            <div class="col-4">
            <iframe width="560" height="315" src="https://www.youtube.com/embed/h25QdBjK0B0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>        </div>
            <div class="col-4">
            <iframe width="560" height="315" src="https://www.youtube.com/embed/e6NaBk9xF_w" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>        </div>
            <div class="col-4">
            <iframe width="560" height="315" src="https://www.youtube.com/embed/z-WmIK_KIn4" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>        </div>
        </div>
    </div>
    <div id="home" class="container-fluid">
        <img src="public\img\img2.avif" alt="" srcset="">
    </div>
