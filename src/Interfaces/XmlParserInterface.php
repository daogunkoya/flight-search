<?php

namespace App\Interfaces;

interface XmlParserInterface
{
public function parseXml(string $xmlString): array;
}