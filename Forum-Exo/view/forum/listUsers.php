<?php
    $users = $result["data"]["users"];

    $title = "listes users"
?>
<div class="container-fluid">
  <div class="row ">
    <div  id="bg-listTopic" style="height:300px ;">
      <h1 class="text-center mb-5">liste des users</h1>
    </div>
  </div>
</div>
<div class="container">
  <table id="table_id" class="table table-striped mt-4">
    <thead>
      <tr class="bg-secondary">
        <th scope="col">Pseudo</th>
        <th scope="col">Status</th>
        <th scope="col">rôle</th>
        <th scope="col">Date de création</th>
        <th scope="col">Gestion droit</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($users as $user) : ?>
        <tr>
          <td><a href="index.php?ctrl=security&action=profilOtherUSer&id=<?= $user->getId() ?>"><?=$user->getPseudo()?></a></td>
          <td scope="row"><?=$user->getStatus() ? "<p class='bg-success'>normale</p>" : "<p class='bg-danger'>Lock</p>" ?></td>
          <td scope="row"><?=$user->afficherRole()?></td>
          <td><?=$user->getCreationDate()?></td>
          <form action="index.php?ctrl=security&action=lockUser&id=<?= $user->getId() ?>" method="post">
            <td><button class="btn btn-primary" name="lock" type="submit" data-bs-toggle="modal" data-bs-target="#exampleModal">Lock/Unlock user</button></td>
          </form>
        </tr>
      <?php endforeach ?>  
    </tbody>
  </table>