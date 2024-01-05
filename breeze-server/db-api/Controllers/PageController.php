<?php

namespace API\Database\Controllers;

use Slim\App;

use API\Database\Models\PageModel;
use API\Database\Classes\PreflightAction;
use API\Database\Classes\CommonController;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class PageController extends CommonController
{
    public function __construct()
    {
        $this->model = new PageModel();
        $this->routeBase =  '/page/';
    }

    public function addRoutes(App $app)
    {
        $this->app = $app;

        try {

            $this->addRouteGetItemById();
            $this->addRouteGetAllItems();

            $app->post($this->routeBase . 'add', function (Request $request, Response $response) {

                $this->response = $response;

                $data = $request->getParsedBody();

                $data['is_home'] = $this->homePageIsSet() ? 0 : 1;

                $id = $this->model->insertItem($data);

                $response->getBody()->write(json_encode($id));

                return $response->withHeader('content-type', 'application/json')->withStatus(200);

            });

            $app->put($this->routeBase . 'update/{id}', function (Request $request, Response $response) {

                $this->response = $response;

                $id = $request->getAttribute('id');
                $data = $request->getParsedBody();

                $result = false;

                foreach ($data as $key => $value) {
                    $result = $this->model->updatePageData($key, $value, $id);
                }

                $response->getBody()->write(json_encode($result));

                return $response->withHeader('content-type', 'application/json')->withStatus(200);

            });

            $app->put($this->routeBase . 'update/is-home/{id}/{value}', function (Request $request, Response $response) {

                $this->response = $response;

                $value = (int) $request->getAttribute('value');
                $id = $request->getAttribute('id');

                if ($value == 1) {

                    $snapshot = $this->model->getItems();

                    $pages = $snapshot->fetchAll();

                    foreach ($pages as $key => $page) {
                        if ($page['id'] == $id) {

                            $this->model->updatePageData('is_home', 1, $id);
                        } else {

                            $this->model->updatePageData('is_home', 0, $page['id']);
                        }
                    }
                }

                $response->getBody()->write(json_encode(true));

                return $response->withHeader('content-type', 'application/json')->withStatus(200);

            });

            $app->delete($this->routeBase . 'delete/{id}', function (Request $request, Response $response) {

                $this->response = $response;

                $id = $request->getAttribute('id');

                $result = $this->model->deleteItem($id);

                $response->getBody()->write(json_encode($result));

                if (!$this->homePageIsSet()) {

                    $snapshot = $this->model->getItems();

                    $pages = $snapshot->fetchAll();

                    if (count($pages) > 0) $this->model->updatePageData('is_home', 1, $pages[0]['id']);
                }

                return $response->withHeader('content-type', 'application/json')->withStatus(200);

            });

        } catch (\PDOException $e) {

            return $this->errorHandler($e);

        }

        $app->options($this->routeBase . 'add', new PreflightAction());
        $app->options($this->routeBase . 'update/{id}', new PreflightAction());
        $app->options($this->routeBase . 'update/is-home/{id}/{value}', new PreflightAction());
        $app->options($this->routeBase . 'delete/{id}', new PreflightAction());
    }

    private function homePageIsSet()
    {
        $homeIsSet = false;

        $snapshot = $this->model->getItems();

        $pages = $snapshot->fetchAll();

        foreach ($pages as $key => $page) {

            if ($page['is_home'] == 1) $homeIsSet = true;
        }

        return $homeIsSet;
    }
}
