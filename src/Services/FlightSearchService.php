<?php

namespace App\Services;

use App\Interfaces\FlightSearchInterface;

class FlightSearchService implements FlightSearchInterface
{
    private string $apiKey;
    private string $baseUrl = "https://www.vibe.travel/interview";

    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
    }

    public function searchFlights(string $departureCode, string $destinationCode, int $departureDate): string
    {
        $headers = array(
            'Accept: application/xml',
        );
        $url = "{$this->baseUrl}?apiKey={$this->apiKey}&departureCode={$departureCode}&destinationCode={$destinationCode}&departureDate={$departureDate}";
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            throw new \Exception('Error fetching flight data: ' . curl_error($ch));
        }

        curl_close($ch);

        return $response;
    }
}
