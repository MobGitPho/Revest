<?php

namespace API\Database\Controllers;

use Slim\App;

use API\Database\Utils\Functions;
use API\Database\Models\DataModel;
use API\Database\Models\MediaModel;
use API\Database\Classes\PreflightAction;
use API\Database\Classes\CommonController;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use splitbrain\PHPArchive\Zip;

class DataController extends CommonController
{
    public function __construct()
    {
        $this->model = new DataModel();
        $this->routeBase = '/data/';
    }

    public function addRoutes(App $app)
    {
        $this->app = $app;

        try {

            $app->get($this->routeBase . 'get/tables-list', function (Request $request, Response $response) {

                $this->response = $response;

                $list = array(
                    0 => array(
                        'label_en' => 'All tables',
                        'label_fr' => 'Toutes les tables',
                        'value' => '*'
                    )
                );

                $json = file_get_contents(Functions::getBasePath() . 'breeze-server/db-api/assets/tables.json');
                $tables = json_decode($json, true);

                foreach ($tables as $key => $value){
                    if (!isset($value['display']) || !$value['display']) {
                        array_push($list, array(
                            'label_en' => $value['label_en'],
                            'label_fr' => $value['label_fr'],
                            'value' => Functions::resolveTableName($key)
                        ));
                    }
                }

                $response->getBody()->write(json_encode($list));

                return $response->withHeader('content-type', 'application/json')->withStatus(200);

            });

            $app->get($this->routeBase . 'get/tables-backups', function (Request $request, Response $response) {

                $this->response = $response;

                $snapshot = $this->model->fetchTablesBackups();

                $backups = $snapshot->fetchAll(\PDO::FETCH_OBJ);

                $response->getBody()->write(json_encode($backups));

                return $response->withHeader('content-type', 'application/json')->withStatus(200);

            });

            $app->get($this->routeBase . 'get/medias-backups', function (Request $request, Response $response) {

                $this->response = $response;

                $snapshot = $this->model->fetchMediasBackups();

                $backups = $snapshot->fetchAll(\PDO::FETCH_OBJ);

                $response->getBody()->write(json_encode($backups));

                return $response->withHeader('content-type', 'application/json')->withStatus(200);

            });

            $app->post($this->routeBase . 'backup/tables', function (Request $request, Response $response) {

                $this->response = $response;

                $data = $request->getParsedBody();

                $folderPath = Functions::getBasePath() . 'breeze-server/backups';

                if (!file_exists($folderPath)) mkdir($folderPath, 0777, true);

                $filePath = $folderPath . '/' .  $data['code'] . '.sql';

                $result = $this->model->backupDatabaseTables($filePath, $data['tables'], array());

                if (!$result) throw new \PDOException('Backup failed');

                $id = $this->model->insertNewTablesBackup($data);

                $response->getBody()->write(json_encode($id));

                return $response->withHeader('content-type', 'application/json')->withStatus(200);

            });

            $app->post($this->routeBase . 'backup/medias', function (Request $request, Response $response) {

                $this->response = $response;

                $data = $request->getParsedBody();

                $folderPath = Functions::getBasePath() . 'breeze-server/backups';

                if (!file_exists($folderPath)) mkdir($folderPath, 0777, true);

                $mediaModel = new MediaModel();

                $snapshot = $mediaModel->getItems();

                $medias = $snapshot->fetchAll(\PDO::FETCH_OBJ);

                $zip = new Zip();

                $filePath = $folderPath . '/' .  $data['code'] . '.zip';

                $zip->create($filePath);

                foreach ($medias as $key => $value) {

                    $mediaDate = explode(' ', $value->insert_datetime)[0];

                    if ($data['medias_date'] == '' || $mediaDate == $data['medias_date']){

                        if (file_exists(Functions::getBasePath() . 'breeze-server/sto-api/' . $value->link)) {

                            $info = pathinfo($value->link);

                            $filename = $info['filename'] . ( isset($info['extension']) ? '.' . $info['extension'] : '' );

                            $zip->addFile(Functions::getBasePath() . 'breeze-server/sto-api/' . $value->link, $filename);

                        }

                    }

                }

                $zip->close();

                $id = $this->model->insertNewMediasBackup($data);

                $response->getBody()->write(json_encode($id));

                return $response->withHeader('content-type', 'application/json')->withStatus(200);

            });

            $app->delete($this->routeBase . 'delete/tables-backup/{id}', function (Request $request, Response $response) {

                $this->response = $response;

                $id = $request->getAttribute('id');

                $result = $this->model->deleteTablesBackup($id);

                $response->getBody()->write(json_encode($result));

                return $response->withHeader('content-type', 'application/json')->withStatus(200);

            });

            $app->delete($this->routeBase . 'delete/medias-backup/{id}', function (Request $request, Response $response) {

                $this->response = $response;

                $id = $request->getAttribute('id');

                $result = $this->model->deleteMediasBackup($id);

                $response->getBody()->write(json_encode($result));

                return $response->withHeader('content-type', 'application/json')->withStatus(200);

            });

        } catch (\PDOException $e) {

            return $this->errorHandler($e);

        }

        $app->options($this->routeBase . 'get/tables-list', new PreflightAction());
        $app->options($this->routeBase . 'get/tables-backups', new PreflightAction());
        $app->options($this->routeBase . 'get/medias-backups', new PreflightAction());
        $app->options($this->routeBase . 'backup/tables', new PreflightAction());
        $app->options($this->routeBase . 'backup/medias', new PreflightAction());
        $app->options($this->routeBase . 'delete/tables-backup/{id}', new PreflightAction());
        $app->options($this->routeBase . 'delete/medias-backup/{id}', new PreflightAction());
    }
}
