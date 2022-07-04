<?php 
    $messages = $result["data"]["messages"];
    $topic = $result["data"]["topic"]; 
    $title = "message topic" 
?>     

<h1 class="text-center mb-5 mt-5">Messages du Topic : <?= $topic->getTitle() ."   " .  ( $topic->getClosed() == false ?'<i class="fa-solid fa-lock  bg-danger"></i>': "");?>
    <?php if(APP\Session::isAdmin() || isset($_SESSION['user']) && ($_SESSION['user']->getId() == $topic->getUser()->getId())){ ?>
      <?php if($topic->getClosed() == true) { ?>
                <form action="index.php?ctrl=security&action=closedTopicByUser&id=<?=$topic->getId()?>" method="post">
                  <td>
                    <button class="btn btn-primary" name="closed" type="submit" data-bs-toggle="modal" data-bs-target="#exampleModal">Fermer topic</button>
                  </td>
                </form>
              <?php } ?>
              <?php if($topic->getClosed() == false){ ?>
                <form action="index.php?ctrl=security&action=openTopicByUser&id=<?=$topic->getId()?>" method="post">
                <td>
                  <button class="btn btn-primary" name="closed" type="submit" data-bs-toggle="modal" data-bs-target="#exampleModal">ouvrir topic</button>
                </td>
              </form>
              <?php } ?>
      <?php } ?>
  
</h1>

<div  class="container">
  <div  class="row row-col-4">
    <div id="bg-img-left" class="col bg-secondary">
      <?php  if(isset($messages)){
        foreach($messages as $message){
          echo "<div class='card mt-2 mb-3' style='max-width: 540px;'>",
                  "<div class='row g-0'>",
                    "<div class='col-md-4'>",
                    "<img class='card-img-top' style='width: 8rem;' src='".$message->getUser()->getImage()."' alt='' srcset=''>",
                    "</div>",
                    "<div class='col-md-8'>",
                      "<div class='card-body>",
                        "<h5 class='card-title'><a href='index.php?ctrl=security&action=profilOtherUSer&id=".$message->getUser()->getId()."'><strong> Par : ".$message->getUser()->getPseudo()."</strong></a></h5>",
                        "<p class='card-text'>".$message->getText()."</p>",
                        "<p class='card-text'><small class='text-muted'>Envoyer le : ".$message->getCreationMessage()."</small></p>";
                           if(APP\Session::isAdmin() || isset($_SESSION['user']) && ($_SESSION['user']->getId() == $message->getUser()->getId())){ 
                            echo '<button type="button" class="btn btn-danger"><a href="index.php?ctrl=forum&action=deleteMessage&id='.$message->getId().'"><i class="fa-solid fa-dumpster fs-3 mb-1"></i></a></button>';
                          }
                  echo  "</div>",
                    "</div>",
                  "</div>",
                "</div>";
            } 
          }else{
            echo  "<p class='card-text fs-1  bg-light mt-5'>Aucun message !</p>";
          }
      ?> 
  </div>
  <div id="bg-img-right" class="col bg-secondary">
    <div class="card mt-2 mb-5" style="width: 18rem;">
      <div class="card-header">
        Infos / Nb connecté(s)
      </div>
      <ul class="list-group list-group-flush">
        <li class="list-group-item">Gestion forum</li>
        <li class="list-group-item">Modérateurs + nom </li>
        <li class="list-group-item">Sujet à ne pas manquer : aucun</li>
      </ul>
    </div>
    <div class="card mt-5 mb-5" style="width: 18rem;">
      <div class="card-header">
        Forums et sujet favoris
      </div>
      <ul class="list-group list-group-flush">
        <li class="list-group-item">Forums favoris : aucun </li>
        <li class="list-group-item">Sujet favoris : aucun </li>
        <li class="list-group-item">A third item</li>
      </ul>
    </div>
    <div class="card mt-5 mb-5" style="width: 18rem;">
      <div class="card-header">
        Actulalité 
      </div>
      <ul class="list-group list-group-flush">
        <li class="list-group-item">An item</li>
        <li class="list-group-item">A second item</li>
        <li class="list-group-item">A third item</li>
      </ul>
    </div>
  </div>
  <div class="row ">
    <h3 class="message" style="color: red"><?= App\Session::getFlash("error") ?></h3> 
    <h3 class="message" style="color: green"><?= App\Session::getFlash("success") ?></h3>
    <?php if(isset($_SESSION["user"])) { 
           if($topic->getClosed() == true) { ?>
      <form action="index.php?ctrl=forum&action=addMessage&id=<?=$topic->getId()?>" method="post" class="mt-5">
        <div class="mb-3 col-6">
          <label for="exampleFormControlTextarea1" class="form-label"><h3>Répondre</h3></label>
          <textarea name='addTextUser' class="form-control" id="exampleFormControlTextarea1" rows="4" placeholder="Pour que les discussions restent agréables, nous vous remercions de rester poli en toutes circonstances.En postant sur nos espaces, vous vous engagez à en respecter la charte d'utilisation. Tout message discriminatoire ou incitant à la haine sera supprimé et son auteur sanctionné." required></textarea>
        </div>
          <button class="btn btn-primary mb-5 " name="submit" type="submit" data-bs-toggle="modal" data-bs-target="#exampleModal">Envoyer</button>
      </form>
    <?php }
        } else echo "<h2 class='bg-warning'>connecter vous pour répondre</h2>" ?>
  </div>
</div>   


