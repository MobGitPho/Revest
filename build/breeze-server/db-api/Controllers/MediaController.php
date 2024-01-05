<?php

namespace API\Database\Controllers;

use Slim\App;

use API\Database\Utils\Functions;
use API\Database\Models\MediaModel;
use API\Database\Classes\PreflightAction;
use API\Database\Classes\CommonController;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use claviska\SimpleImage;

class MediaController extends CommonController
{
    private const THUMBNAILS_FOLDER = 'thumbnails';

    public function __construct()
    {
        $this->model = new MediaModel();
        $this->routeBase = '/media/';
    }

    public function addRoutes(App $app)
    {
        $this->app = $app;

        try {

            $app->get($this->routeBase . 'get/{id}', function (Request $request, Response $response) {

                $this->response = $response;

                $id = $request->getAttribute('id');

                $snapshot = $this->model->getItemById($id);

                $media = $snapshot->fetch();

                $response->getBody()->write(json_encode($media));

                return $response->withHeader('content-type', 'application/json')->withStatus(200);

            });

            $app->get($this->routeBase . 'get/page/{offset}/{limit}', function (Request $request, Response $response) {

                $this->response = $response;

                $offset = $request->getAttribute('offset');
                $limit = $request->getAttribute('limit');

                $snapshot = $this->model->getMediasPage($offset, $limit);

                $medias = $snapshot->fetchAll(\PDO::FETCH_OBJ);

                $response->getBody()->write(json_encode($medias));

                return $response->withHeader('content-type', 'application/json')->withStatus(200);

            });

            $app->get($this->routeBase . 'get/files/{folder}', function (Request $request, Response $response) {

                $this->response = $response;

                $folder = $request->getAttribute('folder');

                $path = Functions::getBasePath() . 'breeze-server/sto-api/root/' . $folder;

                if (file_exists($path)) $files = array_diff(scandir($path), array('.', '..'));
                else $files = [];

                $fileItems = [];

                foreach ($files as $key => $file) {
                    array_push($fileItems, array(
                        'name' => $file,
                        'size' => filesize($path . '/' . $file),
                        'mime' => mime_content_type($path . '/' . $file)
                    ));
                }

                $response->getBody()->write(json_encode($fileItems));

                return $response->withHeader('content-type', 'application/json')->withStatus(200);

            });

            $app->get($this->routeBase . 'all', function (Request $request, Response $response) {

                $this->response = $response;

                $snapshot = $this->model->getItems();

                $medias = $snapshot->fetchAll(\PDO::FETCH_OBJ);

                $response->getBody()->write(json_encode($medias));

                return $response->withHeader('content-type', 'application/json')->withStatus(200);

            });

            $app->post($this->routeBase . 'add', function (Request $request, Response $response) {

                $this->response = $response;

                $data = $request->getParsedBody();

                $result = $this->model->insertItem($data);

                $response->getBody()->write(json_encode($result));

                return $response->withHeader('content-type', 'application/json')->withStatus(200);

            });

            $app->put($this->routeBase . 'update/{id}', function (Request $request, Response $response) {

                $this->response = $response;

                $id = $request->getAttribute('id');
                $data = $request->getParsedBody();

                $result = false;

                foreach ($data as $key => $value) {
                    $result = $this->model->updateItemData($key, $value, $id);
                }

                $response->getBody()->write(json_encode($result));

                return $response->withHeader('content-type', 'application/json')->withStatus(200);

            });

            $app->delete($this->routeBase . 'delete/{id}/{keep-file}', function (Request $request, Response $response) {

                $this->response = $response;

                $id = $request->getAttribute('id');
                $keepFile = $request->getAttribute('keep-file');

                if (isset($keepFile) && !$keepFile){

                    $snapshot = $this->model->getItemById($id);

                    $media = $snapshot->fetch();

                    $path = Functions::getBasePath() . 'breeze-server/sto-api/' . $media['link'];

                    if (file_exists($path)) unlink($path);

                }

                $result = $this->model->deleteItem($id);

                $response->getBody()->write(json_encode($result));

                return $response->withHeader('content-type', 'application/json')->withStatus(200);

            });

            $app->delete($this->routeBase . 'delete-file/{folder}/{file}', function (Request $request, Response $response) {

                $this->response = $response;

                $folder = $request->getAttribute('folder');
                $file = $request->getAttribute('file');

                $result = false;

                $path = Functions::getBasePath() . 'breeze-server/sto-api/root/' . $folder . '/' . $file;

                if (file_exists($path)) $result = unlink($path);

                $response->getBody()->write(json_encode($result));

                return $response->withHeader('content-type', 'application/json')->withStatus(200);

            });

            $app->get($this->routeBase . 'check/{lib}', function (Request $request, Response $response) {

                $this->response = $response;

                $lib = $request->getAttribute('lib');

                $result = false;

                switch ($lib) {
                    case 'gd':
                        $result = extension_loaded('gd') && function_exists('gd_info');
                        break;

                    case 'imagick':
                        $result = extension_loaded('imagick');
                        break;
                }

                $response->getBody()->write(json_encode($result));

                return $response->withHeader('content-type', 'application/json')->withStatus(200);

            });

            $app->post($this->routeBase . 'generate/thumbnail', function (Request $request, Response $response) {

                $this->response = $response;

                $data = $request->getParsedBody();

                $result = false;

                if (isset($data['folder']) && isset($data['file'])) {

                    $rootpath = Functions::getBasePath() . 'breeze-server/sto-api/root/';
                    $filename = pathinfo($data['file'])['filename'];
                    $extension = pathinfo($data['file'])['extension'];

                    if (!file_exists($rootpath . self::THUMBNAILS_FOLDER)) mkdir($rootpath . self::THUMBNAILS_FOLDER, 0777, true);

                    if (in_array( strtolower($extension), ['jpeg', 'jpg', 'png'] )) {
                        switch ($data['lib']) {
                            case 'gd':
                                $image = new SimpleImage($rootpath . $data['folder'] . '/' . $data['file']);

                                foreach ($data['models'] as $key => $model) {

                                    $width = ( isset($data['autoWidth']) && $data['autoWidth'] )
                                            ? ( ( (int) $model['height'] * (int) $image->getWidth() ) / (int) $image->getHeight() )
                                            : (int) $model['width'];

                                    $height = ( isset($data['autoHeight']) && $data['autoHeight'] )
                                            ? ( ( (int) $model['width'] * (int) $image->getHeight() ) / (int) $image->getWidth() )
                                            : (int) $model['height'];

                                    $image->resize($width, $height)
                                        ->toFile($rootpath . self::THUMBNAILS_FOLDER . '/' . $filename . '-' . $model['label'] . '.' . $extension);

                                }
                                break;

                            case 'imagick':
                                $thumb = new \Imagick($rootpath . $data['folder'] . '/' . $data['file']);

                                foreach ($data['models'] as $key => $model) {

                                    $width = ( isset($data['autoWidth']) && $data['autoWidth'] )
                                        ? ( ( (int) $model['height'] * (int) $thumb->getImageWidth() ) / (int) $thumb->getImageHeight() )
                                        : (int) $model['width'];

                                    $height = ( isset($data['autoHeight']) && $data['autoHeight'] )
                                            ? ( ( (int) $model['width'] * (int) $thumb->getImageHeight() ) / (int) $thumb->getImageWidth() )
                                            : (int) $model['height'];

                                    $thumb->resizeImage($width, $height, \Imagick::FILTER_LANCZOS, 1);
                                    $thumb->writeImage($rootpath . self::THUMBNAILS_FOLDER . '/' . $filename . '-' . $model['label'] . '.' . $extension);

                                }
                                break;
                        }

                        $result = true;
                    }

                }

                $response->getBody()->write(json_encode($result));

                return $response->withHeader('content-type', 'application/json')->withStatus(200);

            });

            $app->post($this->routeBase . 'generate/thumbnails', function (Request $request, Response $response) {

                $this->response = $response;

                $data = $request->getParsedBody();

                $result = false;

                $rootpath = Functions::getBasePath() . 'breeze-server/sto-api/root/';

                if (isset($data['folder']) && file_exists($rootpath . $data['folder'])) {

                    if (isset($data['reset']) && $data['reset'] && file_exists($rootpath . self::THUMBNAILS_FOLDER)){

                        $files = array_diff(scandir($rootpath . self::THUMBNAILS_FOLDER), array('.', '..'));

                        foreach ($files as $key => $file) {

                            unlink($rootpath . self::THUMBNAILS_FOLDER . '/' . $file);

                        }

                    }

                    if (!file_exists($rootpath . self::THUMBNAILS_FOLDER)) mkdir($rootpath . self::THUMBNAILS_FOLDER, 0777, true);

                    $files = array_diff(scandir($rootpath . $data['folder']), array('.', '..'));

                    foreach ($files as $key => $file) {

                        $filename = pathinfo($file)['filename'];
                        $extension = pathinfo($file)['extension'];

                        if (in_array( strtolower($extension), ['jpeg', 'jpg', 'png'] )) {

                            switch ($data['lib']) {
                                case 'gd':
                                    $image = new SimpleImage($rootpath . $data['folder'] . '/' . $file);

                                    foreach ($data['models'] as $key => $model) {

                                        $width = ( isset($data['autoWidth']) && $data['autoWidth'] )
                                            ? ( ( (int) $model['height'] * (int) $image->getWidth() ) / (int) $image->getHeight() )
                                            : (int) $model['width'];

                                        $height = ( isset($data['autoHeight']) && $data['autoHeight'] )
                                                ? ( ( (int) $model['width'] * (int) $image->getHeight() ) / (int) $image->getWidth() )
                                                : (int) $model['height'];

                                        $image->resize($width, $height)
                                            ->toFile($rootpath . self::THUMBNAILS_FOLDER . '/' . $filename . '-' . $model['label'] . '.' . $extension);

                                    }
                                    break;

                                case 'imagick':
                                    $thumb = new \Imagick($rootpath . $data['folder'] . '/' . $file);

                                    foreach ($data['models'] as $key => $model) {

                                        $width = ( isset($data['autoWidth']) && $data['autoWidth'] )
                                            ? ( ( (int) $model['height'] * (int) $thumb->getImageWidth() ) / (int) $thumb->getImageHeight() )
                                            : (int) $model['width'];

                                        $height = ( isset($data['autoHeight']) && $data['autoHeight'] )
                                                ? ( ( (int) $model['width'] * (int) $thumb->getImageHeight() ) / (int) $thumb->getImageWidth() )
                                                : (int) $model['height'];

                                        $thumb->resizeImage($width, $height, \Imagick::FILTER_LANCZOS, 1);
                                        $thumb->writeImage($rootpath . self::THUMBNAILS_FOLDER . '/' . $filename . '-' . $model['label'] . '.' . $extension);

                                    }
                                    break;
                            }

                        }

                    }

                    $result = true;

                }

                $response->getBody()->write(json_encode($result));

                return $response->withHeader('content-type', 'application/json')->withStatus(200);

            });

        } catch (\PDOException $e) {

            return $this->errorHandler($e);

        }

        $app->options($this->routeBase . 'get/{id}', new PreflightAction());
        $app->options($this->routeBase . 'get/page/{offset}/{limit}', new PreflightAction());
        $app->options($this->routeBase . 'get/files/{folder}', new PreflightAction());
        $app->options($this->routeBase . 'all', new PreflightAction());
        $app->options($this->routeBase . 'add', new PreflightAction());
        $app->options($this->routeBase . 'update/{id}', new PreflightAction());
        $app->options($this->routeBase . 'delete/{id}/{keep-file}', new PreflightAction());
        $app->options($this->routeBase . 'delete-file/{folder}/{filename}', new PreflightAction());
        $app->options($this->routeBase . 'check/{lib}', new PreflightAction());
        $app->options($this->routeBase . 'generate/thumbnail', new PreflightAction());
        $app->options($this->routeBase . 'generate/thumbnails', new PreflightAction());
    }
}
