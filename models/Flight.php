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

    function selectByCity()
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
        WHERE c1.name = 'Roma' OR c2.name = 'Roma'
        ;";
        $st = $this->pdo->getConnection()->prepare($sql);
        $st->execute();
        // $st->fetchAll(PDO::FETCH_ASSOC);
        var_dump($st->fetchAll(PDO::FETCH_ASSOC));
    }

    function selectBySeats()
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
        HAVING flights.availableSeats >= 30
        ;";
        $st = $this->pdo->getConnection()->prepare($sql);
        $st->execute();
        // $st->fetchAll(PDO::FETCH_ASSOC);
        var_dump($st->fetchAll(PDO::FETCH_ASSOC));
    }

    function create()
    {
        $sql = "INSERT INTO flights (departure, arrival, availableSeats) VALUES (3, 7, 18)";
        $st = $this->pdo->getConnection()->prepare($sql);
        $st->execute();
    }

    function update()
    {
        $sql = "
            UPDATE flights 
            SET 
                departure = 3, 
                arrival = 2, 
                availableSeats = 14 
            WHERE id = 5";
        $st = $this->pdo->getConnection()->prepare($sql);
        $st->execute();
    }

    function delete()
    {
        $sql = "DELETE FROM flights WHERE id = 5";
        $st = $this->pdo->getConnection()->prepare($sql);
        $st->execute();
    }
}
