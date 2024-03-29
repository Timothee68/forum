<?php

namespace Model\Managers;

//on utilise dao pour ce connecter a la base de donnée
use App\DAO;
//on utilise App/manager ca c'est lui qui execute toute les requete sql !
use App\Manager;

class TopicManager extends Manager{
    // on déclares ces variables pour ne plus a avoir à écrire les chemins  ou le nom de la table pour le fonctionement de la fonction du manager pour exécuter les requetes 
    protected $className = "Model\Entities\Topic";
    protected $tableName = "topic";
    // le construct appel la fonction de connexion a la base de donnée SQL 
    public function __construct()
    {
        parent::connect();
        
    }
    
    // reqête pour récuper et les topics et les user qui l'on crée 
    public function findAllTopicsAndUsers($order = null){
        
        $orderQuery = ($order) ?                 
            "ORDER BY ".$order[0]. " ".$order[1] :
            "";
        $sql = "SELECT *
                FROM ".$this->tableName." a 
                ".$orderQuery;

        return $this->getMultipleResults(
            DAO::select($sql), 
            $this->className
        );
    }

    
        // fonction pour afficher les topics par catégorie
        public function findTopicByCategorie($id){

            $sql = "SELECT *
                    FROM ".$this->tableName." a
                    WHERE a.categorie_id = :id ";
                   
    
            return  $this->getMultipleResults(
                DAO::select($sql, ['id' => $id]), 
                $this->className
            );
        }
    // fonction de recherche EN COUR => MARCHE PAS !!!!!!!!!!!!!!
        public function searchTopic($data){
       
            $sql = "SELECT t.id_topic, t.title 
            FROM topic t
            WHERE t.title LIKE '%'.".$data.".'%'";
            return $this->getMultipleResults(
                DAO::select($sql), // ,["data" =>'%'.$data.'%']
                $this->className );
        }
}


