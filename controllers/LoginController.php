<?php
namespace Controllers;

use Libs\View;
use Models\LoginModel;

/**
* LoginController
*/
class LoginController
{
    private $view       = null;
    private $loginModel = null;

    public function __construct()
    {
        $this->loginModel = new LoginModel();
        $this->view = new View();
    }

    public function index()
    {
        $this->show();
    }

    public function login()
    {
        $username = $_REQUEST['username'];
        $password = $_REQUEST['password'];

        $consulta = $this->loginModel->login($username, $password);
        if ($usuarioconsulta = $consulta->fetch()) {
            $_SESSION["username"] = $username;

            header("Location: index.php?accion=tables");
            die();
        } else {
            $this->show("Contraseña incorrecta");
        }
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        session_name('work');
        session_start();
        session_regenerate_id(true);

        header("Location: index.php");
        die();
    }

    public function register()
    {
        if ($_REQUEST['contrasena1r'] == $_REQUEST['contrasena2r']) {
            $consulta = $this->loginModel->register($_REQUEST['usuarior'], $_REQUEST['departamento'], $_REQUEST['contrasena1r']);
            if ($consulta->rowCount()) {
                $this->show("USUARIO REGISTRADO CORRECTAMENTE");
            } else {
                $this->show("Error al registrar el usuario");
            }
        } else {
            $this->show("LAS CONTRASEÑAS NO COINCIDEN");
        }
    }

    private function show($error = "")
    {
        $this->view->addAssets(array(
            'bower_components\jquery\dist\jquery.min.js',
            'bower_components\bootstrap\dist\js\bootstrap.min.js',
            'bower_components\metisMenu\dist\metisMenu.min.js',
            'bower_components\bootstrap\dist\css\bootstrap.min.css',
            'bower_components\fontawesome\css\font-awesome.min.css',
            'bower_components\metisMenu\dist\metisMenu.min.css'
        ));
        $this->view->addJS(array(
            'jquery.easing.min.js',
            'sb-admin-2.min.js'
        ));
        $this->view->addCSS(array(
            'sb-admin-2.min.css'
        ));

        $data['error'] = $error;

        $this->view->show("admin/login.php", $data);
    }
}
