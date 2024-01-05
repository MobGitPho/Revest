<?php

namespace API\Database\Models;

use API\Database\Utils\Functions;

class SubscriptionModel extends \API\Database\Classes\DbManager
{
    public function __construct()
    {
        parent::__construct();

        $this->table = Functions::resolveTableName('subscription_account');
    }

    public function getAccountByHashId($hashId)
    {
        $req = $this->database->prepare("SELECT * FROM $this->table WHERE hash_id = ?");
        $req->execute(array($hashId));

        return $req;
    }

    public function getAccountByUid($uid)
    {
        $req = $this->database->prepare("SELECT * FROM $this->table WHERE uid = ?");
        $req->execute(array($uid));

        return $req;
    }
}
