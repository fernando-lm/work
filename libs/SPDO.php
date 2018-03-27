<?php
namespace Libs;

use \PDO;
use \PDOException;

/**
* SPDO - Singleton para gestionar la conexion a la base de datos
*
*/
class SPDO extends PDO
{
    private static $instance = null;
    private static $dsn      = null;
    private static $user     = null;
    private static $pass     = null;

    public function __construct()
    {
        try {
            parent::__construct(self::$dsn, self::$user, self::$pass);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public static function singleton($dsn, $user, $pass)
    {
        self::$dsn = $dsn;
        self::$user = $user;
        self::$pass = $pass;
        if (self::$instance == null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public static function error(PDOException $error)
    {
        error_log($error->getMessage());
        if ($error->getCode() != 23000) {
            die($error->getMessage());
        }
    }
}
