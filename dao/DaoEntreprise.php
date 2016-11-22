<?php
require_once 'classes/class.Entreprise.php';
require_once 'classes/class.Type.php';

require_once 'Dao.php';

class DaoEntreprise extends Dao
{

    public function DaoEntreprise()
    {
        parent::__construct();
        $this->bean = new Entreprise();
    }


    public function find($id = 0)
    {
        $donnees = $this->findById("entreprise", "ID_ENTREPRISE", $id);
        $this->bean->setId($donnees['ID_ENTREPRISE']);
        $this->bean->setNom($donnees['NOM_ENTREPRISE']);
        $this->bean->setVisiter($donnees['VISITER']);
        $this->bean->setDescription($donnees['DESCRIPTION']);
        $this->bean->setRue($donnees['RUE']);
        $this->bean->setDescriptionAvis($donnees['DESCRIPTION_AVIS']);
        $this->bean->setAvis($donnees['AVIS']);
        $this->bean->setTaille($donnees['TAILLE']);
        $this->bean->setProfil($donnees['PROFIL']);
        $this->bean->setPays($donnees['PAYS']);
        $this->bean->setVille($donnees['VILLE']);
    }

    public function create()
    {
        $sql = "INSERT INTO entreprise (NOM_ENTREPRISE, VISITER, DESCRIPTION, RUE, DESCRIPTION_AVIS, AVIS, TAILLE, PROFIL, PAYS, VILLE) 
          VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $requete = $this->pdo->prepare($sql);
        $requete->bindValue(1, $this->bean->getNom());
        $requete->bindValue(2, $this->bean->getVisiter());
        $requete->bindValue(3, $this->bean->getDescription());
        $requete->bindValue(4, $this->bean->getRue());
        $requete->bindValue(5, $this->bean->getDescriptionAvis());
        $requete->bindValue(6, $this->bean->getAvis());
        $requete->bindValue(7, $this->bean->getTaille());
        $requete->bindValue(8, $this->bean->getProfil());
        $requete->bindValue(9, $this->bean->getPays());
        $requete->bindValue(10, $this->bean->getVille());
        $requete->execute();
    }

    public function delete()
    {
        $donnees = $this->deleteById("entreprise", "ID_ENTREPRISE", $this->bean->getId());
    }

    public function update()
    {
        $sql = "UPDATE entreprise SET NOM_ENTREPRISE = ?, VISITER = ?, AVIS = ?, TAILLE=?, DESCRIPTION= ?, RUE= ?, DESCRIPTION_AVIS=?, PAYS=?, VILLE=?, WHERE ID_ENTREPRISE = ?";
        $requete = $this->pdo->prepare($sql);
        $requete->bindValue(1, $this->bean->getNom());
        $requete->bindValue(2, $this->bean->getVisiter());
        $requete->bindValue(3, $this->bean->getAvis());
        $requete->bindValue(4, $this->bean->getTaille());
        $requete->bindValue(5, $this->bean->getDescription());
        $requete->bindValue(6, $this->bean->getRue());
        $requete->bindValue(7, $this->bean->getDescriptionAvis());
        $requete->bindValue(8, $this->bean->getPays());
        $requete->bindValue(9, $this->bean->getVille());

        $requete->execute();
    }


    public function getListe()
    {
        $query = "SELECT * 
                FROM entreprise    
                ORDER BY  PAYS";
        // Préparation et chargement de la requete
        $requete = $this->pdo->prepare($query);
        $liste = array();
        if ($requete->execute()) {
            while ($donnees = $requete->fetch()) {
                $entreprise = new Entreprise(
                    $donnees['ID_ENTREPRISE'],
                    $donnees['NOM_ENTREPRISE'],
                    $donnees['VISITER'],
                    $donnees['DESCRIPTION'],
                    $donnees['RUE'],
                    $donnees['DESCRIPTION_AVIS'],
                    $donnees['AVIS'],
                    $donnees['TAILLE'],
                    $donnees['PROFIL'],
                    $donnees['PAYS'],
                    $donnees['VILLE']
                );
                $liste[] = $entreprise;
            }
        }
        return $liste;
    }

    public function setLesTypes()
    {
        $sql = "SELECT * FROM `est_de_type` WHERE `ID_TYPE` = 1 
AND `ID_ENTREPRISE` = " . $this->bean->getId();
        $requete = $this->pdo->prepare($sql);
        if ($requete->execute()) {
            $type = new Type();
            if ($donnees = $requete->fetch()) {
                $type = new Type(
                    $donnees['ID_TYPE'],
                    $donnees['TYPE']
                );
            }
            $this->bean->setLesTypes($type);
        }
    }
}