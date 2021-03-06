<?php
require_once 'classes/class.Papier.php';
require_once 'classes/class.Pays.php';
require_once 'classes/class.Personne.php';
require_once 'classes/class.Compose.php';

require_once 'Dao.php';

class DaoPapier extends Dao
{

    public function DaoPapier()
    {
        parent::__construct();
        $this->bean = new Papier();
    }


    public function find($id = 0)
    {
        $donnees = $this->findById("papier", "ID_PAPIER", $id);
        $this->bean->setId($donnees['ID_PAPIER']);
        $this->bean->setNom($donnees['NOM_PAPIER']);
        $this->bean->setDescription($donnees['DESCRIPTION']);
        $this->bean->setConseil($donnees['CONSEIL']);
        $this->bean->setDuree($donnees['DUREE']);
    }

    public function findByNomPap($nom)
    {
        $sql = "SELECT * 
                FROM papier    
                WHERE NOM_PAPIER = '" . $nom . "'
                ORDER BY NOM_PAPIER";
        $requete = $this->pdo->prepare($sql);
        if ($requete->execute()) {
            while ($donnees = $requete->fetch()) {
                $this->bean->setId($donnees['ID_PAPIER']);
                $this->bean->setNom($donnees['NOM_PAPIER']);
                $this->bean->setDescription($donnees['DESCRIPTION']);
                $this->bean->setConseil($donnees['CONSEIL']);
                $this->bean->setDuree($donnees['DUREE']);
            }
        }
    }

    public function create()
    {
        $sql = "INSERT INTO papier (NOM_PAPIER,DESCRIPTION,DUREE)
            VALUES(?, ?, ?)";
        $requete = $this->pdo->prepare($sql);
        $requete->bindValue(1, $this->bean->getNom());
        $requete->bindValue(2, $this->bean->getDescription());
        $requete->bindValue(3, $this->bean->getDuree());
        $requete->execute();
    }

    public function delete(){
        // Recherche des compos
        $sql = "SELECT * FROM compose WHERE ID_PAPIER = ?";
        $requete = $this->pdo->prepare($sql);
        $requete->bindValue(1, $this->bean->getId());
        $liste = array();
        if($requete->execute()){
            while($donnees = $requete->fetch()){
                $liste[] = $donnees['ID_SUIVIT'];
            }
        }
        // Suppression des liens COMPOSE
        for($i=0;$i<count($liste);$i++){
            $sql = "DELETE FROM compose
                    WHERE ID_SUIVIT = ?";
            $requete = $this->pdo->prepare($sql);
            $requete->bindValue(1, $liste[$i]);
            $requete->execute();

        }

        // Recherche des pays
        $sql = "SELECT * FROM est_pour WHERE ID_PAPIER = ?";
        $requete = $this->pdo->prepare($sql);
        $requete->bindValue(1, $this->bean->getId());
        $liste = array();
        if($requete->execute()){
            while($donnees = $requete->fetch()){
                $liste[] = $donnees['ID_PAYS'];
            }
        }
        // Suppression des liens pays
        for($i=0;$i<count($liste);$i++){
            $sql = "DELETE FROM est_pour 
                    WHERE ID_PAYS  = ?";
            $requete = $this->pdo->prepare($sql);
            $requete->bindValue(1, $liste[$i]);
            $requete->execute();


            $this->deleteById("pays", "ID_PAYS", $liste[$i]);
        }

        // Suppression du papier
        $this->deleteById("papier", "ID_PAPIER", $this->bean->getId());
    }

    public function update()
    {
        $sql = "UPDATE papier SET NOM_PAPIER = ?, DESCRIPTION = ?, DUREE=?  WHERE ID_PAPIER = ?";
        $requete = $this->pdo->prepare($sql);
        $requete->bindValue(1, $this->bean->getNom());
        $requete->bindValue(2, $this->bean->getDescription());
        $requete->bindValue(3, $this->bean->getDuree());
        $requete->bindValue(4, $this->bean->getId());
        $requete->execute();
    }
    public function updatePays()
    {
        $sql = "UPDATE est_pour SET ID_PAYS  WHERE ID_PAPIER = ?";
        $requete = $this->pdo->prepare($sql);
        $requete->bindValue(1, $this->bean->getId());
        $requete->bindValue(4, $this->bean->getId());
        $requete->execute();
    }

    public function getListe()
    {
        $query = "SELECT * 
                FROM papier    
                ORDER BY ID_PAPIER";
        // Préparation et chargement de la requete
        $requete = $this->pdo->prepare($query);
        $liste = array();
        if ($requete->execute()) {
            while ($donnees = $requete->fetch()) {
                $papier = new Papier(
                    $donnees['ID_PAPIER'],
                    $donnees['NOM_PAPIER'],
                    $donnees['DESCRIPTION'],
                    $donnees['CONSEIL'],
                    $donnees['DUREE']
                );
                $liste[] = $papier;
            }
        }
        return $liste;
    }

    public function setLesPays()
    {
        $sql = "SELECT * 
                FROM est_pour,pays, papier  
                WHERE papier.ID_PAPIER = " . $this->bean->getId() . "
                AND est_pour.ID_PAYS = pays.ID_PAYS 
                AND est_pour.ID_PAPIER = papier.ID_PAPIER";
        $requete = $this->pdo->prepare($sql);
        $liste = array();
        if ($requete->execute()) {
            while ($donnees = $requete->fetch()) {
                $listePays = new Pays(
                    $donnees['ID_PAYS'],
                    $donnees['NOM_PAYS']
                );
                $liste[] = $listePays;
            }
        }
        $this->bean->setLesPays($liste);
    }
    public function addPays2($listePays){
        $sql = "INSERT INTO est_pour(ID_PAPIER, ID_PAYS) VALUES(?, ?)";
        $requete = $this->pdo->prepare($sql);
        $requete->bindValue(1, $this->bean->getId());
        $requete->bindValue(2, $listePays->getId());

        $requete->execute();
    }
    public function delPays($listePays){
        $sql = "DELETE FROM est_pour WHERE ID_PAPIER = ? AND ID_PAYS = ?";
        $requete = $this->pdo->prepare($sql);
        $requete->bindValue(1, $this->bean->getId());
        $requete->bindValue(2, $listePays->getId());

        $requete->execute();
    }

    public function setLesPersonnes()
    {
        {
            $sql = "SELECT * 
                FROM consulte,personne, papier  
                WHERE papier.ID_PAPIER = " . $this->bean->getId() . "
                AND consulte.ID_PAPIER = papier.ID_PAPIER
                AND consulte.ID_PERSONNE = personne.ID_PERSONNE";

            $requete = $this->pdo->prepare($sql);
            $liste = array();
            if ($requete->execute()) {
                while ($donnees = $requete->fetch()) {
                    $listePersonne = new Personne(
                        $donnees['ID_PERSONNE'],
                        $donnees['NOM'],
                        $donnees['PRENOM'],
                        $donnees['MAIL'],
                        $donnees['ADMIN'],
                        $donnees['PHOTO'],
                        $donnees['MDP']
                    );
                    $liste[] = $listePersonne;
                }
            }
            $this->bean->setLesPersonnes($liste);
        }

    }

    public function addPays($pays = 0, $papier = 0)
    {
        $sql = "INSERT INTO est_pour (ID_PAPIER,ID_PAYS) 
                VALUES (?,?)";

        $requete = $this->pdo->prepare($sql);
        $requete->bindValue(1, $papier);
        $requete->bindValue(2, $pays);
        $requete->execute();
    }

    public function addCompose($suivit)
    {
        $sql = "INSERT INTO compose (ID_PAPIER,ID_SUIVIT) 
                VALUES (?,?)";
        $requete = $this->pdo->prepare($sql);
        $requete->bindValue(1, $this->bean->getId());
        $requete->bindValue(2, $suivit);
        $requete->execute();
    }

    public function setLesSuivits()
    {
        $sql = "SELECT DISTINCT papier.* 
                FROM compose,papier  
                WHERE compose.ID_PAPIER = papier.ID_PAPIER
                AND compose.ID_PAPIER = " .$this->bean->getId();

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
        $this->bean->setLesSuivits($liste);
    }
}