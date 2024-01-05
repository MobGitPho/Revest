<?php

namespace API\SSR;

use API\SSR\Classes\Middlewares\CorsMiddleware;

use Middlewares\TrailingSlash;

use Slim\Views\Twig;
use Slim\Factory\AppFactory;
use Slim\Views\TwigMiddleware;

require_once 'breeze-ssr/vendor/autoload.php';

$app = AppFactory::create();

$dev_mode = file_exists('./composer.json');

$twig = Twig::create('breeze-ssr/templates', ['cache' => $dev_mode ? 'breeze-ssr/cache' : false]);

$app->setBasePath($dev_mode ? '/breeze-ssr' : '');

$app->addBodyParsingMiddleware();
$app->add(new CorsMiddleware());
$app->addRoutingMiddleware();
$app->add(new TrailingSlash(false));
$app->add(TwigMiddleware::create($app, $twig));
$app->addErrorMiddleware($dev_mode, $dev_mode, $dev_mode);

(new \API\SSR\Controller())->addRoutes($app);

$app->run();
