<?php
use Libs\Config;

$config = Config::singleton();

//Estructura de carpetas
define('ROOT_DIR', realpath(dirname(__FILE__)) . "/");
define('BASE_URL', $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['SERVER_NAME'] . ":" . $_SERVER["SERVER_PORT"] .
    strstr($_SERVER["PHP_SELF"], basename($_SERVER["PHP_SELF"]), true));

$config->set('controllersFolder', ROOT_DIR . 'controllers/');
$config->set('modelsFolder',      ROOT_DIR . 'models/');
$config->set('viewsFolder',       ROOT_DIR . 'views/');
$config->set('assetsFolder',      BASE_URL . 'assets/');
$config->set('assetsPath',        ROOT_DIR . 'assets/');
$config->set('jsFolder',          BASE_URL . 'assets/js/');
$config->set('jsPath',            ROOT_DIR . 'assets/js/');
$config->set('cssFolder',         BASE_URL . 'assets/css/');
$config->set('cssPath',           ROOT_DIR . 'assets/css/');
$config->set('imgFolder',         BASE_URL . 'assets/img/');
$config->set('libsURL',           BASE_URL . 'libs/');
$config->set('libsFolder',        ROOT_DIR . 'libs/');

//Bases de datos
$config->set('MYSQL_DSN', 'mysql:host=localhost;dbname=work');
$config->set('MYSQL_USER', 'root');
$config->set('MYSQL_PASS', '');
