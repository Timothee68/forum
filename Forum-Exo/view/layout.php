<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- on ajoute a la balise  -->
    <meta name="csrf-token" content=<?= App\Session::getTokenCSRF() ?>> 
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title><?= $title ?></title>
</head>
<body>
    <?php 
    $categories = $result['data']['categories'];
    ?>
    <header>
        <nav id="nav-color" class="navbar navbar-expand-lg navbar-light bg-primary">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php?ctrl=home&action=index">Jeux vidéo</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php?ctrl=forum&action=index">La liste des topics</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="index.php?ctrl=forum&action=showCategorie" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Catégorie</a>
                            <ul id="categorie-dropdown" class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
                                <?php foreach($categories as $categorie) :?>
                                <li><a  class="dropdown-item" href="index.php?ctrl=forum&action=showTopicsByCategorie&id=<?=$categorie->getId()?>" ><?=$categorie->getTitle()?></a></li>
                                <?php endforeach ?>
                            </ul>
                        </li>
                       <?php if(APP\Session::isAdmin()) { ?>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="index.php?ctrl=forum&action=showUsers">La liste des Users</a>
                        </li>
                      <?php } ?>
                    </ul>
                    <form action="index.php?ctrl=forum&action=search" method="post" class="d-flex">
                        <input class="form-control me-2" name="data" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-warning" type="submit">Search</button>
                    </form>
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <?php if(isset($_SESSION['user'])) : ?>
                        <li class="nav-item" ><a class="nav-link" href="index.php?ctrl=security&action=showProfileUser&id=<?= $_SESSION['user']->getId() ?>">
                            <?= isset($_SESSION['user']) ? "<i class='fa-solid fa-user-large '></i> ".$_SESSION['user']->getPseudo() : "nom du user en session " ?></a>
                        </li>
                        <i class="fa-solid fa-crown "></i>
                        <?php endif ?>
                        <?php if(!isset($_SESSION['user'])) : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?ctrl=security&action=index">Connexion</a>
                        </li>
                        <?php endif ?>
                        <li class="nav-item">
                        </li>
                        <?php if(isset($_SESSION['user'])) : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?ctrl=security&action=logOut">Déconnexion</a>
                        </li>
                        <?php endif ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    
       
    
    <main class="mb-5" id="forum">
        <?= $page ?>
        <h3 class="message" style="color: red"><?= App\Session::getFlash("error") ?></h3>
        <h3 class="message" style="color: green"><?= App\Session::getFlash("success") ?></h3>
    </main>
  
    <footer class=" mt-5 bg-light">
        <div class="container">
            <div class="row">
                <h3>NOUS SUIVRE</h3>
                <div id="reseauxSocial" class="col-md-6 d-flex justify-content-evenly mb-4">
                    <a href="#"> <i class="fa-brands fa-facebook"></i></a>
                    <a href="#"><i class="fa-brands fa-twitter"></i></a>
                    <a href="#"><i class="fa-brands fa-instagram-square"></i></a>
                    <a href="#"><i class="fa-brands fa-youtube"></i></a>
                    <a href="#"><i class="fa-solid fa-rss"></i></a>           
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <p> <a href="/home/forumRules.html">Règlement du forum</a> | <a href="">Contact</a> | <a href="">Informations légales</a>
                     | <a href="">C.G.U.</a> | <a href="">C.G.V.</a> |
                    <a href="">Modération</a> | <a href="">Politique de confidentialité</a> | <a href="">Cookies</a></p>
                </div>
                <p>&copy; 2022 - Forum Tim.LUC. </p>
            </div>
        </div>
    </footer>
    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script>
      $(document).ready( function () {
      $('#table_id').DataTable();
      } );
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="public/js/script.js"></script>
</body>
</html>