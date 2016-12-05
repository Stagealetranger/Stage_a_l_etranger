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
}




