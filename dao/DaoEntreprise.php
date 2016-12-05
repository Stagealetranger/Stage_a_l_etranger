<?php
require_once 'classes/class.Entreprise.php';
require_once 'classes/class.Pays.php';
require_once 'classes/class.Type.php';
require_once 'classes/class.Pays.php';
require_once 'classes/class.OnAccueilli.php';

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
        $this->bean->setAvis($donnees['AVIS']);
        $this->bean->setTaille($donnees['TAILLE']);
        $this->bean->setProfil($donnees['PROFIL']);
        $this->bean->setLatitude($donnees['LATITUDE']);
        $this->bean->setLongitude($donnees['LONGITUDE']);
        $this->bean->setVille($donnees['VILLE']);
        $this->bean->setContact($donnees['CONTACT']);
        $this->bean->setTelephone($donnees['TELEPHONE']);

    }

    public function findByVille($ville = '')
    {
        $donnees = $this->findByVille("entreprise", "VILLE", $ville);
        $this->bean->setId($donnees['ID_ENTREPRISE']);
        $this->bean->setNom($donnees['NOM_ENTREPRISE']);
        $this->bean->setVisiter($donnees['VISITER']);
        $this->bean->setDescription($donnees['DESCRIPTION']);
        $this->bean->setRue($donnees['RUE']);
        $this->bean->setAvis($donnees['AVIS']);
        $this->bean->setTaille($donnees['TAILLE']);
        $this->bean->setProfil($donnees['PROFIL']);
        $this->bean->setVille($donnees['VILLE']);
    }


    public function create()
    {
        $sql = "INSERT INTO entreprise (NOM_ENTREPRISE, VISITER, DESCRIPTION, RUE, AVIS, TAILLE, PROFIL, VILLE) 
          VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $requete = $this->pdo->prepare($sql);
        $requete->bindValue(1, $this->bean->getNom());
        $requete->bindValue(2, $this->bean->getVisiter());
        $requete->bindValue(3, $this->bean->getDescription());
        $requete->bindValue(4, $this->bean->getRue());
        $requete->bindValue(5, $this->bean->getAvis());
        $requete->bindValue(6, $this->bean->getTaille());
        $requete->bindValue(7, $this->bean->getProfil());
        $requete->bindValue(8, $this->bean->getVille());
        $requete->execute();
    }

    public function delete()
    {
        $donnees = $this->deleteById("entreprise", "ID_ENTREPRISE", $this->bean->getId());
    }


    public function update()
    {
        $sql = "UPDATE entreprise SET NOM_ENTREPRISE = ?, VISITER = ?, DESCRIPTION= ?,RUE= ?,  AVIS = ?, TAILLE=?, PROFIL=?,VILLE=?, WHERE ID_ENTREPRISE = ?";
        $requete = $this->pdo->prepare($sql);
        $requete->bindValue(1, $this->bean->getNom());
        $requete->bindValue(2, $this->bean->getVisiter());
        $requete->bindValue(3, $this->bean->getDescription());
        $requete->bindValue(4, $this->bean->getRue());
        $requete->bindValue(5, $this->bean->getAvis());
        $requete->bindValue(6, $this->bean->getTaille());
        $requete->bindValue(7, $this->bean->getProfil());
        $requete->bindValue(8, $this->bean->getVille());
        $requete->execute();

        $requete->execute();
    }


    public function getListe()
    {
        $query = "SELECT * 
                FROM entreprise    
                ORDER BY VILLE";
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
                    $donnees['AVIS'],
                    $donnees['TAILLE'],
                    $donnees['PROFIL'],
                    $donnees['CONTACT'],
                    $donnees['LONGITUDE'],
                    $donnees['LATITUDE'],
                    $donnees['TELEPHONE'],
                    $donnees['VILLE']
                );
                $liste[] = $entreprise;
            }
        }
        return $liste;
    }




    public function setLesPersonnesVont()
    {
        $sql = "SELECT * 
                FROM est_en_stage,personne, entreprise  
                WHERE entreprise.ID_ENTREPRISE = ".$this->bean->getId()."
                AND est_en_stage.ID_ENTREPRISE = entreprise.ID_ENTREPRISE
                AND est_en_stage.ID_PERSONNE = personne.ID_PERSONNE";
        $requete = $this->pdo->prepare($sql);
        $liste = array();
        if ($requete->execute()) {
            while ($donnees = $requete->fetch()) {
                $listePersonne = new Personne(
                    $donnees['ID_PERSONNE'],
                    $donnees['NOM'],
                    $donnees['PRENOM'],
                    $donnees['MAIL']
                );
                $liste[] = $listePersonne;
            }
        }
        $this->bean->setLesPersonnesVont($liste);
    }


    public function setLePays()
    {
        $sql = "SELECT * 
                FROM pays, entreprise   
                WHERE pays.ID_PAYS = entreprise.ID_PAYS 
                AND entreprise.ID_ENTREPRISE =" .$this->bean->getId();
        $requete = $this->pdo->prepare($sql);
        if($requete->execute()){
            $pays = new Pays();
            if($donnees = $requete->fetch()){
                $pays = new Pays(
                    $donnees['ID_PAYS'],
                    $donnees['NOM_PAYS']
                );
            }
            $this->bean->setLePays($pays);
        }
    }


    public function setLesTypes()
    {
        $sql = "SELECT * 
                FROM est_de_type,typeentreprise, entreprise  
                WHERE entreprise.ID_ENTREPRISE = ".$this->bean->getId()."
                AND est_de_type.ID_ENTREPRISE = entreprise.ID_ENTREPRISE
                AND est_de_type.ID_TYPE = typeentreprise.ID_TYPE";
        $requete = $this->pdo->prepare($sql);
        $liste = array();
        if ($requete->execute()) {
            while ($donnees = $requete->fetch()) {
                $listeType[] = new Type(
                    $donnees['ID_TYPE'],
                    $donnees['TYPE']
                );
                $liste[] = $listeType;
            }
        }
        $this->bean->setLesTypes($liste);
    }
}