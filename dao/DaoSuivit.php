<?php
require_once 'classes/class.Suivit.php';

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
        $this->bean->setEffectuer($donnees['EFFECTUER']);

    }

    public function create()
    {
        $sql = "INSERT INTO suivit(EFFECTUER)
            VALUES(?)";

        $requete = $this->pdo->prepare($sql);

        $requete->bindValue(1, $this->bean->getEffectuer());

        $requete->execute();
    }

    public function delete()
    {
        $donnees = $this->deleteById("suivit", "ID_SUIVIT", $this->bean->getId());
    }

    public function update(){
        $sql = "UPDATE suivit SET EFFECTUER = ? WHERE ID_SUIVIT = ?";
        $requete = $this->pdo->prepare($sql);
        $requete->bindValue(1, $this->bean->getEffectuer());
        $requete->bindValue(2, $this->bean->getId());
        $requete->execute();
    }



}