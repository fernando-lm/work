<?php
/**
* FrontController - Clase para gestionar los controladores del sistema
*
*/
namespace Libs;

use Middlewares\Middleware;

class FrontController
{
    public static function main()
    {
        self::cargarClases();

        require 'config.inc.php'; //Archivo con configuraciones.
        require 'settings.inc.php';
        if (file_exists(__DIR__ . 'vendor/autoload.php')) {
            require __DIR__ . '/vendor/autoload.php';
        }

        //Formamos el nombre del Controlador o en su defecto, tomamos que es el IndexController
        if (!empty($_REQUEST['controlador'])) {
            $controllerName = "Controllers\\" . $_REQUEST['controlador'] . 'Controller';
        } else {
            $controllerName = "Controllers\\" . "IndexController";
        }

        //Lo mismo sucede con las acciones, si no hay acción, tomamos index como acción
        if (!empty($_REQUEST['accion'])) {
            $actionName = $_REQUEST['accion'];
        } else {
            $actionName = "index";
        }

        //Si no existe la clase que buscamos y su acción, mostramos un error 404
        if (is_callable(array($controllerName, $actionName)) == false) {
            trigger_error($controllerName . '->' . $actionName . '` no existe', E_USER_NOTICE);
            return false;
        }

        Middleware::handle();

        //Si todo esta bien, creamos una instancia del controlador y llamamos a la acción
        $controller = new $controllerName();
        $controller->$actionName();
    }

    private static function cargarClases()
    {
        spl_autoload_register(function ($class) {
            $dir = "libs/";
            $classFile = $class . '.php';
            if (is_file($classFile) && !class_exists($class)) {
                require $classFile;
                return;
            } elseif ($gestor = opendir($dir)) {
                while (false !== ($entrada = readdir($gestor))) {
                    $classFile = $dir . $entrada . "/" . basename($class) . '.php';
                    if (is_file($classFile) && !class_exists($class)) {
                        require $classFile;
                        break;
                    }
                }
                closedir($gestor);
            }
        });
    }
}
