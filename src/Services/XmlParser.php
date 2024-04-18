<?php

namespace App\Services;

use App\Interfaces\XmlParserInterface;

class XmlParser implements XmlParserInterface
{
    public function parseXml(string $xmlString): array
    {
        $xml = simplexml_load_string($xmlString);

        if (!$xml) {
            throw new \Exception('Error parsing XML response');
        }

        $searchId = (string) $xml['searchid'] ?? '';
        $flights = [];

        foreach ($xml->Flight as $flight) {
            $flights[] = [
                'flightNumber' => (string) $flight->Airline,
                'departureTime' => (int) $flight->DepartureDateTime,
                'arrivalTime' => (int) $flight->ArrivalDateTime,
                'price' => (float) $flight->Price,
            ];
        }

        return [
            'searchId' => $searchId,
            'flights' => $flights,
        ];
    }
}

