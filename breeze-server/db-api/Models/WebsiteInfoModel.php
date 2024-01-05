<?php

namespace API\Database\Models;

use API\Database\Utils\Functions;

class WebsiteInfoModel extends \API\Database\Classes\DbManager
{
    public function __construct()
    {
        parent::__construct();

        $this->table = Functions::getTableNameFromModel($this);
    }

    public function fetchWebsiteInfo()
    {
        return $this->database->query("SELECT * FROM $this->table");
    }

    public function updateWebsiteInfo($name, $newValue)
    {
        $req = $this->database->prepare("UPDATE $this->table SET value = ? WHERE name = ?");
        $res = $req->execute(array($newValue, $name));

        return $res;
    }

    public function insertNewWebsiteInfo($newWebsiteInfo)
    {
        try {
            $req = $this->database->prepare("INSERT INTO $this->table (name, value) VALUES(:name, :value)");
            $req->execute(array(
                ':name' => $newWebsiteInfo['name'],
                ':value' => $newWebsiteInfo['value']
            ));

            return $this->database->lastInsertId();
        } catch (\Exception $e) {
            die('Erreur' . $e->getMessage());
        }

        return 0;
    }

    public function deleteWebsiteInfo($name)
    {
        $req = $this->database->prepare("DELETE FROM $this->table WHERE name = ?");
        $res = $req->execute(array($name));

        return $res;
    }
}
