<?php
require_once 'classes/class.Entreprise.php';
require_once 'classes/class.Papier.php';
require_once 'classes/class.Suivit.php';
require_once 'classes/class.Personne.php';
require_once 'classes/class.OnAccueilli.php';

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

    public function create($suivi)
    {
        $sql = "INSERT INTO personne (NOM,PRENOM,MAIL,MDP,ID_SUIVIT)
            VALUES(?, ?, ?, ?, ?)";
        $requete = $this->pdo->prepare($sql);
        var_dump($suivi);
        $requete->bindValue(1, $this->bean->getNom());
        $requete->bindValue(2, $this->bean->getPrenom());
        $requete->bindValue(3, $this->bean->getMail());
        $requete->bindValue(4, $this->bean->getMdp());
        $requete->bindValue(5, 1);
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
        $sql = "SELECT * FROM personne WHERE MAIL = '" . $mail . "' AND MDP = '" . $mdp . "';";
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

    public function getListe()
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

    public function setLesEntreprisesAccueil()
    {
        {
            $sql = "SELECT * 
                FROM est_en_stage,personne, entreprise  
                WHERE personne.ID_PERSONNE = " . $this->bean->getId() . "
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

    public function setLesPapiers()
    {
        {
            $sql = "SELECT * 
                FROM consulte,personne, papier  
                WHERE personne.ID_PERSONNE = " . $this->bean->getId() . "
                AND consulte.ID_PAPIER = papier.ID_PAPIER
                AND consulte.ID_PERSONNE = personne.ID_PERSONNE";

            $requete = $this->pdo->prepare($sql);
            $liste = array();
            if ($requete->execute()) {
                while ($donnees = $requete->fetch()) {
                    $listePapiers = new Papier(
                        $donnees['ID_PAPIER'],
                        $donnees['NOM_PAPIER'],
                        $donnees['DESCRIPTION'],
                        $donnees['CONSEIL'],
                        $donnees['DUREE']
                    );
                    $liste[] = $listePapiers;
                }
            }
            $this->bean->setLesPapiers($liste);
        }

    }

    public function setLeSuivit()
    {
        $sql = "SELECT * 
                FROM suivit, personne   
                WHERE suivit.ID_SUIVIT = personne.ID_PERSONNE 
                AND personne.ID_PERSONNE =" . $this->bean->getId();
        $requete = $this->pdo->prepare($sql);
        if ($requete->execute()) {
            $suivit = new Suivit();
            if ($donnees = $requete->fetch()) {
                $suivit = new Suivit(
                    $donnees['ID_SUIVIT']
                );
            }
            $this->bean->setLeSuivit($suivit);
        }
    }

    /* public function setLesEntreprisesOnAccueilli()
    {
        {
            $sql = "SELECT * 
                FROM est_aller,personne, entreprise  
                WHERE personne.ID_PERSONNE = " . $this->bean->getId() . "
                AND est_aller.ID_ENTREPRISE = entreprise.ID_ENTREPRISE
                AND est_aller.ID_PERSONNE = personne.ID_PERSONNE";

            $requete = $this->pdo->prepare($sql);
            $liste = array();
            if ($requete->execute()) {
                while ($donnees = $requete->fetch()) {
                    $listeEntreprises = new Entreprise(
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
                        $donnees['TELEPHONE'],
                        $donnees['DESCRIPTION_AVIS']
                    );
                    $liste[] = $listeEntreprises;
                }
            }
            $this->bean->setLesEntreprisesOnAccueilli($liste);
        }

    }*/
   /*public function setLesEntreprisesOnAccueilli() {
        $sql = "SELECT * 
                FROM personne, est_aller,entreprise
                WHERE 
                    est_aller.ID_PERSONNE = " . $this->bean->getId() . " 
                    AND est_aller.ID_PERSONNE = est_aller.ID_ENTREPRISE  
            ";
        $requete = $this->pdo->prepare($sql);
        $liste = array();
        if($requete->execute()) {
            while($donnees = $requete->fetch()){
                $aller = new OnAccueilli($donnees['ID_ENTREPRISE'], $donnees['NOM_ENTREPRISE'],$donnees['VISITER'],
                    $donnees['DESCRIPTION'], $donnees['RUE'], $donnees['AVIS'],$donnees['TAILLE'],$donnees['PROFIL'],
                    $donnees['VILLE'],$donnees['CONTACT'], $donnees['LATITUDE'],$donnees['LONGITUDE'],
                    $donnees['TELEPHONE'], $donnees['DESCRIPTION_AVIS']);
                $liste[] = $aller;
            }
        }
        $this->bean->setLesEntreprisesOnAccueilli($liste);
    }*/
}