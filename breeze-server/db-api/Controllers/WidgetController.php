<?php

namespace API\Database\Controllers;

use Slim\App;

use API\Database\Models\WidgetModel;
use API\Database\Classes\PreflightAction;
use API\Database\Classes\CommonController;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class WidgetController extends CommonController
{
    public function __construct()
    {
        $this->model = new WidgetModel();
        $this->routeBase = '/widget/';
    }

    public function addRoutes(App $app)
    {
        $this->app = $app;

        try {

            $this->addRouteUpdateItem();
            $this->addRouteDeleteItem();
            $this->addRouteGetAllItems();
            $this->addRouteGetItemById();

            $app->post($this->routeBase . 'add/unique', function (Request $request, Response $response) {

                $this->response = $response;

                $data = $request->getParsedBody();

                if (isset($data['wid'])) {
                    $this->model->deleteWidgetByWid($data['wid']);
                }

                $id = $this->model->insertItem($data);

                $response->getBody()->write(json_encode($id));

                return $response->withHeader('content-type', 'application/json')->withStatus(200);

            });

            $app->post($this->routeBase . 'add/replicable', function (Request $request, Response $response) {

                $this->response = $response;

                $data = $request->getParsedBody();

                $id = $this->model->insertItem($data);

                $response->getBody()->write(json_encode($id));

                return $response->withHeader('content-type', 'application/json')->withStatus(200);

            });

            $app->delete($this->routeBase . 'delete-all', function (Request $request, Response $response) {

                $this->response = $response;

                $result = $this->model->deleteAllWidget();

                $response->getBody()->write(json_encode($result));

                return $response->withHeader('content-type', 'application/json')->withStatus(200);

            });

        } catch (\PDOException $e) {

            return $this->errorHandler($e);

        }

        $app->options($this->routeBase . 'add/unique', new PreflightAction());
        $app->options($this->routeBase . 'add/replicable', new PreflightAction());
        $app->options($this->routeBase . 'delete-all', new PreflightAction());
    }
}
