<?php
namespace Model\Entities;

use App\Entity;

class Categorie extends Entity {
    private $id;
    private $title;

    public function __construct($data){         
        $this->hydrate($data);        
    }
	/**
	 * @return mixed
	 */
	function getId() {
		return $this->id;
	}
	
	/**
	 * @param mixed $id 
	 * @return Categorie
	 */
	function setId($id): self {
		$this->id = $id;
		return $this;
	}
	/**
	 * @return mixed
	 */
	function getTitle() {
		return $this->title;
	}
	
	/**
	 * @param mixed $title 
	 * @return Categorie
	 */
	function setTitle($title): self {
		$this->title = $title;
		return $this;
	}
	public function __toString()
	{
		return "catégorie : ".$this->title;   
	}
}