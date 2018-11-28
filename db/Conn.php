<?php
include('Configs.php');
class Conn
{
    private $servername;
    private $username;
    private $password;
    private $database;
    public $conn;
    public function __construct()
    {
        $this->servername = Configs::SQL_SERVER_HOST;
        $this->username = Configs::SQL_SERVER_USER;
        $this->password = Configs::SQL_SERVER_PASSWD;
        $this->database = Configs::SQL_SERVER_DB_NAME;
        $this->conn = mysqli_connect($this->servername,
                               $this->username,
                               $this->password,
                               $this->database);

        $this->queryErrCode = 0;
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
        // else {
            // echo "Connection successfully";
        // }
    }
}
 ?>
