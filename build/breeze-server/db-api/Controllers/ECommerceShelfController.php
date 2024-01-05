<?php

namespace API\Database\Controllers;

use API\Database\Models\ECommerceShelfModel;
use API\Database\Classes\CommonController;

class ECommerceShelfController extends CommonController
{
    public function __construct()
    {
        $this->model = new ECommerceShelfModel();
        $this->routeBase = '/e-commerce-shelf/';
    }
}
