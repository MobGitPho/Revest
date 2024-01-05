<?php

namespace API\Database\Models;

use API\Database\Utils\Functions;

class WidgetModel extends \API\Database\Classes\DbManager
{
    public function __construct()
    {
        parent::__construct();

        $this->table = Functions::getTableNameFromModel($this);
    }

    public function deleteAllWidget()
    {
        $res = $this->database->query("DELETE FROM $this->table");

        return $res;
    }

    public function deleteWidgetByWid($wid)
    {
        $req = $this->database->prepare("DELETE FROM $this->table WHERE wid = ?");
        $res = $req->execute(array($wid));

        return $res;
    }
}
