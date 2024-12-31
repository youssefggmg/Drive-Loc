<?php
class connection {
    private static $instatns =null ;
    private $conn = null;
    private $host = "localhost" ;
    private $dbName = "Drive_Loc";
    private $password = '';
    private $userName = "root";
    private function __construct(){
        try {
            $dsn = "mysql:host={$this->host};dbname={$this->dbName};charset=utf8";
            $this->conn = new PDO($dsn,$this->userName,$this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("there is an error".$e->getMessage());
        }
    }
    public static function getInstance(){
        if (self::$instatns==null) {
            self::$instatns= new connection();
        }
        return self ::$instatns;
    }
    public function getconnection(){
        return $this->conn;
    }
}
?>