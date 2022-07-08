<?php  $title = "login / register";

require_once 'recaptcha/autoload.php';
if(isset($_POST["g-recaptcha-response"])){
    if($_POST["submitSingUp"]){
        $recaptcha = new \ReCaptcha\ReCaptcha("6Leqh9QgAAAAAKsmhQ9RaCAdS2TxI-U7Hvdr8XI4");
        $resp = $recaptcha->verify($_POST["g-recaptcha-response"]);
                        //   ->setExpectedHostname('recaptcha-demo.appspot.com');
        if ($resp->isSuccess()) {
            // Verified!
        } else {
            $errors = $resp->getErrorCodes();
        }
    }
}


?>
<div class="container-fluid">
  <div class="row ">
    <div  id="bg-listTopic" style="height:300px ;">
      <h1 class="text-center mb-5">ready to player talk </h1>
    </div>
  </div>
</div>
<div class="container-fluid">
    <h3 class="message" style="color: red"><?= App\Session::getFlash("error") ?></h3>
    <h3 class="message" style="color: green"><?= App\Session::getFlash("success") ?></h3>
    <div class="row">
        <div class="cotn_principal">
            <div class="cont_centrar">
                <div class="cont_login">
                    <div class="cont_info_log_sign_up">
                        <div class="col_md_login">
                            <div class="cont_ba_opcitiy">
                                <h2>Connexion</h2>  
                                <p>Bienvenu sur le forum des jeux vidéo</p> 
                                <button class="btn_login" onclick="cambiar_login()">LOGIN</button>
                            </div>
                        </div>
                        <div class="col_md_sign_up">
                            <div class="cont_ba_opcitiy">
                                <h2>Inscription</h2>
                                <p>Inscrivez-vous pour pouvoir échanger</p>
                                <button class="btn_sign_up" onclick="cambiar_sign_up()">SIGN UP</button>
                            </div>
                        </div>
                    </div>
                    <div class="cont_back_info">
                        <div class="cont_img_back_grey">
                            <img src="public\img\connexion.avif" alt="" />
                        </div>
                    </div>
                    <div class="cont_forms" >
                        <div class="cont_img_back_">
                            <img src="public\img\login.avif" alt="" />
                        </div>
        
                        <!--Formulaire connexion -->
                        <form action="index.php?ctrl=security&action=login" method="post">
                            <div class="cont_form_login">
                                <a href="#" onclick="ocultar_login_sign_up()" ><i class="fa-solid fa-arrow-left"></i></a>
                                <h2>Connexion</h2>
                                <input name="email" type="email" class="form-control" placeholder="Email" required />
                                <input name="password" type="password" class="form-control" placeholder="Password" required/>
                                <button class="btn_login" type="submit" name="submitLogin" onclick="cambiar_login()">LOGIN</button>
                                <p class="mt-2"><a href="#">Mot de passe oublié ?</a></p>
                            </div>
                        </form>
                            <!--Formulaire inscription -->
                        <form action="index.php?ctrl=security&action=register" method="post">
                            <div class="g-recaptcha" data-sitekey="6Leqh9QgAAAAAJLCmJ3Fy_eQTOQEN6IIc9GljHpl"></div>
                            <div class="cont_form_sign_up">
                                <a href="#" onclick="ocultar_login_sign_up()"><i class="fa-solid fa-arrow-left"></i></a>
                                <h2>Inscription</h2>
                                <input name="email" type="email" class="form-control" placeholder="Email" required/>
                                <input name="pseudo" type="text" class="form-control" placeholder="pseudo" required/>
                                <input name="password" type="password" class="form-control" placeholder="Password " required/>
                                <label for=""> minimum un caractère en majuscule un chiffre une minuscule et 8 caractères</label>
                                <input name="confirmPassword" type="password" class="form-control" placeholder="Confirm Password" required />
                                <button class="btn_sign_up" type="submit" name="submitSignUp" onclick="cambiar_sign_up()">SIGN UP</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>    
<!-- 6Leqh9QgAAAAAJLCmJ3Fy_eQTOQEN6IIc9GljHpl     utilisez cette clé de site dans le code HTML de votre site destiné aux utilisateurs.
-->
<!-- 6Leqh9QgAAAAAKsmhQ9RaCAdS2TxI-U7Hvdr8XI4   Utilisez cette clé secrète pour la communication entre votre site et le service reCAPTCHA-->