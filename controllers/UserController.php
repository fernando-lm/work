<?php
namespace Controllers;

use Libs\Config;
use Libs\SPDO;
use \Delight\Auth\Auth;

/**
*
*/
class UserController
{
    protected $db;

    public function __construct()
    {
        $config = Config::singleton();

        $this->db = SPDO::singleton($config->get('MYSQL_DSN'), $config->get('MYSQL_USER'), $config->get('MYSQL_PASS'));
    }

    public function createUser()
    {
        $auth = new Auth($this->db);

        try {
            $userId = $auth->admin()->createUser($_POST['email'], $_POST['password'], $_POST['username']);
        }
        catch (\Delight\Auth\InvalidEmailException $e) {
            // invalid email address
        }
        catch (\Delight\Auth\InvalidPasswordException $e) {
            // invalid password
        }
        catch (\Delight\Auth\UserAlreadyExistsException $e) {
            // user already exists
        }
    }
}