<?php

namespace SnorkelWeb\DBManager;

use Closure;
use Exception;
use SnorkelWeb\DBManager\Credentials;
use PDO;

class Connection
{
    private $hostname;
    private $username;
    private $password;
    private $dbname;
    private $type;
    public $credentials;

    public $connection;
    public $bool;

    public function __construct($type = null, $hostname = null, $username = null, $password = null, $dbname = null)
    {
        // Instantiate a new Class;
        $this->credentials = new Credentials();
        is_null($type) ? $this->type = $this->credentials->key["type"] : $this->type = $type;
        is_null($username) ? $this->username = $this->credentials->key["username"] : $this->username = $username;
        is_null($hostname) ? $this->hostname = $this->credentials->key["hostname"] : $this->hostname = $hostname;
        is_null($dbname) ? $this->dbname = $this->credentials->key['dbname'] : $this->dbname = $dbname;
        is_null($password) ? $this->password = $this->credentials->key['password']: $this->password = $password;

// Create Setter
        $this->credentials->Setter($this->type,$this->hostname,$this->username,$this->password,$this->dbname);

        try {
        $this->connection = $this->credentials->OpenConnection();
        } catch (\PDOException $e) {
            $this->bool = false;
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    return $this;
    }

}
