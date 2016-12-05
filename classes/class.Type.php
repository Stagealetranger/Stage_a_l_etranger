<?php

require_once('class.Entreprise.php');

class Type
{
    // --- ASSOCIATIONS ---
    // generateAssociationEnd : lesEntreprises

    // --- ATTRIBUTES ---

    private $id = 0;
    private $type = null;
    private $lesEntreprises = array();

    public function __construct( $id=0, $type=null)
    {
        $this->id = $id;
        $this->type = $type;

    }

    
    public function getId(){return $this->id;}
    public function setId($id){$this->id = $id;}
    public function getType(){return $this->type;}
    public function setType($type){$this->type = $type;}
    public function getLesEntreprises(){return $this->lesEntreprises;}
    public function setLesEntreprises($lesEntreprises){$this->lesEntreprises = $lesEntreprises;}
    
    
    
   
    

}

?>