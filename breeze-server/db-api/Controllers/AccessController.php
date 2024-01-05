<?php

namespace API\Database\Controllers;

use API\Database\Models\AccessModel;
use API\Database\Classes\CommonController;

class AccessController extends CommonController
{
    public function __construct()
    {
        $this->model = new AccessModel();
        $this->routeBase = '/access/';
    }
}
