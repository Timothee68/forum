<?php
    namespace App;
    //une class absrtact signifie que Les classes définies comme abstraites ne peuvent pas être instanciées on ne feras jamais de $varibale = new AbstractController
    abstract class AbstractController{
        //on force les class enfants a utilise la fonction index 
        public function index(){}
        // fonction qui sert a faire les redirection 
        public function redirectTo($ctrl = null, $action = null, $id = null){
            if($ctrl != "home"){
                $url = $ctrl ? "?ctrl=".$ctrl : "";
                $url.= $action ? "&action=".$action : "";
                $url.= $id ? "&id=".$id : "";
            }
            else $url = "/";
            header("Location: $url");
            die();
        }

        public function restrictTo($role){
            
            if(!Session::getUser() || !Session::getUser()->getRole() == $role){
                $this->redirectTo("security", "login");
            }
            return;
        }
        
        
    }