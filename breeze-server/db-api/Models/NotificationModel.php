<?php

namespace API\Database\Models;

use API\Database\Utils\Functions;

class NotificationModel extends \API\Database\Classes\DbManager
{
    public function __construct(){

        parent::__construct();

        $this->table = Functions::getTableNameFromModel($this);

    }
}
