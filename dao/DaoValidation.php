<?php
require_once 'classes/class.Validation.php';

require_once 'Dao.php';

class DaoValidation extends Dao
{

    public function DaoValidation()
    {
        parent::__construct();
        $this->bean = new Validation();
    }


    public function find($id)
    {
        $donnees = $this->findById("validation", "ID_validation", $id);
        $this->bean->setId($donnees['ID_VALIDATION']);
        $this->bean->setNom($donnees['NOM']);
        $this->bean->setPrenom($donnees['PRENOM']);
        $this->bean->setMail($donnees['MAIL']);
        $this->bean->setMdp($donnees['MDP']);
    }

    public function create()
    {
        $sql = "INSERT INTO validation (NOM,PRENOM,MAIL,MDP)
            VALUES(?, ?, ?, ?)";
        $requete = $this->pdo->prepare($sql);
        $requete->bindValue(1, $this->bean->getNom());
        $requete->bindValue(2, $this->bean->getPrenom());
        $requete->bindValue(3, $this->bean->getMail());
        $requete->bindValue(4, $this->bean->getMdp());
        $requete->execute();
    }
    
    public function update()
    {
        $sql = "UPDATE validation SET NOM = ?, PRENOM = ?, MAIL = ?, MDP = ? WHERE ID_VALIDATION = ?";
        $requete = $this->pdo->prepare($sql);
        $requete->bindValue(1, $this->bean->getNom());
        $requete->bindValue(2, $this->bean->getPrenom());
        $requete->bindValue(3, $this->bean->getMail());
        $requete->bindValue(4, $this->bean->getMdp());
        $requete->execute();
    }

    public function delete()
    {
        $donnees = $this->deleteById("validation", "ID_VALIDATION", $this->bean->getId());
    }

    public function connect($mail, $mdp)
    {
        $sql = "SELECT * FROM validation WHERE MAIL = '". $mail ."' AND MDP = '". $mdp ."';";
        $requete = $this->pdo->prepare($sql);
        if ($requete->execute()) {
            while ($donnees = $requete->fetch()) {
                $this->bean->setId($donnees['ID_VALIDATION']);
                $this->bean->setNom($donnees['NOM']);
                $this->bean->setPrenom($donnees['PRENOM']);
                $this->bean->setMail($donnees['MAIL']);
                $this->bean->setAdmin($donnees['ADMIN']);
                $this->bean->setPhoto($donnees['PHOTO']);
                $this->bean->setMdp($donnees['MDP']);


            }
        }
    }

    public function getListe()
    {
        $query = "SELECT * 
                FROM validation   
                ORDER BY  ID_VALIDATION";
        // Préparation et chargement de la requete
        $requete = $this->pdo->prepare($query);
        $liste = array();
        if ($requete->execute()) {
            while ($donnees = $requete->fetch()) {
                $validation = new Validation(
                    $donnees['ID_VALIDATION'],
                    $donnees['NOM'],
                    $donnees['PRENOM'],
                    $donnees['MAIL'],
                    $donnees['MDP']
                );
                $liste[] = $validation;
            }
        }
        return $liste;
    }



}