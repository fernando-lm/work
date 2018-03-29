<?php
/**
* View - Clase para manejar las vistas
*
* Uso:
* El uso es bastante sencillo:
* $vista = new View();
* $vista->show('listado.php', array("nombre" => "Juan"));
*
*/
namespace Libs;

class View
{
    private $config;
    private $include_js  = "";
    private $include_css = "";

    public function __construct()
    {
        //Traemos una instancia de nuestra clase de configuracion.
        $this->config = Config::singleton();
    }

    public function show($name, $vars = array(), $output = false)
    {
        //Armamos la ruta a la plantilla
        $path = $this->config->get('viewsFolder') . $name;

        //Si no existe el fichero en cuestion, mostramos un 404
        if (file_exists($path) == false) {
            trigger_error('Template `' . $path . '` does not exist.', E_USER_NOTICE);
            return false;
        }

        //Si hay variables para asignar, las pasamos una a una.
        if (is_array($vars)) {
            $vars['include_css']    = $this->include_css;
            $vars['include_js']     = $this->include_js;
            $vars['img_path']       = $this->config->get('imgFolder');
            foreach ($vars as $key => $value) {
                $$key = $value;
            }
        }

        //Finalmente, incluimos la plantilla.
        if ($output) {
            ob_start();
            include($path);
            $template = ob_get_contents();
            ob_end_clean();
            return $template;
        } else {
            include($path);
        }
    }

    public function addJS($js_files = array())
    {
        if (!is_array($js_files)) {
            $js_files = array($js_files);
        }

        $jsFolder = $this->config->get('jsFolder');
        $jsPath   = $this->config->get('jsPath');

        foreach ($js_files as $value) {
            if (($ver = filemtime($jsPath . $value)) !== false) {
                $this->include_js .= "<script type='text/javascript' src='$jsFolder$value?$ver'></script>";
            }
        }
    }

    public function addCSS($css_files = array())
    {
        if (!is_array($css_files)) {
            $css_files = array($css_files);
        }

        $cssFolder = $this->config->get('cssFolder');
        $cssPath   = $this->config->get('cssPath');

        foreach ($css_files as $value) {
            if (($ver = filemtime($cssPath . $value)) !== false) {
                $this->include_css .= "<link rel='stylesheet' type='text/css' href='$cssFolder$value?$ver'>";
            }
        }
    }

    public function addAssets($files = array())
    {
        if (!is_array($files)) {
            $files = array($files);
        }

        $assetsFolder = $this->config->get('assetsFolder');
        $assetsPath   = $this->config->get('assetsPath');

        foreach ($files as $value) {
            if (($ver = filemtime($assetsPath . $value)) !== false) {
                if (pathinfo($value, PATHINFO_EXTENSION) == 'css') {
                    $this->include_css .= "<link rel='stylesheet' type='text/css' href='$assetsFolder$value?$ver'>";
                } elseif (pathinfo($value, PATHINFO_EXTENSION) == 'js') {
                    $this->include_js .= "<script type='text/javascript' src='$assetsFolder$value?$ver'></script>";
                }
            }
        }
    }

    public function setNoCache()
    {
        header("Cache-Control: no-cache, must-revalidate");
        header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
    }

    public function __t($str)
    {
        $assetsPath = $this->config->get('assetsPath');
        $lang = $this->getLang();

        if ($lang !== null) {
            if (file_exists($assetsPath . 'lang/' . $lang . '.php')) {
                include($assetsPath . 'lang/' . $lang . '.php');
                if (isset($lang[$str])) {
                    $str = $lang[$str];
                }
            }
        }

        return $str;
    }

    private function getLang()
    {
        $lang = DEFAULT_LANG;

        if (isset($_SESSION['lang'])) {
            $lang = $_SESSION['lang'];
        }

        return $lang;
    }
}
