<?php
namespace SnorkelWeb\DBManager;
use PDO;
class Credentials
{
   

    private $hostname;
    private $username;
    private $password;
    private $dbname;
    private $type;
    public $key;
    
    public function __construct()
    {
        if(file_exists(DATABASE)){
             // Set Empty Array
             $this->fetchini();
           }
    }

    public function Setter($type,$hostname,$username,$password,$dbname)
    {
        $this->type = $type;
        $this->hostname = $hostname;
        $this->username = $username;
        $this->password = $password;
        $this->dbname = $dbname;
    }
    public function type()
    {
        return $this->type;
    }

    public function Hostname()
    {
        return $this->hostname;
    }

    public function Username()
    {
        return $this->username;
    }

    public function Password()
    {
        return $this->password;
    }

    public function Dbname()
    {
        return $this->dbname;
    }

    private function dsn()
    {
        
         return $this->type().":host=".$this->Hostname().";dbname=".$this->Dbname();
         
    }

    public function OpenConnection()
    {
        // echo $this->Hostname();
        return new PDO($this->dsn(),$this->Username(),$this->Password(),$this->Options());
    }


    public function Options()
    {
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        return $options;
    }







    public function fetchini()
    {
        $this->key = [];
        // Get Ini File using Constant
        $file = parse_ini_file(DATABASE);

        foreach($file as $key => $ini)
        {
             $this->key[$key] = $ini;
        }
        
       //  Set individua-l Values
       return $this->key;
   
    }

}
