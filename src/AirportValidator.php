<?php

namespace App;

class AirportValidator
{
    private Database $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function isValidAirportCode(string $code): bool
    {
        $sql = "SELECT COUNT(*) as count FROM airports WHERE code = ?";
        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->execute([$code]);

        $result = $stmt->fetch();

        return $result['count'] > 0;
    }

    public function validateInput(string $departure, string $destination, string $departureDate): array
    {
        $departure = $this->sanitizeAirportCode($departure);
        $destination = $this->sanitizeAirportCode($destination);

        $errors = [];

        if (empty($departure) || empty($destination)) {
            $errors[] = "Departure and destination airports are required.";
        }

        if ($departure === $destination) {
            $errors[] = "Departure and destination airports cannot be the same.";
        }

        if (!$this->isValidAirportCode($departure)) {
            $errors[] = "Invalid departure airport code!";
        }

        if (!$this->isValidAirportCode($destination)) {
            $errors[] = "Invalid destination airport code!";
        }

        // Validate and convert departure date to Unix timestamp
        $departureDateTimestamp = $this->validateAndConvertDate($departureDate, 'Y-m-d');

        if (!$departureDateTimestamp) {
            $errors[] = "Invalid departure date format! Please use YYYY-MM-DD.";
        }

        return [
            'errors' => $errors,
            'departure' => $departure,
            'destination' => $destination,
            'departureDate' => $departureDateTimestamp,
        ];
    }

    private function sanitizeAirportCode(string $code): string
    {
        return htmlspecialchars(trim($code), ENT_QUOTES, 'UTF-8');
    }

    private function validateAndConvertDate(string $dateString, string $format): ?int
    {
        $date = \DateTime::createFromFormat($format, $dateString);

        if ($date && $date->format($format) === $dateString) {
            return $date->getTimestamp();
        }

        return null;
    }
}
