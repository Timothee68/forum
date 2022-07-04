<?php

    $topics = $result["data"]["topics"];
    $nb = $result["data"]["nb"]; // je récupère un tableau a 2 dimensions 
    $title = "listes des topics"
?>
<div class="container-fluid">
  <div class="row ">
    <div  id="bg-listTopic" style="height:300px ;">
      <h1 class="text-center mb-5">liste des topics</h1>
    </div>
  </div>
</div>
    <h3 class="message" style="color: red"><?= App\Session::getFlash("error") ?></h3>
    <h3 class="message" style="color: green"><?= App\Session::getFlash("success") ?></h3>
<div class="container">
  <div class="row">
    <table id="table_id" class="table table-striped mt-4 display">
      <thead>
        <tr class="bg-secondary">
          <th scope="col ">Catégorie</th>
          <th scope="col">Topics</th>
          <th scope="col">Nb Messages</th>
          <th scope="col">Date de création</th>
          <th scope="col">Pseudo</th>
          <th scope="col"></th>
          <th scope="col"></th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($topics as $topic) : ?>
          <tr>
            <td><a href="index.php?ctrl=forum&action=showTopicsByCategorie&id=<?=$topic->getCategorie()->getId()?>"><?=$topic->getCategorie()->getTitle()?></a></td>
            <td scope="row"><a href="index.php?ctrl=forum&action=showMessagesTopic&id=<?=$topic->getId()?>"><?=$topic->getTitle()."  ".( $topic->getClosed() == false ?'<i class="fa-solid fa-lock  bg-danger"></i>': "")?></a></td>
            <td scope="row"><?=$nb[$topics->key()]["nb"] ?> Message(s)</td>  
            <td><a href="index.php?ctrl=forum&action=showMessagesTopic&id=<?=$topic->getId()?>"><?=$topic->getDateTopic()?></a></td>
            <td><a href="index.php?ctrl=forum&action=showMessagesByUser&id=<?=$topic->getUser()->getId()?>"><?=$topic->getUser()->getPseudo()?></a></td>
            <?php if( APP\Session::isAdmin() || isset($_SESSION['user']) && ($_SESSION['user']->getId() == $topic->getUser()->getId())){ ?>
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
            <td>
              <div class="accordion" id="accordionPanelsStayOpenExample">
                <div class="accordion-item">
                <h2 class="accordion-header" id="headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        Modifier titre topic
                    </button>
                  </h2>
                  <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                      <form action="index.php?ctrl=forum&action=editTopic&id=<?=$topic->getId()?>" method="POST" class="row g-3"  enctype="multipart/form-data">    
                        <div class="mb-3">
                          <input name="title" type="text" class="form-control" id="formGroupExampleInput" placeholder="Saisir le titre du sujet">
                        </div>
                        <button class="btn btn-primary mt-3 mb-3 " name="submit" type="submit" data-bs-toggle="modal" data-bs-target="#exampleModal">Modifier</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </td>
            <td><a href="index.php?ctrl=forum&action=deleteTopic&id=<?=$topic->getId()?>"><i class='fa-solid fa-dumpster fs-1 mt-1'></i></td>
           <?php } else  echo "<td></td>","<td></td>","<td></td>"; ?> 
          </tr>
        <?php endforeach ?>  
      </tbody>
    </table>
  </div>
</div>


<!-- explication nb message -->
<!-- $nb = [0]["nb"] = le nombre de message , =>  0 etant l'id 
$nb = [1]["nb"]
$nb = [2]["nb"]
$nb = [3]["nb"] -->
