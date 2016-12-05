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
}