<?php
require_once 'classes/class.Papier.php';
require_once 'classes/class.Pays.php';
require_once 'classes/class.Personne.php';

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
        $sql = "INSERT INTO papier (NOM_PAPIER,DESCRIPTION,CONSEIL,DUREE)
            VALUES(?, ?, ?, ?)";
        $requete = $this->pdo->prepare($sql);
        $requete->bindValue(1, $this->bean->getNom());
        $requete->bindValue(2, $this->bean->getDescription());
        $requete->bindValue(3, $this->bean->getConseil());
        $requete->bindValue(4, $this->bean->getDuree());
        $requete->execute();
    }

    public function delete()
    {
        $donnees = $this->deleteById("papier", "ID_PAPIER", $this->bean->getId());
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
   
}