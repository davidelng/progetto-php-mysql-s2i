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

    function create(array $data)
    {
        $sql = "INSERT INTO cities (name) VALUES (:name);";
        $st = $this->pdo->getConnection()->prepare($sql);
        $params = array('name' => $data['name']);
        $st->execute($params);
    }

    function update($id, array $data)
    {
        $sql = "UPDATE cities SET name = :name WHERE id = :id;";
        $st = $this->pdo->getConnection()->prepare($sql);
        $params = array('id' => $id, 'name' => $data['name']);
        $st->execute($params);
    }

    function delete($id)
    {
        $sql = "DELETE FROM cities WHERE id = :id;";
        $st = $this->pdo->getConnection()->prepare($sql);
        $params = array('id' => $id);
        $st->execute($params);
    }
}
