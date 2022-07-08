<?php
// on le place dans la catégorie des controllers 
namespace Controller;

    // on va utilise la catégorie app et topic manager 

use App\AbstractController;
use App\ControllerInterface;
use App\Session;
use Model\Managers\MessageManager;
use Model\Managers\TopicManager;
use Model\Managers\UserManager;
use Model\Managers\CategorieManager;

    // on crée une calss ForumController fille de abstractController et on implemente controller interface pour forcer a utilisé dans le cas présent la fonction index 
    class ForumController extends AbstractController implements ControllerInterface {
    // on surcharge la fonction index hériter de abstractControlleur pour lui chhanger le contenu 
    // fonction qui récupere et affiche les topics la date de création et le pseudo de créateur du topic 
        public function index (){ // index est obligatoirement a déclarer car il est définie dans controller interface !
            
            $topicManager =new TopicManager();
            $messageManager = new MessageManager();
            $categorieManager = new CategorieManager();
            
                // je récupere les infos dans la table topic
                $topics =  $topicManager->findAllTopicsAndUsers(["dateTopic","DESC"]);
                // pour chaque topic je récupere le nb de message par l'id des topic dans un tableau équivalant 
                foreach ($topics as $topic){
                    $nb[]=  $messageManager->findNbMessagesByTopic($topic->getId());  // $nb c'est un array de nb message par id 
                        
                }
                return [
                    "view" => VIEW_DIR."forum/listTopics.php",  

                        "data" => [ // data prend la valeur d'un tableau qui contient topics 
                        "topics" => $topicManager->findAllTopicsAndUsers(["dateTopic","DESC"]), //topics qui vaut $topicManager de l'objet TopicManager qui execute  la fonction de trouver tout les topics avec en paramêtre la selection par date dans l'ordre décroissant
                        "categories" => $categorieManager->findAll(),                                                                                                      
                        "nb" =>  $nb  // j'envoie le tableau dans le tableau data
                ]         
            ];
        }
        // fontion pour afficher les topics par catégorie
        public function showTopicsByCategorie($id){ 
            $categorieManager = new CategorieManager();
            $topicManager = new TopicManager();

            return [
                "view" => VIEW_DIR."forum/listTopicsByCategorie.php",
                "data" => [
                    "categories2" => $categorieManager->findTopicsById($id),
                    "topics" => $topicManager->findTopicByCategorie($id),
                    "categories" => $categorieManager->findAll(),
                ]
            ];

        }
        // fonction pour voir la listes des utilisateurs 
        public function showUsers(){

            $userManager = new UserManager();
            $categorieManager = new CategorieManager();

            return [
                "view" => VIEW_DIR."forum/listUsers.php",
                "data" => [
                    "users" => $userManager->findAll(),
                    "categories" => $categorieManager->findAll(),
                ]
            ];
        }

  
        //fonction pour récuperer et afficher les messages d'un topic par son id 
        public function showMessagesTopic($id){
            $categorieManager = new CategorieManager();
            $messageManager = new MessageManager();
            $topicManager = new TopicManager();
            return [
                "view" => VIEW_DIR."forum/listMessages.php",
                "data" => [
                    "messages" => $messageManager->findMessagesByTopic($id),
                    "topic" => $topicManager->findOneById($id),
                    "categories" => $categorieManager->findAll(),
                ],
            
                ];
        }

        // fonction qui afficher tout les messages posté d'un utilisateur liée au topic 
        public function showMessagesByUser($id){
            $categorieManager = new CategorieManager();
            $messageManager = new MessageManager();
            $user = new UserManager();
            return [
                "view" => VIEW_DIR."forum/listUserMessages.php",
                "data" => [
                    "userMessages" => $messageManager->MessageByUser($id),
                    "categories" => $categorieManager->findAll(),
                    "pseudo" => $user->findOneById($id)
                ] 
            ];
        }
        //fonction pour ajouter un topic dans une categorie 
        public function addTopic(){
        
            $topicManager = new TopicManager();
            if($_SESSION['user']){

                $user= $_SESSION['user']->getId();

                if(isset($_POST['submit']) )
                {
                    $title= filter_input(INPUT_POST,"titleTopic",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    $categorie = filter_input(INPUT_POST,'categorie_id',FILTER_VALIDATE_INT,FILTER_SANITIZE_NUMBER_INT);  
                    $text = filter_input(INPUT_POST,'addTextUser',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    if(Session::getTokenCSRF() !== $_POST['csrfToken'])
                    {
                        $this->redirectTo("security", "logOut");
                    }
                    if(isset($title,$categorie)){
                        //  je récuprere l'id de l'ajout pour le reutiliser 
                    $idTopic = $topicManager->add([ "user_id" => $user ,"title" => $title,"categorie_id" => $categorie]);

                        if($text)
                        {      
                            $messageManager = new MessageManager();
                            $messageManager->add(["topic_id" => $idTopic , "user_id" => $user , "text" => $text]);
                            $this->redirectTo("forum","showMessagesTopic",$idTopic);
                        } else {
                            Session::addFlash("error","remplisser les champs ");
                        }
                        Session::addFlash("success","Topic ajouter avec succès");                                  
                        }
                } else {
                    $this->redirectTo("forum","index");
                    Session::addFlash("error","remplisser les champs ");
                }
            }
        }
    
        // fonction pour modifer le nom du topic EN COUR !!!!!
        public function editTopic($id)
        {       
            if(isset($_POST["submit"]))
            {
                $title = filter_input(INPUT_POST,"title",FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                if(Session::getTokenCSRF() !== $_POST['csrfToken'])
                {
                    $this->redirectTo("security", "logOut");
                }
                    if($title)
                    {
                        $topicManager =new TopicManager();
                        $topicManager->edit([ "title" => $title],$id);
                        Session::addFlash("success","Nom du Topic modifier avec succès");
                        $this->redirectTo("forum","index",$id);
                    }         
            } 
        }
        // fonction pour supprimé un topic dans la liste des topics
        public function deleteTopic($id){
            $topicManager = new TopicManager();   
            $topicManager->delete($id);
            Session::addFlash("success","Topic supprimer avec succès");
            $this->redirectTo("forum","index",$id);
        }
        // fonction pour supprimer un topic dans une catégorie précise 
        public function deleteTopicBycategorie($id){
        
            $categorieManager = new CategorieManager();
            $topicManager = new TopicManager();
            $id2 = $topicManager->findOneById($id)->getCategorie()->getId();
            $topicManager->delete($id);
            Session::addFlash("success","Topic supprimer avec succès");
            return [
                "view" => VIEW_DIR."forum/listTopicsByCategorie.php",
                "data" => [
                    "categories2" => $categorieManager->findTopicsById($id2),
                    "topics" => $topicManager->findTopicByCategorie($id2),
                    "categories" => $categorieManager->findAll(),
                ]
            ];
        }
        // fonction pour modifer le nom de la catégorie 
        public function editTopicByCategorie($id)
        {    
            $categorieManager = new CategorieManager();

            if(isset($_POST["submit"]))
            {
                $title = filter_input(INPUT_POST,"title",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                if(Session::getTokenCSRF() !== $_POST['csrfToken'])
                {
                    $this->redirectTo("security", "logOut");
                }
                if($title)
                {
                    $topicManager =new TopicManager();
                    $topicManager->edit([ "title" => $title],$id);
                    // il faut rechercher l'id de la categorie pour afficher le title de la catégorie ...
                    $id2 = $topicManager->findOneById($id)->getCategorie()->getId();
                    Session::addFlash("success","Nom du Topic modifier avec succès");
                    return [
                        "view" => VIEW_DIR."forum/listTopicsByCategorie.php",  
                        "data" => [ 
                            "categories2" => $categorieManager->findTopicsById($id2),
                            "topics" => $topicManager->findTopicByCategorie($id2),
                            "categories" => $categorieManager->findAll(),
                        ]                
                    ];
                }
            }
        }
        
        // fonction pour ajouter et afficher le message envoyer sur le topic 
        public function addMessage($id)
        {
            $messageManager =new MessageManager();

            if($_SESSION['user'] ){

                $user= $_SESSION['user']->getId();
            
                if(isset($_POST['submit']) && empty($_POST['submit']))
                {
                    if(isset($_POST["addTextUser"]) && $_POST["addTextUser" ]!= "")
                    {
                        $text= filter_input(INPUT_POST,"addTextUser",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                        // var_dump(["topic_id" => $id , "user_id" => $user , "text" => $text]);die;
                        if(Session::getTokenCSRF() !== $_POST['csrfToken'])
                        {
                            $this->redirectTo("security", "logOut");
                        }
                        $messageManager->add(["topic_id" => $id , "user_id" => $user , "text" => $text]);
                        Session::addFlash("success","Message ajouter avec succès");
                        $this->redirectTo("forum","showMessagesTopic",$id);
                    } else {
                            Session::addFlash("error","remplisser le champ ");
                            $this->redirectTo("forum","showMessagesTopic",$id);
                    }
                } else {
                    Session::addFlash("error","remplisser le champ ");
                    $this->redirectTo("forum","showMessagesTopic",$id);

                }
            }
        }
        
        // fonction pour supprimer un message  
        public function deleteMessage($id){ 
            $categorieManager = new CategorieManager();
                
            $messageManager =new MessageManager();
            $topicManager = new TopicManager();
            
            // requete pour récupérer l'id du topic avant la suppression par la table message 
            $id2 = $messageManager->findOneById($id)->getTopic()->getId();
            $messageManager->delete($id);
            Session::addFlash("success","Message supprimer avec succès");
            return [
                "view" => VIEW_DIR."forum/listMessages.php",
                "data" => [
                    "messages" => $messageManager->findMessagesByTopic($id2),
                    "topic" => $topicManager->findOneById($id2),
                    "categories" => $categorieManager->findAll(),
                    ]                  
            ];
        }

        // fonction pour afficher toutes les catégories 
        public function showCategorie()
        {
            $categorieManager = new CategorieManager();
            return [
                "view" => VIEW_DIR."layout.php",
                "data" => [
                    "categories" => $categorieManager->findAll(),
                ]
            ];
        }
  
  
        // fonction de recherche marche pas !!!!!!!!!!!!!!!
        public function search($data)
        {   
            $categorieManager = new CategorieManager();
            if($_POST['data']){
              
                $data = filter_input(INPUT_POST,'data',FILTER_SANITIZE_FULL_SPECIAL_CHARS,FILTER_FLAG_NO_ENCODE_QUOTES);
                if($data)
                { 
                    $topicManager = new TopicManager();
                    $userManager = new UserManager();
                    $messageManager = new MessageManager();
                    return [
                        "view" => VIEW_DIR."forum/searchResult.php",  
                        "data" => [ 
                            "categories" => $categorieManager->findAll(),
                            "searchTopic" => $topicManager->searchTopic(["data" =>'%'.$data.'%']),
                            "searchMessage" => $messageManager->searchMessage(["data" =>'%'.$data.'%']),
                            "searchPseudo" => $userManager->searchUser(["data"=>'%'.$data.'%']),
                        ]
                    ];
                }
            }
        }
   
}