<?php

class City
{
    protected $pdo;

    function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    function selectAll()
    {
        $sql = "SELECT cities.id, cities.name FROM cities;";
        $st = $this->pdo->getConnection()->prepare($sql);
        $st->execute();
        var_dump($st->fetchAll(PDO::FETCH_ASSOC));
    }

    function create()
    {
        $sql = "INSERT INTO cities (name) VALUES ('Bruxelles');";
        $st = $this->pdo->getConnection()->prepare($sql);
        $st->execute();
    }

    function update()
    {
        $sql = "UPDATE cities SET name = 'Palermo' WHERE id = 8;";
        $st = $this->pdo->getConnection()->prepare($sql);
        $st->execute();
    }

    function delete()
    {
        $sql = "DELETE FROM cities WHERE id = 8;";
        $st = $this->pdo->getConnection()->prepare($sql);
        $st->execute();
    }
}
