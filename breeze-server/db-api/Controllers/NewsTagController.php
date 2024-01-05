<?php

namespace API\Database\Controllers;

use API\Database\Models\NewsTagModel;
use API\Database\Classes\CommonController;

class NewsTagController extends CommonController
{
    public function __construct()
    {
        $this->model = new NewsTagModel();
        $this->routeBase = '/news-tag/';
    }
}
