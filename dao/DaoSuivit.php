<?php
require_once 'classes/class.Suivit.php';
require_once 'classes/class.Compose.php';
require_once 'classes/class.Personne.php';

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
        $sql = "INSERT INTO suivit(NOM_ENT)
            VALUES(?)";

        $requete = $this->pdo->prepare($sql);
        $requete->bindValue(1, $this->bean->getNom());
        $requete->execute();
    }

    public function delete()
    {
        $donnees = $this->deleteById("suivit", "ID_SUIVIT", $this->bean->getId());
    }

    public function setLesPersonnes()
    {
        $sql = "SELECT * 
                FROM personne, suivit   
                WHERE suivit.ID_SUIVIT = personne.ID_SUIVIT 
                AND suivit.ID_SUIVIT =" .$this->bean->getId();
        $requete = $this->pdo->prepare($sql);
        if($requete->execute()){
            $personne= new Personne();
            if($donnees = $requete->fetch()){
                $personne = new Personne(
                    $donnees['ID_PERSONNE'],
                    $donnees['NOM'],
                    $donnees['PRENOM'],
                    $donnees['MAIL'],
                    $donnees['ADMIN'],
                    $donnees['PHOTO'],
                    $donnees['MDP']
                );
            }
            $this->bean->setLesPersonnes($personne);
        }
    }
    public function setLePays()
    {
        $sql="SELECT *
        FROM pays
        WHERE pays.ID_PAYS = suivit.ID_SUIVIT
        AND suivit.ID_SUIVIT =" . $this->bean->getId();
        $requete = $this->pdo->prepare($sql);
        if ($requete->execute()) {
            $pays = new Pays();
            if ($donnees = $requete->fetch()) {
                $pays = new Pays(
                    $donnees['ID_PAYS'],
                    $donnees['NOM_PAYS']
                );
            }
            $this->bean->setLePays($pays);
        }
    }

}