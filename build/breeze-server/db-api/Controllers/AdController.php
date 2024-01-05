<?php

namespace API\Database\Controllers;

use Slim\App;

use API\Database\Models\AdModel;
use API\Database\Classes\PreflightAction;
use API\Database\Classes\CommonController;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class AdController extends CommonController
{
    public function __construct()
    {
        $this->model = new AdModel();
        $this->routeBase = '/ad/';
    }

    public function addRoutes(App $app)
    {
        $this->app = $app;

        try {

            $this->addRouteAddItem();
            $this->addRouteUpdateItem();
            $this->addRouteDeleteItem();
            $this->addRouteGetItemById();

            $app->get($this->routeBase . 'all', function (Request $request, Response $response) {

                $this->response = $response;

                $snapshot = $this->model->getAds();

                $ads = $snapshot->fetchAll(\PDO::FETCH_OBJ);

                $response->getBody()->write(json_encode($ads));

                return $response->withHeader('content-type', 'application/json')->withStatus(200);

            });

            $app->get($this->routeBase . 'id/all', function (Request $request, Response $response) {

                $this->response = $response;

                $snapshot = $this->model->getAdIds();

                $adIds = $snapshot->fetchAll(\PDO::FETCH_OBJ);

                $response->getBody()->write(json_encode($adIds));

                return $response->withHeader('content-type', 'application/json')->withStatus(200);

            });

            $app->get($this->routeBase . 'id/get/{id}', function (Request $request, Response $response) {

                $this->response = $response;

                $id = $request->getAttribute('id');

                $snapshot = $this->model->getAdIdById($id);

                $adId = $snapshot->fetch();

                $response->getBody()->write(json_encode($adId));

                return $response->withHeader('content-type', 'application/json')->withStatus(200);

            });

            $app->post($this->routeBase . 'id/add', function (Request $request, Response $response) {

                $this->response = $response;

                $data = $request->getParsedBody();

                $id = $this->model->insertNewAdId($data);

                $response->getBody()->write(json_encode($id));

                return $response->withHeader('content-type', 'application/json')->withStatus(200);

            });

            $app->put($this->routeBase . 'id/update/{id}', function (Request $request, Response $response) {

                $this->response = $response;

                $id = $request->getAttribute('id');
                $data = $request->getParsedBody();

                $result = false;

                foreach ($data as $key => $value) {
                    $result = $this->model->updateAdIdData($key, $value, $id);
                }

                $response->getBody()->write(json_encode($result));

                return $response->withHeader('content-type', 'application/json')->withStatus(200);

            });

            $app->delete($this->routeBase . 'id/delete/{id}', function (Request $request, Response $response) {

                $this->response = $response;

                $id = $request->getAttribute('id');

                $result = $this->model->deleteAdId($id);

                $response->getBody()->write(json_encode($result));

                return $response->withHeader('content-type', 'application/json')->withStatus(200);

            });


        } catch (\PDOException $e) {

            return $this->errorHandler($e);

        }

        $app->options($this->routeBase . 'id/all', new PreflightAction());
        $app->options($this->routeBase . 'id/get/{id}', new PreflightAction());
        $app->options($this->routeBase . 'id/add', new PreflightAction());
        $app->options($this->routeBase . 'id/update/{id}', new PreflightAction());
        $app->options($this->routeBase . 'id/delete/{id}', new PreflightAction());

    }

}
