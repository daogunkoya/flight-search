<?php

use PHPUnit\Framework\TestCase;
use App\Services\XmlParser;

class XmlParserTest extends TestCase
{
    public function testParseXml()
    {
        $xmlString = '<?xml version="1.0" encoding="utf-8"?>
        <Flights searchid="12345">
            <Flight>
                <Airline>BA</Airline>
                <DepartureDateTime>1743789600</DepartureDateTime>
                <ArrivalDateTime>1744394400</ArrivalDateTime>
                <Price>243.50</Price>
            </Flight>
        </Flights>';

        $parser = new XmlParser();
        $flightsData = $parser->parseXml($xmlString);

        $expected = [
            'searchId' => '12345',
            'flights' => [
                [
                    'flightNumber' => 'BA',
                    'departureTime' => 1743789600,
                    'arrivalTime' => 1744394400,
                    'price' => 243.50,
                ],
            ],
        ];

        $this->assertEquals($expected, $flightsData);
    }
}
