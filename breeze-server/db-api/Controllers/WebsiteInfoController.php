<?php

namespace API\Database\Controllers;

use Slim\App;

use API\Database\Models\WebsiteInfoModel;
use API\Database\Classes\PreflightAction;
use API\Database\Classes\CommonController;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class WebsiteInfoController extends CommonController
{
    public function __construct()
    {
        $this->model = new WebsiteInfoModel();
        $this->routeBase = '/website-info/';
    }

    public function addRoutes(App $app)
    {
        $this->app = $app;

        try {

            $app->get($this->routeBase . 'all', function (Request $request, Response $response) {

                $this->response = $response;

                $snapshot = $this->model->fetchWebsiteInfo();

                $data = $snapshot->fetchAll(\PDO::FETCH_OBJ);

                $response->getBody()->write(json_encode($data));

                return $response->withHeader('content-type', 'application/json')->withStatus(200);

            });

            $app->post($this->routeBase . 'add', function (Request $request, Response $response) {

                $this->response = $response;

                $data = $request->getParsedBody();

                $id = $this->model->insertNewWebsiteInfo($data);

                $response->getBody()->write(json_encode($id));

                return $response->withHeader('content-type', 'application/json')->withStatus(200);

            });

            $app->put($this->routeBase . 'update', function (Request $request, Response $response) {

                $this->response = $response;

                $data = $request->getParsedBody();

                $result = false;

                if (is_array($data)) {

                    foreach ($data as $key => $value) {

                        $result = $this->model->updateWebsiteInfo($value['name'], $value['value']);
                    }
                } else {

                    $result = $this->model->updateWebsiteInfo($data['name'], $data['value']);
                }

                $response->getBody()->write(json_encode($result));

                return $response->withHeader('content-type', 'application/json')->withStatus(200);

            });

            $app->delete($this->routeBase . 'delete/{name}', function (Request $request, Response $response) {

                $this->response = $response;

                $name = $request->getAttribute('name');

                $result = $this->model->deleteWebsiteInfo($name);

                $response->getBody()->write(json_encode($result));

                return $response->withHeader('content-type', 'application/json')->withStatus(200);

            });

        } catch (\PDOException $e) {

            return $this->errorHandler($e);

        }

        $app->options($this->routeBase . 'all', new PreflightAction());
        $app->options($this->routeBase . 'add', new PreflightAction());
        $app->options($this->routeBase . 'update', new PreflightAction());
        $app->options($this->routeBase . 'delete/{name}', new PreflightAction());
    }
}
