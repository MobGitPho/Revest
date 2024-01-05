<?php

namespace API\Database\Controllers;

use API\Database\Classes\CommonController;
use API\Database\Models\ECommerceCategoryModel;

class ECommerceCategoryController extends CommonController
{
    public function __construct()
    {
        $this->model = new ECommerceCategoryModel();
        $this->routeBase = '/e-commerce-category/';
    }
}
