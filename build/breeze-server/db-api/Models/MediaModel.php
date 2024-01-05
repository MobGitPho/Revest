<?php

namespace API\Database\Models;

use API\Database\Utils\Functions;

class MediaModel extends \API\Database\Classes\DbManager
{
    public function __construct(){

        parent::__construct();

        $this->table = Functions::getTableNameFromModel($this);

    }

    public function getMediasPage($offset, $limit)
    {
        return $this->database->query("SELECT * FROM $this->table ORDER BY id DESC LIMIT $offset, $limit");
    }
}
