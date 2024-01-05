<?php

namespace API\Database\Models;

use API\Database\Utils\Functions;

class UserModel extends \API\Database\Classes\DbManager
{
    public function __construct()
    {
        parent::__construct();

        $this->table = Functions::getTableNameFromModel($this);
    }

    public function getUsersByAccess($access)
    {
        $req = $this->database->prepare("SELECT * FROM $this->table WHERE access = ?");
        $req->execute(array($access));

        return $req;
    }

    public function getUserByHashId($hashId)
    {
        $req = $this->database->prepare("SELECT * FROM $this->table WHERE hash_id = ?");
        $req->execute(array($hashId));

        return $req;
    }

    public function getUserByUid($uid)
    {
        $req = $this->database->prepare("SELECT * FROM $this->table WHERE uid = ?");
        $req->execute(array($uid));

        return $req;
    }
}
