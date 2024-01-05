<?php

namespace API\Database\Controllers;

use Slim\App;

use API\Database\Utils\Functions;
use API\Database\Models\GlobalModel;
use API\Database\Classes\PreflightAction;
use API\Database\Classes\CommonController;
use API\Database\Classes\CustomRequestManager;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class GlobalController extends CommonController
{
    public function __construct()
    {
        $this->model = new GlobalModel();
        $this->routeBase = '/global/';
    }

    public function addRoutes(App $app)
    {
        $this->app = $app;

        try {

            $app->get($this->routeBase . '{table}/all', function (Request $request, Response $response) {

                $this->response = $response;

                $table = Functions::resolveTableName($request->getAttribute('table'));

                $snapshot = $this->model->getItems($table);

                $items = $snapshot->fetchAll(\PDO::FETCH_OBJ);

                $response->getBody()->write(json_encode($items));

                return $response->withHeader('content-type', 'application/json')->withStatus(200);

            });

            $app->get($this->routeBase . '{table}/get/{id}', function (Request $request, Response $response) {

                $this->response = $response;

                $id = $request->getAttribute('id');
                $table = Functions::resolveTableName($request->getAttribute('table'));

                $snapshot = $this->model->getItemById($id, $table);

                $item = $snapshot->fetch();

                $response->getBody()->write(json_encode($item));

                return $response->withHeader('content-type', 'application/json')->withStatus(200);

            });

            $app->post($this->routeBase . '{table}/add', function (Request $request, Response $response) {

                $this->response = $response;

                $table = Functions::resolveTableName($request->getAttribute('table'));

                $data = $request->getParsedBody();

                $id = $this->model->insertItem($data, $table);

                $response->getBody()->write(json_encode($id));

                return $response->withHeader('content-type', 'application/json')->withStatus(200);

            });

            $app->put($this->routeBase . '{table}/update/{id}', function (Request $request, Response $response) {

                $this->response = $response;

                $id = $request->getAttribute('id');
                $table = Functions::resolveTableName($request->getAttribute('table'));

                $data = $request->getParsedBody();

                $result = false;

                foreach ($data as $key => $value) {
                    $result = $this->model->updateItemData($key, $value, $id, $table);
                }

                $response->getBody()->write(json_encode($result));

                return $response->withHeader('content-type', 'application/json')->withStatus(200);

            });

            $app->delete($this->routeBase . '{table}/delete/{id}', function (Request $request, Response $response) {

                $this->response = $response;

                $id = $request->getAttribute('id');
                $table = Functions::resolveTableName($request->getAttribute('table'));

                $result = $this->model->deleteItem($id, $table);

                $response->getBody()->write(json_encode($result));

                return $response->withHeader('content-type', 'application/json')->withStatus(200);

            });

            $app->post($this->routeBase . 'custom-request/json', function (Request $request, Response $response) {

                $this->response = $response;

                $query = $request->getParsedBody();

                $requestManager = new CustomRequestManager();

                $response->getBody()->write(json_encode($requestManager->handleJsonQuery($query)->execute()));

                return $response->withHeader('content-type', 'application/json')->withStatus(200);

            });

            $app->post($this->routeBase . 'custom-request/sql', function (Request $request, Response $response) {

                $this->response = $response;

                $query = $request->getParsedBody();

                $requestManager = new CustomRequestManager();

                $response->getBody()->write(json_encode($requestManager->execute($query)));

                return $response->withHeader('content-type', 'application/json')->withStatus(200);

            });


        } catch (\PDOException $e) {

            return $this->errorHandler($e);

        }

        $app->options($this->routeBase . '{table}/all', new PreflightAction());
        $app->options($this->routeBase . '{table}/get/{id}', new PreflightAction());
        $app->options($this->routeBase . '{table}/add', new PreflightAction());
        $app->options($this->routeBase . '{table}/update/{id}', new PreflightAction());
        $app->options($this->routeBase . '{table}/delete/{id}', new PreflightAction());
        $app->options($this->routeBase . 'custom-request/json', new PreflightAction());
        $app->options($this->routeBase . 'custom-request/sql', new PreflightAction());

    }
}
