<?php

namespace API\SSR\Utils;

use Jawira\CaseConverter\Convert;

abstract class Functions
{
    static function getBaseUrl()
    {

        $base_url = (isset($_SERVER['HTTPS']) &&  $_SERVER['HTTPS'] === 'on')  ? "https" : "http";

        $base_url .= "://";

        $base_url .= $_SERVER['HTTP_HOST'];

        if ($_SERVER['SERVER_PORT'] != 80 && $_SERVER['SERVER_PORT'] != 443) {
            $base_url .= ":{$_SERVER['SERVER_PORT']}";
        }

        return $base_url;
    }

    static function getPrefix()
    {
        $paths = [
            "/../../",
            "/../../../",
            "/../../breeze-server/",
            "/../../../breeze-server/",
        ];

        $filename = "config.ini";
        $config = [];

        foreach ($paths as $path) {

            if (file_exists(__DIR__ . $path . $filename)) {

                $config = parse_ini_file(__DIR__ . $path . $filename);

                break;
            }
        }

        if (isset($config['prefix'])) {

            if (self::endsWith($config['prefix'], '_')) return $config['prefix'];

            else return $config['prefix'] . '_';
        }

        return '';
    }

    static function resolveTableName($suffix)
    {
        if (self::startsWith($suffix, self::getPrefix())) return $suffix;

        return self::getPrefix() . $suffix;
    }

    static function getTableNameFromModel($obj)
    {
        $modelName = (new \ReflectionClass($obj))->getShortName();

        $trimmed = str_replace('Model', '', $modelName);

        $converted = new Convert($trimmed);

        return self::resolveTableName($converted->toSnake());
    }

    static function isAssoc(array $arr)
    {
        if (array() === $arr) return false;

        return array_keys($arr) !== range(0, count($arr) - 1);
    }

    static function startsWith($string, $startString)
    {
        $len = strlen($startString);

        return (substr($string, 0, $len) === $startString);
    }

    static function endsWith($string, $endString)
    {
        $len = strlen($endString);

        if ($len == 0) return true;

        return (substr($string, -$len) === $endString);
    }

    static function replaceEmptySpaces($str, $with = '%20')
    {
        return str_replace(' ', $with, $str);
    }

    static function minify($content)
    {
        //remove redundant (white-space) characters
        $replace = array(
            //remove tabs before and after HTML tags
            '/\>[^\S ]+/s'   => '>',
            '/[^\S ]+\</s'   => '<',
            //shorten multiple whitespace sequences; keep new-line characters because they matter in JS!!!
            '/([\t ])+/s'  => ' ',
            //remove leading and trailing spaces
            '/^([\t ])+/m' => '',
            '/([\t ])+$/m' => '',
            // remove JS line comments (simple only); do NOT remove lines containing URL (e.g. 'src="http://server.com/"')!!!
            '~//[a-zA-Z0-9 ]+$~m' => '',
            //remove empty lines (sequence of line-end and white-space characters)
            '/[\r\n]+([\t ]?[\r\n]+)+/s'  => "\n",
            //remove empty lines (between HTML tags); cannot remove just any line-end characters because in inline JS they can matter!
            '/\>[\r\n\t ]+\</s'    => '><',
            //remove "empty" lines containing only JS's block end character; join with next line (e.g. "}\n}\n</script>" --> "}}</script>"
            '/}[\r\n\t ]+/s'  => '}',
            '/}[\r\n\t ]+,[\r\n\t ]+/s'  => '},',
            //remove new-line after JS's function or condition start; join with next line
            '/\)[\r\n\t ]?{[\r\n\t ]+/s'  => '){',
            '/,[\r\n\t ]?{[\r\n\t ]+/s'  => ',{',
            //remove new-line after JS's line end (only most obvious and safe cases)
            '/\),[\r\n\t ]+/s'  => '),',
            //remove quotes from HTML attributes that does not contain spaces; keep quotes around URLs!
            '~([\r\n\t ])?([a-zA-Z0-9]+)="([a-zA-Z0-9_/\\-]+)"([\r\n\t ])?~s' => '$1$2=$3$4', //$1 and $4 insert first white-space character found before/after attribute
        );
        $rContent = preg_replace(array_keys($replace), array_values($replace), $content);

        //remove optional ending tags (see http://www.w3.org/TR/html5/syntax.html#syntax-tag-omission )
        $remove = array(
            '</option>', '</li>', '</dt>', '</dd>', '</tr>', '</th>', '</td>'
        );
        $rContent = str_ireplace($remove, '', $rContent);

        return $rContent;
    }

    static function escapeBracesInterpolation($text)
    {
        return str_replace(['{{', '}}'], ['\{\{', '\}\}'], $text);
    }
}
