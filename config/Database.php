<?php
require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__, "config.env");
$dotenv->safeLoad();

class Database
{
    // DB Params
    private $host = $_SERVER['HOST'];
    private $db_name = $_SERVER['DB_NAME'];
    private $username = $_SERVER['USERNAME'];
    private $password = $_SERVER['PASSWORD'];
    private $conn;

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
