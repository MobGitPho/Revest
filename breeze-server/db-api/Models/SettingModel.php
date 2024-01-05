<?php

namespace API\Database\Models;

use API\Database\Utils\Functions;

class SettingModel extends \API\Database\Classes\DbManager
{
    public function __construct(){

        parent::__construct();

        $this->table = Functions::getTableNameFromModel($this);

    }

    public function fetchSettings()
    {
        return $this->database->query("SELECT * FROM $this->table");
    }

    public function updateSettingData($name, $newValue)
    {
        $req = $this->database->prepare("UPDATE $this->table SET value = ? WHERE name = ?");
        $res = $req->execute(array($newValue, $name));

        return $res;
    }

    public function insertNewSetting($newSetting)
    {
        try {
            $req = $this->database->prepare("INSERT INTO $this->table (name, value) VALUES(:name, :value)");
            $req->execute(array(
                ':name' => $newSetting['name'],
                ':value' => $newSetting['value']
            ));

            return $this->database->lastInsertId();
        } catch (\Exception $e) {
            die('Erreur' . $e->getMessage());
        }

        return 0;
    }

    public function deleteSetting($name)
    {
        $req = $this->database->prepare("DELETE FROM $this->table WHERE name = ?");
        $res = $req->execute(array($name));

        return $res;
    }
}
