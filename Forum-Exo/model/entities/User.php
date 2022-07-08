<?php
namespace Model\Entities;

use App\Entity;

class User extends Entity {

    private $id;
    private $pseudo;
    private $email;
    private $password;
    private $creationDate;
    private $image;
    private $status ;
    private $role;
    

    public function __construct($data){         
        $this->hydrate($data);        
    }
        /**
         * Get the value of pseudo
         */ 
        public function getPseudo()
        {
            return $this->pseudo;
        }

        /**
         * Set the value of pseudo
         *
         * @return  self
         */ 
        public function setPseudo($pseudo)
        {
            $this->pseudo = $pseudo;

            return $this;
        }

        /**
         * Get the value of email
         */ 
        public function getEmail()
        {
            return $this->email;
        }

        /**
         * Set the value of email
         *
         * @return  self
         */ 
        public function setEmail($email)
        {
            $this->email = $email;

            return $this;
        }

        /**
         * Get the value of password
         */ 
        public function getPassword()
        {
            return $this->password;
        }

        /**
         * Set the value of password
         *
         * @return  self
         */ 
        public function setPassword($password)
        {
            $this->password = $password;

            return $this;
        }

        /**
         * Get the value of creation_date
         */ 
        public function getCreationDate()
        {
            $formattedDate = $this->creationDate->format("d/m/Y, H:i:s");
            return $formattedDate;
        }
        public function setCreationDate($date){
            $this->creationDate = new \DateTime($date);
            return $this;
        }
        
        /**
         * @return mixed
         */
        function getImage() {
            return $this->image;
        }
        
        /**
         * @param mixed $image 
         * @return User
         */
        function setImage($image): self {
            $this->image = $image;
            return $this;
        }
        /**
         * Get the value of status
         */ 
        public function getStatus()
        {
            return $this->status;
        }

        /**
         * Set the value of status
         *
         * @return  self
         */ 
        public function setStatus($status)
        {
            $this->status = $status;

            return $this;
        }

        /**
         * Get the value of role
         */ 
        public function getRole()
        {
           
                return $this->role;
            }
        

        public function afficherRole(){

          if(in_array("ROLE_ADMIN",$this->getRole())){
                return "admin";
          }else{
            return "user";
          }
        }

        /**
         * Set the value of role
         *
         * @return  self
         */ 
        public function setRole($r)
        {
            // on indique ici que l'on va récuperer du Json que nous allons récuperer
            $this->role = json_decode($r);
            // si il n'y a pas de role attitré
            if(empty($this->$r)){
                // on attribut automaitquement le role User 
                $this->role[]= "ROLE_USER";
            }

            return $this;
        }

        public function hasRole($role){
        // on retourne donc si dans le tableau Json on trouve un role qui correspond au role envoyer en paramêtre alors on return true ;
          return in_array($role,$this->getRole());
        }

            /**
         * Get the value of id
         */ 
        public function getId()
        {
            return $this->id;
        }

        /**
         * Set the value of id
         *
         * @return  self
         */ 
        public function setId($id)
        {
            $this->id = $id;

            return $this;
        }
        public function __toString()
        {
            return "ID User : ".$this->id." qui a le pseudo  : ".$this->pseudo." avec l'email suivant :".$this->email." dont le mdp est : ".$this->password." son statut est : ".$this->status." qui a un rôle de :".$this->role." crée le : ".$this->creationDate->format("d/m/Y, H:i:s"); 
        }

}







