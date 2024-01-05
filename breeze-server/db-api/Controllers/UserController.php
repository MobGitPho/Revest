<?php

namespace API\Database\Controllers;

use Slim\App;

use API\Database\Models\UserModel;
use API\Database\Classes\PreflightAction;
use API\Database\Classes\CommonController;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class UserController extends CommonController
{
    public function __construct()
    {
        $this->model = new UserModel();
        $this->routeBase = '/user/';
    }

    public function addRoutes(App $app)
    {
        $this->app = $app;

        try {

            $this->addRouteAddItem();
            $this->addRouteUpdateItem();
            $this->addRouteDeleteItem();
            $this->addRouteGetItemById();
            $this->addRouteGetAllItems();

            $app->get($this->routeBase . 'admin/all', function (Request $request, Response $response) {

                $this->response = $response;

                $snapshot = $this->model->getUsersByAccess(0);

                $administrators = $snapshot->fetchAll(\PDO::FETCH_OBJ);

                $response->getBody()->write(json_encode($administrators));

                return $response->withHeader('content-type', 'application/json')->withStatus(200);

            });

            $app->get($this->routeBase . 'check/{uid}', function (Request $request, Response $response) {

                $this->response = $response;

                $uid = $request->getAttribute('uid');

                $snapshot = $this->model->getUserByUid($uid);

                $users = $snapshot->fetchAll(\PDO::FETCH_OBJ);

                $response->getBody()->write(json_encode(count($users) > 0));

                return $response->withHeader('content-type', 'application/json')->withStatus(200);

            });

        } catch (\PDOException $e) {

            return $this->errorHandler($e);

        }

        $app->options($this->routeBase . 'admin/all', new PreflightAction());
        $app->options($this->routeBase . 'check/{uid}', new PreflightAction());
    }
}
