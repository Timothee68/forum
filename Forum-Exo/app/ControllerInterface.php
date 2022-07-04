<?php
    // on le place dans App ou application car il seras utilise partout dans l'application
    namespace App;

    interface ControllerInterface{
        // on délcare une fonction index qui forcera tout les controller a avoir cet fonction avec la méthode implements
        public function index();
    }