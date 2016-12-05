<?php
require_once 'classes/class.Entreprise.php';
require_once 'classes/class.Papier.php';
require_once 'classes/class.Suivit.php';
require_once 'classes/class.Personne.php';

require_once 'Dao.php';

class DaoPersonne extends Dao
{

    public function DaoPersonne()
    {
        parent::__construct();
        $this->bean = new Personne();
    }


    public function find($id)
    {
        $donnees = $this->findById("personne", "ID_PERSONNE", $id);
        $this->bean->setId($donnees['ID_PERSONNE']);
        $this->bean->setNom($donnees['NOM']);
        $this->bean->setPrenom($donnees['PRENOM']);
        $this->bean->setMail($donnees['MAIL']);
        $this->bean->setPhoto($donnees['PHOTO']);
        $this->bean->setMdp($donnees['MDP']);
    }

    public function create()
    {
        $sql = "INSERT INTO personne (NOM,PRENOM,MAIL,MDP)
            VALUES(?, ?, ?, ?)";
        $requete = $this->pdo->prepare($sql);
        $requete->bindValue(1, $this->bean->getNom());
        $requete->bindValue(2, $this->bean->getPrenom());
        $requete->bindValue(3, $this->bean->getMail());
        $requete->bindValue(4, $this->bean->getMdp());
        $requete->execute();
    }

    public function delete()
    {
        $donnees = $this->deleteById("personne", "ID_PERSONNE", $this->bean->getId());
    }

    public function update()
    {
        $sql = "UPDATE personne SET NOM = ?, PRENOM = ?, MAIL = ?, PHOTO =?, MDP = ? WHERE ID_PERSONNE = ?";
        $requete = $this->pdo->prepare($sql);
        $requete->bindValue(1, $this->bean->getNom());
        $requete->bindValue(2, $this->bean->getId());
        $requete->bindValue(3, $this->bean->getPrenom());
        $requete->bindValue(4, $this->bean->getMail());
        $requete->bindValue(5, $this->bean->getPhoto());
        $requete->bindValue(6, $this->bean->getMdp());
        $requete->execute();
    }


    public function connect($mail, $mdp)
    {
        $sql = "SELECT * FROM personne WHERE MAIL = '". $mail ."' AND MDP = '". $mdp ."';";
        $requete = $this->pdo->prepare($sql);
        if ($requete->execute()) {
            while ($donnees = $requete->fetch()) {
                $this->bean->setId($donnees['ID_PERSONNE']);
                $this->bean->setNom($donnees['NOM']);
                $this->bean->setPrenom($donnees['PRENOM']);
                $this->bean->setMail($donnees['MAIL']);
                $this->bean->setAdmin($donnees['ADMIN']);
                $this->bean->setPhoto($donnees['PHOTO']);
                $this->bean->setMdp($donnees['MDP']);
                $this->bean->setLeSuivit($donnees['ID_SUIVIT']);


            }
        }
    }
    public function getListePersonne()
    {
        $query = "SELECT * 
                FROM personne   
                ORDER BY  ID_PERSONNE";
        // Préparation et chargement de la requete
        $requete = $this->pdo->prepare($query);
        $liste = array();
        if ($requete->execute()) {
            while ($donnees = $requete->fetch()) {
                $personne = new Personne(
                    $donnees['ID_PERSONNE'],
                    $donnees['NOM'],
                    $donnees['PRENOM'],
                    $donnees['MAIL'],
                    $donnees['PHOTO'],
                    $donnees['MDP']
                );
                $liste[] = $personne;
            }
        }
        return $liste;
    }


    public function setLesEntreprisesAccueil(){
        {
            $sql = "SELECT * 
                FROM est_en_stage,personne, entreprise  
                WHERE personne.ID_PERSONNE = ".$this->bean->getId()."
                AND est_en_stage.ID_ENTREPRISE = entreprise.ID_ENTREPRISE
                AND est_en_stage.ID_PERSONNE = personne.ID_PERSONNE";

            $requete = $this->pdo->prepare($sql);
            $liste = array();
            if ($requete->execute()) {
                while ($donnees = $requete->fetch()) {
                    $listeEntreprise = new Entreprise(
                        $donnees['ID_ENTREPRISE'],
                        $donnees['NOM_ENTREPRISE'],
                        $donnees['VISITER'],
                        $donnees['DESCRIPTION'],
                        $donnees['RUE'],
                        $donnees['AVIS'],
                        $donnees['TAILLE'],
                        $donnees['PROFIL'],
                        $donnees['VILLE'],
                        $donnees['CONTACT'],
                        $donnees['LATITUDE'],
                        $donnees['LONGITUDE'],
                        $donnees['TELEPHONE']
                    );
                    $liste[] = $listeEntreprise;
                }
            }
            $this->bean->setLesEntreprisesAccueil($liste);
        }

    }
}