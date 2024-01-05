<?php

namespace API\Database\Models;

use API\Database\Utils\Functions;

class AdModel extends \API\Database\Classes\DbManager
{
    private $altTable;

    public function __construct(){

        parent::__construct();

        $this->table = Functions::getTableNameFromModel($this);
        $this->altTable = Functions::resolveTableName('ad_id');

    }

    public function getAds()
    {
        return $this->database->query("
            SELECT $this->table.*, $this->altTable.reusable AS ad_id_reusable, $this->altTable.params AS ad_id_params
            FROM $this->table
            LEFT JOIN $this->altTable ON $this->table.pid = $this->altTable.id
        ");
    }

    public function getAdIds()
    {
        return $this->getItems($this->altTable);
    }

    public function getAdIdById($id)
    {
        return $this->getItemById($id, $this->altTable);
    }

    public function insertNewAdId($newAdId)
    {
        return $this->insertItem($newAdId, $this->altTable);
    }

    public function updateAdIdData($column, $newValue, $id)
    {
        return $this->updateItemData($column, $newValue, $id, $this->altTable);
    }

    public function deleteAdId($id)
    {
        return $this->deleteItem($id, $this->altTable);
    }
}
