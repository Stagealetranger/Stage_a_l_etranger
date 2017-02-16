<?php
require_once 'classes/class.Suivit.php';
require_once 'classes/class.Compose.php';
require_once 'classes/class.Papier.php';
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
        $this->bean->setNom($donnees['NOM_ENT']);
        $this->bean->setLePays($donnees['ID_PAYS']);

    }

    public function findNom($nom)
    {
        $donnees = $this->findById("suivit", "NOM_ENT", $nom);
        $this->bean->setId($donnees['ID_SUIVIT']);
    }

    public function create($nom)
    {
        $sql = "INSERT INTO suivit(NOM_ENT)
            VALUES(?)";
        $requete = $this->pdo->prepare($sql);
        $requete->bindValue(1,$nom);
        $requete->execute();
    }

    public function updateNom($id)
    {
        $sql = "UPDATE `suivit` SET `NOM_ENT` = '' WHERE `suivit`.`ID_SUIVIT` = '".$id."';";
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

    public function setCompose()
    {
        $sql = "SELECT compose.*, papier.* 
                    FROM compose, papier 
                    WHERE 
                    compose.ID_SUIVIT = " . $this->bean->getId() . "
                    AND compose.ID_PAPIER = papier.ID_PAPIER 
                    ORDER BY NOM_PAPIER";
        $requete = $this->pdo->prepare($sql);
        $listePapier = array();
        if ($requete->execute()) {
            while ($donnees = $requete->fetch()) {
                $Compose = new Compose(
                    $donnees['ID_PAPIER'], $donnees['NOM_PAPIER'], $donnees['DESCRIPTION'], $donnees['CONSEIL'], $donnees['DUREE'], $donnees['EFFECTUER'], $donnees['DATE_VALID']
                );
                $listePapier[] = $Compose;
            }
        }
        $this->bean->setLesPapiers($listePapier);
    }


    public function getlisteByPays()
    {
        $sql = "SELECT DISTINCT papier.* 
                FROM suivit,papier,est_pour  
                WHERE est_pour.ID_PAYS = suivit.ID_PAYS
                AND papier.ID_PAPIER = est_pour.ID_PAPIER
                AND suivit.ID_PAYS = " .$this->bean->getLePays();
        $requete = $this->pdo->prepare($sql);
        $liste = array();
        if ($requete->execute()) {
            while ($donnees = $requete->fetch()) {
                $Papier = new Papier(
                    $donnees['ID_PAPIER'],
                    $donnees['NOM_PAPIER'],
                    $donnees['DESCRIPTION'],
                    $donnees['CONSEIL'],
                    $donnees['DUREE']
                );
                $liste[] = $Papier;
            }
        }
       return $liste;
    }

    public function addCompose($papier,$date)
    {
        $sql = "INSERT INTO compose (ID_PAPIER,ID_SUIVIT,DATE_VALID,EFFECTUER) 
                VALUES (?,?,?,?)";
        var_dump($papier);
        var_dump($this->bean->getId());
        var_dump($date);
        $requete = $this->pdo->prepare($sql);
        $requete->bindValue(1, $papier);
        $requete->bindValue(2, $this->bean->getId());
        $requete->bindValue(3, $date);
        $requete->bindValue(4, 0);
        $requete->execute();
    }

    public function getlisteCompose()
    {
        $sql = "SELECT DISTINCT papier.* 
                FROM compose,papier  
                WHERE compose.ID_PAPIER = papier.ID_PAPIER
                AND compose.ID_SUIVIT = " .$this->bean->getId();

        $requete = $this->pdo->prepare($sql);
        $liste = array();
        if ($requete->execute()) {
            while ($donnees = $requete->fetch()) {
                $Compose = new Compose(
                    $donnees['ID_PAPIER'], $donnees['NOM_PAPIER'], $donnees['DESCRIPTION'], $donnees['CONSEIL'], $donnees['DUREE']
                );
                $liste[] = $Compose;
            }
        }
       return $liste;
    }
}