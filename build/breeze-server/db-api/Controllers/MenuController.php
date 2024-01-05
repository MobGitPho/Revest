<?php

namespace API\Database\Controllers;

use Slim\App;

use API\Database\Models\MenuModel;
use API\Database\Classes\PreflightAction;
use API\Database\Classes\CommonController;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class MenuController extends CommonController
{
    public function __construct()
    {
        $this->model = new MenuModel();
        $this->routeBase = '/menu/';
    }

    public function addRoutes(App $app)
    {
        $this->app = $app;

        try {

            $app->get($this->routeBase . 'all', function (Request $request, Response $response) {

                $this->response = $response;

                $snapshot = $this->model->getMenus();

                $menus = $snapshot->fetchAll(\PDO::FETCH_OBJ);

                $response->getBody()->write(json_encode($menus));

                return $response->withHeader('content-type', 'application/json')->withStatus(200);

            });

            $app->get($this->routeBase . 'items/all', function (Request $request, Response $response) {

                $this->response = $response;

                $snapshot = $this->model->getMenuItems();

                $items = $snapshot->fetchAll(\PDO::FETCH_OBJ);

                $response->getBody()->write(json_encode($items));

                return $response->withHeader('content-type', 'application/json')->withStatus(200);

            });

            $app->get($this->routeBase . 'items/parent/{parent}', function (Request $request, Response $response) {

                $this->response = $response;

                $parent = $request->getAttribute('parent');

                $snapshot = $this->model->getMenuItemsByParent($parent);

                $items = $snapshot->fetchAll(\PDO::FETCH_OBJ);

                $response->getBody()->write(json_encode($items));

                return $response->withHeader('content-type', 'application/json')->withStatus(200);

            });

            $app->get($this->routeBase . 'locations', function (Request $request, Response $response) {

                $this->response = $response;

                $snapshot = $this->model->getMenuLocations();

                $locations = $snapshot->fetchAll(\PDO::FETCH_OBJ);

                $response->getBody()->write(json_encode($locations));

                return $response->withHeader('content-type', 'application/json')->withStatus(200);

            });

            $app->get($this->routeBase . 'get/{id}', function (Request $request, Response $response) {

                $this->response = $response;

                $id = $request->getAttribute('id');

                $snapshot = $this->model->getMenuById($id);

                $menu = $snapshot->fetch();

                $response->getBody()->write(json_encode($menu));

                return $response->withHeader('content-type', 'application/json')->withStatus(200);

            });

            $app->post($this->routeBase . 'add', function (Request $request, Response $response) {

                $this->response = $response;

                $data = $request->getParsedBody();

                $id = $this->model->insertNewMenu($data);

                $response->getBody()->write(json_encode($id));

                return $response->withHeader('content-type', 'application/json')->withStatus(200);

            });

            $app->post($this->routeBase . 'item/add', function (Request $request, Response $response) {

                $this->response = $response;

                $data = $request->getParsedBody();

                $id = $this->model->insertNewMenuItem($data);

                $response->getBody()->write(json_encode($id));

                return $response->withHeader('content-type', 'application/json')->withStatus(200);

            });

            $app->put($this->routeBase . 'update/{id}', function (Request $request, Response $response) {

                $this->response = $response;

                $id = $request->getAttribute('id');
                $data = $request->getParsedBody();

                $result = false;

                foreach ($data as $key => $value) {
                    $result = $this->model->updateMenuData($key, $value, $id);
                }

                $response->getBody()->write(json_encode($result));

                return $response->withHeader('content-type', 'application/json')->withStatus(200);

            });

            $app->put($this->routeBase . 'item/update/{id}', function (Request $request, Response $response) {

                $this->response = $response;

                $id = $request->getAttribute('id');
                $data = $request->getParsedBody();

                $result = false;

                foreach ($data as $key => $value) {
                    $result = $this->model->updateMenuItemData($key, $value, $id);
                }

                $response->getBody()->write(json_encode($result));

                return $response->withHeader('content-type', 'application/json')->withStatus(200);

            });

            $app->put($this->routeBase . 'locations/update', function (Request $request, Response $response) {

                $this->response = $response;

                $data = $request->getParsedBody();

                $this->model->deleteMenuLocations();

                $result = false;

                foreach ($data['locations'] as $key => $value) {
                    $result = $this->model->insertNewMenuLocation($value['value'], $value['menu'], $data['insert_by']);
                }

                $response->getBody()->write(json_encode($result));

                return $response->withHeader('content-type', 'application/json')->withStatus(200);

            });

            $app->delete($this->routeBase . 'delete/{id}', function (Request $request, Response $response) {

                $this->response = $response;

                $id = $request->getAttribute('id');

                $result1 = $this->model->deleteMenuItemByMenu($id);
                $result2 = $this->model->deleteMenu($id);
                $result3 = $this->model->deleteMenuLocations();

                $response->getBody()->write(json_encode($result1 && $result2 && $result3));

                return $response->withHeader('content-type', 'application/json')->withStatus(200);

            });

            $app->delete($this->routeBase . 'item/delete/{id}', function (Request $request, Response $response) {

                $this->response = $response;

                $id = $request->getAttribute('id');

                $result = $this->model->deleteMenuItem($id);

                $response->getBody()->write(json_encode($result));

                return $response->withHeader('content-type', 'application/json')->withStatus(200);

            });

        } catch (\PDOException $e) {

            return $this->errorHandler($e);

        }

        $app->options($this->routeBase . 'all', new PreflightAction());
        $app->options($this->routeBase . 'items/all', new PreflightAction());
        $app->options($this->routeBase . 'items/parent/{parent}', new PreflightAction());
        $app->options($this->routeBase . 'locations', new PreflightAction());
        $app->options($this->routeBase . 'get/{id}', new PreflightAction());
        $app->options($this->routeBase . 'add', new PreflightAction());
        $app->options($this->routeBase . 'item/add', new PreflightAction());
        $app->options($this->routeBase . 'update/{id}', new PreflightAction());
        $app->options($this->routeBase . 'item/update/{id}', new PreflightAction());
        $app->options($this->routeBase . 'locations/update', new PreflightAction());
        $app->options($this->routeBase . 'delete/{id}', new PreflightAction());
        $app->options($this->routeBase . 'item/delete/{id}', new PreflightAction());
    }
}
