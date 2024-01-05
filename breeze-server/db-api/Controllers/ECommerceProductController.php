<?php

namespace API\Database\Controllers;

use Slim\App;

use API\Database\Classes\PreflightAction;
use API\Database\Classes\CommonController;
use API\Database\Models\ECommerceProductModel;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class ECommerceProductController extends CommonController
{
    public function __construct()
    {
        $this->model = new ECommerceProductModel();
        $this->routeBase = '/e-commerce-product/';
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

            $app->get($this->routeBase . 'get/page/{offset}/{limit}', function (Request $request, Response $response) {

                $this->response = $response;

                $offset = $request->getAttribute('offset');
                $limit = $request->getAttribute('limit');

                $snapshot = $this->model->getProductsPage($offset, $limit);

                $products = $snapshot->fetchAll(\PDO::FETCH_OBJ);

                $response->getBody()->write(json_encode($products));

                return $response->withHeader('content-type', 'application/json')->withStatus(200);

            });

        } catch (\PDOException $e) {

            return $this->errorHandler($e);

        }

        $app->options($this->routeBase . 'get/page/{offset}/{limit}', new PreflightAction());
    }
}
