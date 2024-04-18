<?php
/*
 *  Results
 *  -------
 *  You should retreive the customer's flight results from the database and output them to the customer's browser. The flights should be
 *  styled with an external CSS file to match the design screenshot in the exercise question.
 */


require 'vendor/autoload.php';

use App\Database;
use App\Services\FlightDatabase;

header('Content-Type: application/json');

$db = new Database();
$flightDatabase = new FlightDatabase($db);

$searchId = $_GET['searchId'] ?? '';

if (!$searchId) {
    echo json_encode(['error' => 'Search ID is missing']);
    exit();
}

$flights = $flightDatabase->getFlightsBySearchId($searchId);

echo json_encode(['flights' => $flights]);

?>