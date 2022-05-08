<?php

class Flight
{
    protected $pdo;

    function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    function selectAll()
    {
        $sql = "
        SELECT
            flights.id,
            c1.name as departure,
            c2.name as arrival,
            flights.availableSeats
        FROM flights
        LEFT JOIN cities c1 ON c1.id = flights.departure
        LEFT JOIN cities c2 ON c2.id = flights.arrival
        ORDER BY flights.availableSeats ASC
        ;";
        $st = $this->pdo->getConnection()->prepare($sql);
        $st->execute();
        // $st->fetchAll(PDO::FETCH_ASSOC);
        var_dump($st->fetchAll(PDO::FETCH_ASSOC));
    }

    function selectByCity($city)
    {
        $sql = "
        SELECT
            flights.id,
            c1.name as departure,
            c2.name as arrival,
            flights.availableSeats
        FROM flights
        LEFT JOIN cities c1 ON c1.id = flights.departure
        LEFT JOIN cities c2 ON c2.id = flights.arrival
        WHERE c1.name = :name OR c2.name = :name
        ;";
        $st = $this->pdo->getConnection()->prepare($sql);
        $params = array('name' => $city);
        $st->execute($params);
        // $st->fetchAll(PDO::FETCH_ASSOC);
        var_dump($st->fetchAll(PDO::FETCH_ASSOC));
    }

    function selectBySeats($num)
    {
        $sql = "
        SELECT
            flights.id,
            c1.name as departure,
            c2.name as arrival,
            flights.availableSeats
        FROM flights
        LEFT JOIN cities c1 ON c1.id = flights.departure
        LEFT JOIN cities c2 ON c2.id = flights.arrival
        HAVING flights.availableSeats >= :seats
        ;";
        $st = $this->pdo->getConnection()->prepare($sql);
        $params = array('seats' => $num);
        $st->execute($params);
        // $st->fetchAll(PDO::FETCH_ASSOC);
        var_dump($st->fetchAll(PDO::FETCH_ASSOC));
    }

    function create(array $data)
    {
        $sql = "
            INSERT INTO flights (
                departure, 
                arrival, 
                availableSeats) 
            VALUES (
                :departure, 
                :arrival, 
                :availableSeats
            )";
        $st = $this->pdo->getConnection()->prepare($sql);
        $params = array(
            'departure' => $data['departure'],
            'arrival' => $data['arrival'],
            'availableSeats' => $data['availableSeats']
        );
        $st->execute($params);
    }

    function update($id, array $data)
    {
        $sql = "
            UPDATE flights 
            SET availableSeats = :seats 
            WHERE id = :id";
        $st = $this->pdo->getConnection()->prepare($sql);
        $params = array('id' => $id, 'seats' => $data['availableSeats']);
        $st->execute($params);
    }

    function delete($id)
    {
        $sql = "DELETE FROM flights WHERE id = :id";
        $st = $this->pdo->getConnection()->prepare($sql);
        $params = array('id' => $id);
        $st->execute($params);
    }
}
