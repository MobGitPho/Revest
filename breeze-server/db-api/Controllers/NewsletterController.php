<?php

namespace API\Database\Controllers;

use Slim\App;

use API\Database\Models\NewsletterModel;
use API\Database\Classes\PreflightAction;
use API\Database\Classes\CommonController;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class NewsletterController extends CommonController
{
    public function __construct()
    {
        $this->model = new NewsletterModel();
        $this->routeBase = '/newsletter/';
    }

    public function addRoutes(App $app)
    {
        $this->app = $app;

        try {

            $app->get($this->routeBase . 'email/all', function (Request $request, Response $response) {

                $this->response = $response;

                $snapshot = $this->model->getEmails();

                $emails = $snapshot->fetchAll(\PDO::FETCH_OBJ);

                $response->getBody()->write(json_encode($emails));

                return $response->withHeader('content-type', 'application/json')->withStatus(200);

            });

            $app->get($this->routeBase . 'campaign/all', function (Request $request, Response $response) {

                $this->response = $response;

                $snapshot = $this->model->getCampaigns();

                $campaigns = $snapshot->fetchAll(\PDO::FETCH_OBJ);

                $response->getBody()->write(json_encode($campaigns));

                return $response->withHeader('content-type', 'application/json')->withStatus(200);

            });

            $app->get($this->routeBase . 'email/get/{id}', function (Request $request, Response $response) {

                $this->response = $response;

                $id = $request->getAttribute('id');

                $snapshot = $this->model->getEmailById($id);

                $email = $snapshot->fetch();

                $response->getBody()->write(json_encode($email));

                return $response->withHeader('content-type', 'application/json')->withStatus(200);

            });

            $app->get($this->routeBase . 'campaign/get/{id}', function (Request $request, Response $response) {

                $this->response = $response;

                $id = $request->getAttribute('id');

                $snapshot = $this->model->getCampaignById($id);

                $campaign = $snapshot->fetch();

                $response->getBody()->write(json_encode($campaign));

                return $response->withHeader('content-type', 'application/json')->withStatus(200);

            });

            $app->post($this->routeBase . 'email/add', function (Request $request, Response $response) {

                $this->response = $response;

                $data = $request->getParsedBody();

                $id = $this->model->insertNewEmail($data);

                $response->getBody()->write(json_encode($id));

                return $response->withHeader('content-type', 'application/json')->withStatus(200);

            });

            $app->post($this->routeBase . 'campaign/add', function (Request $request, Response $response) {

                $this->response = $response;

                $data = $request->getParsedBody();

                $id = $this->model->insertNewCampaign($data);

                $response->getBody()->write(json_encode($id));

                return $response->withHeader('content-type', 'application/json')->withStatus(200);

            });

            $app->put($this->routeBase . 'email/update/{id}', function (Request $request, Response $response) {

                $this->response = $response;

                $id = $request->getAttribute('id');
                $data = $request->getParsedBody();

                $result = false;

                foreach ($data as $key => $value) {
                    $result = $this->model->updateEmailData($key, $value, $id);
                }

                $response->getBody()->write(json_encode($result));

                return $response->withHeader('content-type', 'application/json')->withStatus(200);

            });

            $app->put($this->routeBase . 'campaign/update/{id}', function (Request $request, Response $response) {

                $this->response = $response;

                $id = $request->getAttribute('id');
                $data = $request->getParsedBody();

                $result = false;

                foreach ($data as $key => $value) {
                    $result = $this->model->updateCampaignData($key, $value, $id);
                }

                $response->getBody()->write(json_encode($result));

                return $response->withHeader('content-type', 'application/json')->withStatus(200);

            });

            $app->delete($this->routeBase . 'email/delete/{id}', function (Request $request, Response $response) {

                $this->response = $response;

                $id = $request->getAttribute('id');

                $result = $this->model->deleteEmail($id);

                $response->getBody()->write(json_encode($result));

                return $response->withHeader('content-type', 'application/json')->withStatus(200);

            });

            $app->delete($this->routeBase . 'campaign/delete/{id}', function (Request $request, Response $response) {

                $this->response = $response;

                $id = $request->getAttribute('id');

                $result = $this->model->deleteCampaign($id);

                $response->getBody()->write(json_encode($result));

                return $response->withHeader('content-type', 'application/json')->withStatus(200);

            });

        } catch (\PDOException $e) {

            return $this->errorHandler($e);

        }

        $app->options($this->routeBase . 'email/all', new PreflightAction());
        $app->options($this->routeBase . 'campaign/all', new PreflightAction());
        $app->options($this->routeBase . 'email/get/{id}', new PreflightAction());
        $app->options($this->routeBase . 'campaign/get/{id}', new PreflightAction());
        $app->options($this->routeBase . 'email/add', new PreflightAction());
        $app->options($this->routeBase . 'campaign/add', new PreflightAction());
        $app->options($this->routeBase . 'email/update/{id}', new PreflightAction());
        $app->options($this->routeBase . 'campaign/update/{id}', new PreflightAction());
        $app->options($this->routeBase . 'email/delete/{id}', new PreflightAction());
        $app->options($this->routeBase . 'campaign/delete/{id}', new PreflightAction());
    }
}
