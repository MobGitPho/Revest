<?php

namespace API\Database\Controllers;

use Slim\App;

use API\Database\Utils\DbInfo;
use API\Database\Utils\Functions;
use API\Database\Models\SettingModel;
use API\Database\Classes\PreflightAction;
use API\Database\Classes\CommonController;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use splitbrain\PHPArchive\Zip;

class SettingController extends CommonController
{
    public function __construct()
    {
        $this->model = new SettingModel();
        $this->routeBase = '/setting/';
    }

    public function addRoutes(App $app)
    {
        $this->app = $app;

        try {

            $app->get($this->routeBase . 'all', function (Request $request, Response $response) {

                $this->response = $response;

                $snapshot = $this->model->fetchSettings();

                $settings = $snapshot->fetchAll(\PDO::FETCH_OBJ);

                $response->getBody()->write(json_encode($settings));

                return $response->withHeader('content-type', 'application/json')->withStatus(200);

            });

            $app->get($this->routeBase . 'fetch/db-config', function (Request $request, Response $response) {

                $this->response = $response;

                $config = parse_ini_file(__DIR__ . "/../../config.ini");

                $response->getBody()->write(json_encode($config));

                return $response->withHeader('content-type', 'application/json')->withStatus(200);

            });

            $app->get($this->routeBase . 'check/server', function (Request $request, Response $response) {

                $this->response = $response;

                $response->getBody()->write(json_encode(true));

                return $response->withHeader('content-type', 'application/json')->withStatus(200);

            });

            $app->get($this->routeBase . 'check/database', function (Request $request, Response $response) {

                $this->response = $response;

                $config = parse_ini_file(__DIR__ . "/../../config.ini");

                $db = new \PDO(
                    'mysql:host=' . ($config['host'] ?? '') . ';dbname=' . ($config['dbname'] ?? '') . ';charset=' . DbInfo::CHARSET,
                    ($config['username'] ?? ''),
                    ($config['password'] ?? ''),
                    array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION)
                );

                $db->query('SELECT * FROM ' . ($config['prefix'] ?? '') . 'user');

                $tables = $db->query("SHOW TABLES");
                if (count($tables->fetchAll()) < 13) throw new \PDOException("Some tables are missing");

                $response->getBody()->write(json_encode(true));

                return $response->withHeader('content-type', 'application/json')->withStatus(200);

            });

            $app->get($this->routeBase . 'get/previews/{context}', function (Request $request, Response $response) {

                $this->response = $response;

                $context = $request->getAttribute('context');

                $images = [];

                $path = Functions::getBasePath() . $context . '/';

                $files = file_exists($path) ? array_diff(scandir($path), array('.', '..', 'index.json')) : [];

                foreach ($files as $key => $file) {
                    $extension = pathinfo($file)['extension'];

                    if (in_array( strtolower($extension), ['jpeg', 'jpg', 'png', 'svg'] )) array_push($images, $file);
                }

                $response->getBody()->write(json_encode($images));

                return $response->withHeader('content-type', 'application/json')->withStatus(200);

            });

            $app->get($this->routeBase . 'get/plugins/folders', function (Request $request, Response $response) {

                $this->response = $response;

                $folders = [];

                $path = Functions::getBasePath() . 'breeze-plugins/';

                $content = file_exists($path) ? array_diff(scandir($path), array('.', '..')) : [];

                foreach ($content as $key => $item) {

                    if (is_dir($path . $item)) array_push($folders, $item);

                }

                $response->getBody()->write(json_encode($folders));

                return $response->withHeader('content-type', 'application/json')->withStatus(200);

            });

            $app->get($this->routeBase . 'get/plugins/data', function (Request $request, Response $response) {

                $this->response = $response;

                $data = [];

                $path = Functions::getBasePath() . 'breeze-plugins/';

                $content = file_exists($path) ? array_diff(scandir($path), array('.', '..')) : [];

                foreach ($content as $key => $item) {

                    if (is_dir($path . $item) && file_exists($path . $item . '/plugin.json')) {

                        $content = file_get_contents($path . $item . '/plugin.json');

                        $data[$item] = $content;

                    }

                }

                $response->getBody()->write(json_encode($data));

                return $response->withHeader('content-type', 'application/json')->withStatus(200);

            });

            $app->post($this->routeBase . 'write/db-config', function (Request $request, Response $response) {

                $this->response = $response;

                $data = $request->getParsedBody();

                new \PDO(
                    'mysql:host=' . $data['host'] . ';charset=' . DbInfo::CHARSET,
                    $data['username'],
                    $data['password'],
                    array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION)
                );

                $configPath = Functions::getBasePath() . 'breeze-server/config.ini';

                $fp = fopen($configPath, 'w');

                if (!$fp) throw new \PDOException("Unable to set up the configuration file");

                $content = "[database]\n" .
                    "username = \"" . $data['username'] . "\"\n" .
                    "password = \"" . $data['password'] . "\"\n" .
                    "host = \"" . $data['host'] . "\"\n" .
                    "dbname = \"" . $data['dbname'] . "\"\n" .
                    "prefix = \"" . $data['prefix'] . "\"";

                $task = fwrite($fp, $content);
                fclose($fp);

                $response->getBody()->write(json_encode((bool) $task));

                return $response->withHeader('content-type', 'application/json')->withStatus(200);

            });

            $app->post($this->routeBase . 'write/db-sql', function (Request $request, Response $response) {

                $this->response = $response;

                $data = $request->getParsedBody();

                try {

                    $db = new \PDO(
                        'mysql:host=' . $data['host'] . ';charset=' . DbInfo::CHARSET,
                        $data['username'],
                        $data['password'],
                        array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION)
                    );

                    $task = false;

                    $dbPath = Functions::getBasePath() . 'breeze-server/db-api/assets/db-init.sql';

                    $query = file_get_contents($dbPath);
                    $query = str_replace('${dbname}', $data['dbname'], $query);
                    $query = str_replace('${prefix}', $data['prefix'], $query);
                    $task = $db->exec($query);

                    $response->getBody()->write(json_encode((bool) $task));

                } catch (\Exception $e) {

                    $response->getBody()->write(json_encode(false));

                }

                return $response->withHeader('content-type', 'application/json')->withStatus(200);

            });

            $app->post($this->routeBase . 'add', function (Request $request, Response $response) {

                $this->response = $response;

                $data = $request->getParsedBody();

                $id = $this->model->insertNewSetting($data);

                $response->getBody()->write(json_encode($id));

                return $response->withHeader('content-type', 'application/json')->withStatus(200);

            });

            $app->post($this->routeBase . 'install/template', function (Request $request, Response $response) {

                $this->response = $response;

                $data = $request->getParsedBody();
                $uploadedFiles = $request->getUploadedFiles();

                $uploadedFile = $uploadedFiles['file'];
                if ($uploadedFile->getError() === UPLOAD_ERR_OK) {

                    $filename = $uploadedFile->getClientFilename();
                    $extension = pathinfo($filename)['extension'];

                    if (strtolower($extension) != 'zip') throw new \PDOException("FILE_INVALID");

                    $tmpPath = Functions::getBasePath() . 'tmp.zip';

                    if (file_exists($tmpPath)) unlink($tmpPath);
                    $uploadedFile->moveTo($tmpPath);

                    $zip = new Zip();
                    $zip->open($tmpPath);
                    $contents = $zip->contents();

                    $wantedFiles = ['.htaccess', 'js', 'css', 'index.html', 'sections', 'widgets', 'template'];

                    foreach ($contents as $key => $content) {
                        $key = array_search($content->getPath(), $wantedFiles, true);
                        if (gettype($key) == 'integer') {
                            unset($wantedFiles[$key]);

                            $wantedFiles = array_values($wantedFiles);
                        }
                    }

                    if (count($wantedFiles) > 0) {
                        unlink($tmpPath);

                        throw new \PDOException("TEMPLATE_INVALID");
                    }

                    self::resetRootFolder('breeze-server', $data['folder'], 'tmp.zip');

                    $zip->open($tmpPath);
                    $zip->extract(Functions::getBasePath());

                    unlink($tmpPath);
                }

                $response->getBody()->write(json_encode(true));

                return $response->withHeader('content-type', 'application/json')->withStatus(200);

            });

            $app->put($this->routeBase . 'update', function (Request $request, Response $response) {

                $this->response = $response;

                $data = $request->getParsedBody();

                $result = $this->model->updateSettingData($data['name'], $data['value']);

                $response->getBody()->write(json_encode($result));

                return $response->withHeader('content-type', 'application/json')->withStatus(200);

            });

            $app->put($this->routeBase . 'update/json', function (Request $request, Response $response) {

                $this->response = $response;

                $data = $request->getParsedBody();

                $result = false;

                $filePath = Functions::getBasePath() . $data['file'] . '/index.json';

                if (file_exists($filePath)) {

                    if (isset($data['data']) && !empty($data['data'])) {

                        $result = file_put_contents($filePath, json_encode($data['data'], JSON_PRETTY_PRINT));
                    } else {

                        $result = file_put_contents($filePath, '{}');
                    }
                }

                $response->getBody()->write(json_encode((bool) $result));

                return $response->withHeader('content-type', 'application/json')->withStatus(200);

            });

            $app->put($this->routeBase . 'update/folder', function (Request $request, Response $response) {

                $this->response = $response;

                $data = $request->getParsedBody();

                $result = '';

                if (isset($data['newValue']) && !empty($data['newValue'])) {

                    $currentValue = isset($data['currentValue']) && !empty($data['currentValue'])
                        ? $data['currentValue']
                        : 'breeze';
                    $newValue = $data['newValue'];

                    $task1 = rename(Functions::getBasePath() . $currentValue, Functions::getBasePath() . $newValue);
                    $task2 = false;
                    $task3 = false;

                    $htaccessPath = Functions::getBasePath() . $newValue . '/.htaccess';

                    if ($task1 && file_exists($htaccessPath)) {
                        $data = file($htaccessPath);
                        $resultData = [];

                        foreach ($data as $key => $value) {
                            if (trim($value) == ("RewriteRule . /" . $currentValue . "/index.html [L]")) {
                                array_push($resultData, "RewriteRule . /" . $newValue . "/index.html [L]\n");
                            } else {
                                array_push($resultData, $value);
                            }
                        }

                        $task2 = file_put_contents($htaccessPath, implode('', $resultData));
                    }

                    $indexPath = Functions::getBasePath() . 'index.php';

                    if ($task1 && file_exists($indexPath)) {

                        $fp = fopen($indexPath, 'w');

                        if ($fp) {
                            $content = "<?php header('Location: " . $newValue . "/'); exit(); ?>";

                            $task3 = fwrite($fp, $content);
                            fclose($fp);
                        }
                    } else {
                        $task3 = true;
                    }

                    $result = $task1 && $task2 && $task3 ? 'SUCCESS' : 'FAILURE';
                } else {
                    $result = 'NO-VALUE';
                }

                $response->getBody()->write(json_encode($result));

                return $response->withHeader('content-type', 'application/json')->withStatus(200);

            });

            $app->delete($this->routeBase . 'delete/{name}', function (Request $request, Response $response) {

                $this->response = $response;

                $name = $request->getAttribute('name');

                $result = $this->model->deleteSetting($name);

                $response->getBody()->write(json_encode($result));

                return $response->withHeader('content-type', 'application/json')->withStatus(200);

            });

            $app->delete($this->routeBase . 'delete/template/{breeze-folder}', function (Request $request, Response $response) {

                $this->response = $response;

                $folder = $request->getAttribute('breeze-folder');

                self::resetRootFolder('breeze-server', $folder);

                $indexPath = Functions::getBasePath() . 'index.php';

                $fp = fopen($indexPath, 'w');

                if (!$fp) throw new \PDOException("Unable to create index file");

                $content = "<?php header('Location: " . $folder . "/'); exit(); ?>";

                $task = fwrite($fp, $content);
                fclose($fp);

                $response->getBody()->write(json_encode($task));

                return $response->withHeader('content-type', 'application/json')->withStatus(200);

            });

        } catch (\PDOException $e) {

            return $this->errorHandler($e);

        }

        $app->options($this->routeBase . 'all', new PreflightAction());
        $app->options($this->routeBase . 'fetch/db-config', new PreflightAction());
        $app->options($this->routeBase . 'check/server', new PreflightAction());
        $app->options($this->routeBase . 'check/database', new PreflightAction());
        $app->options($this->routeBase . 'get/previews/{context}', new PreflightAction());
        $app->options($this->routeBase . 'get/plugins/folders', new PreflightAction());
        $app->options($this->routeBase . 'get/plugins/data', new PreflightAction());
        $app->options($this->routeBase . 'write/db-config', new PreflightAction());
        $app->options($this->routeBase . 'write/db-sql', new PreflightAction());
        $app->options($this->routeBase . 'add', new PreflightAction());
        $app->options($this->routeBase . 'install/template', new PreflightAction());
        $app->options($this->routeBase . 'update', new PreflightAction());
        $app->options($this->routeBase . 'update/json', new PreflightAction());
        $app->options($this->routeBase . 'update/folder', new PreflightAction());
        $app->options($this->routeBase . 'delete/{name}', new PreflightAction());
        $app->options($this->routeBase . 'delete/template/{breeze-folder}', new PreflightAction());
    }

    private function resetRootFolder(...$excludedFiles)
    {
        $files = array_diff(scandir(Functions::getBasePath()), array('.', '..'));

        foreach ($files as $key => $file) {

            if (!in_array($file, $excludedFiles)) {

                if (is_file(Functions::getBasePath() . $file)) {

                    chmod(Functions::getBasePath() . $file, 0777);
                    unlink(Functions::getBasePath() . $file);
                } else if (is_dir(Functions::getBasePath() . $file)) {

                    Functions::deleteRecursively(Functions::getBasePath() . $file);
                }
            }
        }
    }
}
