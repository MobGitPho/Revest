<?php

namespace API\Database\Controllers;

use API\Database\Classes\CommonController;
use API\Database\Models\SectionModel;

class SectionController extends CommonController
{
    public function __construct()
    {
        $this->model = new SectionModel();
        $this->routeBase = '/section/';
    }
}
