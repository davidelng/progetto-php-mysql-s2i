<?php

class Database
{
    protected $connection;

    function getConnection()
    {
        return $this->connection;
    }

    function openConnection($config)
    {
        try {
            $this->connection = new PDO(
                $config['connection'] . ';dbname=' . $config['name'],
                $config['username'],
                $config['password'],
                $config['options']
            );
        } catch (PDOException $e) {
            echo 'Connection error: ' . $e->getMessage();
            exit;
        }
    }

    // function buildQuery($sql, $parameters)
    // {
    //     $st = $this->pdo->gertCOnnection()->prepare($sql);
    //     $st->execute($parameters);
    // }
}
