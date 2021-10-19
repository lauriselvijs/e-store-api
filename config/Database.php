<?php
require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__, "config.env");
$dotenv->safeLoad();


class Database
{
    // DB Params
    private $host;
    private $db_name;
    private $username;
    private $password;
    private $conn;


    public function __construct()
    {
        $this->host = $_SERVER['HOST'];
        $this->db_name = $_SERVER['DB_NAME'];
        $this->username = $_SERVER['USERNAME'];
        $this->password = $_SERVER['PASSWORD'];
    }

    // DB Connect
    public function connect()
    {
        $this->conn = null;

        try {
            $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection Error: " . $e->getMessage();
        }

        return $this->conn;
    }
}
