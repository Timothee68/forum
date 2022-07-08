<?php
 $categorieManager = $result["data"]["categories2"];
 $topicsManager = $result["data"]["topics"];
 $title = "listes des topics par catégorie";
 $count = 1;
?>

<div class="container-fluid">
  <div class="row ">
    <div  id="bg-listTopic" style="height:300px ;">
    <h1 class="text-center mb-5">Topics : <?= $categorieManager->getTitle() ?> </h1>
    </div>
  </div>
</div>

        <h3 class="message" style="color: red"><?= App\Session::getFlash("error") ?></h3>
        <h3 class="message" style="color: green"><?= App\Session::getFlash("success") ?></h3>

<div class="container">
  <table id="table_id" class="table table-striped mt-4 ">
    <thead>
      <tr class="bg-secondary">
        <th scope="col">Topics</th>
        <th scope="col">Date de création</th>
        <th scope="col">Pseudo</th>
        <th scope="col"></th>
        <th scope="col"></th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
      <?php if(isset($topicsManager))
            {
                foreach($topicsManager as $topic)
                {
                 
                 echo "<tr>",
                    "<th scope='row'><a href='index.php?ctrl=forum&action=showMessagesTopic&id=".$topic->getId()."'>".$topic->getTitle().'  '.( $topic->getClosed() == false ?'<i class="fa-solid fa-lock  bg-danger"></i>': '')."</a></th>",
                    "<td><a href='index.php?ctrl=forum&action=showMessagesTopic&id=".$topic->getId()."'>".$topic->getDateTopic()."</a></td>",
                    "<td><a href='index.php?ctrl=forum&action=showMessagesByUser&id=".$topic->getUser()->getId()."'>".$topic->getUser()->getPseudo()."</a></td>";
                    ?>
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
                            <?php }  ?>
                          <td>
                          <div class='accordion' id='accordionPanelsStayOpenExample'>
                            <div class='accordion-item'>
                              <h2 class='accordion-header' id='heading<?=$count?>'>
                              <button class='accordion-button collapsed' type='button' data-bs-toggle='collapse' data-bs-target='#collapse<?=$count?>' aria-expanded='false' aria-controls='collapse<?=$count?>'>
                                    Modifier titre topic
                              </button>
                              </h2>
                            <div id='collapse<?=$count?>' class='accordion-collapse collapse' aria-labelledby='heading<?=$count?>' data-bs-parent='#accordionExample'>
                              <div class='accordion-body'>
                                  <form action='index.php?ctrl=forum&action=editTopicByCategorie&id=<?=$topic->getId()?>' method='POST' class='row g-3'  enctype='multipart/form-data'>    
                                    <div class='mb-3'>
                                      <input name='title' type='text' class='form-control' id='formGroupExampleInput' value=" <?= $topic->getTitle() ; ?>">
                                    </div>
                                  <button class='btn btn-primary mt-3 mb-3 ' name='submit' type='submit' data-bs-toggle='modal' data-bs-target='#exampleModal'>Modifier</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                       </td>
                        <td>            <!-- Button trigger modal -->
                          <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal<?=$topic->getId() ?>">
                            <i class='fa-solid fa-dumpster fs-1 mt-1'></i>
                          </button>
                        </td>
                                      <!-- Modal -->
                        <div class="modal fade" id="exampleModal<?=$topic->getId() ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Confirmer vous la suppression du topic ? </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                              la suppression est définitif et supprimera tout les messages contenues 
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa-solid fa-xmark"></i></button>
                                <button type="button" class="btn btn-primary"><a href="index.php?ctrl=forum&action=deleteTopicBycategorie&id=<?=$topic->getId()?>"><i class='fa-solid fa-dumpster fs-1 mt-1'></i></a></button>
                              </div>
                            </div>
                          </div>
                        </div>


                    <?php  } else {
                      echo"<td></td>","<td></td>","<td></td>"; 
                     } ?>
                  </tr>
               <?php   $count++;
                }  
            }else{
              echo "<p class='card-text'>Aucun topic !</p>";
              }
            ?> 
    </tbody>
  </table>
    <h3 class="message" style="color: red"><?= App\Session::getFlash("error") ?></h3>
    <h3 class="message" style="color: green"><?= App\Session::getFlash("success") ?></h3>


<?php if(isset($_SESSION["user"])) { 
  if( $_SESSION['user']->getStatus() == true ){?>
  <div class="row">
    <form action="index.php?ctrl=forum&action=addTopic&id=<?=$categorieManager->getId()?>" method="post">
      <div class="mb-3 col-6">
        <label for="formGroupExampleInput" class="form-label"><h3 class="mt-5 mb-3">Nouveau Sujet</h3></label>
        <input name="titleTopic" type="text" class="form-control" id="formGroupExampleInput" placeholder="Saisir le titre du sujet">
        <div class="mb-3 ">
          <label for="exampleFormControlTextarea1" class="form-label"><h3>Ajouter un message accompagnant le topic</h3></label>
          <textarea name='addTextUser' class="form-control " id="exampleFormControlTextarea1" rows="4" placeholder="Pour que les discussions restent agréables, nous vous remercions de rester poli en toutes circonstances.En postant sur nos espaces, vous vous engagez à en respecter la charte d'utilisation. Tout message discriminatoire ou incitant à la haine sera supprimé et son auteur sanctionné." required></textarea>
        </div>
        <select name="categorie_id" class="form-select" style="display: none;" aria-label="Default select example">
            <option value="<?=$categorieManager->getId() ?>"><?=$categorieManager->getId() ?></option>
        </select>
      <button class="btn btn-primary mt-4 " name="submit" type="submit" data-bs-toggle="modal" data-bs-target="#example">Envoyer</button>
    </form>
   <?php }
   } else echo "<h2 class='bg-warning'>connecter vous pour ajouter des topics</h2>"?>
  </div>     
</div>

