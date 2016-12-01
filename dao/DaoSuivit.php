<?php
require_once 'classes/class.Suivit.php';
require_once 'classes/class.Compose.php';

require_once 'Dao.php';

class DaoSuivit extends Dao{

    public function DaoSuivit()
    {
        parent::__construct();
        $this->bean = new Suivit();
    }

    public function find($id)
    {
        $donnees = $this->findById("suivit", "ID_SUIVIT", $id);
        $this->bean->setId($donnees['ID_SUIVIT']);

    }

    public function create()
    {
        $sql = "INSERT INTO suivit()
            VALUES()";

        $requete = $this->pdo->prepare($sql);
        $requete->execute();
    }

    public function delete()
    {
        $donnees = $this->deleteById("suivit", "ID_SUIVIT", $this->bean->getId());
    }
    
    public function setEffectuer()
    {
        $sql = "SELECT ID_SUIVIT as EFFECTUER
                FROM compose    
                WHERE 
                 ID_SUIVIT = " . $this->bean->getId();
        $requete = $this->pdo->prepare($sql);
        $this->bean->setEffectuer(0);
        if ($requete->execute()) {
            if ($donnees = $requete->fetch()) {
                $this->bean->setEffectuer($donnees['EFFECTUER']);
            }
        }

    }

}