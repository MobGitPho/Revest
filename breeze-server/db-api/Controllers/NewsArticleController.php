<?php

namespace API\Database\Controllers;

use Slim\App;

use API\Database\Models\NewsArticleModel;
use API\Database\Classes\PreflightAction;
use API\Database\Classes\CommonController;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class NewsArticleController extends CommonController
{
    public function __construct()
    {
        $this->model = new NewsArticleModel();
        $this->routeBase = '/news-article/';
    }

    public function addRoutes(App $app)
    {
        $this->app = $app;

        try {

            $this->addRouteAddItem();
            $this->addRouteDeleteItem();
            $this->addRouteGetItemById();
            $this->addRouteGetAllItems();

            $app->put($this->routeBase . 'update/{id}', function (Request $request, Response $response) {

                $this->response = $response;

                $id = $request->getAttribute('id');
                $data = $request->getParsedBody();

                $result = false;

                foreach ($data as $key => $value) {
                    $result = $this->model->updateArticleData($key, $value, $id);
                }

                $response->getBody()->write(json_encode($result));

                return $response->withHeader('content-type', 'application/json')->withStatus(200);

            });


        } catch (\PDOException $e) {

            return $this->errorHandler($e);

        }

        $app->options($this->routeBase . 'update/{id}', new PreflightAction());
    }
}
