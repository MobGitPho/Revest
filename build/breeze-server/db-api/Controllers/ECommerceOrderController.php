<?php

namespace API\Database\Controllers;

use API\Database\Classes\CommonController;
use API\Database\Models\ECommerceOrderModel;

class ECommerceOrderController extends CommonController
{
    public function __construct()
    {
        $this->model = new ECommerceOrderModel();
        $this->routeBase = '/e-commerce-order/';
    }
}
