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

    public function delete(){
        // Recherche des compos
        $sql = "SELECT * FROM est_pour WHERE ID_PAYS = ?";
        $requete = $this->pdo->prepare($sql);
        $requete->bindValue(1, $this->bean->getId());
        $liste = array();
        if($requete->execute()){
            while($donnees = $requete->fetch()){
                $liste[] = $donnees['ID_PAPIER'];
            }
        }
        // Suppression des liens COMPOSE
        for($i=0;$i<count($liste);$i++){
            $sql = "DELETE FROM est_pour
                    WHERE ID_PAPIER = ?";
            $requete = $this->pdo->prepare($sql);
            $requete->bindValue(1, $liste[$i]);
            $requete->execute();

        }

        // Recherche des ent
        $sql = "SELECT * FROM entreprise WHERE ID_PAYS = ?";
        $requete = $this->pdo->prepare($sql);
        $requete->bindValue(1, $this->bean->getId());
        $liste = array();
        if($requete->execute()){
            while($donnees = $requete->fetch()){
                $liste[] = $donnees['ID_ENTREPRISE'];
            }
        }
        // Suppression des liens pays
        for($i=0;$i<count($liste);$i++){
            $sql = "DELETE FROM entreprise
                    WHERE ID_ENTREPRISE  = ?";
            $requete = $this->pdo->prepare($sql);
            $requete->bindValue(1, $liste[$i]);
            $requete->execute();


            $this->deleteById("entreprise", "ID_ENTREPRISE", $liste[$i]);
        }

        // Suppression du pays 
        $this->deleteById("pays", "ID_PAYS", $this->bean->getId());
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
                AND pays.ID_PAYS =" . $this->bean->getId();
        $requete = $this->pdo->prepare($sql);
        if ($requete->execute()) {
            $entreprise = new Entreprise();
            if ($donnees = $requete->fetch()) {
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

    public function getListePays($id)
    {
        $query = "SELECT * 
                FROM est_pour 
                WHERE ID_PAYS = '" . $id. "'
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
    
    public function update()
    {
        $sql = "UPDATE pays SET NOM_PAYS = ? WHERE ID_PAYS = ?";
        $requete = $this->pdo->prepare($sql);
        $requete->bindValue(1, $this->bean->getNom());
        $requete->bindValue(2, $this->bean->getId());
        $requete->execute();
    }
}