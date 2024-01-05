<?php

namespace API\Database\Classes;

use Slim\App;

interface ControllerInterface
{
    public function addRoutes(App $app);
}
