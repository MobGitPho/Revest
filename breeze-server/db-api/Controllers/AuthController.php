<?php

namespace API\Database\Controllers;

use Slim\App;

use API\Database\Models\AuthModel;
use API\Database\Classes\PreflightAction;
use API\Database\Classes\CommonController;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class AuthController extends CommonController
{
    public function __construct()
    {
        $this->model = new AuthModel();
        $this->routeBase = '/auth';
    }

    public function addRoutes(App $app)
    {
        $this->app = $app;

        try {

            $app->post($this->routeBase, function (Request $request, Response $response) {

                $this->response = $response;

                $data = $request->getParsedBody();
                $result = [];

                if (
                    isset($data['username']) and !empty($data['username'])
                    and isset($data['password']) and !empty($data['password'])
                ) {

                    $uid = false;
                    $password = false;
                    $id = '';
                    $name = '';
                    $email = '';
                    $access = 0;
                    $status = 0;
                    $hash_id = '';
                    $avatar = '';
                    $last_login = null;

                    $users = $this->model->getItems();

                    while ($user = $users->fetch()) {

                        $uid = $user['uid'] == $data['username'];

                        if ($uid) {

                            $password = $user['password'] == $data['password'];
                            if ($password) {

                                $id = $user['id'];
                                $name = $user['name'];
                                $email = $user['email'];
                                $access = $user['access'];
                                $status = $user['status'];
                                $hash_id = $user['hash_id'];
                                $avatar = $user['avatar'];
                                $last_login = $user['last_login'];
                            }

                            break;
                        }
                    }
                    $users->closeCursor();

                    if ($uid and $password) {

                        $result['username'] = true;
                        $result['password'] = true;
                        $result['user']['id'] = $id;
                        $result['user']['name'] = $name;
                        $result['user']['email'] = $email;
                        $result['user']['uid'] = $data['username'];
                        $result['user']['access'] = (int) $access;
                        $result['user']['status'] = (int) $status;
                        $result['user']['hash_id'] = $hash_id;
                        $result['user']['avatar'] = $avatar;
                        $result['user']['last_login'] = $last_login;
                    } elseif ($uid) {

                        $result['username'] = true;
                        $result['password'] = false;
                        $result['user'] = '';
                    } else {

                        $result['username'] = false;
                        $result['password'] = false;
                        $result['user'] = '';
                    }
                }

                $response->getBody()->write(json_encode($result));

                return $response->withHeader('content-type', 'application/json')->withStatus(200);
            });
        } catch (\PDOException $e) {

            return $this->errorHandler($e);
        }

        $app->options($this->routeBase, new PreflightAction());
    }
}
