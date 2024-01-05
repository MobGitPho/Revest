<?php

namespace API\SSR;

use Slim\App;

use API\SSR\Model;
use API\SSR\Utils\Functions;
use API\SSR\Classes\PreflightAction;
use API\SSR\Classes\ControllerInterface;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use Slim\Views\Twig;

class Controller implements ControllerInterface
{
    private $model;
    private $response;
    private $base_url;

    private $menus;
    private $pages;
    private $widgets;
    private $sections;
    private $info_items;
    private $menu_items;
    private $menu_locations;
    private $item_data = '';
    private $news_categories;
    private $widgets_json_data;
    private $sections_json_data;

    public function __construct()
    {
        $this->model = new Model();

        $this->base_url = Functions::getBaseUrl();
    }

    private function setInitialData($content)
    {
        return Functions::escapeBracesInterpolation(str_replace(
            "<!-- GENERATED BODY CONTENT -->",
            "
                <script>
                    window.menus = " . json_encode($this->menus) . ";
                    window.pages = " . json_encode($this->pages) . ";
                    window.widgets = " . json_encode($this->widgets) . ";
                    window.sections = " . json_encode($this->sections) . ";
                    window.infoItems = " . json_encode($this->info_items) . ";
                    window.menuItems = " . json_encode($this->menu_items) . ";
                    window.menuLocations = " . json_encode($this->menu_locations) . ";
                    window.newsCategories = " . json_encode($this->news_categories) . ";
                    window.widgetsJsonData = " .  $this->widgets_json_data . ";
                    window.sectionsJsonData = " . $this->sections_json_data . ";
                    window.itemData = " . json_encode($this->item_data) . ";
                </script>
            ",
            $content
        ));
    }

    private function fetchInitialData()
    {
        $menu_table = Functions::resolveTableName('menu');
        $page_table = Functions::resolveTableName('page');
        $widget_table = Functions::resolveTableName('widget');
        $section_table = Functions::resolveTableName('section');
        $info_table = Functions::resolveTableName('website_info');
        $news_category_table = Functions::resolveTableName('news_category');
        $menu_location_table = Functions::resolveTableName('menu_location');

        $snp1 = $this->model->getItems($menu_table);
        $snp2 = $this->model->getItems($page_table);
        $snp3 = $this->model->getItems($info_table);
        $snp4 = $this->model->getItems($widget_table);
        $snp5 = $this->model->getItems($section_table);
        $snp6 = $this->model->getItems($news_category_table);
        $snp7 = $this->model->getItems($menu_location_table);

        $this->menus = $snp1->fetchAll(\PDO::FETCH_OBJ);
        $this->pages = $snp2->fetchAll(\PDO::FETCH_OBJ);
        $this->widgets = $snp4->fetchAll(\PDO::FETCH_OBJ);
        $this->sections = $snp5->fetchAll(\PDO::FETCH_OBJ);
        $this->info_items = $snp3->fetchAll(\PDO::FETCH_OBJ);
        $this->menu_locations = $snp7->fetchAll(\PDO::FETCH_OBJ);
        $this->news_categories = $snp6->fetchAll(\PDO::FETCH_OBJ);

        $this->widgets_json_data = file_exists(__DIR__ . '/../widgets/index.json') ? json_encode(json_decode(file_get_contents(__DIR__ . '/../widgets/index.json')), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) : '';
        $this->sections_json_data = file_exists(__DIR__ . '/../sections/index.json') ? json_encode(json_decode(file_get_contents(__DIR__ . '/../sections/index.json')), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) : '';
    }

    private function fetchWebsiteInfo()
    {
        $title_info_item = $this->getItem($this->info_items, 'TITLE', 'name');
        $description_info_item = $this->getItem($this->info_items, 'DESCRIPTION', 'name');
        $main_logo_info_item = $this->getItem($this->info_items, 'MAIN_LOGO', 'name');
        $favicon_info_item = $this->getItem($this->info_items, 'FAVICON', 'name');
        $keywords_item = $this->getItem($this->info_items, 'META_KEYS', 'name');

        $description = json_decode($description_info_item->value);
        $title = json_decode($title_info_item->value);
        $favicon = $favicon_info_item->value;
        $main_logo = $main_logo_info_item->value;
        $keywords = str_replace(';', ',', $keywords_item->value);

        return (object) [
            'title' => $title,
            'favicon' => $favicon,
            'keywords' => $keywords,
            'main_logo' => $main_logo,
            'description' => $description
        ];
    }

    private function fetchNewsArticleContent($request, $content, $params)
    {

        $news_article_table = Functions::resolveTableName('news_article');
        $snp = NULL;

        if ($params[0] == 'id') {

            $snp = $this->model->getItemById($request->getAttribute('id'), $news_article_table);
        } else if ($params[0] == 'slug') {

            $snp = $this->model->getItemBySlug($request->getAttribute('slug'), $news_article_table);
        } else return $this->fetchDefaultContent($content);

        if (is_null($snp)) {

            return $this->fetchDefaultContent($content);
        } else {
            $article = $snp->fetch(\PDO::FETCH_OBJ);

            $this->item_data = $article;

            $title = json_decode($article->title);
            $summary = json_decode($article->summary);

            $info = $this->fetchWebsiteInfo();

            $content1 = $this->setInitialData($content);

            return str_replace(
                "<!-- GENERATED HEAD CONTENT -->",
                "
                    <title>{$title->FR} - {$info->title->FR}</title>

                    <link rel=\"shortcut icon\" href=\"{$this->base_url}/breeze-server/sto-api/" . Functions::replaceEmptySpaces($info->favicon) . "\"/>
                    <meta name=\"description\" content=\"{$summary->FR}\"/>
                    <meta name=\"keywords\" content=\"{$info->keywords}\"/>

                    <meta property=\"og:site_name\" content=\"{$info->title->FR}\"/>
                    <meta property=\"og:title\" content=\"{$title->FR}\"/>
                    <meta property=\"og:description\" content=\"{$summary->FR}\"/>
                    <meta property=\"og:image\" content=\"{$this->base_url}/breeze-server/sto-api/" . Functions::replaceEmptySpaces($article->featured_image) . "\"/>
                    <meta property=\"og:type\" content=\"article\"/>
                    <meta property=\"og:locale\" content=\"FR\"/>
                    <meta property=\"og:url\" content=\"{$this->base_url}\"/>

                    <meta name=\"twitter:card\" content=\"summary_large_image\"/>
                    <meta name=\"twitter:title\" content=\"{$title->FR}\"/>
                    <meta name=\"twitter:description\" content=\"{$summary->FR}\"/>
                    <meta name=\"twitter:image\" content=\"{$this->base_url}/breeze-server/sto-api/" . Functions::replaceEmptySpaces($article->featured_image) . "\"/>
                    <meta name=\"twitter:image:alt\" content=\"{$title->FR}\"/>
                ",
                $content1
            );
        }
    }

    private function fetchNewsCategoryContent($request, $content, $params)
    {

        $news_category_table = Functions::resolveTableName('news_category');
        $snp = NULL;

        if ($params[0] == 'id') {

            $snp = $this->model->getItemById($request->getAttribute('id'), $news_category_table);
        } else if ($params[0] == 'slug') {

            $snp = $this->model->getItemBySlug($request->getAttribute('slug'), $news_category_table);
        } else return $this->fetchDefaultContent($content);

        if (is_null($snp)) {

            return $this->fetchDefaultContent($content);
        } else {
            $category = $snp->fetch(\PDO::FETCH_OBJ);

            $this->item_data = $category;

            $name = json_decode($category->name);
            $description = json_decode($category->description);

            $info = $this->fetchWebsiteInfo();

            $preview = $category->preview ?? $info->main_logo;

            $content1 = $this->setInitialData($content);

            return str_replace(
                "<!-- GENERATED HEAD CONTENT -->",
                "
                    <title>{$name->FR} - {$info->title->FR}</title>

                    <link rel=\"shortcut icon\" href=\"{$this->base_url}/breeze-server/sto-api/" . Functions::replaceEmptySpaces($info->favicon) . "\"/>
                    <meta name=\"description\" content=\"{$description->FR}\"/>
                    <meta name=\"keywords\" content=\"{$info->keywords}\"/>

                    <meta property=\"og:site_name\" content=\"{$info->title->FR}\"/>
                    <meta property=\"og:title\" content=\"{$name->FR}\"/>
                    <meta property=\"og:description\" content=\"{$description->FR}\"/>
                    <meta property=\"og:image\" content=\"{$this->base_url}/breeze-server/sto-api/" . Functions::replaceEmptySpaces($preview) . "\"/>
                    <meta property=\"og:type\" content=\"article\"/>
                    <meta property=\"og:locale\" content=\"FR\"/>
                    <meta property=\"og:url\" content=\"{$this->base_url}\"/>

                    <meta name=\"twitter:card\" content=\"summary_large_image\"/>
                    <meta name=\"twitter:title\" content=\"{$name->FR}\"/>
                    <meta name=\"twitter:description\" content=\"{$description->FR}\"/>
                    <meta name=\"twitter:image\" content=\"{$this->base_url}/breeze-server/sto-api/" . Functions::replaceEmptySpaces($preview) . "\"/>
                    <meta name=\"twitter:image:alt\" content=\"{$name->FR}\"/>
                ",
                $content1
            );
        }
    }

    private function fetchECommerceProductContent($request, $content, $params)
    {

        $ec_product_table = Functions::resolveTableName('e_commerce_product');
        $snp = NULL;

        if ($params[0] == 'id') {

            $snp = $this->model->getItemById($request->getAttribute('id'), $ec_product_table);
        } else return $this->fetchDefaultContent($content);

        if (is_null($snp)) {

            return $this->fetchDefaultContent($content);
        } else {
            $product = $snp->fetch(\PDO::FETCH_OBJ);

            $this->item_data = $product;

            $name = json_decode($product->name);
            $description = json_decode($product->short_description);

            $info = $this->fetchWebsiteInfo();

            $content1 = $this->setInitialData($content);

            return str_replace(
                "<!-- GENERATED HEAD CONTENT -->",
                "
                    <title>{$name->FR} - {$info->title->FR}</title>

                    <link rel=\"shortcut icon\" href=\"{$this->base_url}/breeze-server/sto-api/" . Functions::replaceEmptySpaces($info->favicon) . "\"/>
                    <meta name=\"description\" content=\"{$description->FR}\"/>
                    <meta name=\"keywords\" content=\"{$info->keywords}\"/>

                    <meta property=\"og:site_name\" content=\"{$info->title->FR}\"/>
                    <meta property=\"og:title\" content=\"{$name->FR}\"/>
                    <meta property=\"og:description\" content=\"{$description->FR}\"/>
                    <meta property=\"og:image\" content=\"{$this->base_url}/breeze-server/sto-api/" . Functions::replaceEmptySpaces($info->main_logo) . "\"/>
                    <meta property=\"og:type\" content=\"article\"/>
                    <meta property=\"og:locale\" content=\"FR\"/>
                    <meta property=\"og:url\" content=\"{$this->base_url}\"/>

                    <meta name=\"twitter:card\" content=\"summary_large_image\"/>
                    <meta name=\"twitter:title\" content=\"{$name->FR}\"/>
                    <meta name=\"twitter:description\" content=\"{$description->FR}\"/>
                    <meta name=\"twitter:image\" content=\"{$this->base_url}/breeze-server/sto-api/" . Functions::replaceEmptySpaces($info->main_logo) . "\"/>
                    <meta name=\"twitter:image:alt\" content=\"{$name->FR}\"/>
                ",
                $content1
            );
        }
    }

    private function fetchECommerceCategoryContent($request, $content, $params)
    {

        $ec_category_table = Functions::resolveTableName('e_commerce_category');
        $snp = NULL;

        if ($params[0] == 'id') {

            $snp = $this->model->getItemById($request->getAttribute('id'), $ec_category_table);
        } else if ($params[0] == 'slug') {

            $snp = $this->model->getItemBySlug($request->getAttribute('slug'), $ec_category_table);
        } else return $this->fetchDefaultContent($content);

        if (is_null($snp)) {

            return $this->fetchDefaultContent($content);
        } else {
            $category = $snp->fetch(\PDO::FETCH_OBJ);

            $this->item_data = $category;

            $name = json_decode($category->name);
            $description = json_decode($category->description);

            $info = $this->fetchWebsiteInfo();

            $preview = $category->preview ?? $info->main_logo;

            $content1 = $this->setInitialData($content);

            return str_replace(
                "<!-- GENERATED HEAD CONTENT -->",
                "
                    <title>{$name->FR} - {$info->title->FR}</title>

                    <link rel=\"shortcut icon\" href=\"{$this->base_url}/breeze-server/sto-api/" . Functions::replaceEmptySpaces($info->favicon) . "\"/>
                    <meta name=\"description\" content=\"{$description->FR}\"/>
                    <meta name=\"keywords\" content=\"{$info->keywords}\"/>

                    <meta property=\"og:site_name\" content=\"{$info->title->FR}\"/>
                    <meta property=\"og:title\" content=\"{$name->FR}\"/>
                    <meta property=\"og:description\" content=\"{$description->FR}\"/>
                    <meta property=\"og:image\" content=\"{$this->base_url}/breeze-server/sto-api/" . Functions::replaceEmptySpaces($preview) . "\"/>
                    <meta property=\"og:type\" content=\"article\"/>
                    <meta property=\"og:locale\" content=\"FR\"/>
                    <meta property=\"og:url\" content=\"{$this->base_url}\"/>

                    <meta name=\"twitter:card\" content=\"summary_large_image\"/>
                    <meta name=\"twitter:title\" content=\"{$name->FR}\"/>
                    <meta name=\"twitter:description\" content=\"{$description->FR}\"/>
                    <meta name=\"twitter:image\" content=\"{$this->base_url}/breeze-server/sto-api/" . Functions::replaceEmptySpaces($preview) . "\"/>
                    <meta name=\"twitter:image:alt\" content=\"{$name->FR}\"/>
                ",
                $content1
            );
        }
    }

    private function fetchDefaultContent($content)
    {

        $info = $this->fetchWebsiteInfo();

        $content1 = $this->setInitialData($content);

        return str_replace(
            "<!-- GENERATED HEAD CONTENT -->",
            "
                <title>{$info->title->FR}</title>

                <link rel=\"shortcut icon\" href=\"{$this->base_url}/breeze-server/sto-api/" . Functions::replaceEmptySpaces($info->favicon) . "\"/>
                <meta name=\"description\" content=\"{$info->description->FR}\"/>
                <meta name=\"keywords\" content=\"{$info->keywords}\"/>

                <meta property=\"og:site_name\" content=\"{$info->title->FR}\"/>
                <meta property=\"og:title\" content=\"{$info->title->FR}\"/>
                <meta property=\"og:description\" content=\"{$info->description->FR}\"/>
                <meta property=\"og:image\" content=\"{$this->base_url}/breeze-server/sto-api/" . Functions::replaceEmptySpaces($info->main_logo) . "\"/>
                <meta property=\"og:type\" content=\"website\"/>
                <meta property=\"og:locale\" content=\"FR\"/>
                <meta property=\"og:url\" content=\"{$this->base_url}\"/>

                <meta name=\"twitter:card\" content=\"summary_large_image\"/>
                <meta name=\"twitter:title\" content=\"{$info->title->FR}\"/>
                <meta name=\"twitter:description\" content=\"{$info->description->FR}\"/>
                <meta name=\"twitter:image\" content=\"{$this->base_url}/breeze-server/sto-api/" . Functions::replaceEmptySpaces($info->main_logo) . "\"/>
                <meta name=\"twitter:image:alt\" content=\"{$info->title->FR}\"/>
            ",
            $content1
        );
    }

    private function fetchContent($request, $type = 'default', $params = [])
    {

        $view = Twig::fromRequest($request);

        $content = file_exists(__DIR__ . '/templates/index.html') ? file_get_contents(__DIR__ . '/templates/index.html') : '';

        $this->fetchInitialData();

        if (!empty($content)) {

            if (count($params) > 0) {

                switch ($type) {

                    case 'news_article':
                        $content = $this->fetchNewsArticleContent($request, $content, $params);
                        break;

                    case 'news_category':
                        $content = $this->fetchNewsCategoryContent($request, $content, $params);
                        break;

                    case 'e_commerce_product':
                        $content = $this->fetchECommerceProductContent($request, $content, $params);
                        break;

                    case 'e_ecommerce_category':
                        $content = $this->fetchECommerceCategoryContent($request, $content, $params);
                        break;

                    default:
                        $content = $this->fetchDefaultContent($content);
                        break;
                }
            } else $content = $this->fetchDefaultContent($content);
        }

        return Functions::minify($view->fetchFromString($content, [
            'lang' => 'fr'
        ]));
    }

    private function getItem($array, $key, $column)
    {

        $result = NULL;

        foreach ($array as $item) {

            if ($item->{$column} == $key) {

                $result = $item;
            }
        }

        return $result;
    }

    public function addRoutes(App $app)
    {

        try {

            $menu_item_table = Functions::resolveTableName('menu_item');

            $snapshot = $this->model->getItems($menu_item_table);

            $items = $snapshot->fetchAll(\PDO::FETCH_OBJ);

            $this->menu_items = $items;

            $raw_paths = [];

            if (count($items) > 0) {

                foreach ($items as $key => $item) {

                    if (!in_array(trim($item->path), $raw_paths)) {

                        if (trim($item->path) == '/') {

                            $app->get('/', function (Request $request, Response $response) {

                                $this->response = $response;

                                $response->getBody()->write($this->fetchContent($request));

                                return $response->withStatus(200);
                            });
                        } else if (!empty(trim($item->path))) {

                            $path = Functions::endsWith(trim($item->path), '/') ? trim($item->path) : trim($item->path) . '/';
                            $params = [];

                            if (preg_match_all('#:(.*?)\/#i', $path, $matches)) {
                                for ($y = 0; $y < count($matches[0]); $y++) {
                                    $path = str_replace($matches[0][$y], '{' . $matches[1][$y] . '}/', $path);
                                }

                                $params = $matches[1];
                            }

                            $path = rtrim($path, '/');

                            $app->get($path, function (Request $request, Response $response) use ($params, $path) {

                                $this->response = $response;
                                $type = 'default';

                                if (preg_match('#\/(article|art)\/#i', $path)) {
                                    $type = 'news_article';
                                } else if (preg_match('#\/(category|categorie|categ)\/#i', $path)) {
                                    $type = 'news_category';
                                } else if (preg_match('#\/(category|categorie|categ)\/e\/#i', $path)) {
                                    $type = 'e_commerce_category';
                                } else if (preg_match('#\/(product|produit|prod)\/#i', $path)) {
                                    $type = 'e_commerce_product';
                                } else if (preg_match('#\/(article|art)\/e\/#i', $path)) {
                                    $type = 'e_commerce_product';
                                }

                                $response->getBody()->write($this->fetchContent($request, $type, $params));

                                return $response->withStatus(200);
                            });
                        }

                        array_push($raw_paths, trim($item->path));
                    }
                }
            } else {

                $app->get('/', function (Request $request, Response $response) {

                    $this->response = $response;

                    $response->getBody()->write($this->fetchContent($request));

                    return $response->withStatus(200);
                });
            }
        } catch (\PDOException $e) {

            $error = array("message" => $e->getMessage());

            $this->response->getBody()->write(json_encode($error));

            return $this->response->withHeader('content-type', 'application/json')->withStatus(500);
        }

        $app->options('/', new PreflightAction());
    }
}
