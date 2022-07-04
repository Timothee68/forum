<?php

namespace Model\Managers;

//on utilise dao pour ce connecter a la base de donnée
use App\DAO;
//on utilise App/manager ca c'est lui qui execute toute les requete sql !
use App\Manager;

class UserManager extends Manager{
    // on déclares ces variables pour ne plus a avoir à écrire les chemins  ou le nom de la table pour le fonctionement de la fonction du manager pour exécuter les requetes 
    protected $className = "Model\Entities\User";
    protected $tableName = "User";
    public function __construct()
    {
        parent::connect();
        
    }
    
    // fonction pour vérifier si l'email est déja existant 
    public function findOneByEmail($email){

        $sql = "SELECT *
                FROM ".$this->tableName." a
                WHERE a.email = :email";

        return $this->getOneOrNullResult(
            DAO::select($sql, ['email' => $email], false), 
            $this->className
        );
    }
    
    // fonction pour vérifier si le pseudo est déja existant 
    public function findOneByUser($pseudo){

        $sql = "SELECT *
                FROM ".$this->tableName." a
                WHERE a.pseudo = :pseudo ";

        return $this->getOneOrNullResult(
            DAO::select($sql, ['pseudo' => $pseudo], false), 
            $this->className
        );
    }

    // fonction pour retrouver le mot de passe par l'email 
    public function retrievePassword($email){

        $sql = "SELECT *
        FROM ".$this->tableName." a
        WHERE a.email = :email";

        return $this->getOneOrNullResult(
            DAO::select($sql, ['email' => $email], false), 
            $this->className
        );
    }

    // fonction de recherche EN COUR => MARCHE PAS !!!!!!!!!!!!!!
  
    public function searchUser($data){
           
                $sql ="SELECT u.id_user, u.pseudo 
                FROM  user u 
                WHERE  u.pseudo LIKE '%".$data."%'";
                return $this->getMultipleResults(
                    DAO::select($sql,["pseudo" =>'%'.$data.'%']), 
                    $this->className );
    }

  
}