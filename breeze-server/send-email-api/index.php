<?php

namespace API\EmailSender;

use API\Database\Classes\Middlewares\ApiKeyAuthMiddleware;
use API\Database\Classes\Middlewares\CorsMiddleware;
use API\Database\Classes\PreflightAction;
use API\Database\Utils\Constants;

use API\EmailSender\Core\Launcher;
use API\EmailSender\Core\SendEmailException;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

use Middlewares\TrailingSlash;
use Slim\Factory\AppFactory;

date_default_timezone_set('Etc/UTC');

require_once '../vendor/autoload.php';

$dev_mode = file_exists('../composer.json');

$app = AppFactory::create();

$app->setBasePath('/breeze-server/send-email-api');

$app->addBodyParsingMiddleware();
$app->add(new CorsMiddleware());
$app->addRoutingMiddleware();
$app->add(new TrailingSlash(true));
$app->add(new ApiKeyAuthMiddleware(Constants::API_KEYS));
$app->addErrorMiddleware($dev_mode, $dev_mode, $dev_mode);

$app->post('/', function (Request $request, Response $response) {
    try {
        $data = $request->getParsedBody();

        try {

            $launcher = new Launcher($data);

            $result = $launcher->sendEmail();

            $response->getBody()->write(json_encode($result));
        } catch (\Exception $e) {

            $launcher1 = new Launcher($data, true);

            $result1 = $launcher1->sendEmail();

            $response->getBody()->write(json_encode($result1));
        }

        return $response->withHeader('content-type', 'application/json')->withStatus(200);
    } catch (SendEmailException $e) {
        $error = array("message" => $e->getMessage());

        $response->getBody()->write(json_encode($error));

        return $response->withHeader('content-type', 'application/json')->withStatus(432);
    } catch (\Exception $e) {
        $error = array("message" => $e->getMessage());

        $response->getBody()->write(json_encode($error));

        return $response->withHeader('content-type', 'application/json')->withStatus(500);
    }
});

$app->options('/', new PreflightAction());

$app->run();
