<?php
namespace Models;

use Libs\SPDO;
use Libs\Config;

/**
* LoginModel
*/
class LoginModel
{
    private $table_name = "users";
    private $db = null;

    public function __construct()
    {
        $config = Config::singleton();

        $this->db = SPDO::singleton($config->get('MYSQL_DSN'), $config->get('MYSQL_USER'), $config->get('MYSQL_PASS'));
    }

    public function getUsuariosActivos()
    {
        try {
            $consulta = $this->db->prepare("SELECT * FROM $this->table_name WHERE active = 1");
            $consulta->execute();
        } catch (PDOException $e) {
            $this->db->error($e);
        }

        return $consulta;
    }

    public function login($username, $password)
    {
        try {
            $consulta = $this->db->prepare("SELECT * FROM $this->table_name WHERE username=:username AND password=:password AND active = 1");
        } catch (PDOException $e) {
            $this->db->error($e);
        }
        $consulta->bindParam(":username", $username, SPDO::PARAM_STR);
        $consulta->bindParam(":password", $password, SPDO::PARAM_STR);
        try {
            $consulta->execute();
        } catch (PDOException $e) {
            $this->db->error($e);
        }

        return $consulta;
    }

    public function register($usuario, $departamento, $contrasena)
    {
        try {
            $consulta = $this->db->prepare("INSERT INTO $this->table_name(usuario, departamento, contrasena, registrado) VALUES(:usuario, :departamento, :contrasena, NOW())");
        } catch (PDOException $e) {
            $this->db->error($e);
        }
        $consulta->bindParam(":usuario", $usuario, SPDO::PARAM_STR);
        $consulta->bindParam(":departamento", $departamento, SPDO::PARAM_STR);
        $consulta->bindParam(":contrasena", $contrasena, SPDO::PARAM_STR);
        try {
            $consulta->execute();
        } catch (PDOException $e) {
            $this->db->error($e);
        }

        return $consulta;
    }
}
