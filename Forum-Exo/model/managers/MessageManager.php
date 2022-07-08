<?php

namespace Model\Managers;

use App\DAO;
use App\Manager;

class MessageManager extends Manager{
    protected $className = "Model\Entities\Message";
    protected $tableName ="message";
    public function __construct()
    {
        parent::connect();
        
    }
    
    // fonction pour récuperer les messages pour un topic 
    public function findMessagesByTopic($id){

        $sql = "SELECT *
                FROM ".$this->tableName." a
                WHERE a.topic_id = :id ";
               

        return  $this->getMultipleResults(
            DAO::select($sql, ['id' => $id]), 
            $this->className
        );
    }
    
        //fonction pour récupérer les message d'un utilisateur
        public function MessageByUser($id){
            $sql = "SELECT *
                    FROM ".$this->tableName." a
                    WHERE a.user_id = :id ";
        

            return  $this->getMultipleResults(
                DAO::select($sql, ['id' => $id]), 
                $this->className
            );
        }
        
        // fonction pour afficher le nombre de message par topic
        public function findNbMessagesByTopic($id){

            $sql = "SELECT COUNT(a.text) as nb
                    FROM ".$this->tableName." a
                    WHERE topic_id = :id
                    ORDER BY  topic_id ";
                   
                    
            return $this->getSingleScalarResult(
                DAO::select($sql,["id" => $id])
                
            );
        }

            // fonction de recherche EN COUR => MARCHE PAS !!!!!!!!!!!!!!
    public function searchMessage($data){

        $sql ="SELECT m.id_message, m.text
        FROM  message m 
        WHERE m.text  LIKE '%'.".$data.".'%'";
        return $this->getMultipleResults(
            DAO::select($sql), //,["data" =>'%'.$data.'%']
            $this->className );
}
}
