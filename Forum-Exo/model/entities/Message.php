<?php
namespace Model\Entities;

use App\Entity;

class Message extends Entity {
// se sont les mêmes noms des différents colonnes dans la table Message obligatoirement avec les clefs étrangères et tout les getteur et setteur 
    private $id;
    private $text;
    private $creationMessage;
    private $user;
    private $topic;


        public function __construct($data)
        {
            $this->hydrate($data);
        }

        /**
         * Get the value of content
         */ 
        public function getText()
        {
            return $this->text;
        }

        /**
         * Set the value of content
         *
         * @return  self
         */ 
        public function setText($text)
        {
            $this->text = $text;

            return $this;
        }

        /**
         * Get the value of creation_message
         */ 
        public function getCreationMessage(){
            $formattedDate = $this->creationMessage->format("d/m/Y, H:i:s");
            return $formattedDate;
        }

        public function setCreationMessage($date){
            $this->creationMessage = new \DateTime($date);
            return $this;
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
        
        // public function __toString()
        // {
        //     echo "Le contenu du message contient".$this->content."datant du ".$this->creationMessage->format('%d-%m-%Y, %H:%M:%s');
        // }

    /**
     * Get the value of user
     */ 
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set the value of user
     *
     * @return  self
     */ 
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get the value of topic
     */ 
    public function getTopic()
    {
        return $this->topic;
    }

    /**
     * Set the value of topic
     *
     * @return  self
     */ 
    public function setTopic($topic)
    {
        $this->topic = $topic;

        return $this;
    }
    public function __toString()
	{
    	return "id : ".$this->id." text etant :".$this->text." ".$this->user." ".$this->topic;   
	}
}