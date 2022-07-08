<?php
 $messages = $result["data"]["userMessages"];
 $pseudo = $result["data"]["pseudo"];
 $title = "listes messages utilisateurs"
?>
 
<h1 class="text-center mt-5 ">Les messages de l'utilisateur <?= $pseudo->getPseudo()?> </h1>
  <div class="container">
    <div class="col-2">
      <h3 class=" text-center mb-5"><?=$pseudo->getStatus() ? "<p class='bg-success'>normale</p>" : "<p class='bg-danger'>Lock</p>" ?></h3>
    </div>
    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">Message</th>
          <th scope="col">Date de création</th>
          <th scope="col">Nom topic</th>
          <th scope="col">Catégorie topic</th>
        </tr>
      </thead>
      <tbody>
        <?php if(isset($messages)){
        foreach($messages as $message) : ?>
        <tr>
          <th scope="row"><?=$message->getText()?></th>
          <th><?=$message->getCreationMessage()?></th>
          <th><a href="index.php?ctrl=forum&action=showMessagesTopic&id=<?=$message->getTopic()->getId()?>"><?=$message->getTopic()->getTitle()?></a></th>  
          <th><a href="index.php?ctrl=forum&action=showTopicsByCategorie&id=<?=$message->getTopic()->getCategorie()->getId()?>"><?=$message->getTopic()->getCategorie()->getTitle()?></a></th>
        </tr>
        <?php endforeach ?>  

       <?php } else {
        echo "<h1> AUCUN MESSAGE PUBLIER </h1>";
       } ?>  
      </tbody>
    </table>
  </div>  