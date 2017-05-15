<?php

/**
 * Created by PhpStorm.
 * User: carlo
 * Date: 14/05/2017
 * Time: 02:13
 */
class Sql extends PDO
{
    private $conn;

    public function __construct()
    {
        $this->conn = new PDO("mysql:dbname=dbphp7;host=localhost", "root", "root");
    }

    private function prepareSql($sql, $params = [])
    {
        $stmt = $this->conn->prepare($sql);

        if(count($params) > 1)
        {
            $this->setParams($stmt, $params);
        } else {
            foreach($params as $key => $value)
            {
                $this->setParam($stmt, $key, $value);
            }

        }

        $stmt->execute();
        return $stmt;
    }

    public function select($sql, $params = [])
    {
        $stmt = $this->prepareSql($sql, $params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    private function setParam($statment, $key, $value)
    {
        $statment->bindParam($key, $value);
    }

    private function setParams($statment, $params = [])
    {
        foreach($params as $key => $value)
        {
            $statment->bindParam($key, $value);
        }
    }
}