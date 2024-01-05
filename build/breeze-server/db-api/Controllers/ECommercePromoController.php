<?php

namespace API\Database\Controllers;

use API\Database\Classes\CommonController;
use API\Database\Models\ECommercePromoModel;

class ECommercePromoController extends CommonController
{
    public function __construct()
    {
        $this->model = new ECommercePromoModel();
        $this->routeBase = '/e-commerce-promo/';
    }
}
