<?php

use PHPUnit\Framework\TestCase;
use App\Services\FlightSearchService;

class FlightSearchServiceTest extends TestCase
{
    public function testSearchFlights()
    {
        $departureCode = 'LHR';
        $destinationCode = 'AMS';
        $departureDate = 1743789600; // Example timestamp

        $config = require 'config.php';
        $mockApiKey = $config['api_key'];

        $mockResponse = '<?xml version="1.0" encoding="utf-8"?>
        <Flights searchid="12345">
            <Flight>
                <DepartureCode>LHR</DepartureCode>
                <DestinationCode>AMS</DestinationCode>
                <DepartureDateTime>1743789600</DepartureDateTime>
                <ArrivalDateTime>1744394400</ArrivalDateTime>
                <Airline>BA</Airline>
                <Price>243.50</Price>
            </Flight>
        </Flights>';

        $mockedService = $this->getMockBuilder(FlightSearchService::class)
            ->setConstructorArgs([$mockApiKey])
            ->onlyMethods(['fetchData'])
            ->getMock();

        $mockedService->method('fetchData')->willReturn($mockResponse);

        $flights = $mockedService->searchFlights($departureCode, $destinationCode, $departureDate);

        $expected = '<?xml version="1.0" encoding="utf-8"?>
        <Flights searchid="12345">
            <Flight>
                <DepartureCode>LHR</DepartureCode>
                <DestinationCode>AMS</DestinationCode>
                <DepartureDateTime>1743789600</DepartureDateTime>
                <ArrivalDateTime>1744394400</ArrivalDateTime>
                <Airline>BA</Airline>
                <Price>243.50</Price>
            </Flight>
        </Flights>';

        $this->assertEquals($expected, $flights);
    }
}
