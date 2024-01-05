<?php

namespace API\Database\Models;

use API\Database\Utils\Functions;

class NewsArticleModel extends \API\Database\Classes\DbManager
{
    public function __construct(){

        parent::__construct();

        $this->table = Functions::getTableNameFromModel($this);

    }

    public function updateArticleData($column, $newValue, $id)
    {
        $req = $this->database->prepare("UPDATE $this->table SET $column = ? WHERE id = ?");
        $res1 = $req->execute(array($newValue, $id));

        $req = $this->database->prepare("UPDATE $this->table SET edit_datetime=NOW() WHERE id = ?");
        $res2 = $req->execute(array($id));

        return $res1 && $res2;
    }
}
