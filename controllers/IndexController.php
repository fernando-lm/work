<?php
namespace Controllers;

use Models\UserModel;
use Libs\View;

/**
* IndexController
*/
class IndexController
{
    private $userModel = null;
    private $view = null;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->view = new View();
    }

    public function index()
    {
        $this->view->addAssets(array(
            'bower_components\jquery\dist\jquery.min.js',
            'bower_components\bootstrap\dist\js\bootstrap.min.js',
            'bower_components\metisMenu\dist\metisMenu.min.js',
            'bower_components\bootstrap\dist\css\bootstrap.min.css',
            'bower_components\fontawesome\css\font-awesome.min.css',
            'bower_components\metisMenu\dist\metisMenu.min.css',
            'bower_components\flag-icon-css\css\flag-icon.min.css'
        ));
        $this->view->addJS(array(
            'jquery.easing.min.js',
            'sb-admin-2.min.js'
        ));
        $this->view->addCSS(array(
            'sb-admin-2.min.css'
        ));

        $this->view->show("admin/login.php");
    }

    public function tables()
    {
        $this->view->addAssets(array(
            'bower_components\jquery\dist\jquery.min.js',
            'bower_components\bootstrap\dist\js\bootstrap.min.js',
            'bower_components\metisMenu\dist\metisMenu.min.js',
            'bower_components\bootstrap\dist\css\bootstrap.min.css',
            'bower_components\fontawesome\css\font-awesome.min.css',
            'bower_components\metisMenu\dist\metisMenu.min.css',
            'bower_components\flag-icon-css\css\flag-icon.min.css'
        ));
        $this->view->addJS(array(
            'jquery.easing.min.js',
            'sb-admin-2.min.js'
        ));
        $this->view->addCSS(array(
            'sb-admin-2.min.css'
        ));

        $menu['flag'] = $this->getFlag();
        $data['menu'] = $this->view->show("admin/menu.php", $menu, true);
        $this->view->show("admin/tables.php", $data);
    }

    public function users()
    {
        $this->view->addAssets(array(
            'bower_components\jquery\dist\jquery.min.js',
            'bower_components\bootstrap\dist\js\bootstrap.min.js',
            'bower_components\metisMenu\dist\metisMenu.min.js',
            'bower_components\jquery-validation\dist\jquery.validate.min.js',
            'bower_components\bootstrap\dist\css\bootstrap.min.css',
            'bower_components\fontawesome\css\font-awesome.min.css',
            'bower_components\metisMenu\dist\metisMenu.min.css',
            'bower_components\flag-icon-css\css\flag-icon.min.css'
        ));
        $this->view->addJS(array(
            'jquery.easing.min.js',
            'sb-admin-2.min.js'
        ));
        $this->view->addCSS(array(
            'sb-admin-2.min.css'
        ));

        $menu['flag'] = $this->getFlag();
        $data['menu'] = $this->view->show("admin/menu.php", $menu, true);
        $this->view->show("admin/users.php", $data);
    }

    public function lang()
    {
        $_SESSION['lang'] = $_REQUEST['lang'];
        $redirect         = $_REQUEST['redirect'];

        header("location: $redirect");
    }

    private function getFlag()
    {
        $flag = DEFAULT_LANG;

        if (isset($_SESSION['lang'])) {
            $flag = ($_SESSION['lang']=='en')?"gb":$_SESSION['lang'];
        }

        return $flag;
    }
}
