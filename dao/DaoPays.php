<?php
require_once 'classes/class.Pays.php';
require_once 'classes/class.Entreprise.php';
require_once 'classes/class.Papier.php';
require_once 'Dao.php';

class DaoPays extends Dao
{

    public function DaoPays()
    {
        parent::__construct();
        $this->bean = new Pays();
    }
    
    
    
    public function find($id = 0)
    {
        $donnees = $this->findById("pays", "ID_PAYS", $id);
        $this->bean->setId($donnees['ID_PAYS']);
        $this->bean->setNom($donnees['NOM_PAYS']);
    }
    public function create()
    {
        $sql = "INSERT INTO pays (NOM_PAYS)
            VALUES(?)";
        $requete = $this->pdo->prepare($sql);
        $requete->bindValue(1, $this->bean->getNom());
        $requete->execute();
    }
    public function delete()
    {
        $donnees = $this->deleteById("pays", "ID_PAYS", $this->bean->getId());
    }
    public function getListe()
    {
        $query = "SELECT * 
                FROM pays 
                ORDER BY NOM_PAYS";
        // Préparation et chargement de la requete
        $requete = $this->pdo->prepare($query);
        $liste = array();
        if ($requete->execute()) {
            while ($donnees = $requete->fetch()) {
                $pays = new Pays(
                    $donnees['ID_PAYS'],
                    $donnees['NOM_PAYS']
                );
                $liste[] = $pays;
            }
        }
        return $liste;
    }
    public function setLesEntreprises()
    {
        $sql = "SELECT * 
                FROM pays, entreprise   
                WHERE pays.ID_PAYS = entreprise.ID_PAYS 
                AND pays.ID_PAYS =" .$this->bean->getId();
        $requete = $this->pdo->prepare($sql);
        if($requete->execute()){
            $entreprise= new Entreprise();
            if($donnees = $requete->fetch()){
                $entreprise = new Entreprise(
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
            }
            $this->bean->setLesEntreprise($entreprise);
        }
    }
    public function setLesPapiers()
    {
        $sql = "SELECT * 
                FROM est_pour,pays, papier  
                WHERE pays.ID_PAYS = " . $this->bean->getId() . "
                AND est_pour.ID_PAYS = pays.ID_PAYS 
                AND est_pour.ID_PAPIER = papier.ID_PAPIER";
        $requete = $this->pdo->prepare($sql);
        $liste = array();
        if ($requete->execute()) {
            while ($donnees = $requete->fetch()) {
                $listePapier[] = new Papier(
                    $donnees['ID_PAPIER'],
                    $donnees['NOM_PAPIER'],
                    $donnees['DESCRIPTION'],
                    $donnees['CONSEIL'],
                    $donnees['DUREE']
                );
                $liste[] = $listePapier;
            }
        }
        $this->bean->setLesPapiers($liste);
    }
    public function findByNom($pays = null)
    {
        $sql = "SELECT * 
                FROM pays 
                WHERE pays.NOM_PAYS = '" . $pays . "'";
        $requete = $this->pdo->prepare($sql);
        if ($requete->execute()) {
            if ($donnees = $requete->fetch()) {
                $this->bean->setId($donnees['ID_PAYS']);
                $this->bean->setNom($donnees['NOM_PAYS']);
            }
        }
}