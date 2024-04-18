<?php

namespace App\Services;

use App\Database;
use PDO;

class FlightDatabase
{
    private Database $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function insertFlights(array $flights, string $searchId, string $departureAirport, string $destinationAirport): void
    {
        $sql = "INSERT INTO flights (searchid, departureairport, destinationairport, departuredatetime, arrivaldatetime, airlinecode, price) 
                    VALUES (:searchid, :departureairport, :destinationairport, :departuredatetime, :arrivaldatetime, :airlinecode, :price)";

        $stmt = $this->db->getConnection()->prepare($sql);

        foreach ($flights as $flight) {
            $stmt->bindParam(':searchid', $searchId);
            $stmt->bindParam(':departureairport', $departureAirport);
            $stmt->bindParam(':destinationairport', $destinationAirport);
            $stmt->bindParam(':departuredatetime', $flight['departureTime']);
            $stmt->bindParam(':arrivaldatetime', $flight['arrivalTime']);
            $stmt->bindParam(':airlinecode', $flight['flightNumber']);
            $stmt->bindParam(':price', $flight['price']);

            $stmt->execute();
        }
    }

    public function getFlightsBySearchId(string $searchId): array
    {
        $sql = "SELECT airlinecode AS airline_code,
                   departuredatetime AS departure_time,
                   arrivaldatetime AS arrival_time,
                   departureairport as departure_airport,
                   destinationairport as destination_airport,
                   price
            FROM flights
            WHERE searchid = ?";

        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->execute([$searchId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


}
