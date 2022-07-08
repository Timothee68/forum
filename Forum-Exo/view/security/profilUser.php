<?php 
    $profil = $result["data"]['user'];
    $title = "Profile"
?>

<article>
    <div class="container bg-light bg-opacity-75 mt-4">
        <H1 >Mon Compte</H1>
        <h3 class="message" style="color: red"><?= App\Session::getFlash("error") ?></h3>
        <h3 class="message" style="color: green"><?= App\Session::getFlash("success") ?></h3>
        <div class="card mb-4">
            <div class="row g-0 ">
                <h5 class="profile-user card-title bg-primary text-light p-3 fw-bold">Informations personelles</h5>
                <div class="col-md-4 p-3 ">
                    <img src="<?=$profil->getImage()?>" class="img-fluid rounded-start mt-2" alt="...">
                    <!-- accrodeon -->
                    <div class="accordion" id="accordionPanelsStayOpenExample">
                      <div class="accordion-item">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Modifier Image
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <form action="index.php?ctrl=security&action=changeProfilePicture&id=<?=$profil->getId()?>" method="POST" class="row g-3"  enctype="multipart/form-data">    
                                    <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Nouvelle Image de profile </label>
                                            <input name="image"  type="file" class="form-control" id="formFile">
                                        </div>
                                        <button class="btn btn-primary mt-3 mb-3 " name="submit" type="submit" data-bs-toggle="modal" data-bs-target="#exampleModal">Modifier</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <p class="card-text fs-2 text-center mt-4">Pseudo : <?=$profil->getPseudo() ;?></p>
                        <p class="card-text fs-2 text-center mt-4">Email : <?= $profil->getEmail();?></p>
                        <p class="card-text fs-4 text-center mt-4">Crée le : <?= $profil->getCreationDate();?></p>
                        <p class="card-text fs-4 text-center mt-4">Tu es : <?= $profil->afficherRole();?></p>
                        <div class="col-2">
                            <p class="card-text fs-4 text-center mt-4"><?= $profil->getStatus() ? "<p class='bg-success'>normale</p>" : "<p class='bg-danger'>Honte à toi tu as été banni pour ton mauvais comportement tu seras peut-étre ré-accepté utlérieurement </p>";?></p>
                        </div>
                    </div> 
                </div>               
                <div class="row g-0">
                    <p>
                    <button class="btn btn-danger text-light mb- d-grid gap-2 col-3 mx-auto " type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        Modifier
                    </button>
                    </p>
                    <div class="collapse" id="collapseExample">
                        <div class="card card-body">
                            <form action="index.php?ctrl=security&action=updatePseudo&id=<?=$profil->getId()?>" method="POST" class="row g-3" >
                                <div class="col-md-4">
                                    <label for="validationServer01" class="form-label">Pseudo</label>
                                    <input name="pseudo" type="text" class="form-control"  placeholder="nouveau Pseudo">                                       
                                    <button class="btn btn-primary mt-3 mb-3 " name="submit" type="submit" data-bs-toggle="modal" data-bs-target="#exampleModal">Modifier</button>
                                </div>
                            </form>
                            <a href="index.php?ctrl=security&action=deleteProfil&id=<?=$profil->getId()?>"><p class="text-danger text-center">Supprimer mon Compte</p></a>
                        </div>
                    </div>
                </div> 
            </div> 
        </div>        
                    <!-- accordeon -->        
        <div class="row">
            <div class="accordion" id="accordionPanelsStayOpenExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                        <button class="profile-user accordion-button bg-primary text-light" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                        Modifier Adresse Email
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
                        <div class="accordion-body">
                            <form action="index.php?ctrl=security&action=updateEmail&id=<?=$profil->getId()?>" method="POST" class="row g-3" >
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Nouvelle address email</label>
                                    <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    <div id="emailHelp" class="form-text">Ne jamais donner son adresse mail.</div>
                                    <button class="btn btn-primary mt-3 mb-3 " name="submit" type="submit" data-bs-toggle="modal" data-bs-target="#exampleModal">Modifier</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="accordion-item mb-4">
                        <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                            <button class="profile-user accordion-button collapsed bg-primary text-light" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                            Modifier mon Mot de Passe
                            </button>
                        </h2>
                    </div>
                    <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingTwo">
                    <form action="index.php?ctrl=security&action=updatePassword&id=<?=$profil->getId()?>" method="POST" class="row g-3" >
                        <div class="accordion-body">
                            <input name="password" class="form-control mt-4" type="password" placeholder="Mot de Passe actuel" aria-label="default input example">
                            <input name="passwordNew" class="form-control mt-4" type="password" placeholder="Nouveaux Mot de Passe" aria-label="default input example">
                            <input name="passwordVerifie" class="form-control mt-4" type="password" placeholder="Confirmer Nouveaux Mot de Passe" aria-label="default input example">
                            <button class="btn btn-primary mt-3 mb-3 " name="submit" type="submit" data-bs-toggle="modal" data-bs-target="#exampleModal">Modifier</button>
                        </div>
                    </form>
                    </div>
                </div>    
            </div>
        </div>
    </div>
</article>                  
       