<?php
require_once('class.Suivit.php');

class Compose extends Suivit
{
    private $effectuer = false;
    
    private $setlesPapiers = array();

    public function Compose($id=0, $effectuer)
    {
        // --- Appel du constructeur de la classe m�re ---
        // Ici la classe Casque pour lequel il faut id, nom et cout
        parent::__construct($id = 0);
        // --- On compl�te ensuite la construction de l'objet
        // --- En initialisant les attributs restants
        $this->effectuer = $effectuer;
    }

    public function getEffectuer() {return $this->effectuer;}
    public function setEffectuer($effectuer){$this->effectuer=$effectuer;}
    
    public function getSetlesPapiers(){return $this->setlesPapiers;}
    public function setSetlesPapiers($setlesPapiers){$this->setlesPapiers = $setlesPapiers;}
    

}