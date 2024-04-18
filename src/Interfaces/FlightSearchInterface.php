<?php

namespace App\Interfaces;

interface FlightSearchInterface
{
    public function searchFlights(string $departureCode, string $destinationCode, int $departureDate): string;
}
