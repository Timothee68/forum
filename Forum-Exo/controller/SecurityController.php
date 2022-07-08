<?php

namespace Controller;

use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\UserManager;
use App\Session;
use Model\Managers\CategorieManager;
use Model\Managers\MessageManager;
use Model\Managers\TopicManager;

class SecurityController extends AbstractController implements ControllerInterface{
    // redirection pour la connexion / inscription 
    public function index()
    {
        $categorieManager = new CategorieManager();
        Session::setTokenCSRF(bin2hex(random_bytes(32)));
        return [
            "view" => VIEW_DIR."security/connexion.php", 
            "data" => [
                "categories" => $categorieManager->findAll(),
            ]
        ];
    }

    // fonction pour crée un compte 
    public function register()
    {
        $categorieManager = new CategorieManager();
        if(isset($_POST['submitSignUp']))
        {
            $email = filter_input(INPUT_POST,"email",FILTER_SANITIZE_EMAIL,FILTER_VALIDATE_EMAIL);
            $pseudo = filter_input(INPUT_POST,"pseudo",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $password = filter_input(INPUT_POST,"password",FILTER_SANITIZE_FULL_SPECIAL_CHARS,FILTER_VALIDATE_REGEXP);
            // array(
            //     "options" => array("regexp"=>
            //     "/\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[0-9])(?=\S*[A-Z])(?=\S*[\d])\S*/")));
            $confirmPassword = filter_input(INPUT_POST,"confirmPassword",FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            if($email && $pseudo && $password )
            {       
                $userManager = new UserManager();
                // si on la requete sql ne trouve pas d'email similaire en bdd sa renvoie a false donc si c'est false on poursuit 
                if(!$userManager->findOneByEmail($email))
                {
                    // si la requete sql ne trouve pas de user similaire en bbd renvoie a false donc si c'est false on poursuit 
                    if(!$userManager->findOneByUser($pseudo))
                    {
                        if 
                        (($password == $confirmPassword ) and strlen($password) >=8 )
                        
                        {
                            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                            $userManager->add(["email" => $email, "pseudo" => $pseudo,"password" => $passwordHash , "role" => json_encode(["ROLE_USER"])]);

                        }else {
                            Session::addFlash("error","Le mot de passe n'est pas identique. Ou pas assez long!!");
                        }               
                    }else {
                        Session::addFlash("error","pseudo déja utilisé");
                    }
                }else{
                    Session::addFlash("error","email déja enregistrer");
                } 
            }              
            $this->redirectTo("security","index");
        }
    }


     // fonction de login 
    public function login()
    {      
        $categorieManager = new CategorieManager();
        $userManager = new UserManager();

        if(isset($_POST['submitLogin']))
        {
            $email = filter_input(INPUT_POST,"email",FILTER_SANITIZE_EMAIL,FILTER_VALIDATE_EMAIL);
            $password = filter_input(INPUT_POST,"password",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            if(Session::getTokenCSRF() !== $_POST['csrfToken']){
                $this->logout();
            }

            if($email && $password) 
            {
                $dbPass = $userManager->retrievePassword($email);
                $hash = $dbPass->getPassword();
                $user = $userManager->findOneByEmail($email);
                
                if(password_verify($password,$hash))
                {
                    if($user->getStatus() == true)
                    {    
                        Session::setUser($user);
                        //initialisation d'un token pour toute la session user
                        Session::setTokenCSRF(bin2hex(random_bytes(32)));
                        Session::addFlash("success","vous êtes bien connecter bravo noobie !! =)");
                        return [
                            "view" => VIEW_DIR."home.php",
                            "data" => [
                                "user" => $user,
                                "categories" => $categorieManager->findAll(),
                                ]     
                            ];
                    } else {
                        Session::addFlash('error',"Vous avez été bannie il fallait respecter les règles") ;
                        $this->redirectTo("security","index");
                    }
                } else {
                    Session::addFlash('error',"Identifiant ou Mot de passe incorrecte") ;
                    $this->redirectTo("security","index");
                } 
            }
        }
    }
    
    // fonction pour ce déconnecter 
    public function logOut(){
               
        unset($_SESSION['tokenCSRF']);
        $_SESSION[] = session_unset();
        Session::addFlash("success","Déconnexion avec succès a bientôt =) ");
        $this->redirectTo("security","index");
    }

    //fonction pour voir son profil utilisateur
    public function showProfileUser($id){

        $categorieManager = new CategorieManager();
        $userManager = new UserManager();
        return [
                "view" => VIEW_DIR."security/profilUser.php",
                "data" => [
                    "user" => $userManager->findOneById($id),
                    "categories" => $categorieManager->findAll(),
                ]     
        ];
    }

    // fonction pour voir le profil des autres utilisateurs 
    public function profilOtherUser($id){
        $categorieManager = new CategorieManager();
        $userManager = new UserManager();
        return 
        [
            "view" => VIEW_DIR."security/profilOtherUser.php",
            "data" => [
                "user" => $userManager->findOneById($id),
                "categories" => $categorieManager->findAll(),
            ]     
        ];
    }

    // fonction pour changer son pseudo 
    public function updatePseudo($id)
    {                  
        $userManager = new UserManager();   
        
            if(isset($_POST["submit"]))
            {
                $pseudo = filter_input(INPUT_POST,"pseudo",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                if(Session::getTokenCSRF() !== $_POST['csrfToken']){
                    $this->logout();
                }
                if($pseudo)
                {
                    $userManager->edit(["pseudo" => $pseudo],$id);
                    SESSION::setUser($userManager->findOneById($id));
                    Session::addFlash('success',"Pseudo Modifier avec succès !") ;
                    $this->redirectTo("security","showProfileUser",$id);
                }
            }
    }

    // fonction pour changer son email
    public function updateEmail($id)
    {
        $userManager = new UserManager();   
        if(isset($_POST["submit"]))
        {
            $email = filter_input(INPUT_POST,"email",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            if(Session::getTokenCSRF() !== $_POST['csrfToken']){
                $this->logout();
            }
            if($email)
            {
                $userManager->edit(["email" => $email],$id);
                SESSION::setUser($userManager->findOneById($id));
                Session::addFlash('success',"E-mail Modifier avec succès !") ;
                $this->redirectTo("security","showProfileUser",$id);
            }
        }
    }


    public function updatePassword($id)
    {
        if(isset($_POST["submit"]))
        {
            $password = filter_input(INPUT_POST,"password",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $passwordNew = filter_input(INPUT_POST,"passwordNew",FILTER_SANITIZE_FULL_SPECIAL_CHARS,FILTER_VALIDATE_REGEXP);
            $passwordVerifie = filter_input(INPUT_POST,"passwordVerifie",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            if(Session::getTokenCSRF() !== $_POST['csrfToken']){
                $this->logout();
            }
            if($passwordNew == $passwordVerifie)
            {
                if($password && $passwordNew )
                {
                    $userManager = new UserManager();  
                
                    $dbPass =  $userManager->findOneById($id); //je récupere les infos du user par l'id' 
                    $hash = $dbPass->getPassword();// je recupère le mot de passe en bdd haché 
                
                    if(password_verify($password,$hash)) // je vérifie que le mpd envoyé est le bon si c'est le cas 
                    {
                        $passwordHash = password_hash($passwordNew, PASSWORD_DEFAULT);  // on hache le nouveau mdp
                        $userManager->edit(["password" => $passwordHash],$id); // je remplace le mdp par le nouveau 
                        SESSION::setUser($userManager->findOneById($id)); // je relance le user en session avec les nouvelles infos 
                        Session::addFlash('success',"Mot de passe Modifier avec succès !") ;
                        $this->redirectTo("security","showProfileUser",$id);
                    } else {
                        Session::addFlash('success',"<p class='bg-danger'>mot de passe incorrecte <p>") ;
                    }
                }
            }      
        }else {
            Session::addFlash('success', "<p class='bg-danger'>les mots de passe ne sont pas identiques <p>") ;
        }
    }

    // public function pour changer de photo de profil
    public function changeProfilePicture($id)
    {
        $userManager = new UserManager();
        if(isset($_POST['submit']))
        {
            if(Session::getTokenCSRF() !== $_POST['csrfToken']){
                $this->logout();
            }
            if(isset($_FILES['image']))
            {
                // si on echo $_FILES on obtient un tableau qui contient les infos dans le deuxieme [' '] on les places dans des variables
                $tmpName = $_FILES['image']['tmp_name'];
                $name = $_FILES['image']['name'];
                $size = $_FILES['image']['size'];
                $error = $_FILES['image']['error'];
    
                $tabExtension = explode('.', $name);
                $extension = strtolower(end($tabExtension));
                //Tableau des extensions que l'on accepte
                $extensions = ['jpg', 'png', 'jpeg', 'gif'];
                //Taille max que l'on accepte
                $maxSize = 400000;
            
                if(in_array($extension, $extensions) && $size <= $maxSize && $error == 0)
                {
                    // Génère un identifiant unique
                    $uniqueID = uniqid('', true );
                    $file = 'public/img/'.$uniqueID.'.'.$extension;
                    //  vaut l'id générer.jpg par exemple 
                    // Déplace un fichier téléchargé
                    move_uploaded_file($tmpName , './public/img/'.$name);
                    // il faut renomée le fichier avec l'uniqueiD et son extension car elle est enreigstrer en base de donnée de cet manière.
                    rename('./public/img/'.$name , './public/img/'.$uniqueID.'.'.$extension);
                    $image = $file;
                }
                else{
                    Session::addFlash('error', "<p>mauvaise extension ou fichier trop volumineux ! <p>") ;
                };
                $userManager->edit(['image' => $image],$id);
                Session::addFlash('success', "Photo modifier avec succès") ;
                $this->redirectTo("security","showProfileUser",$id);
            }
        }
    }

    public function closedTopicByUser($id)
    {
        $topicManager = new TopicManager();
        
        if(isset($_POST["closed"]))
        {
            $topicManager->edit(["closed" => 0],$id);
            Session::addFlash('success', "Votre topic a bien été fermer ! ");
            $this->redirectTo("forum","index",$id);
        }
    }
    public function openTopicByUser($id)
    {       
        $topicManager = new TopicManager();
        if(isset($_POST["closed"]))
        {  
            $topicManager->edit(["closed" => 1],$id);
            Session::addFlash('success', "Votre topic a bien été ouvert !");
            $this->redirectTo("forum","index",$id);
        }
    }
   
    // fonction pour lock ou delock USer
    public function lockUser($id){
        
        $categorieManager = new CategorieManager();
        $userManager = new UserManager();
       
        if(isset($_POST["lock"]))
        {
            $status = $userManager->findOneById($id)->getStatus();
            if($status == 1 ){
                $userManager->edit(["status" => 0],$id);
            } else {
                $userManager->edit(["status" => 1],$id);
            }
            $this->redirectTo("forum","showUsers",$id);
        }
    }
    // fonction pour supprimer son compte utilisateur
    public function deleteProfil($id){
            $userManager = new UserManager();
            $categorieManager = new CategorieManager();
            $userManager->delete($id);
            $_SESSION[] = session_unset();
            Session::addFlash('success', "<p>Votre compte utilisateur a été supprimer avec succès !!! <p>") ;
            $this->redirectTo("security","index");
    }    

}
                    