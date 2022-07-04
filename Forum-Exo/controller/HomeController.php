<?php
// on cree un espace Controller dans lequel on met HomeController.php
 namespace Controller;
//
use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\CategorieManager;

    // on crée une calss ForumController fille de abstractController et on implemente controller interface pour forcer a utilisé dans le cas présent la fonction index 
    class HomeController extends AbstractController implements ControllerInterface{
        // on surcharge la fonction index hériter de abstractControlleur pour lui chhanger le contenu 
        public function index(){// index est obligatoirement a déclarer car il est définie dans controller interface !
          
            $categorieManager = new CategorieManager;
            
            return [
                "view" => VIEW_DIR."home.php",
                "data" => [
                    "categories" => $categorieManager->findAll(),
                ]
            ];
        }

        
    }