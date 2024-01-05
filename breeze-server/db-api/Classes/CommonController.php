<?php

namespace API\Database\Classes;

use Slim\App;
use API\Database\Classes\PreflightAction;
use API\Database\Classes\ControllerInterface;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

abstract class CommonController implements ControllerInterface
{
    protected $app;
    protected $model;
    protected $response;
    protected $routeBase;

    public function addRoutes(App $app)
    {
        $this->app = $app;

        try {

            $this->addRouteAddItem();
            $this->addRouteUpdateItem();
            $this->addRouteDeleteItem();
            $this->addRouteGetItemById();
            $this->addRouteGetAllItems();
            $this->addRouteGetItemsByParent();

        } catch (\PDOException $e) {

            return $this->errorHandler($e);

        }
    }

    protected function addRouteGetAllItems() {

        $this->app->get($this->routeBase . 'all', function (Request $request, Response $response) {

            $this->response = $response;

            $snapshot = $this->model->getItems();

            $items = $snapshot->fetchAll(\PDO::FETCH_OBJ);

            $response->getBody()->write(json_encode($items));

            return $response->withHeader('content-type', 'application/json')->withStatus(200);

        });

        $this->app->options($this->routeBase . 'all', new PreflightAction());

    }

    protected function addRouteGetItemsByParent() {

        $this->app->get($this->routeBase . 'parent/{parent}', function (Request $request, Response $response) {

            $this->response = $response;

            $parent = $request->getAttribute('parent');

            $snapshot = $this->model->getItemsByParent($parent);

            $items = $snapshot->fetchAll(\PDO::FETCH_OBJ);

            $response->getBody()->write(json_encode($items));

            return $response->withHeader('content-type', 'application/json')->withStatus(200);

        });

        $this->app->options($this->routeBase . 'parent/{parent}', new PreflightAction());

    }

    protected function addRouteGetItemById() {

        $this->app->get($this->routeBase . 'get/{id}', function (Request $request, Response $response) {

            $this->response = $response;

            $id = $request->getAttribute('id');

            $snapshot = $this->model->getItemById($id);

            $item = $snapshot->fetch();

            $response->getBody()->write(json_encode($item));

            return $response->withHeader('content-type', 'application/json')->withStatus(200);

        });

        $this->app->options($this->routeBase . 'get/{id}', new PreflightAction());

    }

    protected function addRouteAddItem() {

        $this->app->post($this->routeBase . 'add', function (Request $request, Response $response) {

            $this->response = $response;

            $data = $request->getParsedBody();

            $id = $this->model->insertItem($data);

            $response->getBody()->write(json_encode($id));

            return $response->withHeader('content-type', 'application/json')->withStatus(200);

        });

        $this->app->options($this->routeBase . 'add', new PreflightAction());

    }

    protected function addRouteUpdateItem() {

        $this->app->put($this->routeBase . 'update/{id}', function (Request $request, Response $response) {

            $this->response = $response;

            $id = $request->getAttribute('id');
            $data = $request->getParsedBody();

            $result = false;

            foreach ($data as $key => $value) {
                $result = $this->model->updateItemData($key, $value, $id);
            }

            $response->getBody()->write(json_encode($result));

            return $response->withHeader('content-type', 'application/json')->withStatus(200);

        });

        $this->app->options($this->routeBase . 'update/{id}', new PreflightAction());

    }

    protected function addRouteDeleteItem() {

        $this->app->delete($this->routeBase . 'delete/{id}', function (Request $request, Response $response) {

            $this->response = $response;

            $id = $request->getAttribute('id');

            $result = $this->model->deleteItem($id);

            $response->getBody()->write(json_encode($result));

            return $response->withHeader('content-type', 'application/json')->withStatus(200);

        });

        $this->app->options($this->routeBase . 'delete/{id}', new PreflightAction());

    }

    protected function errorHandler($e) {

        $error = array("message" => $e->getMessage());

        $this->response->getBody()->write(json_encode($error));

        return $this->response->withHeader('content-type', 'application/json')->withStatus(500);

    }
}
