<?php

namespace API\SSR\Classes;

use Slim\App;

interface ControllerInterface
{
    public function addRoutes(App $app);
}
