<?php 
    $user = $result['data']['user'];
    $title = "Profil utilisateur";
?>
<article>
  <div class="container">
    <div class="row ">
      <div id="bg-otherUser">
        <h1 class="text-center mb-5">liste des users</h1>
      </div>
    </div>
  </div>
  <div class="container mt-5">
      <div class="row ">
          <div class="card text-center col-6">
            <div class="card-header bg-secondary mt-4">
               Profil Utilisateur 
            </div>
            <div class='col-md-4 mt-4 mb-4'>
                <img class='card-img-top' style='width: 6rem;' src='<?=$user->getImage()?>' alt='' srcset=''>
            </div>
            <div class="card-body">
                <h5 class="card-title mb-4"> Pseudo : <?=$user->getPseudo()?></h5>
                <p class="card-text mb-4"><?=$user->getRole()?></p>
                <p class="card-text">Statut de l'utilisateur : <?=$user->getStatus() ? "<p class='bg-success'>normale</p>" : "<p class='bg-danger'>Lock</p>" ?></p>
            </div>
            <div class="card-footer text-muted mb-5">
              <?=$user->getRole()?> depuis le <?=$user->getCreationDate()?>
            </div>
          </div>
      </div>
  </div>
</article>

           