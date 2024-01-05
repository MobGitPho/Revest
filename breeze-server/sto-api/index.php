<?php

namespace API\Storage;

use API\Database\Classes\Middlewares\ApiKeyAuthMiddleware;
use API\Database\Classes\Middlewares\CorsMiddleware;
use API\Database\Classes\PreflightAction;
use API\Database\Utils\Constants;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

use Middlewares\TrailingSlash;
use Slim\Factory\AppFactory;

require_once '../vendor/autoload.php';

$dev_mode = file_exists('../composer.json');

$app = AppFactory::create();

$app->setBasePath('/breeze-server/sto-api');

$app->addBodyParsingMiddleware();
$app->add(new CorsMiddleware());
$app->addRoutingMiddleware();
$app->add(new TrailingSlash(true));
$app->add(new ApiKeyAuthMiddleware(Constants::API_KEYS));
$app->addErrorMiddleware($dev_mode, $dev_mode, $dev_mode);

$app->post('/', function (Request $request, Response $response) {
	$baseDirectory = dirname(__FILE__) . '/root';
	$uploadedFiles = $request->getUploadedFiles();
	$uploadBasePath = str_replace(array('\\', 'C:'), array('/', ''), $baseDirectory);

	$uploadedFile = $uploadedFiles['file'];
	if ($uploadedFile->getError() === UPLOAD_ERR_OK) {
		$data = $request->getParsedBody();

		if (isset($data['folder'])) {

			$uploadBasePath .= '/' . $data['folder'];

			if (!file_exists($uploadBasePath)) mkdir($uploadBasePath, 0777, true);
		}

		$filename = $uploadedFile->getClientFilename();

		if (file_exists($uploadBasePath . DIRECTORY_SEPARATOR . $filename)) {

			if (isset($data['overwrite']) && $data['overwrite']) {

				$uploadedFile->moveTo($uploadBasePath . DIRECTORY_SEPARATOR . $filename);
				$response->getBody()->write('{"status":"success"}');
			} else {

				$response->getBody()->write('{"status":"exists"}');
			}
		} else {

			$uploadedFile->moveTo($uploadBasePath . DIRECTORY_SEPARATOR . $filename);
			$response->getBody()->write('{"status":"success"}');
		}
	} else {
		$response->getBody()->write('{"status":"error"}');
	}

	return $response;
});

$app->options('/', new PreflightAction());

$app->run();
