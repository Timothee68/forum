<?php
 $categorieManager = $result["data"]["categories2"];
 $topicsManager = $result["data"]["topics"];
 $title = "listes des topics par catégorie"
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
      <?php if(isset($topicsManager)){
                foreach($topicsManager as $topic){
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
                      <?php echo "<td>
                          <div class='accordion' id='accordionPanelsStayOpenExample'>
                            <div class='accordion-item'>
                            <h2 class='accordion-header' id='headingThree'>
                            <button class='accordion-button collapsed' type='button' data-bs-toggle='collapse' data-bs-target='#collapseThree' aria-expanded='false' aria-controls='collapseThree'>
                                  Modifier titre topic
                                </button>
                              </h2>
                              <div id='collapseThree' class='accordion-collapse collapse' aria-labelledby='headingThree' data-bs-parent='#accordionExample'>
                              <div class='accordion-body'>
                                  <form action='index.php?ctrl=forum&action=editTopicByCategorie&id=".$topic->getId()."' method='POST' class='row g-3'  enctype='multipart/form-data'>    
                                    <div class='mb-3'>
                                      <input name='title' type='text' class='form-control' id='formGroupExampleInput' placeholder='Saisir le titre du sujet'>
                                    </div>
                                    <button class='btn btn-primary mt-3 mb-3 ' name='submit' type='submit' data-bs-toggle='modal' data-bs-target='#exampleModal'>Modifier</button>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>
                       </td>",
                    "<td><a href='index.php?ctrl=forum&action=deleteTopicBycategorie&id=".$topic->getId()."'><i class='fa-solid fa-dumpster fs-1 mt-1'></i></a></td>";
                     } else {
                      echo"<td></td>","<td></td>","<td></td>"; 
                     }
                  "</tr>";
                }
            }else{
              echo  "<p class='card-text'>Aucun topic !</p>";
            }
            ?> 
    </tbody>
  </table>
    <h3 class="message" style="color: red"><?= App\Session::getFlash("error") ?></h3>
    <h3 class="message" style="color: green"><?= App\Session::getFlash("success") ?></h3>
<?php if(isset($_SESSION["user"])) { ?>
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
      <button class="btn btn-primary mt-4 " name="submit" type="submit" data-bs-toggle="modal" data-bs-target="#exampleModal">Envoyer</button>
    </form>
   <?php } else echo "<h2 class='bg-warning'>connecter vous pour ajouter des topics</h2>"?>
  </div>     
</div>

