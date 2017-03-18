<?php

/**
 * Created by PhpStorm.
 * User: ikneb
 * Date: 23.09.2016
 * Time: 23:57
 */
class Database
{

    private $conn;
    private $host = 'localhost';
    private $db = 'test';
    private $charset = 'utf8mb4';

    public function connect_db()
    {
        $opt = array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        );
        $dsn = "mysql:host=$this->host;dbname=$this->db;charset=$this->charset";

        $this->conn = new PDO($dsn, 'root', '', $opt);
        return $this->conn;
    }


    public function createTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS test (
            id int(11) AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(50) NOT NULL,
            artistname varchar(30) NOT NULL)";
        $this->conn->query($sql);
    }


    public function insertData($name, $artistname)
    {
        $stmt = $this->conn->prepare("INSERT INTO test (name, artistname) VALUES (:name, :artistname)");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':artistname', $artistname);
        $stmt->execute();
    }

    public function updateData($name,$artistname,$id)
    {
        $name = htmlspecialchars($name);
        $id = (int)$id;
        $l_theQuery = "UPDATE test SET name='$name', artistname='$artistname' WHERE id=$id";
        $l_stmt = $this->conn->prepare($l_theQuery);
        $l_stmt->execute();

    }

    public function deleteData($id)
    {
        $l_theQuery = "DELETE FROM test WHERE name = $id";
        $l_stmt = $this->conn->prepare($l_theQuery);
        $l_stmt->execute();
    }

    public function selectData()
    {
        $pass = $this->conn->query("
        SELECT * FROM test WHERE  name='Den' AND id=1");
        $result = $pass->fetchAll();
        return $result;
    }

}