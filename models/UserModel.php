<?php
namespace Models;

use Libs\Config;
use Libs\SPDO;

/**
 * UserModel
 */
class UserModel
{
    protected $db;
    private static $table_name = "users";

    public function __construct()
    {
        $config = Config::singleton();

        $this->db = SPDO::singleton($config->get('MYSQL_DSN'), $config->get('MYSQL_USER'), $config->get('MYSQL_PASS'));
        $this->db->setAttribute(SPDO::ATTR_ERRMODE, SPDO::ERRMODE_EXCEPTION);
    }

    public function getUsers()
    {
        try {
            $consulta = $this->db->prepare("SELECT * FROM " . self::$table_name);
            $consulta->execute();
        } catch (PDOException $e) {
            $this->db->error($e);
        }

        return $consulta;
    }
}
