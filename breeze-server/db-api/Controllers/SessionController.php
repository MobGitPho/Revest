<?php

namespace API\Database\Controllers;

use API\Database\Models\SessionModel;
use API\Database\Classes\CommonController;

class SessionController extends CommonController
{
    public function __construct()
    {
        $this->model = new SessionModel();
        $this->routeBase = '/session/';
    }
}
