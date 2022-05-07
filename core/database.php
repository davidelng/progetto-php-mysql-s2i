<?php

class Database
{
    protected $connection;

    // protected
    //     $connection,
    //     $connectionOpen = false;

    // function isConnectionOpen()
    // {
    //     return $this->connectionOpen;
    // }

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
            // $this->connectionOpen = true;
        } catch (PDOException $e) {
            // $this->connectionOPen = false;
            echo 'Connection error: ' . $e->getMessage();
            exit;
        }
    }
}
