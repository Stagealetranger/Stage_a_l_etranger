<?php
require_once 'classes/class.Type.php';

require_once 'Dao.php';

class DaoType extends Dao
{

    public function DaoType()
    {
        parent::__construct();
        $this->bean = new Type();
    }

    public function find($id = 0)
    {
        $donnees = $this->findById("typeentreprise", "ID_TYPE", $id);
        $this->bean->setId($donnees['ID_TYPE']);
        $this->bean->setType($donnees['TYPE']);
    }
    public function delete()
    {
        $donnees = $this->deleteById("type", "ID_TYPE", $this->bean->getId());
    }
    public function getListe()
    {
        $query = "SELECT * 
                FROM typeentreprise ";
        // Préparation et chargement de la requete
        $requete = $this->pdo->prepare($query);
        $liste = array();
        if ($requete->execute()) {
            while ($donnees = $requete->fetch()) {
                $type = new Type(
                    $donnees['ID_TYPE'],
                    $donnees['TYPE']
                );
                $liste[] = $type;
            }
        }
        return $liste;
    }

    public function setLesEntreprises()
    {
        $sql = "SELECT * 
                FROM est_de_type,typeentreprise, entreprise  
                WHERE typeentreprise.ID_TYPE = " . $this->bean->getId() . "
                AND est_de_type.ID_ENTREPRISE = entreprise.ID_ENTREPRISE
                AND est_de_type.ID_TYPE = typeentreprise.ID_TYPE";
        $requete = $this->pdo->prepare($sql);
        $liste = array();
        if ($requete->execute()) {
            while ($donnees = $requete->fetch()) {
                $listeEntreprise[] = new Entreprise(
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
        $this->bean->setLesEntreprises($liste);
    }


    public function addEntreprise($entreprise)
    {
        $sql = "INSERT INTO est_de_type (ID_TYPE,ID_ENTREPRISE) 
                VALUES (?,?)";

        $requete = $this->pdo->prepare($sql);
        $requete->bindValue(2, $entreprise->getId());
        $requete->bindValue(1, $this->bean->getId());
        $requete->execute();
    }

}




