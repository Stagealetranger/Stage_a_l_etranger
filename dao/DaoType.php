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

    
}




