<?php
require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__, "config.env");
$dotenv->safeLoad();

$host = $_SERVER['HOST'];
$db_name = $_SERVER['DB_NAME'];
$username = $_SERVER['USERNAME'];
$password = $_SERVER['PASSWORD'];


class Database
{
    // DB Params
    private $host = 'localhost';
    private $db_name = "estore";
    private $username = 'lauris';
    private $password = 'password';
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
