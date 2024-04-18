<?php

require 'vendor/autoload.php';

use App\AirportValidator;
use App\Database;
use App\Services\FlightDatabase;
use App\Services\FlightSearchService;
use App\Services\XmlParser;

$db = new Database();
$validator = new AirportValidator($db);
$config = require 'src/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $validationResult = $validator->validateInput($_POST['departure'] ?? '',
        $_POST['destination'] ?? '',
        $_POST['date'] ?? '');

    $errors = $validationResult['errors'];
    $departure = $validationResult['departure'];
    $destination = $validationResult['destination'];
    $departureDate = $validationResult['departureDate'];  // Example timestamp for departure date

    if (empty($errors)) {
        try {
            $flightSearch = new FlightSearchService($config['api_key']);

            // Search for flights
            $xmlResponse = $flightSearch->searchFlights($departure, $destination, $departureDate);
            $xmlParser = new XmlParser();

            // Parse XML
            $parsedFlights = $xmlParser->parseXml($xmlResponse);

            $searchId = $parsedFlights['searchId'] ?? '';

            $flightDatabase = new FlightDatabase($db);
            $flightDatabase->insertFlights($parsedFlights['flights'] ?? [], $searchId, $departure, $destination);

            // Return searchId as response
            echo json_encode(['searchId' => $searchId]);

        } catch (\Exception $e) {
            $errors[] = $e->getMessage();
        }
    } else {
        echo json_encode(['errors' => $errors]);
    }
}
