<?php

namespace API\Database\Controllers;

use API\Database\Models\NotificationModel;
use API\Database\Classes\CommonController;

class NotificationController extends CommonController
{
    public function __construct()
    {
        $this->model = new NotificationModel();
        $this->routeBase = '/notification/';
    }
}
