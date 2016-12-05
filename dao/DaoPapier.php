<?php
require_once 'classes/class.Papier.php';

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

    public function update(){
        $sql = "UPDATE papier SET NOM_PAPIER = ?, DESCRIPTION = ?, CONSEIL = ?, DUREE=?, PAYS = ? WHERE ID_PAPIER = ?";
        $requete = $this->pdo->prepare($sql);
        $requete->bindValue(1, $this->bean->getNom());
        $requete->bindValue(2, $this->bean->getId());
        $requete->bindValue(3, $this->bean->getDescription());
        $requete->bindValue(4, $this->bean->getConseil());
        $requete->bindValue(5, $this->bean->getDuree());
        $requete->execute();
    }


    public function getListe()
    {
        $query = "SELECT * 
                FROM papier    
                ORDER BY  PAYS";
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






}