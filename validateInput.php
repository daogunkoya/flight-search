<?php

require 'vendor/autoload.php';

use App\AirportValidator;
use App\Database;

$db = new Database();
$validator = new AirportValidator($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $validationResult = $validator->validateInput($_POST['departure'] ?? '', $_POST['destination'] ?? '');

    $errors = $validationResult['errors'];
    $departure = $validationResult['departure'];
    $destination = $validationResult['destination'];

    if (empty($errors)) {
        // Proceed to searching.php or perform other actions
    }
}

?>
