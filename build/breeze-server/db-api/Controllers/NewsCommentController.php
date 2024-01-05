<?php

namespace API\Database\Controllers;

use API\Database\Models\NewsCommentModel;
use API\Database\Classes\CommonController;

class NewsCommentController extends CommonController
{
    public function __construct()
    {
        $this->model = new NewsCommentModel();
        $this->routeBase = '/news-comment/';
    }
}
