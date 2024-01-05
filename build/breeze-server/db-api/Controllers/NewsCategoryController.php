<?php

namespace API\Database\Controllers;

use API\Database\Models\NewsCategoryModel;
use API\Database\Classes\CommonController;

class NewsCategoryController extends CommonController
{
    public function __construct()
    {
        $this->model = new NewsCategoryModel();
        $this->routeBase = '/news-category/';
    }
}
